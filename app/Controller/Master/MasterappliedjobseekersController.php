<?php
App::uses('MasterAppController', 'Controller');
// Import CakePdf
App::uses('CakePdf', 'CakePdf.Pdf');
class MasterappliedjobseekersController extends MasterAppController {
	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('User','UserEducation','UserQualification','UserLanguageSkill','UserCareerHistory','UserComputingSkill','UserSpecialInstruction','UserCoreSkill','IndustryBig','IndustrySmall','JobCategorie','JobCategorieSub',	'OccupationApply','CmpHeadhunter','Region', 'Message', 'TransactionManager', 'AdminUser');

	// Display the complete information of the user and allows adoption and non-adoption
	public function browse($id = null) {
		// For showing error message and the other page instead of requested page because the ID is not provided
		if (!$id) {
			$this->Session->setFlash('Enter user ID', "error");
			$this->redirect(array('action' => 'index'));
		}

		$adminUser = $this->AdminUser->findById(1);

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

		// Extending the association-level for using all of user's informations
		$this->OccupationApply->recursive = 2;

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

		// Getting the total industries for determination which industries are included in user's information
		$industryb = $this->IndustryBig->find('list',array(
			'fields' => 'IndustryBig.label'));
		$industrys = $this->IndustrySmall->find('list',array(
			'fields' => 'IndustrySmall.label'));

		//Job's Region
		$region = $this->Region->findById($occ['Occupation']['location_small_id']);
		if ($region) {
			$job_region = $region['Region']['name'];
		}

		// Getting the total job-categories for determination which job-categories are included in user's information
		$categoryb = $this->JobCategorie->find('list',array(
			'fields' => 'JobCategorie.label'));
		$categorys = $this->JobCategorieSub->find('list',array(
			'fields' => 'JobCategorieSub.label'));

		// Company informations
		$company_info = $this->CmpHeadhunter->findById($occ['OccupationApply']['cmp_headhunter_id']);

		// Sending the user-information and others for display
		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','industryb','industrys','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill','occ','company_info','job_region', 'adminUser','month','industry','job','jobSub','language','computer_skill_level')
		);
	}


	// save the state if the user has been adopted.
	public function adoption() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {

			// adopted status and date
			$adopted_info = array(
				'id' => $this->request->data['id'],
				'status' => 3,
				'adopted_date' => date('Y-m-d'));

			if ($this->OccupationApply->saveAll($adopted_info)) {
				return true;
			}
		}
	}

	// save the state if the user has been refused.
	public function not_adopted() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$this->OccupationApply->id = $this->request->data['id'];
			if ($this->OccupationApply->saveField('status', '4')) {
				return true;
			}
		}
	}

	// save the state if the user has been refused.
	public function successAdoption() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$this->OccupationApply->id = $this->request->data['id'];
			if ($this->OccupationApply->saveField('status', '6')) {
				return true;
			}
		}
	}


	// CV download action
	public function profilePdf($id=null) {
		$this->layout = 'default';

		$data = array();

		$data['nationality'] = $this->OptionCommon->nationality;
		$data['marital_status'] = $this->OptionCommon->marital_status;
		$data['religion'] = $this->OptionCommon->religion;
		$data['language_skill'] = $this->OptionCommon->language_skill;
		$data['ms_skill'] = $this->OptionCommon->ms_skill_level;
		$data['salary'] = $this->OptionCommon->salary_range;
		$data['availability'] = $this->OptionCommon->availability;
		$data['edu'] = $this->OptionCommon->education;
		$data['month'] = $this->OptionCommon->month;
		$data['location'] = $this->Region->find('list', array('fields' => array('id', 'name')));
		$data['industry'] = $this->IndustryBig->find('list', array('fields' => array('id', 'label')));
		$data['job'] = $this->JobCategorie->find('list', array('fields' => array('id', 'label')));
		$data['jobSub'] = $this->JobCategorieSub->find('list', array('fields' => array('id', 'label')));

		$this->User->recursive = 2;
		$userInfo = $this->User->findById($id);
		$data = array_merge($data, $userInfo);

		$user_id = $userInfo['User']['jobseeker_id'];

		ini_set('memory_limit', '512M');

		$this->set(compact('data', 'user_id'));
	}

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
		$conditions = $this->OccupationApply->parseCriteria($req);
		if (!empty($occupation_id)) {
			$conditions = array_merge(array('OccupationApply.occupation_id' => $occupation_id), $conditions);
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
				'FIND_IN_SET(\''. $user_id .'\',OccupationApply.cmp_headhunter_id)',
				'OccupationApply.deleted' => 0
			),
			'recursive' => 1
		);

		$pag = $this->paginate('OccupationApply');
		$this->set(compact('pag','limit'));
	}

	public function delete($id = null) {
		if (empty($id)) {
			throw new Exception('ERROR JOBSEEKER ID NOT EXISTS');
		}
		$this->OccupationApply->id = $id;
		if (!$this->OccupationApply->exists()) {
			throw new Exception('ERROR JOBSEEKER NOT EXISTS');
		}
		$data = array('OccupationApply' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))) ;
		if (!$this->OccupationApply->save($data, array('validate' => false))) {
			throw new Exception('ERROR COULD NOT DELETE JOBSEEKER');
		}
		$this->redirect( array('action' => 'index'));
	}

	public function contact() {
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
			$data['Sender'][0]['Receiver'][0]['receiver_user_type'] = 'J';
			$data['Sender'][0]['Receiver'][0]['sender_user_type'] = $loggedInUserType;
			$data['Sender'][0]['Receiver'][0]['name'] = ($this->Auth->user('type') == 1) ? $this->Auth->user('company_name') : $this->Auth->user('headhunter_name');
			$data['Sender'][0]['Receiver'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['Receiver'][0]['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Sender'][0]['Receiver'][0]['label'] = ($this->Auth->user('type') == 1) ? 'Company' : 'Headhunter';


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
				$sent_mail_count  = $sent_mail + 1;
				$avaliable_mail_count  = $total_mail_count - $sent_mail_count;
				$total_mail_count = $total_mail_count - 1 ;
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

				// Contact status and date
				$contact_info = array(
					'id' => $this->request->data['Message']['occupation_id'],
					'status' => 2,
					'contact_date' => date('Y-m-d H:i:s'));

				if (!$this->OccupationApply->saveAll($contact_info)) {
					throw new Exception('ERROR COULD CHANGE OCCUPATION APPLY STATUS');
				}

				$this->CmpHeadhunter->id = $this->Auth->user('id');
				if (!$this->CmpHeadhunter->save($cmpData, array('validate' => false))) {
					throw new Exception('ERROR COULD CHANGE CmpHeadhunter');
				}

				$this->TransactionManager->commit($transaction);
				$this->Session->setFlash('Message has been sent', 'success');
				$this->redirect(array('controller' => 'masterappliedjobseekers', 'action' => 'browse', $this->request->data['Message']['occupation_id']));

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
				$this->redirect(array('controller' => 'masterappliedjobseekers', 'action' => 'browse', $this->request->data['Message']['user']));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->Session->setFlash('message couldn\'t sent', 'error');
				$this->TransactionManager->rollback($transaction);
			}

		}
	}
}