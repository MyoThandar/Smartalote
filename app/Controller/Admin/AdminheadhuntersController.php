<?php
App::uses('AdminAppController', 'Controller');
class AdminheadhuntersController extends AdminAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('CmpHeadhunter','Region','IndustryBig','IndustrySmall', 'TransactionManager','HeadhunterOtherLanguage','Message');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$status = !empty($this->request->query['status']) ? trim($this->request->query['status']) : '';
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';

		if ($status == 1) { //Active company list
			$condition = array(
				'CmpHeadhunter.type' => 0,
				'CmpHeadhunter.deactivate' => 0,
				'CmpHeadhunter.deleted' => 0
			);
		} elseif ($status == 2) { //Deactivated company list
			$condition = array(
				'CmpHeadhunter.type' => 0,
				'CmpHeadhunter.deactivate' => 1,
				'CmpHeadhunter.deleted' => 0
			);
		} else {
			$condition = array(
				array(
					'CmpHeadhunter.type ' => 0,
					'CmpHeadhunter.deleted' => 0
				),
				'OR' => array(
					array('CmpHeadhunter.company_id LIKE' => '%'.$keyword.'%'),
					array('CmpHeadhunter.company_name LIKE' => '%'.$keyword.'%'),
					array('CmpHeadhunter.headhunter_name LIKE' => '%'.$keyword.'%'),
					array('CmpHeadhunter.mobile LIKE' => '%'.$keyword.'%'),
					array('CmpHeadhunter.company_phone LIKE' => '%'.$keyword.'%'),
					array('CmpHeadhunter.email LIKE' => '%'.$keyword.'%')
				)
			);
		}

		$this->paginate = array(
				'paramType' => 'querystring',
				'limit' => $limit,
				'order' => array('id' => 'DESC'),
				'conditions' => $condition
			);

		$pag = $this->paginate('CmpHeadhunter');
		$this->set(compact('pag','limit'));
	}

	public function add() {
		$this->layout = 'admin';
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->next_three_years();
		$language = $this->OptionCommon->language;
		$industry = $this->OptionCommon->industry;
		$education = $this->OptionCommon->education;
		$language_skill = $this->OptionCommon->language_skill;
		$headhunter_language_skill = $this->OptionCommon->headhunter_language_skill;
		$mail_transmission= $this->OptionCommon->mail_transmission;
		$bindustry = '' ;
		$sindustry = '' ;

		$dblocation = $this->Region->find('all',array( //region select
			'fields' => 'name'));
		$location = array();
		$locationckey = 1 ;
		foreach ($dblocation as $lockey => $locvalue) {
			$location[$locationckey] = $locvalue['Region']['name'];
			$locationckey++;
		}

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		if (!empty($cmpdata['CmpHeadhunter']['establishment'])) {
			$estiblished_date = explode('-', $cmpdata['CmpHeadhunter']['establishment']);
			$cut_day = substr($estiblished_date[2], 0, strpos($estiblished_date[2], ' '));
			$cmpdata['CmpHeadhunter']['day'] = $cut_day;
			$cmpdata['CmpHeadhunter']['month'] = $estiblished_date[1];
			$cmpdata['CmpHeadhunter']['year'] = $estiblished_date[0];
		}

		$error = false;
		$company = '' ;
		if (!empty($this->request->data['CmpHeadhunter']['company_name'])) {
			$company = $this->request->data['CmpHeadhunter']['company_name'];
		}
		if (!empty($this->request->data)) {
			$bigarr = $this->request->data['CmpHeadhunter']['industry_big'];
			$loc = $this->request->data['CmpHeadhunter']['location'];
			$edu = $this->request->data['CmpHeadhunter']['education'];
			$logo = $this->request->data['CmpHeadhunter']['logo']['name'];
			if (!empty($this->request->data['CmpHeadhunter']['small_label'])) {
				$sindustry = $this->request->data['CmpHeadhunter']['small_label'];
			}
		}
		$lastcompanyID = $this->CmpHeadhunter->find('first',array('conditions' => array('type' => 0), 'order' => array('id' => 'DESC'),'fields' => 'company_id'));
		if (!empty($lastcompanyID['CmpHeadhunter']['company_id'])){
			$temp = substr($lastcompanyID['CmpHeadhunter']['company_id'], 2);
			$num = $temp+1;
			$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'HH';
		$UserCode = $prefix.$CompanyID;
		if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
			$industry1 = $this->request->data['CmpHeadhunter']['industry_big'];
		}

		$this->set(compact('month','day','year','industry','rday','rmonth','ryear','rindustry','location', 'big_industry', 'small_industry', 'loc','UserCode','education','edu','language_skill', 'error','mail_transmission', 'language','company','headhunter_language_skill','industry1'));

		if ($this->request->is(array('post', 'put'))) {

			// remove validate
			$validateAttrKey = array(
				'representative_postion',
				'representative_name',
				'hp_address',
				'capital',
				'number_of_employee',
				'contact_position',
				'contact_name'
			);

			foreach ($validateAttrKey as $key => $value) {
				$this->CmpHeadhunter->validator()->remove($value);
			}

			$this->request->data['CmpHeadhunter']['company_id'] = $UserCode;
			$this->request->data['CmpHeadhunter']['type'] = 0;

			try {
				$transaction = $this->TransactionManager->begin();

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
				}

				// validate the upload file.
				if (!empty($this->request->data['CmpHeadhunter']['logo']['name'])) {
					$tmpName = $this->request->data['CmpHeadhunter']['logo']['tmp_name'];
					$name = $this->request->data['CmpHeadhunter']['logo']['name'];
					unset($this->request->data['CmpHeadhunter']['logo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('image', $this->request->data['CmpHeadhunter'])) {
					$name = $this->request->data['CmpHeadhunter']['image'];
					unset($this->request->data['CmpHeadhunter']['logo']);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				}

				$industry_str = '' ;

				if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
					foreach ($this->request->data['CmpHeadhunter']['industry_big'] as $bigkey => $bigvalue) {
						$industry_str .= $bigvalue . ',';
					}
				}

				$this->request->data['CmpHeadhunter']['industry_big'] = $industry_str ;

				$this->request->data['CmpHeadhunter']['about'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['about']);
				$this->request->data['CmpHeadhunter']['profile'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['profile']);
				$this->request->data['CmpHeadhunter']['self_pr'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['self_pr']);

				// Total mail and available mail If number of mail transmission was  chosen
				if (!empty($this->request->data['CmpHeadhunter']['mail_limit'])) {
					$total = explode(' ', $mail_transmission[$this->request->data['CmpHeadhunter']['mail_limit']]);
					$this->request->data['CmpHeadhunter']['total_mail'] = $total[0];
					$this->request->data['CmpHeadhunter']['avaliable_mail'] = $this->request->data['CmpHeadhunter']['total_mail'];
				}

				$this->CmpHeadhunter->create();
				if (!$this->CmpHeadhunter->saveAssociated($this->request->data, array('deep' => true))) {

					if (array_key_exists('establishment', $this->CmpHeadhunter->validationErrors)) {
						$this->CmpHeadhunter->validationErrors['day'] = $this->CmpHeadhunter->validationErrors['establishment'];
						unset($this->CmpHeadhunter->validationErrors['establishment']);
					}

					$this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$about = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['about']);
				$profile = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['profile']);
				$self_pr = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['self_pr']);

				$this->request->data['CmpHeadhunter']['industry_big'] = $bigarr;
				$image = $this->request->data['CmpHeadhunter']['logo'];
				$requestData = $this->request->data;

				if (empty($this->request->data['CmpHeadhunter']['company_name'])) {
					$company = 'empty' ;
				}

				$this->set(compact('image', 'requestData','company', 'industry1', 'about', 'profile', 'self_pr'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}
		}
	}

	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR MASTER USER ID NOT EXISTS');
			}
			$this->CmpHeadhunter->id = $id;
			if (!$this->CmpHeadhunter->exists()) {
				throw new Exception('ERROR MASTER USER NOT EXISTS');
			}
			if (!$this->CmpHeadhunter->save(array('CmpHeadhunter' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE MASTER USER');
			}
			$this->TransactionManager->commit($transaction);
		} catch (Exception $e) {
			$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
			$this->log($e->getMessage(), LOG_ERR);
			$this->TransactionManager->rollback($transaction);
			$this->redirect(array('action' => 'index'));
		}
		$this->redirect(array('action' => 'index'));
	}

	public function approved($id = null) {
		$approved = $this->CmpHeadhunter->findById($id);
		$this->CmpHeadhunter->id = $id;
		if ($approved['CmpHeadhunter']['deactivate'] == true) {
			$this->CmpHeadhunter->saveField('deactivate', '0');
		} else {
			if (!$this->CmpHeadhunter->save(array('CmpHeadhunter' => array('deactivate' => 1, 'deactivate_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP MASTER USER');
			}
		}
		$this->redirect( array('action' => 'index'));
	}

	public function browse($id) {
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
		$main_language_skill = $this->OptionCommon->language_skill;
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
			$bskill = $main_language_skill[$cmpdata['CmpHeadhunter']['burmese_level']] ;
		}
		if (!empty($cmpdata['CmpHeadhunter']['english_level'])) {
			$eskill = $main_language_skill[$cmpdata['CmpHeadhunter']['english_level']] ;
		}
		if (!empty($cmpdata['CmpHeadhunter']['chinese_level'])) {
			$cskill = $main_language_skill[$cmpdata['CmpHeadhunter']['chinese_level']] ;
		}
		if (!empty($cmpdata['CmpHeadhunter']['japanese_level'])) {
			$jskill = $main_language_skill[$cmpdata['CmpHeadhunter']['japanese_level']] ;
		}

		$this->set(compact('cmpdata','regionname','edu','big','small','bskill','eskill','cskill','jskill','mail_transmission','main_language_skill','language_skill','language','monthly_mail','big_industry','array1'));
	}

	public function edit($id) {
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->next_three_years();
		$language = $this->OptionCommon->language;
		$education= $this->OptionCommon->education;
		$language_skill= $this->OptionCommon->language_skill;
		$headhunter_language_skill= $this->OptionCommon->headhunter_language_skill;
		$mail_transmission= $this->OptionCommon->mail_transmission;
		$bindustry = '' ;
		$sindustry = '' ;
		$cbox_error = '' ;
		$company = '';

		$location = $this->Region->find('all',array(
			'fields' => 'name'
		));

		foreach ($location as $lockey => $locvalue) {
			$location[$lockey] = $locvalue['Region']['name'];
		}

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		$company = '' ;
		if (!empty($this->request->data['CmpHeadhunter']['company_name'])) {
			$company = $this->request->data['CmpHeadhunter']['company_name'];
		}

		$error = false;
		$cmp_data = $this->CmpHeadhunter->findById($id);
		$companyId = $cmp_data['CmpHeadhunter']['company_id'];

		if (!empty($cmp_data)) {
			$company = $cmp_data['CmpHeadhunter']['company_name'] ;
		}

		if (!empty($this->request->data['CmpHeadhunter']['company_name'])) {
			$company = $this->request->data['CmpHeadhunter']['company_name'];
		} elseif ($this->request->data) {
			$company = '';
		}

		$big = rtrim($cmp_data['CmpHeadhunter']['industry_big'],',');
		$industry_big = explode(',',$big);

		if (!empty($cmp_data['CmpHeadhunter']['establishment'])) {
			$estiblished_date = explode('-', $cmp_data['CmpHeadhunter']['establishment']);
			$cut_day = substr($estiblished_date[2], 0, strpos($estiblished_date[2], ' '));
			$cmp_data['CmpHeadhunter']['day'] = $estiblished_date[2];
			$cmp_data['CmpHeadhunter']['month'] = $estiblished_date[1];
			$cmp_data['CmpHeadhunter']['year'] = $estiblished_date[0];
		}

		if (!$this->request->data) {
			unset($cmp_data['CmpHeadhunter']['mail_limit']);
			$this->request->data = $cmp_data;
			$this->request->data['CmpHeadhunter']['industry_big'] = $industry_big;
			$industry_str = '' ;
			$loc=$this->request->data['CmpHeadhunter']['location'];
			$edu=$this->request->data['CmpHeadhunter']['education'];
		}

		$this->set(compact('month','day','year','industry','rday','rmonth','ryear','rindustry','location', 'big_industry','loc','UserCode','education','edu','language_skill', 'error','mail_transmission', 'language','cmp_data','day_select','year_select','month_select','cbox_error','industry_big','company','headhunter_language_skill','profile','self_pr','about','companyId'));

		if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
			$industry1 = $this->request->data['CmpHeadhunter']['industry_big'];
		}

		if ($this->request->is(array('post', 'put'))) {
			// remove validate
			$validateAttrKey = array(
				'contact_position',
				'contact_name',
				'representative_postion',
				'representative_name',
				'hp_address',
				'capital',
				'number_of_employee',
				'password',
				'confirm_password'
			);

			foreach ($validateAttrKey as $key => $value) {
				$this->CmpHeadhunter->validator()->remove($value);
			}

			if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
				$industry1 = $this->request->data['CmpHeadhunter']['industry_big'];
			}

			try {
				$transaction = $this->TransactionManager->begin();
				$this->request->data['CmpHeadhunter']['id'] = $id;

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

				$deleted = $this->HeadhunterOtherLanguage->find('all',array(
					'conditions' => array(
						'cmp_headhunter_id' => $id
					)
				));

				if (!empty($deleted)) {
					$this->HeadhunterOtherLanguage->deleteAll(array('HeadhunterOtherLanguage.cmp_headhunter_id' => $id));
				}

				$industry_str = '' ;
				if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
					foreach ($this->request->data['CmpHeadhunter']['industry_big'] as $bigkey => $bigvalue) {
						$industry_str .= $bigvalue.',';
					}
				}

				$this->request->data['CmpHeadhunter']['industry_big'] = $industry_str ;

				if (!empty($this->request->data['CmpHeadhunter']['about'])) {
					$this->request->data['CmpHeadhunter']['about'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['about']);
				}
				if (!empty($this->request->data['CmpHeadhunter']['profile'])) {
					$this->request->data['CmpHeadhunter']['profile'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['profile']);
				}
				if (!empty($this->request->data['CmpHeadhunter']['self_pr'])) {
					$this->request->data['CmpHeadhunter']['self_pr'] = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['self_pr']);
				}

				if ($this->request->data['CmpHeadhunter']['independents'] == 1) {
					$this->request->data['CmpHeadhunter']['company_name'] = null;
					$this->CmpHeadhunter->validator()->remove('company_name');
				}

				// Total mail and available mail If number of mail transmission was chosen
				if (!empty($this->request->data['CmpHeadhunter']['mail_limit'])) {
					$total = explode(' ', $mail_transmission[$this->request->data['CmpHeadhunter']['mail_limit']]);
					$this->request->data['CmpHeadhunter']['total_mail'] = $cmp_data['CmpHeadhunter']['total_mail'] + $total[0];
					$this->request->data['CmpHeadhunter']['avaliable_mail'] = $this->request->data['CmpHeadhunter']['total_mail'] - $cmp_data['CmpHeadhunter']['sent_mail'];
				}

				$this->CmpHeadhunter->create();
				if (!$this->CmpHeadhunter->saveAssociated($this->request->data, array('deep' => true))) {
					if (array_key_exists('establishment', $this->CmpHeadhunter->validationErrors)) {
						$this->CmpHeadhunter->validationErrors['day'] = $this->CmpHeadhunter->validationErrors['establishment'];
						unset($this->CmpHeadhunter->validationErrors['establishment']);
					}
					$this->set('cbox_error','error', 'true');
					throw new Exception('ERROR COULD NOT ADD CMPHEADHUNTER DATA');
				}
				$this->TransactionManager->commit($transaction);
				$this->Session->setFlash('Successfully edited headhunter', 'success');
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$big_array = array();
				if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
					$this->request->data['CmpHeadhunter']['industry_big'] = rtrim($this->request->data['CmpHeadhunter']['industry_big'],',');
					$big_array = explode(',', $this->request->data['CmpHeadhunter']['industry_big']) ;
				}
				$this->request->data['CmpHeadhunter']['industry_big'] = $big_array ;
				if (empty($this->request->data['CmpHeadhunter']['company_name'])) {
					$company = 'empty' ;
				}
				$about = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['about']);
				$profile = str_replace('<br />', PHP_EOL, $this->request->data['CmpHeadhunter']['profile']);
				$self_pr = $this->request->data['CmpHeadhunter']['self_pr'];

				$image = $this->request->data['CmpHeadhunter']['logo'];
				$requestData = $this->request->data;
				$this->set(compact('image', 'requestData','company','about','profile','self_pr'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				$this->Session->setFlash('Couldn\'t edit headhunter', 'error');
				return;
			}
		}
	}

	private function __convertToValidationErrors($errors) {
		foreach ($errors as $key => $val) {
			$this->CmpHeadhunter->validationErrors[$key] = $val;
		}
	}
}