<?php
App::uses('MasterAppController', 'Controller');
class MasterheadhuntersController extends  MasterAppController {
	public $components = array('OptionCommon');
	public $uses = array('SubHeadhunter','CmpHeadhunter','Region','IndustryBig','IndustrySmall','Occupation','TransactionManager','JobCategorieSub','JobCategorie');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'master';
	}

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$status = !empty($this->request->query['status']) ? trim($this->request->query['status']) : '';
		$condition = array();
		$auth_id = $this->Auth->user('company_id');

		if ($status == 1 ) { //Active company list
			$condition = array( 'SubHeadhunter.deactivate ' => 0, 'SubHeadhunter.company_id' => $auth_id);
		} elseif ($status == 2 ) { //Deactivated company list
			$condition = array( 'SubHeadhunter.deactivate ' => '1', 'SubHeadhunter.company_id' => $auth_id);
		} else {
			$condition = array(
				'SubHeadhunter.deleted ' => 0,
				'SubHeadhunter.company_id' => $auth_id ,
				'OR' => array(
					array('SubHeadhunter.company_id LIKE' => '%'.$keyword.'%'),
					array('SubHeadhunter.company_name LIKE' => '%'.$keyword.'%'),
					array('SubHeadhunter.location LIKE' => '%'.$keyword.'%')
					)
				);
		}

		$this->paginate = array(
				'paramType' => 'querystring',
				'limit' => $limit,
				'order' => array('id' => 'DESC'),
				'conditions' => $condition
			) ;
		$pag = $this->paginate('SubHeadhunter');
		$this->set(compact('pag','limit'));
	}

	public function approved($id = null) {
		$approved = $this->SubHeadhunter->findById($id);
		$this->SubHeadhunter->id = $id;
		if ($approved['SubHeadhunter']['deactivate'] == true) {
			if (!$this->SubHeadhunter->saveField('deactivate', '0')) {
				throw new Exception('ERROR COULD NOT SAVE DEACTIVATE DATA');
			}
		} else {
			if (!$this->SubHeadhunter->save(array('SubHeadhunter' => array('deactivate' => 1, 'deactivate_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP SUBHEADHUNTER DATA');
			}
		}
		$this->redirect( array('action' => 'index'));
	}

	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR SUBHEADHUNTER ID NOT EXISTS');
			}
			$this->SubHeadhunter->id = $id;
			if (!$this->SubHeadhunter->exists()) {
				throw new Exception('ERROR COULD NOT STOP SUBHEADHUNTER DATA NOT EXISTS');
			}
			if (!$this->SubHeadhunter->save(array('SubHeadhunter' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE SUBHEADHUNTER DATA');
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

	public function add() {
		$hid = $this->Auth->user('id');

		// get array from the OptionCommon Component.
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->next_three_years();
		$mail_transmission = $this->OptionCommon->mail_transmission;
		$employee= $this->OptionCommon->employee;

		$region = $this->Region->find('list', array(
			'fields' => 'name'
		));

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array(
				'IndustrySmall.id',
				'IndustrySmall.label',
				'IndustrySmall.industry_big_id'
			),
			'order' => array(
				'IndustrySmall.industry_big_id' => 'ASC'
			)
		));

		$sub_company_id = $this->CmpHeadhunter->find('first', array(
			'fields' => array(
				'CmpHeadhunter.company_id'
			),
			'conditions' => array(
				'CmpHeadhunter.id' => $hid
			)
		));

		$s_code = $sub_company_id['CmpHeadhunter']['company_id'];

		$error = false;

		if (!empty($this->request->data['CmpHeadhunter']['small_label'])) {
			$sindustry = $this->request->data['CmpHeadhunter']['small_label'];
		}

		if (!empty($this->request->data['CmpHeadhunter']['capital']) && is_numeric($this->request->data['CmpHeadhunter']['capital']) ) {
			$unformat_num = $this->request->data['CmpHeadhunter']['capital'] ;
			$format_num = number_format($this->request->data['CmpHeadhunter']['capital']);
			$this->request->data['CmpHeadhunter']['capital']= $format_num;
		}

		$this->set(compact('region','big_industry','error','day','month','year','mail_transmission','employee','small_industry'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['SubHeadhunter']['company_id'] = $s_code;

				if (
					!empty($this->request->data['SubHeadhunter']['year']) ||
					!empty($this->request->data['SubHeadhunter']['month']) ||
					!empty($this->request->data['SubHeadhunter']['day']))
				{
					// validate the establishment date.
					$year = $this->request->data['SubHeadhunter']['year'];
					$month = $this->request->data['SubHeadhunter']['month'];
					$day = $this->request->data['SubHeadhunter']['day'];

					$this->request->data['SubHeadhunter']['establishment'] = $year . '-' . $month . '-' . $day;
				}

				// validate the upload file.
				if (!empty($this->request->data['SubHeadhunter']['logo']['name'])) {
					$tmpName = $this->request->data['SubHeadhunter']['logo']['tmp_name'];
					$name = $this->request->data['SubHeadhunter']['logo']['name'];
					unset($this->request->data['SubHeadhunter']['logo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['SubHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('image', $this->request->data['SubHeadhunter'])) {
					$name = $this->request->data['SubHeadhunter']['image'];
					unset($this->request->data['SubHeadhunter']['logo']);
					$this->request->data['SubHeadhunter']['logo'] = $name;

				}

				$capital_rev = strrev($this->request->data['SubHeadhunter']['capital']);
				if (strpos($capital_rev, ',') !== FALSE) {
					$this->request->data['SubHeadhunter']['capital'] = $this->request->data['SubHeadhunter']['capital'];
				} else {
					$capital_split = str_split($capital_rev, 3);
					$capital = '' ;
					foreach ($capital_split as $capkey => $capvalue) {
						$capital .= $capvalue . ',' ;
					}
					$capital = substr(strrev($capital), 1) ;
					$this->request->data['SubHeadhunter']['capital'] = $capital;
				}

				$validateAttrKey = array('email', 'location','industry_big_id');
				foreach ($validateAttrKey as $key => $value) {
					$this->SubHeadhunter->validator()->remove($value);
				}

				if (!$this->SubHeadhunter->save($this->request->data)) {
					if (array_key_exists('establishment', $this->SubHeadhunter->validationErrors)) {
						$this->SubHeadhunter->validationErrors['day'] = $this->SubHeadhunter->validationErrors['establishment'];
						unset($this->SubHeadhunter->validationErrors['establishment']);
					}
					$this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD COMPANY');
				}
				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$image = $this->request->data['SubHeadhunter']['logo'];
				$this->set('image', $image);
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}
		}
	}

	public function edit($id = null) {
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->next_three_years();
		$employee= $this->OptionCommon->employee;
		$mail_transmission = $this->OptionCommon->mail_transmission;
		$error = false ;
		$subheadhunter = $this->SubHeadhunter->findById($id);

		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
		));

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		$region = $this->Region->find('list',array(
			'fields' => 'name'));

		if (!empty($subheadhunter['SubHeadhunter']['establishment'])) {
			$estiblished_date = explode('-', $subheadhunter['SubHeadhunter']['establishment']);
			$subheadhunter['SubHeadhunter']['day'] = $estiblished_date[2];
			$subheadhunter['SubHeadhunter']['month'] = $estiblished_date[1];
			$subheadhunter['SubHeadhunter']['year'] = $estiblished_date[0];
		}

		if (!$this->request->data) {
			$this->request->data = $subheadhunter;
		}

		$this->set(compact('subheadhunter','region','big_industry','small_industry','day','month','year','error','mail_transmission','employee','password','nmonth'));

		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();
				$this->request->data['SubHeadhunter']['id'] = $id;

				if (
					!empty($this->request->data['SubHeadhunter']['year']) ||
					!empty($this->request->data['SubHeadhunter']['month']) ||
					!empty($this->request->data['SubHeadhunter']['day']))
				{
					// validate the establishment date.
					$year = $this->request->data['SubHeadhunter']['year'];
					$month = $this->request->data['SubHeadhunter']['month'];
					$day = $this->request->data['SubHeadhunter']['day'];

					$this->request->data['SubHeadhunter']['establishment'] = $year . '-' . $month . '-' . $day;
				}

				// validate the upload file.
				if (!empty($this->request->data['SubHeadhunter']['logo']['name'])) {
					$tmpName = $this->request->data['SubHeadhunter']['logo']['tmp_name'];
					$name = $this->request->data['SubHeadhunter']['logo']['name'];
					unset($this->request->data['SubHeadhunter']['logo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['SubHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('cologo', $this->request->data['SubHeadhunter'])) {
					$name = $this->request->data['SubHeadhunter']['cologo'];
					unset($this->request->data['SubHeadhunter']['logo']);
					$this->request->data['SubHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('image', $this->request->data['SubHeadhunter'])) {
					$name = $this->request->data['SubHeadhunter']['image'];
					unset($this->request->data['SubHeadhunter']['logo']);
					$this->request->data['SubHeadhunter']['logo'] = $name;
				}

				$validateAttrKey = array('location','email', 'industry_big_id');
				foreach ($validateAttrKey as $key => $value) {
					$this->SubHeadhunter->validator()->remove($value);
				}

				$jobs = $this->Occupation->find('list',array(
							'conditions' => array(
								'Occupation.sub_headhunter_id' => $id,
								'Occupation.deleted' => 0
								),
							'fields' => 'Occupation.id'
							)
						);

				if (!$this->SubHeadhunter->save($this->request->data)) {
					if (array_key_exists('establishment', $this->SubHeadhunter->validationErrors)) {
						$this->SubHeadhunter->validationErrors['day'] = $this->SubHeadhunter->validationErrors['establishment'];
						unset($this->SubHeadhunter->validationErrors['establishment']);
					}
					$this->set('error', 'true');
					throw new Exception('ERROR COULD NOT EDIT');
				}

				// Update industry big id and small id in Occupation table
				if (!empty($jobs)) {
					$details = array(
						'industry_big_id' => $this->request->data['SubHeadhunter']['industry_big_id'],
						'industry_small_id' => $this->request->data['SubHeadhunter']['industry_small_id']
					);
					$this->Occupation->updateAll($details,array('Occupation.id' => $jobs));
				}

				$this->TransactionManager->commit($transaction);
			} catch (Exception $e) {
				$image = $this->request->data['SubHeadhunter']['logo'];
				$requestData = $this->request->data;
				$this->set(compact('image', 'requestData'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}
			$this->redirect(array('action' => 'index'));
		}

		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function find() {
		$this->Company->recursive = -1;
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$results = $this->Company->find('all', array(
				'fields' => array('Company.name'),
				//remove the leading '%' if you want to restrict the matches more
				'conditions' => array('Company.name LIKE ' => '%' . $this->request->query['q'] . '%')
				));
			foreach($results as $result) {
				echo $result['Company']['name'] . "\n";
			}
		} else {
			//if the form wasn't submitted with JavaScript
			//set a session variable with the search term in and redirect to index page
			$this->Session->write('companyName',$this->request->data['Company']['name']);
			$this->redirect(array('action' => 'index'));
		}
	}

	private function __convertToValidationErrors($errors) {
        foreach ($errors as $key => $val) {
            $this->SubHeadhunter->validationErrors[$key] = $val;
        }
    }
}