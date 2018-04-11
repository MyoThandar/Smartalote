<?php
App::uses('AdminAppController', 'Controller');
class AdminCompanysController extends AdminAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('CmpHeadhunter','Region','IndustryBig','IndustrySmall','TransactionManager','Message');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$status = !empty($this->request->query['status']) ? trim($this->request->query['status']) : '';
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$condition = array();

		if ($status == 1) { //Active company list
			$condition = array(
				'CmpHeadhunter.type ' => 1 ,
				'CmpHeadhunter.deactivate ' => 0,
				'CmpHeadhunter.deleted ' => 0
			) ;
		} elseif ($status == 2) { //Deactivated company list
			$condition = array(
				'CmpHeadhunter.type ' => 1 ,
				'CmpHeadhunter.deactivate ' => 1,
				'CmpHeadhunter.deleted ' => 0
			) ;
		} else {
			$condition = array(
				array(
					'CmpHeadhunter.type ' => 1,
					'CmpHeadhunter.deleted ' => 0
				),
				'OR' => array(
					array('CmpHeadhunter.company_id LIKE' => '%'. $keyword .'%'),
					array('CmpHeadhunter.company_name LIKE' => '%'. $keyword .'%'),
					array('CmpHeadhunter.contact_name LIKE' => '%'. $keyword .'%'),
					array('CmpHeadhunter.company_phone LIKE' => '%'. $keyword .'%'),
					array('CmpHeadhunter.email LIKE' => '%'. $keyword .'%')
				)
			) ;
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
		if ($approved['CmpHeadhunter']['deactivate'] == true){
			$this->CmpHeadhunter->saveField('deactivate', '0');
		} else {
			if (!$this->CmpHeadhunter->save(array('CmpHeadhunter' => array('deactivate' => 1, 'deactivate_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP MASTER USER');
			}
		}
		$this->redirect( array('action' => 'index'));
	}

	public function add() {
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->next_three_years();
		$employee= $this->OptionCommon->employee;
		$mail_transmission = $this->OptionCommon->mail_transmission;

		$bindustry = '' ;
		$sindustry = '' ;
		$unformat_num = '' ;

		$lastcompanyID = $this->CmpHeadhunter->find('first',array('conditions' => array('type' => 1), 'order' => array('id' => 'DESC'),'fields' => 'company_id'));

		if (!empty($lastcompanyID['CmpHeadhunter']['company_id'])) {
			$temp = substr($lastcompanyID['CmpHeadhunter']['company_id'], 2);
			$num = $temp+1;
			$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);
		} else {
			$num = 1;
			$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);
		}
		$prefix = 'CO';
		$UserCode = $prefix.$CompanyID;

		$location_list = $this->Region->find('all',array(
			'fields' => 'name'));
		foreach ($location_list as $lockey => $locvalue) {
			$location[$lockey+1] =  $locvalue['Region']['name'];
		}

		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
		));

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		$error = false;

		if (!empty($this->request->data)) {

			$remployee=$this->request->data['CmpHeadhunter']['number_of_employee'];
			$loc=$this->request->data['CmpHeadhunter']['region'];
			$logo=$this->request->data['CmpHeadhunter']['logo']['name'];

			if (!empty($this->request->data['CmpHeadhunter']['small_label'])) {
				$sindustry = $this->request->data['CmpHeadhunter']['small_label'];
			}

			if (!empty($this->request->data['CmpHeadhunter']['capital']) && is_numeric($this->request->data['CmpHeadhunter']['capital']) ) {
				$unformat_num = $this->request->data['CmpHeadhunter']['capital'] ;
				$format_num = number_format($this->request->data['CmpHeadhunter']['capital']);
				$this->request->data['CmpHeadhunter']['capital']= $format_num;
			}
		}

		$this->set(compact('employee','remployee','rday','rmonth','ryear','day','month','year','location','loc','big_industry','small_industry','smallinlabel','UserCode', 'error','mail_transmission','logo','unformat_num','mon'));

		if ($this->request->is(array('post', 'put'))) {

			$this->CmpHeadhunter->validator()->remove('headhunter_name');
			$this->CmpHeadhunter->validator()->remove('education');
			$this->CmpHeadhunter->validator()->remove('about');
			$this->CmpHeadhunter->validator()->remove('language');

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

				$this->request->data['CmpHeadhunter']['company_id'] = $UserCode;
				$this->request->data['CmpHeadhunter']['deactivate'] = 0;
				$this->request->data['CmpHeadhunter']['type'] = 1;

				// Total mail and available mail If number of mail transmission was chosen
				if (!empty($this->request->data['CmpHeadhunter']['mail_limit'])) {
					$total = explode(' ', $mail_transmission[$this->request->data['CmpHeadhunter']['mail_limit']]);
					$this->request->data['CmpHeadhunter']['total_mail'] = $total[0];
					$this->request->data['CmpHeadhunter']['avaliable_mail'] = $this->request->data['CmpHeadhunter']['total_mail'];
				}

				// save to the database
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
				$text = $this->request->data['CmpHeadhunter']['overview'];
				$breaks = array("<br />");
				$text = str_ireplace($breaks, "\r\n", $text);

				$image = $this->request->data['CmpHeadhunter']['logo'];

				$this->set(compact('text','image'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}

	public function browse($id) {
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

	public function edit($id) {
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->next_three_years();
		$employee= $this->OptionCommon->employee;
		$mail_transmission = $this->OptionCommon->mail_transmission;
		$this->CmpHeadhunter->recursive = -1 ;
		$cmpdata = $this->CmpHeadhunter->findByid($id);

		$location_list = $this->Region->find('all',array(
			'fields' => 'name'));

		foreach ($location_list as $lockey => $locvalue) {
			$location[$lockey+1] =  $locvalue['Region']['name'];
		}

		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
		));

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		if (!empty($cmpdata['CmpHeadhunter']['establishment'])) {
			$estiblished_date = explode('-', $cmpdata['CmpHeadhunter']['establishment']);
			$cut_day = substr($estiblished_date[2], 0, strpos($estiblished_date[2], ' '));
			$cmpdata['CmpHeadhunter']['day'] = $estiblished_date[2];
			$cmpdata['CmpHeadhunter']['month'] = $estiblished_date[1];
			$cmpdata['CmpHeadhunter']['year'] = $estiblished_date[0];
		}

		$overview_text = $cmpdata['CmpHeadhunter']['overview'];
		$breaks = array("<br />","<br />");
		$cmpdata['CmpHeadhunter']['overview'] = str_ireplace($breaks, "\r\n", $overview_text);

		if (!$this->request->data) {
			unset($cmpdata['CmpHeadhunter']['mail_limit']);
			$this->request->data = $cmpdata;
		}
		$error = false;

		if (!empty($cmpdata['CmpHeadhunter']['capital'])) {
			$unformat_num = str_replace(',', '', $cmpdata['CmpHeadhunter']['capital']) ;
			$format_num = number_format($unformat_num);
			$this->request->data['CmpHeadhunter']['capital']= $format_num;
		}

		$this->set(compact('cmpdata','mail_transmission','location','big_industry','day','month','year','established_day','established_month','established_year','employee','unformat_num','small_industry','error'));

		if ($this->request->is(array('post', 'put'))) {

			if (!empty($this->request->data['CmpHeadhunter']['password_update'])) {
				$this->request->data['CmpHeadhunter']['password'] = $this->request->data['CmpHeadhunter']['password_update'];
			}

			try {
				$transaction = $this->TransactionManager->begin();
				$this->request->data['CmpHeadhunter']['id'] = $id;

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

				// Total mail and available mail If number of mail transmission was chosen
				if (!empty($this->request->data['CmpHeadhunter']['mail_limit'])) {
					$total = explode(' ', $mail_transmission[$this->request->data['CmpHeadhunter']['mail_limit']]);
					$this->request->data['CmpHeadhunter']['total_mail'] = $cmpdata['CmpHeadhunter']['total_mail'] + $total[0];
					$this->request->data['CmpHeadhunter']['avaliable_mail'] = $this->request->data['CmpHeadhunter']['total_mail'] - $cmpdata['CmpHeadhunter']['sent_mail'];
				}

				// save to the database.
				if (!$this->CmpHeadhunter->save($this->request->data)) {
					if (array_key_exists('establishment', $this->CmpHeadhunter->validationErrors)) {
						$this->CmpHeadhunter->validationErrors['day'] = $this->CmpHeadhunter->validationErrors['establishment'];
						unset($this->CmpHeadhunter->validationErrors['establishment']);
					}
					throw new Exception('ERROR COULD NOT ADD COMPANY');
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$text = $this->request->data['CmpHeadhunter']['overview'];
				$breaks = array("<br />");
				$text = str_ireplace($breaks, "\r\n", $text);
				$image = $this->request->data['CmpHeadhunter']['logo'];

				$this->set(compact('text','image'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
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