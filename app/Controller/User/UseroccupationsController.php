<?php
App::uses('UserAppController', 'Controller');
class UseroccupationsController extends UserAppController {
	public $components = array('OptionCommon','RequestHandler');
	public $uses = array('User', 'TransactionManager','Occupation','CmpHeadhunter','JobCategorie','JobCategorieSub','IndustryBig','IndustrySmall','OccupationApply','OccupationFavorite','HeadhunterOtherLanguage','Region');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'user_new';
		// $this->Auth->allow(array('applied'));
	}
	public function index() {
		$user_id = $this->Auth->user('id');
		$salary = $this->OptionCommon->salary_range;

		//Get applied occupations
		$occupations = $this->Occupation->find('all',
			array(
				'conditions' => array('Occupation.deactivate' => 0,'Occupation.deleted' => 0),
				'joins' => array(array('table' => 'occupation_applies',
					'alias' => 'OccupationApply',
					'type' => 'INNER',
					'conditions' => array('Occupation.id = OccupationApply.occupation_id',
						'OccupationApply.user_id' => $user_id)
					))
				)
			);


		//Get company of applied occupations
		$app_company_id = array() ;
		foreach ($occupations as $key => $value) {
			$app_company_id[$value['Occupation']['id']] = $this->CmpHeadhunter->findByCompanyId($value['Occupation']['cmp_headhunter_id']);
		}

		$app_companies = array() ;
		foreach ($app_company_id as $appkey => $appvalue) {
			if ($appvalue['CmpHeadhunter']['company_name']) {
				$app_companies[$appkey] = $appvalue['CmpHeadhunter']['company_name'];
			} elseif($appvalue['CmpHeadhunter']['headhunter_name']) {
				$app_companies[$appkey] = $appvalue['CmpHeadhunter']['headhunter_name'];
			}
		}

		//Get saved occupations
		$saveOccupaitons = $this->Occupation->find('all',
			array(
				'joins' => array(array('table' => 'occupation_favorites',
					'alias' => 'OccupationFavorite',
					'type' => 'INNER',
					'conditions' => array('Occupation.id = OccupationFavorite.occupation_id',
						'OccupationFavorite.user_id' => $user_id)
					))
				)
			);
		$company_id = array() ;

		//Get company of saved occupations
		foreach ($saveOccupaitons as $key => $value) {
			$company_id[$value['Occupation']['id']] = $this->CmpHeadhunter->findByCompanyId($value['Occupation']['cmp_headhunter_id']);

		}

		$companies = array() ;
		foreach ($company_id as $cokey => $covalue) {
			if ($covalue['CmpHeadhunter']['company_name']) {
				$companies[$cokey] = $covalue['CmpHeadhunter']['company_name'];
			} elseif($covalue['CmpHeadhunter']['headhunter_name']) {
				$companies[$cokey] = $covalue['CmpHeadhunter']['headhunter_name'];
			}
		}

		$this->set(compact('occupations','saveOccupaitons','user_id','cv','companies','salary','app_companies'));
	}

	public function detail($id=null) {
		$user_id = $this->Auth->user('id');
		$salary_range = $this->OptionCommon->salary_range;
		$edu = $this->OptionCommon->education;
		$employee = $this->OptionCommon->employee;

		$jobDetail = $this->Occupation->find('first', array(
			'conditions' => array(
				'Occupation.id' => $id,
				'Occupation.deactivate' => 0
			),
			'order' => array('Occupation.created' => 'DESC'),
			'recursive' => 2
		));

		if (!empty($jobDetail['CmpHeadhunter']['logo'])) {
			if (!file_exists(WWW_ROOT . DS . 'img' . DS . $jobDetail['CmpHeadhunter']['logo'])) {
				$jobDetail['CmpHeadhunter']['logo'] = 'common_photo.jpg';
			}
		} else {
			$jobDetail['CmpHeadhunter']['logo'] = 'common_photo.jpg';
		}

		if (!empty($jobDetail['SubHeadhunter']['logo'])) {
			if (!file_exists(WWW_ROOT . DS . 'img' . DS . $jobDetail['SubHeadhunter']['logo'])) {
				$jobDetail['SubHeadhunter']['logo'] = 'common_photo.jpg';
			}
		} else {
			$jobDetail['SubHeadhunter']['logo'] = 'common_photo.jpg';
		}

		$region = $this->Region->find('list', array(
			'fields' => array('id', 'name'),
			'conditions' => array('Region.deleted' => 0)
		));

		$industry = $this->IndustryBig->find('list', array('fields' => array('id', 'label')));
		$small = $this->IndustrySmall->find('list', array('fields' => array('id', 'label')));

		if ($jobDetail['CmpHeadhunter']['type'] == 0) {
			$industry_id = explode(',', $jobDetail['CmpHeadhunter']['industry_big']);
			$jobDetail['CmpHeadhunter']['industry_big'] = '' ;
			foreach ($industry_id as $k => $v) {
				if (!empty($v)) {
					 $jobDetail['CmpHeadhunter']['industry_big'] .= $industry[$v]. '-'.$v.'&';
				}
			}

			if (!empty($jobDetail['SubHeadhunter'])) {
				$jobDetail['SubHeadhunter']['industry_big'] = $industry[$jobDetail['SubHeadhunter']['industry_big_id']];
				$jobDetail['SubHeadhunter']['industry_small'] = $small[$jobDetail['SubHeadhunter']['industry_small_id']];
			}

		} else {
			$jobDetail['CmpHeadhunter']['industry_big'] = $industry[$jobDetail['CmpHeadhunter']['industry_big']];
			$jobDetail['CmpHeadhunter']['industry_small'] = $small[$jobDetail['CmpHeadhunter']['industry_small']];
		}

		$job_lists = $this->Occupation->find('all',array(
			'conditions' => array(
				'NOT' => array('Occupation.id' => $id),
				'Occupation.ch_id' => $jobDetail['CmpHeadhunter']['id'],
				'Occupation.deactivate' => 0)
			)
		);

		if (!empty($job_lists)) {
			foreach($job_lists as $key => $val) {
				if (!empty($val['CmpHeadhunter']['logo'])) {
					if (!file_exists(WWW_ROOT . DS . 'img' . DS . $val['CmpHeadhunter']['logo'])) {
						$job_lists[$key]['CmpHeadhunter']['logo'] = 'common_photo.jpg';
					}
				} else {
					$job_lists[$key]['CmpHeadhunter']['logo'] = 'common_photo.jpg';
				}
			}
		}
		//Get saved job
		$savedOccupation = $this->OccupationFavorite->find('first',array(
			'conditions' => array('OccupationFavorite.occupation_id' => $id,
				'OccupationFavorite.user_id' => $user_id
				)
			));


		//Get apply job
		$appliedOccupation = $this->OccupationApply->find('first',array(
			'conditions' => array('OccupationApply.occupation_id' => $id,
				'OccupationApply.user_id' => $user_id),
			'fields' => array('OccupationApply.status')
			));


		$this->set(compact('jobDetail', 'job_lists', 'cmp_logo', 'salary_range', 'edu', 'industry', 'employee', 'region', 'user_id','savedOccupation','appliedOccupation'));
	}

	public function applied() {

		$user_id = $this->Auth->user('id');
		if ($this->request->is('ajax') ) {
			Configure::write('debug', 0);
			$job_id = $this->data['job_id'];

			$cmpheadhunterId = $this->Occupation->findById($job_id);

			$datas = array(
				'user_id' => $user_id,
				'occupation_id' => $job_id,
				'cmp_headhunter_id' => $cmpheadhunterId['CmpHeadhunter']['id'],
				'status' => 1
			);

			if($this->OccupationApply->save($datas)) {

				$apply_count = $cmpheadhunterId['Occupation']['number_of_applicant'] + 1 ;

				$this->Occupation->id = $job_id;
				if ($this->Occupation->saveField('number_of_applicant', $apply_count)) {
					return new CakeResponse(array('body'=> json_encode('Applied'),'status'=>200));
				}

			}

			return false;
		}
		return false;
	}

	public function saveJob() {

		$this->request->allowMethod('ajax');
		$this->response->type('json');
		Configure::write('debug', 0);
		$job_id = $this->data['job_id'];

		$user_id = $this->Auth->user('id');
		$occData = $this->Occupation->findById($job_id);


		if (!empty($occData)) {
			$keepNum = $occData['Occupation']['number_of_keep'] +1;
		}


		$this->Occupation->id = $occData['Occupation']['id'];
		if (!$this->Occupation->save(array('Occupation' => array('number_of_keep' => $keepNum)), array('validate' => false))) {
			return new CakeResponse(array('body'=> json_encode('Error1'),'status'=>301));
		}

		$data = array(
			'OccupationFavorite' => array(
				'user_id' => $user_id,
				'occupation_id' => $job_id,
				'cmp_headhunter_id' => $occData['CmpHeadhunter']['id']
		));

		if (!$this->OccupationFavorite->save($data)) {
			return new CakeResponse(array('body'=> json_encode('Error2'),'status'=>301));
		}

		return new CakeResponse(array('body'=> json_encode('Saved'),'status'=>200));

	}

	public function savedJobDelete($id) {
		//Get login userid
		$user_id = $this->Auth->user('id');

		//delete saved occupation id
		if ($this->OccupationFavorite->deleteAll([
			'OccupationFavorite.occupation_id' => $id,
			'OccupationFavorite.user_id' => $user_id
			])) {
			$occupation_save = $this->Occupation->findById($id,array(
				'fields' => 'Occupation.number_of_keep'));
			$keep_count = $occupation_save['Occupation']['number_of_keep'] - 1 ;
			$this->Occupation->id = $id;
			$this->Occupation->saveField('number_of_keep', $keep_count);
			$this->redirect(array('action' => 'index'));
		}
	}

	public function appliedJobDelete($id) {
		//Get login userid
		$user_id = $this->Auth->user('id');

		$occ_status = $this->OccupationApply->find('first',array('conditions'=>
			array('OccupationApply.occupation_id'=>$id,'OccupationApply.user_id' => $user_id),
			'fields' => 'OccupationApply.status'
			));

		$status = $occ_status['OccupationApply']['status'];
		if ($status == 1 || $status == 5) {
			$this->OccupationApply->deleteAll(['OccupationApply.occupation_id' => $id,'OccupationApply.user_id' => $user_id
				]);

			$occupation_apply = $this->Occupation->findById($id,array(
				'fields' => 'Occupation.number_of_applicant'));
			$apply_count = $occupation_apply['Occupation']['number_of_applicant'] -1 ;
			$this->Occupation->id = $id;
			$this->Occupation->saveField('number_of_applicant', $apply_count);

			$this->redirect(array('action' => 'index'));

		} else if($status == 2) {

			$this->OccupationApply->updateAll(array('cancel_status'=>2), array('OccupationApply.occupation_id'=>$id ,'OccupationApply.user_id' => $user_id));
			$occupation_apply = $this->Occupation->findById($id,array(
				'fields' => 'Occupation.number_of_applicant'));
			$apply_count = $occupation_apply['Occupation']['number_of_applicant'] -1 ;
			$this->Occupation->id = $id;
			$this->Occupation->saveField('number_of_applicant', $apply_count);

			$this->redirect(array('action' => 'index'));

		}else if($status == 3){
			$this->OccupationApply->updateAll(array('cancel_status'=>2), array('OccupationApply.occupation_id'=>$id ,'OccupationApply.user_id' => $user_id));

			$occupation_apply = $this->Occupation->findById($id,array(
				'fields' => 'Occupation.number_of_applicant'));
			$apply_count = $occupation_apply['Occupation']['number_of_applicant'] -1 ;
			$this->Occupation->id = $id;
			$this->Occupation->saveField('number_of_applicant', $apply_count);

			$this->redirect(array('action' => 'index'));
		} else {
			$this->OccupationApply->updateAll(array('cancel_status'=>2), array('OccupationApply.occupation_id'=>$id ,'OccupationApply.user_id' => $user_id));

			$occupation_apply = $this->Occupation->findById($id,array(
				'fields' => 'Occupation.number_of_applicant'));
			$apply_count = $occupation_apply['Occupation']['number_of_applicant'] -1 ;
			$this->Occupation->id = $id;
			$this->Occupation->saveField('number_of_applicant', $apply_count);

			$this->redirect(array('action' => 'index'));
		}

	}

}