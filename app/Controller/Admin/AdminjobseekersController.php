<?php
App::uses('AdminAppController', 'Controller');
// App::uses('CakeEmail', 'Network/Email');
class AdminjobseekersController extends AdminAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('User','UserEducation','UserQualification','UserLanguageSkill','UserCareerHistory','UserComputingSkill','UserSpecialInstruction','UserCoreSkill','IndustryBig','IndustrySmall','JobCategorie','JobCategorieSub','OccupationApply','OccupationFavorite','TransactionManager','Region');
	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'admin';
	}
	public function index () {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ?  strtolower(trim($this->params->query['keyword'])) : '';
		$condition = array();

		if ($keyword == 'male') {
			$condition = array(
				'User.gender' => '1',
				'User.deleted' => 0
			);
		}elseif($keyword == 'female') {
			$condition = array(
				'User.gender' => '2',
				'User.deleted' => 0
			);
		}else{
			$condition = array(
				'User.deleted' => 0,
				'OR' => array(
					array('User.jobseeker_id LIKE' => '%'.$keyword.'%'),
					array('User.email LIKE' => '%'.$keyword.'%'),
					array('User.name LIKE' => '%'.$keyword.'%'),
				)
			);
		}

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'asc'),
			'conditions' => $condition
		);

		$pag = $this->paginate('User');
		$this->set(compact('pag','limit'));
	}
	public function browse ($id) {
		$nation = $this->OptionCommon->nationality ;
		$marital_status = $this->OptionCommon->marital_status ;
		$religion = $this->OptionCommon->religion ;
		$language_skill = $this->OptionCommon->language_skill ;
		$ms_skill = $this->OptionCommon->ms_skill_level ;
		$salary = $this->OptionCommon->salary_range ;
		$availability = $this->OptionCommon->availability ;
		$edu = $this->OptionCommon->education ;
		$location = $this->Region->find('list', array(
			'fields' => array('id', 'name'),
		));
		$industry = $this->IndustryBig->find('list', array('fields' => array('id', 'label')));
		$job = $this->JobCategorie->find('list', array('fields' => array('id', 'label')));
		$jobSub = $this->JobCategorieSub->find('list', array('fields' => array('id', 'label')));
		$language = $this->OptionCommon->language;
		$month = $this->OptionCommon->month;
		$computer_skill_level = $this->OptionCommon->computer_skill_level;

		if (!$id) {
			$this->Session->setFlash('Enter user ID。', "error");
			$this->redirect(array('action' => 'index'));
		}

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

		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','industryb','industrys','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill','location','month','industry','job','jobSub','language','computer_skill_level'));
	}
	public function approved($id = null) {
		$approved = $this->User->findById($id);
		$this->User->id = $id;
		if ($approved['User']['withdraw'] == true){
			$this->User->saveField('withdraw', '0');
		}else {
			if (!$this->User->save(array('User' => array('withdraw' => 1)), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP MASTER USER');
			}
		}
		$this->redirect( array('action' => 'index'));
	}
	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR MASTER USER ID NOT EXISTS');
			}
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new Exception('ERROR MASTER USER NOT EXISTS');
			}
			if (!$this->User->save(array('User' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT DELETE MASTER USER');
			}
			$this->TransactionManager->commit($transaction);
		}
		catch (Exception $e) {
			$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
			$this->log($e->getMessage(), LOG_ERR);
			$this->TransactionManager->rollback($transaction);
			$this->redirect(array('action' => 'index'));
		}
		$this->redirect(array('action' => 'index'));
	}
}