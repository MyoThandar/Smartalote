<?php
App::uses('MasterAppController', 'Controller');
class MasterprofilesController extends MasterAppController {
	public $components = array('OptionCommon');
	public $uses = array('CmpHeadhunter','HeadhunterOtherLanguage','Region','IndustryBig','IndustrySmall','Occupation','TransactionManager');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'master';
	}

	public function companyBrowse($id) {
		$employeee = $this->OptionCommon->employee;
		$mail_transmission = $this->OptionCommon->mail_transmission;
		$regionname = '' ;
		$big = '' ;

		if (!$id) {
			$this->Session->setFlash('Enter company ID。', "error");
			$this->redirect(array('action' => 'index'));
		}
		$cmpdata = $this->CmpHeadhunter->findByid($id);

		$reg = $this->Region->findByid($cmpdata['CmpHeadhunter']['region']);
		if (!empty($reg)) {
			$regionname = $reg['Region']['name'];
		}

		if (!empty($cmpdata['CmpHeadhunter']['number_of_employee'])) {
			$emp_number = $employeee[$cmpdata['CmpHeadhunter']['number_of_employee']];
		}

		$small = $cmpdata['CmpHeadhunter']['industry_small'];
		$industry_data = $this->IndustrySmall->findById($small);

		$this->set(compact('cmpdata','regionname','emp_number','industry_data','mail_transmission'));
	}

	public function companyEdit($id = null) {
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->next_three_years();
		$employee= $this->OptionCommon->employee;
		$mail_transmission = $this->OptionCommon->mail_transmission;
		$cbox_error = '';

		// find company profile.
		$cmpheadhunter = $this->CmpHeadhunter->findById($id);
		$image = $cmpheadhunter['CmpHeadhunter']['logo'];

		if (!empty($cmpheadhunter['CmpHeadhunter']['establishment'])) {
			$estiblished_date = explode('-', $cmpheadhunter['CmpHeadhunter']['establishment']);
			$cmpheadhunter['CmpHeadhunter']['day'] = $estiblished_date[2];
			$cmpheadhunter['CmpHeadhunter']['month'] = $estiblished_date[1];
			$cmpheadhunter['CmpHeadhunter']['year'] = $estiblished_date[0];
		}

		// insert line break in overview.
		$overview_text = $cmpheadhunter['CmpHeadhunter']['overview'];
		$breaks = array("<br />","<br />");
		$cmpheadhunter['CmpHeadhunter']['overview'] = str_ireplace($breaks, "\r\n", $overview_text);

		// find small industry.
		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
		));

		// find big industry.
		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		// find region.
		$region = $this->Region->find('list',array('fields' => 'name'));

		$this->set(compact('cmpheadhunter','region','big_industry','small_industry','estiblished_date','dmonth','day','month','year','error','mail_transmission','employee','password','nmonth','cbox_error','image'));

		if (!$this->request->data) {
			$this->request->data = $cmpheadhunter;
		}

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				if (!empty($this->request->data['CmpHeadhunter']['password_update'])) {
					$this->request->data['CmpHeadhunter']['password'] = $this->request->data['CmpHeadhunter']['password_update'];
				}

				if (
					!empty($this->request->data['CmpHeadhunter']['year']) ||
					!empty($this->request->data['CmpHeadhunter']['month']) ||
					!empty($this->request->data['CmpHeadhunter']['day']))
				{
					// validate the establishment date.
					$year = $this->request->data['CmpHeadhunter']['year'];
					$month = $this->request->data['CmpHeadhunter']['month'];
					$day = $this->request->data['CmpHeadhunter']['day'];

					$this->request->data['CmpHeadhunter']['establishment'] = $year . '-' . $month . '-' . $day;
				} else {
					$this->request->data['CmpHeadhunter']['establishment'] = '';
				}

				// validate the upload file.
				if (!empty($this->request->data['CmpHeadhunter']['logo']['name'])) {
					$this->request->data['CmpHeadhunter']['tmpName'] = $this->request->data['CmpHeadhunter']['logo']['tmp_name'];
					$tmpName = $this->request->data['CmpHeadhunter']['logo']['tmp_name'];
					$name = $this->request->data['CmpHeadhunter']['logo']['name'];
					unset($this->request->data['CmpHeadhunter']['logo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('cologo', $this->request->data['CmpHeadhunter'])) {
					$name = $this->request->data['CmpHeadhunter']['cologo'];
					unset($this->request->data['CmpHeadhunter']['logo']);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('image', $this->request->data['CmpHeadhunter'])) {
					$name = $this->request->data['CmpHeadhunter']['image'];
					unset($this->request->data['CmpHeadhunter']['logo']);
					$this->request->data['CmpHeadhunter']['logo'] = $name;
				}

				if (!empty($this->request->data['CmpHeadhunter']['big_label'])) {
					$this->request->data['CmpHeadhunter']['industry_big'] = $this->request->data['CmpHeadhunter']['big_label'];
				}

				$jobs = $this->Occupation->find('list',array(
							'conditions' => array(
								'Occupation.ch_id' => $id,
								'Occupation.deleted' => 0
								),
							'fields' => 'Occupation.id'
							)
						);

				$this->request->data['CmpHeadhunter']['id'] = $id;

				if (!$this->CmpHeadhunter->save($this->request->data)) {
					// make changes in validationErrors message.
					if (array_key_exists('establishment', $this->CmpHeadhunter->validationErrors)) {
						$this->CmpHeadhunter->validationErrors['day'] = $this->CmpHeadhunter->validationErrors['establishment'];
						unset($this->CmpHeadhunter->validationErrors['establishment']);
					}

					$this->set('cbox_error','error', 'true');
					throw new Exception('ERROR COULD NOT EDIT');
				}

				// Update industry big id and small id in Occupation table
				if (!empty($jobs)) {
					$details = array(
						'industry_big_id' => $this->request->data['CmpHeadhunter']['industry_big'],
						'industry_small_id' => $this->request->data['CmpHeadhunter']['industry_small']
					);
					$this->Occupation->updateAll($details,array('Occupation.id' => $jobs));
				}

				$this->TransactionManager->commit($transaction);

			} catch (Exception $e) {
				$image = $this->request->data['CmpHeadhunter']['logo'];
				$text = $this->request->data['CmpHeadhunter']['overview'];
				$breaks = array("<br />");
				$this->request->data['CmpHeadhunter']['overview'] = str_ireplace($breaks, "\r\n", $text);
				$requestData = $this->request->data;
				$this->set(compact('image', 'requestData','image'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}
			$this->redirect(array('controller' => 'Masterprofiles', 'action' => 'companyBrowse',$id));
		}
	}

	public function headhunterBrowse($id) {
		$edu = '' ;
		$regionname = '' ;
		$small = '' ;
		$bskill = '' ;
		$eskill = '' ;
		$cskill = '' ;
		$jskill = '' ;
		$monthly_mail = 0 ;

		if (!$id) {
			$this->Session->setFlash('Enter company ID。', "error");
			$this->redirect(array('action' => 'index'));
		}
		$education = $this->OptionCommon->education;
		$language_skill = $this->OptionCommon->headhunter_language_skill;
		$language = $this->OptionCommon->language;
		$mail_transmission = $this->OptionCommon->mail_transmission;

		$cmpdata = $this->CmpHeadhunter->findByid($id);

		if (!empty($cmpdata['CmpHeadhunter']['education'])) {
			$edu = $education[$cmpdata['CmpHeadhunter']['education']] ;
		}
		if (!empty($cmpdata['CmpHeadhunter']['region'])) {
			$reg = $this->Region->findByid($cmpdata['CmpHeadhunter']['region']);
			if (!empty($reg)) {
				$regionname = $reg['Region']['name'];
			}
		}

		$big_industry = $this->IndustryBig->find('all',array(
			'fields' => array('label')));

		$big_data = rtrim($cmpdata['CmpHeadhunter']['industry_big'],",");
		$big = explode(',', $big_data);
		$array1 = array();
		foreach ($big_industry as $key => $value) {
			$array1[$value['IndustryBig']['id']] = $value['IndustryBig']['label'];
		}

		if (!empty($cmpdata['CmpHeadhunter']['burmese_level'])) {
			$bskill = $language_skill[$cmpdata['CmpHeadhunter']['burmese_level']] ;
		}
		if (!empty($cmpdata['CmpHeadhunter']['english_level'])) {
			$eskill = $language_skill[$cmpdata['CmpHeadhunter']['english_level']] ;
		}
		if (!empty($cmpdata['CmpHeadhunter']['chinese_level'])) {
			$cskill = $language_skill[$cmpdata['CmpHeadhunter']['chinese_level']] ;
		}
		if (!empty($cmpdata['CmpHeadhunter']['japanese_level'])) {
			$jskill = $language_skill[$cmpdata['CmpHeadhunter']['japanese_level']] ;
		}

		$this->set(compact('cmpdata','regionname','edu','big','small','bskill','eskill','cskill','jskill','mail_transmission','language_skill','language','monthly_mail','big_industry','array1'));
	}

	public function headhunterEdit($id= null) {
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->next_three_years();
		$language = $this->OptionCommon->language;
		$industry= $this->OptionCommon->industry;
		$education= $this->OptionCommon->education;
		$language_skill= $this->OptionCommon->language_skill;
		$mail_transmission= $this->OptionCommon->mail_transmission;
		$bindustry = '' ;
		$sindustry = '' ;
		$cbox_error = '' ;
		$company = '' ;

		$location = $this->Region->find('all',array('fields' => 'name'));
		foreach ($location as $lockey => $locvalue) {
			$location[$lockey] = $locvalue['Region']['name'];
		}

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		$error = false;
		$cmp_data = $this->CmpHeadhunter->findById($id);
		$companyId = $cmp_data['CmpHeadhunter']['company_id'];

		$big = rtrim($cmp_data['CmpHeadhunter']['industry_big'],',');
		$industry_big = explode(',',$big);

		$image = $cmp_data['CmpHeadhunter']['logo'];

		if (!empty($cmp_data['CmpHeadhunter']['establishment'])) {
			$estiblished_date = explode('-', $cmp_data['CmpHeadhunter']['establishment']);
			// $cut_day = substr($estiblished_date[2], 0, strpos($estiblished_date[2], ' '));
			$cmp_data['CmpHeadhunter']['day'] = $estiblished_date[2];
			$cmp_data['CmpHeadhunter']['month'] = $estiblished_date[1];
			$cmp_data['CmpHeadhunter']['year'] = $estiblished_date[0];
		}

		if (!$this->request->data) {
			$this->request->data = $cmp_data;
			$this->request->data['CmpHeadhunter']['industry_big'] = $industry_big;
			$industry_str = '' ;
			$loc = $this->request->data['CmpHeadhunter']['location'];
			$edu = $this->request->data['CmpHeadhunter']['education'];
		}

		$this->set(compact('month','day','year','industry','rday','rmonth','ryear','rindustry','location', 'big_industry', 'loc','UserCode','education','edu','language_skill', 'error','mail_transmission', 'language','cmp_data','day_select','year_select','month_select','cbox_error','company','image','industry_big','companyId'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();
				if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
					$industry1 = $this->request->data['CmpHeadhunter']['industry_big'];
				}

				if (!empty($this->request->data['CmpHeadhunter']['password_update'])) {
					$this->request->data['CmpHeadhunter']['password'] = $this->request->data['CmpHeadhunter']['password_update'];
				}

				if (
					!empty($this->request->data['CmpHeadhunter']['year']) ||
					!empty($this->request->data['CmpHeadhunter']['month']) ||
					!empty($this->request->data['CmpHeadhunter']['day']))
				{
					// validate the establishment date.
					$year = $this->request->data['CmpHeadhunter']['year'];
					$month = $this->request->data['CmpHeadhunter']['month'];
					$day = $this->request->data['CmpHeadhunter']['day'];

					$this->request->data['CmpHeadhunter']['establishment'] = $year . '-' . $month . '-' . $day;
				} else {
					$this->request->data['CmpHeadhunter']['establishment'] = '';
				}

				// validate the upload file.
				if (!empty($this->request->data['CmpHeadhunter']['logo']['name'])) {
					$tmpName = $this->request->data['CmpHeadhunter']['logo']['tmp_name'];
					$name = $this->request->data['CmpHeadhunter']['logo']['name'];
					unset($this->request->data['CmpHeadhunter']['logo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('cologo', $this->request->data['CmpHeadhunter'])) {
					$name = $this->request->data['CmpHeadhunter']['cologo'];
					unset($this->request->data['CmpHeadhunter']['logo']);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('image', $this->request->data['CmpHeadhunter'])) {
					$name = $this->request->data['CmpHeadhunter']['image'];
					unset($this->request->data['CmpHeadhunter']['logo']);
					$this->request->data['CmpHeadhunter']['logo'] = $name;
				}

				if (!empty($this->request->data['CmpHeadhunter']['big_label'])) {
					$this->request->data['CmpHeadhunter']['industry_big'] = $this->request->data['CmpHeadhunter']['big_label'];
				}

				$deleted = $this->HeadhunterOtherLanguage->find('all',array(
					'conditions' => array(
						'cmp_headhunter_id' => $id
					)
				));
				if (!empty($deleted)) {
					$this->HeadhunterOtherLanguage->deleteAll(array('HeadhunterOtherLanguage.cmp_headhunter_id' => $id));
				}

				if (!empty($this->request->data['CmpHeadhunter']['about'])) {
					$this->request->data['CmpHeadhunter']['about'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['about']);
				}
				if (!empty($this->request->data['CmpHeadhunter']['profile'])) {
					$this->request->data['CmpHeadhunter']['profile'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['profile']);
				}
				if (!empty($this->request->data['CmpHeadhunter']['self_pr'])) {
					$this->request->data['CmpHeadhunter']['self_pr'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['self_pr']);
				}

				$industryString = '';
				if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
					foreach ($this->request->data['CmpHeadhunter']['industry_big'] as $bigkey => $bigvalue) {
						$industryString .= $bigvalue.',';
					}
				}
				$this->request->data['CmpHeadhunter']['industry_big'] = $industryString ;

				/* Validate remove */
				$validateAttrKey = array('representative_postion', 'representative_name', 'hp_address', 'capital','number_of_employee','contact_position','contact_name');
				foreach ($validateAttrKey as $key => $value) {
					$this->CmpHeadhunter->validator()->remove($value);
				}

				$this->request->data['CmpHeadhunter']['id'] = $id;
				if (!$this->CmpHeadhunter->saveAssociated($this->request->data, array('deep' => true))) {
					if (array_key_exists('establishment', $this->CmpHeadhunter->validationErrors)) {
						$this->CmpHeadhunter->validationErrors['day'] = $this->CmpHeadhunter->validationErrors['establishment'];
						unset($this->CmpHeadhunter->validationErrors['establishment']);
					}
					$this->set('cbox_error','error', 'true');
					throw new Exception('ERROR COULD NOT ADD CMPHEADHUNTER DATA');
				}
				$this->TransactionManager->commit($transaction);
			} catch (Exception $e) {

				if (empty($this->request->data['CmpHeadhunter']['company_name'])) {
					$company = 'empty' ;
				}
				$image = empty($this->request->data['CmpHeadhunter']['logo']['name']) ? $this->request->data['CmpHeadhunter']['image'] : $this->request->data['CmpHeadhunter']['logo']['name'];
				$requestData = $this->request->data;
				$this->set(compact('image', 'requestData','company','big','industry1','companyId'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}
			$this->redirect(array('controller' => 'Masterprofiles', 'action' => 'headhunterBrowse',$id));
		}

	}

	private function __convertToValidationErrors($errors) {
		foreach ($errors as $key => $val) {
			$this->CmpHeadhunter->validationErrors[$key] = $val;
		}
	}
}