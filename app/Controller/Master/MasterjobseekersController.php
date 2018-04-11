<?php
App::uses('MasterAppController', 'Controller');
class MasterjobseekersController extends  MasterAppController {
	public $uses = array('User','UserEducation','UserQualification','UserLanguageSkill','UserCareerHistory','UserComputingSkill','UserSpecialInstruction','UserCoreSkill','IndustryBig','IndustrySmall','JobCategorie','JobCategorieSub','OccupationApply','OccupationFavorite','CmpHeadhunter','Region', 'Occupation', 'TransactionManager', 'Message', 'AdminUser','MasterKeepUser');

	public $components = array('OptionCommon','RequestHandler', 'Session',
				'Search.Prg' => array(
					'commonProcess' => array(
						'paramType' => 'querystring',
						'filterEmpty' => true
				)
			)
		);

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'master';
	}

	public function index() {
		$master_id = $this->Auth->user('id');
		$error = true;
		$ages = $this->OptionCommon->age;
		$language_skill = $this->OptionCommon->language_skill;
		$language = $this->OptionCommon->language;
		$education = $this->OptionCommon->education;
		$salary_range = $this->OptionCommon->salary_range;
		$religion = $this->OptionCommon->religion;
		$marital_status = $this->OptionCommon->marital_status;
		$nationality = $this->OptionCommon->nationality;
		$availability = $this->OptionCommon->availability;
		$ms_skill_level = $this->OptionCommon->ms_skill_level;

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
			));
		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
			));
		$big_job = $this->JobCategorie->find('list', array(
			'fields' => array('JobCategorie.id', 'JobCategorie.label'),
			'order' => array('JobCategorie.id' => 'ASC')
		));
		$small_job = $this->JobCategorieSub->find('list', array(
			'fields' => array('JobCategorieSub.id', 'JobCategorieSub.label','JobCategorieSub.job_category_id'),
			'order' => array('JobCategorieSub.job_category_id' => 'ASC')
		));

		/* Jobseeker's location */
		$location = $this->Region->find('list',array(
			'fields' => array('id','name')
			)
		);

		$this->User->recursive = 0;
		$this->Prg->commonProcess();
		$this->paginate = array(
			'conditions' => $this->User->parseCriteria($this->passedArgs),
			'paramType' => 'querystring',
			'order' => array('id' => 'desc'),
		);
		$users = $this->paginate();
		$this->set(compact('location','salary_range','big_industry','small_industry','big_job','small_job','language_skill','language','error','education','users', 'religion', 'marital_status', 'nationality', 'availability', 'ms_skill_level', 'master_id','ages'));
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
		$loginedUser = $this->Auth->User('id');
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

		$adminUser = $this->AdminUser->findById(1);

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

		$company_info = $this->CmpHeadhunter->findById($this->Auth->user('id'));

		$this->Occupation->recursive = -1;
		$jobInfo_info = $this->Occupation->find('all', array(
			'conditions' => array(
				'ch_id' => $this->Auth->user('id'),
				'deactivate' => 0
			)
		));

/* Industry informations */
		$industryb = $this->IndustryBig->find('list',array(
			'fields' => 'IndustryBig.label'));
		$industrys = $this->IndustrySmall->find('list',array(
			'fields' => 'IndustrySmall.label'));

/* Job category informations */
		$categoryb = $this->JobCategorie->find('list',array(
			'fields' => 'JobCategorie.label'));
		$categorys = $this->JobCategorieSub->find('list',array(
			'fields' => 'JobCategorieSub.label'));

/* Master kept users */
		$keptUser = $this->MasterKeepUser->find('list',array(
			'conditions' => array(
				'MasterKeepUser.cmp_headhunter_id' => $loginedUser,
				'MasterKeepUser.user_id' => $id)));


		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','industryb','industrys','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill', 'company_info', 'jobInfo_info', 'adminUser','keptUser','month','industry','job','jobSub','language','computer_skill_level'));
	}

	public function search_result() {
		$error = true;
		$gender = $this->OptionCommon->gender;
		$language_skill = $this->OptionCommon->language_skill;
		$language = $this->OptionCommon->language;
		$education = $this->OptionCommon->education;
		$salary_range = $this->OptionCommon->salary_range;
		$loginedUser = $this->Auth->user('id');

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
			));

		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
			));

		$big_job = $this->JobCategorie->find('list', array(
			'fields' => array('JobCategorie.id', 'JobCategorie.label'),
			'order' => array('JobCategorie.id' => 'ASC')
		));

		$small_job = $this->JobCategorieSub->find('list', array(
			'fields' => array('JobCategorieSub.id', 'JobCategorieSub.label','JobCategorieSub.job_category_id'),
			'order' => array('JobCategorieSub.job_category_id' => 'ASC')
		));

		$job_category = $this->JobCategorie->find('list', array(
			'fields' =>array('label'),
			'conditions' => array('JobCategorie.deleted' =>0)
			)
		);
		$job_category_sub= $this->JobCategorieSub->find('list', array(
			'fields' =>array('label'),
			'conditions' => array('JobCategorieSub.deleted' =>0)
			)
		);
		$BIndustry = $this->IndustryBig->find('list', array(
			'fields' =>array('label'),
			'conditions' => array('IndustryBig.deleted' =>0)
			)
		);
		$SIndustry = $this->IndustrySmall->find('list', array(
			'fields' =>array('label'),
			'conditions' => array('IndustrySmall.deleted' =>0)
			)
		);

		$company_info = $this->CmpHeadhunter->findById($this->Auth->user('id'));

		/* Jobseeker's location */
		$location = $this->Region->find('list',array(
			'fields' => array('id','name')
			)
		);

		$this->Prg->commonProcess();
		$this->paginate = array(
			'conditions' => array(
				$this->User->parseCriteria($this->passedArgs),
				'NOT' => array(
					'FIND_IN_SET(\''. $loginedUser .'\',User.non_disclosure)'
				)
			),
			'limit' => 50,
			'paramType' => 'querystring',
			'order' => array('id' => 'desc'),
			'recursive' => 2
		);
		$users = $this->paginate();
		$this->set(compact('pag','limit','education','location','salary_range','big_industry','small_industry','big_job','small_job','language_skill','language','error','users'));
	}

	public function sendmessage() {
		$this->autoRender = false;

		if ($this->request->is('post')) {

			// get current logged in user type
			$loggedInUserType = $this->Auth->user('company_id');
			$loggedInUserType = $loggedInUserType[0];

			if (!empty($this->request->data['ch_id'])) {
				if (count($this->request->data['ch_id']) > 1) {
					$job_id = implode(',', $this->request->data['ch_id']);
				} else {
					$job_id = $this->request->data['ch_id'][0];
				}
			} else {
				$job_id = '';
			}

			$data = array();

			// initial data for insert to messages table
			$data['Message']['subject'] = $this->request->data['Message']['subject'];
			$data['Message']['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Message']['label'] = $loggedInUserType;

			$data['Sender'][0]['to'] = $this->request->data['Message']['to'];
			$data['Sender'][0]['from'] = $this->Auth->user('email');
			$data['Sender'][0]['creator_id'] = $this->Auth->user('id');
			$data['Sender'][0]['sender_user_type'] = $loggedInUserType;
			$data['Sender'][0]['name'] = $this->request->data['Message']['name'];
			$data['Sender'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Sender'][0]['job_id'] = $job_id;

			// initial data for insert to receiver table
			$data['Sender'][0]['Receiver'][0]['recipient_id'] = $this->request->data['Message']['user_id'];
			$data['Sender'][0]['Receiver'][0]['receiver_user_type'] = 'J';
			$data['Sender'][0]['Receiver'][0]['sender_user_type'] = $loggedInUserType;
			$data['Sender'][0]['Receiver'][0]['name'] = ($this->Auth->user('type') == 1) ? $this->Auth->user('company_name') : $this->Auth->user('headhunter_name');
			$data['Sender'][0]['Receiver'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['Receiver'][0]['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Sender'][0]['Receiver'][0]['label'] = ($this->Auth->user('type') == 1) ? 'Company' : 'Headhunter';;
			$data['Sender'][0]['Receiver'][0]['job_id'] = $job_id;

			switch ($this->Auth->user('mail_limit')) {
				case 1:
					$mail_limit = 10;
					break;
				case 2:
					$mail_limit = 30;
					break;
				case 3:
					$mail_limit = 50;
					break;
				case 4:
					$mail_limit = 100;
					break;
				case 5:
					$mail_limit = 200;
					break;
				default:
					break;
			}

			$cmpHeadHunterData = $this->CmpHeadhunter->findById($this->Auth->user('id'));
			$mail_limit = $cmpHeadHunterData['CmpHeadhunter']['total_mail'];
			$sent_mail = $cmpHeadHunterData['CmpHeadhunter']['sent_mail'];

			if (!empty($mail_limit)) {
				$total_mail_count = (int)$mail_limit;
				$sent_mail_count = $sent_mail + 1;
				$avaliable_mail_count  = $total_mail_count - $sent_mail_count;
			}

			$cmpData = array('CmpHeadhunter' => array(
				'total_mail' => $total_mail_count,
				'sent_mail'  => $sent_mail_count,
				'avaliable_mail' => $avaliable_mail_count
			));

			try {

				$transaction = $this->TransactionManager->begin();

				if (!$this->Message->saveAssociated($data, array('deep' => true))) {
					throw new Exception('ERROR COULD NOT SENT THE MESSAGE');
				}

				$this->CmpHeadhunter->id = $this->Auth->user('id');
				if (!$this->CmpHeadhunter->save($cmpData, array('validate' => false))) {
					throw new Exception('ERROR COULD CHANGE CmpHeadhunter');
				}

				$this->TransactionManager->commit($transaction);
				$this->Session->setFlash('Message has been sent', 'success');

				if ($this->request->data['Message']['master_keep'] == 'master_keep') {
					$this->redirect(array('controller' => 'masterkeptjobseekers', 'action' => 'browse', $this->request->data['Message']['user_id']));
				} elseif($this->request->data['Message']['saved'] == 'saved') {
					$this->redirect(array('controller' => 'mastersavedjobseekers', 'action' => 'browse', $this->request->data['Message']['user_id']));
				} else {
					$this->redirect(array('controller' => 'masterjobseekers', 'action' => 'browse', $this->request->data['Message']['user_id']));
				}

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->Session->setFlash('message couldn\'t sent', 'error');
				$this->TransactionManager->rollback($transaction);
			}

		}
	}

	public function contactMailTransmittion() {
		$this->autoRender = false;

		if ($this->request->is('post')) {

			// get current logged in user type
			$loggedInUserType = $this->Auth->user('company_id');
			$loggedInUserType = $loggedInUserType[0];

			$data = array();

			// initial data for insert to messages table
			$data['Message']['subject'] = $this->request->data['Message']['subject'];
			$data['Message']['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Message']['label'] = $loggedInUserType;

			$data['Sender'][0]['to'] = $this->request->data['Message']['to'];
			$data['Sender'][0]['from'] = $this->Auth->user('email');
			$data['Sender'][0]['creator_id'] = $this->Auth->user('id');
			$data['Sender'][0]['sender_user_type'] = $loggedInUserType;
			$data['Sender'][0]['name'] = $this->request->data['Message']['name'];
			$data['Sender'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['message_body'] = nl2br($this->request->data['Message']['message_body']);

			// initial data for insert to receiver table
			$data['Sender'][0]['Receiver'][0]['recipient_id'] = $this->request->data['Message']['user_id'];
			$data['Sender'][0]['Receiver'][0]['receiver_user_type'] = 'A';
			$data['Sender'][0]['Receiver'][0]['sender_user_type'] = $loggedInUserType;
			$data['Sender'][0]['Receiver'][0]['name'] = ($this->Auth->user('type') == 1) ? $this->Auth->user('company_name') : $this->Auth->user('headhunter_name');
			$data['Sender'][0]['Receiver'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['Receiver'][0]['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Sender'][0]['Receiver'][0]['label'] = ($this->Auth->user('type') == 1) ? 'Company' : 'Headhunter';


			try {

				$transaction = $this->TransactionManager->begin();

				if (!$this->Message->saveAssociated($data, array('deep' => true))) {
					throw new Exception('ERROR COULD NOT SENT THE MESSAGE');
				}

				$this->TransactionManager->commit($transaction);
				$this->Session->setFlash('Message has been sent', 'success');
				$this->redirect(array('controller' => 'masterjobseekers', 'action' => 'browse', $this->request->data['Message']['user']));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->Session->setFlash('message couldn\'t sent', 'error');
				$this->TransactionManager->rollback($transaction);
			}

		}
	}

	public function keep($id) {
		$this->autoRender = false;
		$LoginedUser = $this->Auth->User('id');

		$keep_user['cmp_headhunter_id'] = $LoginedUser;
		$keep_user['user_id'] = $id;

		try {
			if (!$this->MasterKeepUser->save($keep_user, array('validate' => false))) {
				throw new Exception('ERROR COULD KEEP Jobseeker');
			}
			$this->redirect(array('controller' => 'masterjobseekers', 'action' => 'browse', $id));
		} catch (Exception $e) {
			$this->Session->setFlash('This jobseeker couldn\'t keep.', 'error');
			$this->TransactionManager->rollback($transaction);
		}
	}

	public function unkeep($id = null) {
		$loginedUser = $this->Auth->User('id');

		$kept = $this->MasterKeepUser->find('list',array(
			'conditions' => array(
				'MasterKeepUser.cmp_headhunter_id' => $loginedUser,
				'MasterKeepUser.user_id' => $id
				),
			'fields' => array('cmp_headhunter_id','id')
			)
		);

		$this->MasterKeepUser->id = $kept[$loginedUser];

		if (!$this->MasterKeepUser->exists()) {
			throw new NotFoundException('Enter ID.');
		}

		$this->request->allowMethod('post', 'delete');
		if ($this->MasterKeepUser->delete()) {
			$this->redirect(array('action' => 'browse',$id));
		} else {
			$this->Session->setFlash('This jobseeker couldn\'t unkeep.', "error");
		}
	}

}