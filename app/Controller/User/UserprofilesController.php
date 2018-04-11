<?php
App::uses('UserAppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
class UserprofilesController extends UserAppController {
	public $components = array('RequestHandler','OptionCommon','Session');
	public $uses = array('TransactionManager','User','UserEducation','UserQualification','UserLanguageSkill','UserCareerHistory','UserComputingSkill','UserSpecialInstruction','UserCoreSkill','IndustryBig','IndustrySmall','JobCategorie','JobCategorieSub');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'user_new';
		$this->Auth->allow('index');
	}
	public function index(){
		$user_id=$this->Auth->user('id');
		$location = $this->OptionCommon->location;
		$salary_range = $this->OptionCommon->salary_range;
		$carrer_change = $this->OptionCommon->carrer_change;
		$country = $this->OptionCommon->country;
		$users=$this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		$this->set(compact('users','location','salary_range','carrer_change','country'));
	}
	public function preview($id=null) {
		$location = $this->OptionCommon->location;
		$nation = $this->OptionCommon->nationality ;
		$marital_status = $this->OptionCommon->marital_status ;
		$religion = $this->OptionCommon->religion ;
		$language_skill = $this->OptionCommon->language_skill ;
		$ms_skill = $this->OptionCommon->ms_skill_level ;
		$salary = $this->OptionCommon->salary_range ;
		$availability = $this->OptionCommon->availability ;
		$edu = $this->OptionCommon->education ;

		$userdata = $this->User->findByid($id); //User personal info

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

/* Industry informations*/
		$industryb = $this->IndustryBig->find('list',array(
			'fields' => 'IndustryBig.label'));
		$industrys = $this->IndustrySmall->find('list',array(
			'fields' => 'IndustrySmall.label'));

/* Job category informations*/
		$categoryb = $this->JobCategorie->find('list',array(
			'fields' => 'JobCategorie.label'));
		$categorys = $this->JobCategorieSub->find('list',array(
			'fields' => 'JobCategorieSub.label'));

		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','industryb','industrys','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill'));
	}

	public function writeHtmlToPdf($filePath, $view, $profileData = null) {
		// PDF configuration
		$this->pdfConfig = array(
			'orientation'=>'portrait',
			'encoding' => 'UTF-8',
			'download' => true
		);

		// Write html to pdf
		$CakePdf = new CakePdf();
		$CakePdf->template($view, 'custom');
		$CakePdf->viewVars(array('profileData' => $profileData));
		$flag = $CakePdf->write($filePath);
	}

	public function download($fileName, $filePath) {
		clearstatcache();
		setlocale(LC_ALL,'en_US.UTF-8');
		header('Content-Description: File Transfer');
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment; filename='.$fileName);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Content-Length: ' . filesize($filePath));
		readfile($filePath);
		exit;
	}

	public function profilePdf($id=null) {
		$this->autoRender = FALSE;
		$this->layout = 'pdf/custom';
		if (empty($id)) {
			$this->Session->setFlash('No ID is provided!');
			$this->redirect(array('action' => 'index'));
		}

		$location = $this->OptionCommon->location;
		$education = $this->OptionCommon->education;
		$language_skill = $this->OptionCommon->language_skill;
		$nationality = $this->OptionCommon->nationality;
		$ms_skill_level = $this->OptionCommon->ms_skill_level;
		$availability = $this->OptionCommon->availability;
		$salary_range = $this->OptionCommon->salary_range;
		$users = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));

		$users['User']['nationality'] = $nationality[$users['User']['nationality']];
		foreach ($users['UserEducation'] as $key => $value) {
			$users['UserEducation'][$key]['degree'] = $education[$value['degree']];
		}
		foreach ($users['UserLanguageSkill'] as $key => $value) {
			$users['UserLanguageSkill'][$key]['skill'] = $language_skill[$value['skill']];
		}
		foreach ($users['UserComputingSkill'] as $key => $value) {
			$users['UserComputingSkill'][$key]['skill'] = $ms_skill_level[$value['skill']];
		}
		$users['UserCoreSkill'][0]['expected_salary'] = $salary_range[$users['UserCoreSkill'][0]['expected_salary']];
		$users['UserCoreSkill'][0]['current_salary'] = $salary_range[$users['UserCoreSkill'][0]['current_salary']];
		$users['UserCoreSkill'][0]['availability'] = $availability[$users['UserCoreSkill'][0]['availability']];
		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label'),
			'order' => array('IndustrySmall.id' => 'ASC')
		));

		$job_category = $this->JobCategorie->find('list', array(
			'fields' => array('JobCategorie.id', 'JobCategorie.label'),
			'order' => array('JobCategorie.id' => 'ASC')
		));

		$job_category_sub = $this->JobCategorieSub->find('list', array(
			'fields' => array('JobCategorieSub.id', 'JobCategorieSub.label'),
			'order' => array('JobCategorieSub.id' => 'ASC')
		));

		foreach ($users['UserCareerHistory'] as $key => $value) {
			$users['UserCareerHistory'][$key]['industry_small'] = $small_industry[$value['industry_small']];
			$users['UserCareerHistory'][$key]['industry_big'] = $big_industry[$value['industry_big']];
			$users['UserCareerHistory'][$key]['job_category'] = $job_category[$value['job_category']];
			$users['UserCareerHistory'][$key]['job_category_sub'] = $job_category_sub[$value['job_category_sub']];
		}
		$filePath = WWW_ROOT . 'files' . DS . 'profile_pdf'. DS . 'profile_pdf_'.$users['User']['id'].'.pdf';
		$fileName = 'profile_pdf_'.$users['User']['id'].'.pdf';
		$view = 'profile_pdf';
		$this->writeHtmlToPdf($filePath, $view, $users);
		//Check CakePdf->write function return true or false. if return false can't download
		if (file_exists($filePath)) {
			$this->download($fileName, $filePath);
		}
		return $this->redirect(array('controller' => 'userprofiles', 'action' => 'index'));
	}
}