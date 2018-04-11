<?php
App::uses('MasterAppController', 'Controller');

class MasterkeptjobseekersController extends MasterAppController {
	public $components = array('OptionCommon',
				'Search.Prg' => array(
					'commonProcess' => array(
						'paramType' => 'querystring',
						'filterEmpty' => true
				)
			)
		);

	public $uses = array('User','UserEducation','UserQualification','UserLanguageSkill','UserCareerHistory','UserComputingSkill','UserSpecialInstruction','UserCoreSkill','CmpHeadhunter','MasterKeepUser','IndustryBig','IndustrySmall','JobCategorie','JobCategorieSub','Region','TransactionManager');

	public function index() {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$loginedUser = $this->Auth->user('id');

		$this->Prg->commonProcess();
		$req = $this->passedArgs;
		$gender = array('1' => 'male', '2' => 'female');

		if (!empty($keyword)) {
			$genderKey = array_search(strtolower($keyword), array_map('strtolower', $gender));
			if ($genderKey) {
				$req['keyword'] = $genderKey;
			}
		}

		$conditions = array();
		$conditions = $this->MasterKeepUser->parseCriteria($req);

		if (!empty($genderKey)) { //Search by gender
			$array1 = array_keys($conditions['OR']);
			$array2 = array_values($conditions['OR']);
			$temp1 = end($array1);
			$temp2 = end($array2);
			unset($conditions['OR']);
			$conditions['OR'] = array($temp1 => $temp2);
		}

		$this->paginate = array(
			'limit' => $limit,
			'order' => array('id' => 'asc'),
			'fields' => '*',
			'conditions' => array(
				$conditions,
				'FIND_IN_SET(\''. $loginedUser .'\',MasterKeepUser.cmp_headhunter_id)'
			)
		);

		$pag = $this->paginate('MasterKeepUser');

		$this->set(compact('pag','limit','marital_status'));
	}

	public function browse($id = null) {
		// Getting the commonly used informations of carrer-change period, final-education and language-skill, written in OptionCommonComponent
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

		$userdata = $this->User->findById($id); //User personal info

		$user_language = $this->UserLanguageSkill->find('all', array(
			'conditions' => array(
				'UserLanguageSkill.user_id' => $id),
			'fields' => array('skill','certificate')
		));

		$user_edu = $this->UserEducation->find('all', array(
			'conditions' => array(
				'UserEducation.user_id' => $id),
			'fields' => array(
				'university_name','department','degree','enrollment','graduation','remarks')
		));

		$user_career = $this->UserCareerHistory->find('all',array(
			'conditions' => array(
				'UserCareerHistory.user_id' => $id)
			));

		$user_computing = $this->UserComputingSkill->find('all',array(
			'conditions' => array(
				'UserComputingSkill.user_id' => $id)
			));

		$user_qualification = $this->UserQualification->find('all',array(
			'conditions' => array(
				'UserQualification.user_id' => $id)
			));

		$user_instruction = $this->UserSpecialInstruction->find('all',array(
			'conditions' => array(
				'UserSpecialInstruction.user_id' => $id)
			));

		$user_core = $this->UserCoreSkill->find('all',array(
			'conditions' => array(
				'UserCoreSkill.user_id' => $id)
			));

		// Getting the total industries for determination which industries are included in user's information
		$industryb = $this->IndustryBig->find('list',array(
			'fields' => 'IndustryBig.label'));
		$industrys = $this->IndustrySmall->find('list',array(
			'fields' => 'IndustrySmall.label'));

		// Getting the total job-categories for determination which job-categories are included in user's information
		$categoryb = $this->JobCategorie->find('list',array(
			'fields' => 'JobCategorie.label'));
		$categorys = $this->JobCategorieSub->find('list',array(
			'fields' => 'JobCategorieSub.label'));

		// Jobseeker's location
		$location = $this->Region->find('list',array(
			'fields' => array('id','name')
			)
		);

		// Company informations
		$company_info = $this->CmpHeadhunter->findById($this->Auth->user('id'));

		// Sending the user-information and others for display
		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','industryb','industrys','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill','occ','location','company_info','month','industry','job','jobSub','language','computer_skill_level'));
	}
}