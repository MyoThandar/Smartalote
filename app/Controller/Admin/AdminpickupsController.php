<?php
App::uses('AdminAppController', 'Controller');
class AdminpickupsController extends AdminAppController {
	public $components = array('OptionCommon');
	public $uses = array('Pickup','CmpHeadhunter','TransactionManager');

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$pick_term = $this->OptionCommon->pick_term;

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'desc'),
			'conditions' => array(
				'OR' => array(
					array('Pickup.company_id LIKE' => '%'.$keyword.'%'),
					array('Pickup.company_name LIKE' => '%'.$keyword.'%')
				)
			)
		);

		$pag = $this->paginate('Pickup');
		$this->set(compact('pag','limit','pick_term'));
	}

	public function add() {
		$pick_term = $this->OptionCommon->pick_term;
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$pick_year = $this->OptionCommon->pickYear();

		// Auto complement of companies
		$company = $this->CmpHeadhunter->find('all');
		$company_list = $this->CmpHeadhunter->find('all', array('fields' => array('company_name','headhunter_name','company_id')));
		$com_list = array();
		$i = 0;
		foreach ($company_list as $key => $value) {
			$co_name = '' ;
			if ($value['CmpHeadhunter']['company_name']) {
				$co_name = $value['CmpHeadhunter']['company_name'] ;
			} elseif ($value['CmpHeadhunter']['headhunter_name']) {
				$co_name = $value['CmpHeadhunter']['headhunter_name'];
			}
			if (strlen($co_name) > 50) {
					$com_list[$i++] = mb_substr($co_name,0,50,'UTF-8')."...".':'.$value['CmpHeadhunter']['company_id'];
			} else {
				$com_list[$i++] = $co_name.':'.$value['CmpHeadhunter']['company_id'];
			}
		}

		$this->set(compact('pick_term','day','month','pick_year','com_list','company_list','company'));

		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['Pickup']['start_date'] = $this->request->data['Pickup']['year'] . '-' . $this->request->data['Pickup']['month'] . '-' . $this->request->data['Pickup']['day'];

				$company_info = explode(':', $this->request->data['Pickup']['company_name']);
				$this->request->data['Pickup']['company_name'] = $company_info[0];
				$this->request->data['Pickup']['company_id'] = $company_info[1];

				/* Calculation End date from term */

				switch ($this->request->data['Pickup']['term']) {
				case 1:
					$end_date = date('Y-m-d', strtotime("+3 months", strtotime($this->request->data['Pickup']['start_date'])));
					break;
				case 2:
					$end_date = date('Y-m-d', strtotime("+6 months", strtotime($this->request->data['Pickup']['start_date'])));
					break;
				case 3:
					$end_date = date('Y-m-d', strtotime("+12 months", strtotime($this->request->data['Pickup']['start_date'])));
					break;
				}
				$this->request->data['Pickup']['end_date'] = $end_date;

				/* END of Calculation End date from term */

				$this->Pickup->create();
				if (!$this->Pickup->save($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}
				$this->TransactionManager->commit($transaction);

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				$this->Session->setFlash('This company name is already picked up !', 'error');
				return;
			}
			$this->redirect(array('action' => 'index'));
		}
	}

	public function edit($id) {
		$pick_term = $this->OptionCommon->pick_term;
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->pickYear();

		// Auto complement of companies
		$company = $this->CmpHeadhunter->find('all');
		$company_list = $this->CmpHeadhunter->find('all', array('fields' => array('company_name','headhunter_name','company_id')));

		$com_list = array();
		$i = 0;
		foreach ($company_list as $key => $value) {
			$co_name = '' ;
			if ($value['CmpHeadhunter']['company_name']) {
				$co_name = $value['CmpHeadhunter']['company_name'] ;
			} elseif ($value['CmpHeadhunter']['headhunter_name']) {
				$co_name = $value['CmpHeadhunter']['headhunter_name'];
			}
			if (strlen($co_name) > 50) {
					$com_list[$i++] = mb_substr($co_name,0,50,'UTF-8')."...".':'.$value['CmpHeadhunter']['company_id'];
			} else {
				$com_list[$i++] = $co_name.':'.$value['CmpHeadhunter']['company_id'];
			}
		}

		if (!$this->request->data) {

			/* All picked company informations */
			$picked_info = $this->Pickup->findById($id);

			/* Start company allowing date */
			$start_date = explode('-', $picked_info['Pickup']['start_date']);
			$this->request->data = $picked_info;
			$this->request->data['Pickup']['day'] = $start_date[2];
			$this->request->data['Pickup']['month'] = $start_date[1];
			$this->request->data['Pickup']['year'] = $start_date[0];

			/* Company Id and company name */
			$this->request->data['Pickup']['company_name'] = $picked_info['Pickup']['company_name'].':'.$picked_info['Pickup']['company_id'];
		}

		$this->set(compact('pick_term','day','month','year','com_list','company_list','company'));

		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();

				$this->request->data['Pickup']['start_date'] = $this->request->data['Pickup']['year'] . '-' . $this->request->data['Pickup']['month'] . '-' . $this->request->data['Pickup']['day'];

				/* Calculation End date from term */

				switch ($this->request->data['Pickup']['term']) {
				case 1:
					$end_date = date('Y-m-d', strtotime("+3 months", strtotime($this->request->data['Pickup']['start_date'])));
					break;
				case 2:
					$end_date = date('Y-m-d', strtotime("+6 months", strtotime($this->request->data['Pickup']['start_date'])));
					break;
				case 3:
					$end_date = date('Y-m-d', strtotime("+12 months", strtotime($this->request->data['Pickup']['start_date'])));
					break;
				}

				$this->request->data['Pickup']['end_date'] = $end_date;

				/* END of Calculation End date from term */

				// remove validate
				$this->Pickup->validator()->remove('company_name');

				$this->Pickup->id = $id ;
				if (!$this->Pickup->save($this->request->data)) {
					$this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD Tag');
				}
				$this->TransactionManager->commit($transaction);

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
			$this->redirect(array('action' => 'index'));
		}
	}

/**
* delete method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
	public function delete($id = null) {
		$this->Pickup->id = $id;
		if (!$this->Pickup->exists()) {
			throw new NotFoundException('Enter ID.');
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Pickup->delete()) {
			$this->Session->setFlash('This picked up company deleted successfully !', 'success');
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash('This picked up company couldn\'t delete', "error");
		}
	}

}
