<?php
App::uses('AdminAppController', 'Controller');
class AdminregionsController extends AdminAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('Region', 'TransactionManager');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$reg = '';
		$hm_ab = '';
		$keyword = (!empty($this->params->query['keyword'])) ? $this->params->query['keyword'] : '';
		$home_abroad = (!empty($this->params->query['home_abroad'])) ? $this->params->query['home_abroad'] : '';

		if (!empty($this->params->query['keyword'])) {
			$region_name = $this->Region->find('all',array(
				'order' => array('id' => 'asc'),
				'conditions' => array(
					array('deleted ' => '0'),
					'OR' => array(
						array('name LIKE' => '%'.trim($keyword).'%'),
						array('home_abroad LIKE' => '%'.trim($keyword).'%')
						)
					)
				)
			);
		} elseif (!empty($this->params->query['home_abroad'])) {
			$region_name = $this->Region->find('all',array(
				'order' => array('id' => 'desc'),
				'conditions' => array(
					array('deleted ' => '0'),
					'OR' => array(
						'FIND_IN_SET(\''. $home_abroad .'\',home_abroad)',
						)
					)
				)
			);
			$hm_ab = $this->params->query['home_abroad'];
		} else {
			$region_name = $this->Region->find('all');
		}
		$regionlist = $this->Region->find('list');

		$this->set(compact('regionlist','hm_ab','region_name'));

		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();
				if (!$this->Region->save($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}
				$this->TransactionManager->commit($transaction);
			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}
			$this->redirect($this->referer());
		}

	}

	public function delete($id = null) {
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException('Enter ID.');
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Region->delete()) {
			$this->Session->setFlash('Successfully deleted', 'success');
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash('Couldn\'t Delete', 'error');
		}
	}

}