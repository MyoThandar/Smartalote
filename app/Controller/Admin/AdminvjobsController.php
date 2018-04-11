<?php
App::uses('AdminAppController', 'Controller');
class AdminvjobsController extends AdminAppController {

	public $uses = array('JobCategorie','JobCategorieSub', 'TransactionManager');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index() {
		$categoryBig = $this->JobCategorie->find('list', array(
			'fields' => array('JobCategorie.id', 'JobCategorie.label')
		));

		$jobcategoryFilterVal = !empty($this->request->query['job_category']) ? trim($this->request->query['job_category']) : '';
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';

		if (!empty($jobcategoryFilterVal)) {
			$job = $this->JobCategorie->find('all',array(
				'conditions' => array(
					'JobCategorie.id' => $jobcategoryFilterVal)));
		} elseif (!empty($keyword)) {
			// small search
			$keyword_result = $this->JobCategorieSub->find('all',array(
				'conditions' => array(
					'JobCategorieSub.label LIKE' => '%'.$keyword.'%'
				)
			));

			// big search
			if (empty($keyword_result)) {
				$job = $this->JobCategorie->find('all',array(
					'conditions' => array(
						'JobCategorie.label LIKE' => '%'.$keyword.'%')));
			}

		} else {
			$job = $this->JobCategorie->find('all');
		}

		if ($this->request->is(array('post', 'put'))) {
			// Add new job big
			if (!empty($this->request->data['JobCategorie']['label']) ) {
				if (empty($this->request->data['JobCategorieSub'])) {
					$this->Session->write('original_big', $this->request->data['JobCategorie']['label']);
				}

				$blabel = $this->request->data['JobCategorie']['label'] ;
				$this->JobCategorie->set($this->request->data['JobCategorie']);
				if (!$this->JobCategorie->validates()) {
					$this->set('job', $job);
					return;
				}
			}

			try {
				$transaction = $this->TransactionManager->begin();
				$flag = false;
				if (empty($this->request->data['JobCategorie']['id']) && !(isset($_POST['edit']))) {
					if (!empty($this->request->data['JobCategorieSub']) && !empty($this->request->data['JobCategorie'])) { //Old Big && new small

						if (empty($this->request->data['JobCategorieSub'][0]['industry_big_id'])) {
							unset($this->request->data['JobCategorie']['id']);
							$this->request->data['JobCategorie']['label'] = $this->Session->read('original_big');
							if (!$this->JobCategorie->saveAssociated($this->request->data)) {
								throw new Exception('ERROR COULD NOT SAVE JOBCATEGORIE');
							}
							$flag = true;
						} else {
							$this->request->data['JobCategorieSub'][0]['job_category_id'] = $this->request->data['JobCategorieSub'][0]['industry_big_id'];
							$this->JobCategorieSub->create();
							if (!$this->JobCategorieSub->save($this->request->data['JobCategorieSub'][0])) {
								throw new Exception('ERROR COULD NOT SAVE JOBCATEGORIE');
							}
							$flag = true;
						}
					}
				}
				if (isset($_POST['edit'])) {
					$this->request->data['JobCategorie']['id'] = $this->request->data['JobCategorieSub']['industry_big_id'] ;
					if ($this->request->data['JobCategorieSub']['biglabel']) {
						$this->request->data['JobCategorie']['label'] = $this->request->data['JobCategorieSub']['biglabel'] ;
					}
					if ($this->request->data['JobCategorieSub']['smalllabel']) {
						$this->request->data['JobCategorieSub']['label'] = $this->request->data['JobCategorieSub']['smalllabel'] ;
						$this->request->data['JobCategorieSub']['job_category_id'] = $this->request->data['JobCategorieSub']['industry_big_id'] ;
						$this->request->data['JobCategorieSub']['id'] = $this->request->data['JobCategorieSub']['id'] ;
					}

					unset($this->request->data['edit']);
					unset($this->request->data['JobCategorieSub']['biglabel']);
					unset($this->request->data['JobCategorieSub']['smalllabel']);

					if (!$this->JobCategorie->save($this->request->data['JobCategorie'])) {
						throw new Exception('ERROR COULD NOT SAVE INDUSTRY');
					}
					if (!$this->JobCategorieSub->save($this->request->data['JobCategorieSub'])) {
						throw new Exception('ERROR COULD NOT SAVE INDUSTRY');
					}
					$flag = true;
				}
				$this->TransactionManager->commit($transaction);
			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				$this->Session->setFlash('Couldn\'t inserted job category. please try again' , 'error');
			}

			if ($flag) {
				$this->Session->setFlash('Successfully inserted job category .', 'success');
				$this->redirect($this->referer());
			}
		}
		$this->set(compact( 'blabel', 'job','categoryBig', 'small_industry', 'pag','keyword_result'));
	}

	public function delete($industyBigId = null, $IndustrySmallId = null) {
		$this->JobCategorieSub->id = $IndustrySmallId;
		if (!$this->JobCategorieSub->exists()) {
			throw new NotFoundException('INDUSTRY SMALL ID IS NOT FOUND');
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->JobCategorieSub->delete()) {
			$industryData = $this->JobCategorieSub->findByJobCategoryId($industyBigId);
			if (empty($industryData)) {
				$this->JobCategorie->delete($industyBigId);
			}
			$this->Session->setFlash('Successfully deleted', 'success');
		} else {
			$this->Session->setFlash('Couldn\'t Delete', 'error');
		}
		return $this->redirect(array('action' => 'index'));
	}
}