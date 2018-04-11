<?php
App::uses('AdminAppController', 'Controller');
class AdminoccupationsController extends AdminAppController {
	// public $paginate = array();
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('Occupation','Region','JobCategorie','CmpHeadhunter', 'JobCategorieSub','IndustrySmall','OccupationFavorite','OccupationApply','TransactionManager');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}
	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ?  trim($this->params->query['keyword']): '';
		$companyselect = (!empty($this->params->query['company'])) ?  trim($this->params->query['company'] ): '';
		$headhunterselect = (!empty($this->params->query['headhunter'])) ?  trim($this->params->query['headhunter']): '';
		$status = !empty($this->request->query['status']) ? trim($this->request->query['status']) : '';
		$conditions = array();
		$fav = array();
		$app = array();
		$cmpid = $this->CmpHeadhunter->find('all',array(
			'conditions' => array(
				'CmpHeadhunter.deactivate' => 0,
				'CmpHeadhunter.deleted' => 0
			),
			'fields' => 'company_id'));

		$occid = $this->Occupation->find('all',array(
			'fields' => 'id'));
		foreach ($occid as $ckey => $cvalue) {
			$like = $this->OccupationFavorite->find('all',array(
				'conditions' => array(
					'OccupationFavorite.occupation_id' => $cvalue['Occupation']['id'] )));
			$applied = $this->OccupationApply->find('all',array(
				'conditions' => array(
					'OccupationApply.occupation_id' => $cvalue['Occupation']['id'] )));
			$applied_count= 0 ;
			$like_count= 0 ;
			foreach ($like as $likekey => $likevalue) {
				$like_count++ ;
			}
			foreach ($applied as $appliedkey => $appliedvalue) {
				$applied_count++ ;
			}
			$fav[$ckey+1] = $like_count;
			$app[$ckey+1] = $applied_count;
		}
		if (!empty($cmpid)) {
			foreach ($cmpid as $idkey => $idvalue) {
				$arr1[] = $idvalue['CmpHeadhunter']['company_id'] ;
			}

			$cmpname = $this->CmpHeadhunter->find('all',array(
				'conditions' => array(
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0
				) ,
				'fields' =>array(
					'company_name','headhunter_name','type'
					)
			));

			foreach ($cmpname as $namekey => $namevalue) {
				if ($namevalue['CmpHeadhunter']['type'] == 1) {
					$arr2[] = $namevalue['CmpHeadhunter']['company_name'] ;
				} else {
					$arr2[] = $namevalue['CmpHeadhunter']['headhunter_name'] ;
				}
			}
			$cmp_name_id = array_combine($arr1, $arr2) ;

			$company = $this->CmpHeadhunter->find('all',array(
				'conditions' => array('
					CmpHeadhunter.type' => 1,
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0
				),
				'fields' => 'company_name')
				);

			$headhunter = $this->CmpHeadhunter->find('all',array(
				'conditions' => array(
					'CmpHeadhunter.type' => 0,
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0
				),
				'fields' => 'headhunter_name')
				);

			if (!empty($company)) {
				foreach ($company as $ckey => $cvalue) {
					if (strlen($cvalue['CmpHeadhunter']['company_name']) > 18) {
						$coname[$ckey+1] = mb_substr($cvalue['CmpHeadhunter']['company_name'],0,18,'UTF-8')."...";
					} else {
						$coname[$ckey+1] = $cvalue['CmpHeadhunter']['company_name'];
					}
				}
				$coname = array_unique($coname) ;
			}

			if (!empty($headhunter)) {
				foreach ($headhunter as $hkey => $hvalue) {
					if (strlen($hvalue['CmpHeadhunter']['headhunter_name']) > 18) {
						$huntername[$hkey+1] = mb_substr($hvalue['CmpHeadhunter']['headhunter_name'],0,18,'UTF-8')."...";
					} else {
						$huntername[$hkey+1] = $hvalue['CmpHeadhunter']['headhunter_name'];
					}
				}
				$huntername = array_unique($huntername) ;
			}
		}

		if(!empty($headhunterselect) && !empty($companyselect)) {
			$this->paginate = array(
				'paramType' => 'querystring',
				'limit' => $limit,
				'order' => array('id' => 'DESC'),
				'conditions' => array(
					'CmpHeadhunter.id' => "CO")
				);
		}elseif(!empty($companyselect)){
			$selectco = $this->CmpHeadhunter->find('all',array(
				'conditions' => array(
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0,
					'FIND_IN_SET(\''. $coname[$companyselect] .'\',CmpHeadhunter.company_name)'),
				'fields' => 'CmpHeadhunter.company_id'));
			$this->paginate = array(
				'paramType' => 'querystring',
				'limit' => $limit,
				'order' => array('id' => 'desc'),
				'conditions' => array(
					'FIND_IN_SET(\''. $selectco[0]['CmpHeadhunter']['company_id'] .'\',Occupation.cmp_headhunter_id)'
					),
				);
		}elseif(!empty($headhunterselect) && empty($companyselect)){
			$selecthh = $this->CmpHeadhunter->find('all',array(
				'conditions' => array(
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0,
					'FIND_IN_SET(\''. $huntername[$headhunterselect] .'\',CmpHeadhunter.headhunter_name)'),
				'fields' => 'CmpHeadhunter.company_id'));
			$this->paginate = array(
				'paramType' => 'querystring',
				'limit' => $limit,
				'order' => array('id' => 'desc'),
				'conditions' => array(
					'FIND_IN_SET(\''. $selecthh[0]['CmpHeadhunter']['company_id'] .'\',Occupation.cmp_headhunter_id)'
					),
				);
		} else {
			$occ = $this->CmpHeadhunter->find('all',array(
				'conditions' => array(
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0,
					'OR' => array(
						array('CmpHeadhunter.headhunter_name LIKE' => '%'.trim($keyword).'%'),
						array('CmpHeadhunter.company_name LIKE' => '%'.trim($keyword).'%')))
				));
			$tmp = array();
			foreach ($occ as $occkey => $occvalue) {
				$tmp[$occkey] = $occvalue['CmpHeadhunter']['company_id'];
			}

			// Searching by Job ID
			$this->Occupation->virtualFields['cojob_id'] = 'CONCAT(Occupation.cmp_headhunter_id, "-", Occupation.job_id)';

			$this->paginate = array(
				'paramType' => 'querystring',
				'limit' => $limit,
				'order' => array('id' => 'DESC'),
				'conditions' => array(
					'Occupation.deleted' => 0,
					'OR' => array(
						array('Occupation.cmp_headhunter_id' => $tmp),
						array('Occupation.cojob_id LIKE' => '%'.$keyword.'%'),
						array('Occupation.job_title LIKE' => '%'.$keyword.'%'),
						array('Occupation.job_id LIKE' => '%'.$keyword.'%'),
					)
				)
			);
		}

		$pag = $this->paginate('Occupation');

		$this->set(compact('pag','limit','cmp_name_id','coname','huntername','companyselect','headhunterselect','fav','app'));
	}

	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR Job ID NOT EXISTS');
			}
			$this->Occupation->id = $id;
			if (!$this->Occupation->exists()) {
				throw new Exception('ERROR Job NOT EXISTS');
			}
			$this->log("here");
			if (!$this->Occupation->save(array('Occupation' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE Job');
			}
			$this->TransactionManager->commit($transaction);
		}catch (Exception $e) {
			$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
			$this->log($e->getMessage(), LOG_ERR);
			$this->TransactionManager->rollback($transaction);
			$this->redirect(array('action' => 'index'));
		}
		$this->redirect(array('action' => 'index'));
	}

	public function approved($id = null) {
		$approved = $this->Occupation->findById($id);
		$this->Occupation->id = $id;
		if ($approved['Occupation']['deactivate'] == true){
			$this->Occupation->saveField('deactivate', '0');
		} else {
			// $this->Company->saveField('start', '1');
			if (!$this->Occupation->save(array('Occupation' => array('deactivate' => 1, 'deactivate_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP MASTER USER');
			}
		}
		$this->redirect( array('action' => 'index'));
	}

	public function browse($id) {
		$salary = $this->OptionCommon->salary_range;
		$salary_range = '';
		if (!$id) {
			$this->Session->setFlash('Enter company ID。', "error");
			$this->redirect(array('action' => 'index'));
		}
		$occdata = $this->Occupation->findByid($id);

		$cmp = $this->CmpHeadhunter->find('all',array(
			'conditions' => array (
				'company_id' => $occdata['Occupation']['cmp_headhunter_id'])));
		if ($cmp[0]['CmpHeadhunter']['type'] == 0) {
			$cmp_name = $cmp[0]['CmpHeadhunter']['headhunter_name'] ;
		} elseif ($cmp[0]['CmpHeadhunter']['type'] == 1) {
			$cmp_name = $cmp[0]['CmpHeadhunter']['company_name'] ;
		}
		if ($occdata['Occupation']['salary_range']) {
			$salary_range = $salary[$occdata['Occupation']['salary_range']];
		}
		$region_id=$occdata['Occupation']['location_small_id'];
		$this->Region->id = $region_id;
		$region_name = $this->Region->field('name');
		$job = $this->JobCategorieSub->findById($occdata['Occupation']['job_category_sub_id']);
		$industry = $this->IndustrySmall->findById($occdata['Occupation']['industry_small_id']);

		$fav = array();
		$app = array();
			$like = $this->OccupationFavorite->find('all',array(
				'conditions' => array(
					'OccupationFavorite.occupation_id' => $id)));
			$applied = $this->OccupationApply->find('all',array(
				'conditions' => array(
					'OccupationApply.occupation_id' => $id )));
			$applied_count= 0 ;
			$like_count= 0 ;
			foreach ($like as $likekey => $likevalue) {
				$like_count++ ;
			}
			foreach ($applied as $appliedkey => $appliedvalue) {
				$applied_count++ ;
			}

		$this->set(compact('occdata','region_name','job','cmp_name','industry','salary_range','like_count','applied_count'));
	}
}