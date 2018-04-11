<?php
App::uses('MasterAppController', 'Controller');
// Import CakePdf
App::uses('CakePdf', 'CakePdf.Pdf');
class MastersavedjobseekersController extends MasterAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('User','UserEducation','UserQualification','UserLanguageSkill','UserCareerHistory','UserComputingSkill','UserSpecialInstruction','UserCoreSkill','IndustryBig','IndustrySmall','JobCategorie','JobCategorieSub',	'OccupationFavorite','CmpHeadhunter','Region', 'Message', 'TransactionManager', 'AdminUser');


	public function index($occupation_id = 0) {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$user_id = $this->Auth->user('id');

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
		$conditions = $this->OccupationFavorite->parseCriteria($req);

		if (!empty($occupation_id)) {
			$conditions = array_merge(array('OccupationFavorite.occupation_id' => $occupation_id), $conditions);
		}

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
				'FIND_IN_SET(\''. $user_id .'\',OccupationFavorite.cmp_headhunter_id)',
				'OccupationFavorite.deleted' => 0
			),
			'recursive' => 1
		);

		$pag = $this->paginate('OccupationFavorite');
		$this->set(compact('pag','limit'));
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

		// Extending the association-level for using all of user's informations
		// $this->OccupationFavorite->recursive = 2;

		$occ = $this->OccupationFavorite->findByUser_id($id);

		$userdata = $this->User->findByid($occ['OccupationFavorite']['user_id']); //User personal info

		$user_language = $this->UserLanguageSkill->find('all', array(
			'conditions' => array(
				'UserLanguageSkill.user_id' => $occ['OccupationFavorite']['user_id']),
			'fields' => array('skill','certificate')
		));

		$user_edu = $this->UserEducation->find('all', array(
			'conditions' => array(
				'UserEducation.user_id' => $occ['OccupationFavorite']['user_id']),
			'fields' => array(
				'university_name','department','degree','enrollment','graduation','remarks')
		));

		$user_career = $this->UserCareerHistory->find('all',array(
			'conditions' => array(
				'UserCareerHistory.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		$user_computing = $this->UserComputingSkill->find('all',array(
			'conditions' => array(
				'UserComputingSkill.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		$user_qualification = $this->UserQualification->find('all',array(
			'conditions' => array(
				'UserQualification.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		$user_instruction = $this->UserSpecialInstruction->find('all',array(
			'conditions' => array(
				'UserSpecialInstruction.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		$user_core = $this->UserCoreSkill->find('all',array(
			'conditions' => array(
				'UserCoreSkill.user_id' => $occ['OccupationFavorite']['user_id'])
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
		$company_info = $this->CmpHeadhunter->findByCompany_id($occ['Occupation']['cmp_headhunter_id']);

		// Sending the user-information and others for display
		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','industryb','industrys','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill','occ','location','company_info'));
	}

}