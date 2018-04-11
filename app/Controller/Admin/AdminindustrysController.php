<?php
App::uses('AdminAppController', 'Controller');
class AdminIndustrysController extends AdminAppController {

	public $uses = array('IndustryBig', 'IndustrySmall', 'TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label')
		));
		$industryBigFilterVal = !empty($this->request->query['industry_big']) ? trim($this->request->query['industry_big']) : '';
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';

		if (!empty($industryBigFilterVal)) {
			$industry = $this->IndustryBig->find('all',array(
				'conditions' => array(
					'IndustryBig.id' => $industryBigFilterVal)));
		} elseif (!empty($keyword)) {
			// small search
			$keyword_result = $this->IndustrySmall->find('all',array(
				'conditions' => array(
					'IndustrySmall.label LIKE' => '%' . $keyword . '%'
				)
			));

			// big search
			if (empty($keyword_result)) {
				$industry = $this->IndustryBig->find('all',array(
					'conditions' => array(
						'IndustryBig.label LIKE' => '%'.$keyword.'%')));
			}

		} else {
			$industry = $this->IndustryBig->find('all');
		}

		if ($this->request->is(array('post', 'put'))) {
			// Add new industry big
			if (!empty($this->request->data['IndustryBig']['label']) ) {
				if (empty($this->request->data['IndustrySmall'])) {
					$this->Session->write('original_big', $this->request->data['IndustryBig']['label']);
				}
				$blabel = $this->request->data['IndustryBig']['label'] ;
				$this->IndustryBig->set($this->request->data['IndustryBig']);
				if (!$this->IndustryBig->validates()) {
					$this->set('industry', $industry);
					return;
				}
			}

			try {
				$transaction = $this->TransactionManager->begin();
				$flag = false;
				if (empty($this->request->data['IndustryBig']['id']) && !(isset($_POST['edit']))) {
					if (!empty($this->request->data['IndustrySmall']) && !empty($this->request->data['IndustryBig'])) { //Old Big && new small
						if (empty($this->request->data['IndustrySmall'][0]['industry_big_id'])) {
							unset($this->request->data['IndustryBig']['id']);
							$this->request->data['IndustryBig']['label'] = $this->Session->read('original_big');
							if (!$this->IndustryBig->saveAssociated($this->request->data)) {
								throw new Exception('ERROR COULD NOT SAVE INDUSTRY');
							}
							$flag = true;
						} else {
							$this->IndustrySmall->create();
							if (!$this->IndustrySmall->save($this->request->data['IndustrySmall'][0])) {
								throw new Exception('ERROR COULD NOT SAVE INDUSTRY');
							}
							$flag = true;
						}
					}
				}
				if (isset($_POST['edit'])) {
					$this->request->data['IndustryBig']['id'] = $this->request->data['IndustrySmall']['industry_big_id'] ;
					if ($this->request->data['IndustrySmall']['biglabel']) {
						$this->request->data['IndustryBig']['label'] = $this->request->data['IndustrySmall']['biglabel'] ;
					}
					if ($this->request->data['IndustrySmall']['smalllabel']) {
						$this->request->data['IndustrySmall']['label'] = $this->request->data['IndustrySmall']['smalllabel'] ;
						$this->request->data['IndustrySmall']['industry_big_id'] = $this->request->data['IndustrySmall']['industry_big_id'] ;
						$this->request->data['IndustrySmall']['id'] = $this->request->data['IndustrySmall']['id'] ;
					}

					unset($this->request->data['edit']);
					unset($this->request->data['IndustrySmall']['biglabel']);
					unset($this->request->data['IndustrySmall']['smalllabel']);

					if (!$this->IndustryBig->save($this->request->data['IndustryBig'])) {
						throw new Exception('ERROR COULD NOT SAVE INDUSTRY');
					}
					if (!$this->IndustrySmall->save($this->request->data['IndustrySmall'])) {
						throw new Exception('ERROR COULD NOT SAVE INDUSTRY');
					}
					$flag = true;
				}
				$this->TransactionManager->commit($transaction);
			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				$this->Session->setFlash('Couldn\'t inserted industry. please try again' , 'error');
			}

			if ($flag) {
				$this->Session->setFlash('Successfully inserted industry', 'success');
				$this->redirect($this->referer());
			}
		}
		$this->set(compact( 'blabel', 'industry','big_industry', 'small_industry', 'pag','keyword_result'));
	}

	public function delete($industyBigId = null, $IndustrySmallId = null) {
		$this->IndustrySmall->id = $IndustrySmallId;
		if (!$this->IndustrySmall->exists()) {
			throw new NotFoundException('INDUSTRY SMALL ID IS NOT FOUND');
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->IndustrySmall->delete()) {
			$industryData = $this->IndustrySmall->findByIndustryBigId($industyBigId);
			if (empty($industryData)) {
				$this->IndustryBig->delete($industyBigId);
			}
			$this->Session->setFlash('Successfully deleted', 'success');
		} else {
			$this->Session->setFlash('Couldn\'t Delete', 'error');
		}
		return $this->redirect(array('action' => 'index'));
	}
}