<?php
App::uses('AdminAppController', 'Controller');
class AdminappliedjobseekersController extends AdminAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('User' , 'UserEducation' , 'UserQualification' , 'UserLanguageSkill' , 'UserCareerHistory' , 'UserComputingSkill' , 'UserSpecialInstruction' , 'UserCoreSkill' , 'IndustryBig' , 'IndustrySmall' , 'JobCategorie' , 'JobCategorieSub' , 'OccupationApply' , 'OccupationFavorite' ,'CmpHeadhunter','Region', 'Occupation','TransactionManager');

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? strtolower(trim($this->params->query['keyword'])) : '';
		$condition = array();

		$userId = $this->OccupationApply->find('list',array('fields' => array('OccupationApply.user_id')));

		if ($keyword == 'male') { //for male searching
			$condition = array(
				'User.id' => $userId,
				'User.gender' => 1,
				'User.deleted' => 0,
			);
		} elseif ($keyword == 'female') { //for female searching
			$condition = array(
				'User.id' => $userId,
				'User.gender' => 2,
				'User.deleted' => 0,
			);
		} else {
			$condition = array(
				'User.id' => $userId,
				'User.deleted' => 0,
				'OR' => array(
					array('User.jobseeker_id LIKE' => '%' . $keyword . '%'),
					array('User.email LIKE' => '%' . $keyword . '%'),
					array('User.name LIKE' => '%' . $keyword . '%')
				)
			);
		}

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'asc'),
			'conditions' => $condition
		);

		$pag = $this->paginate('OccupationApply');
		$this->set(compact('pag' , 'limit'));
	}

	public function browse($id) {
		$nation = $this->OptionCommon->nationality ;
		$marital_status = $this->OptionCommon->marital_status ;
		$religion = $this->OptionCommon->religion ;
		$language_skill = $this->OptionCommon->language_skill ;
		$ms_skill = $this->OptionCommon->ms_skill_level ;
		$salary = $this->OptionCommon->salary_range ;
		$availability = $this->OptionCommon->availability ;
		$edu = $this->OptionCommon->education ;
		$month = $this->OptionCommon->month;
		$industry = $this->IndustryBig->find('list', array('fields' => array('id', 'label')));
		$job = $this->JobCategorie->find('list', array('fields' => array('id', 'label')));
		$jobSub = $this->JobCategorieSub->find('list', array('fields' => array('id', 'label')));
		$language = $this->OptionCommon->language;
		$computer_skill_level = $this->OptionCommon->computer_skill_level;

		if (!$id) {
			$this->Session->setFlash('Enter user ID。', "error");
			$this->redirect(array('action' => 'index'));
		}

		$occ = $this->OccupationApply->findByid($id);

		$userdata = $this->User->findByid($occ['OccupationApply']['user_id']); //User personal info

		$user_language = $this->UserLanguageSkill->find('all', array(
			'conditions' => array(
				'UserLanguageSkill.user_id' => $occ['OccupationApply']['user_id']),
			'fields' => array('skill','certificate')
		));

		$user_edu = $this->UserEducation->find('all', array(
			'conditions' => array(
				'UserEducation.user_id' => $occ['OccupationApply']['user_id']),
			'fields' => array(
				'university_name','department','degree','enrollment','graduation','remarks')
		));

		$user_career = $this->UserCareerHistory->find('all',array(
			'conditions' => array(
				'UserCareerHistory.user_id' => $occ['OccupationApply']['user_id'])
			));

		$user_computing = $this->UserComputingSkill->find('all',array(
			'conditions' => array(
				'UserComputingSkill.user_id' => $occ['OccupationApply']['user_id'])
			));

		$user_qualification = $this->UserQualification->find('all',array(
			'conditions' => array(
				'UserQualification.user_id' => $occ['OccupationApply']['user_id'])
			));

		$user_instruction = $this->UserSpecialInstruction->find('all',array(
			'conditions' => array(
				'UserSpecialInstruction.user_id' => $occ['OccupationApply']['user_id'])
			));

		$user_core = $this->UserCoreSkill->find('all',array(
			'conditions' => array(
				'UserCoreSkill.user_id' => $occ['OccupationApply']['user_id'])
			));
		/* Job category informations */
		$categoryb = $this->JobCategorie->find('list',array(
			'fields' => 'JobCategorie.label'));
		$categorys = $this->JobCategorieSub->find('list',array(
			'fields' => 'JobCategorieSub.label'));

		/* Job's Region */
		$region = $this->Region->findById($occ['Occupation']['location_small_id']);

		/* Jobseeker's location */
		$location = $this->Region->find('list',array(
			'fields' => array('id','name')
			)
		);

		if ($region) {
			$job_region = $region['Region']['name'];
		}

		// Getting the total industries for determination which industries are included in user's information
		$industryb = $this->IndustryBig->find('list',array(
			'fields' => 'IndustryBig.label'));
		$industrys = $this->IndustrySmall->find('list',array(
			'fields' => 'IndustrySmall.label'));

		/* Company informations */
		$company_info = $this->CmpHeadhunter->findById($occ['OccupationApply']['cmp_headhunter_id']);

		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill','occ','company_info','job_region','location','industrys','industryb','month','industry','job','jobSub','language','computer_skill_level'));
	}

	public function warning() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? strtolower(trim($this->params->query['keyword'])) : '';
		$condition = array();

		$cmpname = $this->CmpHeadhunter->find('all',array(
				'fields' =>array('company_name','headhunter_name','type','id')));

		foreach ($cmpname as $key => $value) {
			if ($value['CmpHeadhunter']['type'] == 1) {
				$company[$value['CmpHeadhunter']['id']] = $value['CmpHeadhunter']['company_name'] ;
			} else {
				$company[$value['CmpHeadhunter']['id']] = $value['CmpHeadhunter']['headhunter_name'] ;
			}
		}

		if (!empty($keyword)) {
			$co_id = $this->CmpHeadhunter->find('list',array(
				'conditions' => array(
					'OR' => array(
						'CmpHeadhunter.headhunter_name LIKE' => '%'.$keyword.'%',
						'CmpHeadhunter.company_name LIKE' => '%'.$keyword.'%'
					)
				)));

			$user_id = $this->User->find('list',array(
				'conditions' => array(
					'User.name LIKE' => '%'.$keyword.'%'),
				'fields' => 'id'));

			$job_id = $this->Occupation->find('list',array(
				'conditions' => array(
					'OR' => array(
						'Occupation.job_title LIKE' => '%'.$keyword.'%',
						'Occupation.job_id LIKE' => '%'.$keyword.'%'
						)
					),
				'fields' => 'id'));

			$condition = array(
				'OR' => array(
					array(
						'OccupationApply.cancel_status' => 1,
						'OccupationApply.status' => 2
					),
					array(
						'OccupationApply.cancel_status' => 1,
						'OccupationApply.status' => 3
					)
				),
				'OR' => array(
					array('OccupationApply.cmp_headhunter_id' => $co_id),
					array('OccupationApply.user_id' => $user_id),
					array('OccupationApply.occupation_id' => $job_id)
				)
			);

		} else {
			$condition = array(
				'OR' => array(
					array(
						'OccupationApply.cancel_status' => 1,
						'OccupationApply.status' => 2
					),
					array(
						'OccupationApply.cancel_status' => 1,
						'OccupationApply.status' => 3
					)
				)
			);
		}

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'asc')
			);
		$pag = $this->paginate('OccupationApply', $condition);

		$this->set(compact('pag' , 'limit','company'));

	}
}