<?php
App::uses('UserAppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
class MypagesController extends UserAppController {

	public $components = array('OptionCommon','Session', 'RequestHandler');

	public $uses = array(
		'User',
		'UserEducation',
		'UserComputingSkill',
		'UserCoreSkill',
		'UserSubCoreSkill',
		'UserExperience',
		'UserLanguageSkill',
		'IndustrySmall',
		'IndustryBig',
		'JobCategorie',
		'JobCategorieSub',
		'UserCareerHistory',
		'UserSpecialInstruction',
		'UserQualification',
		'Region',
		'TransactionManager'
	);

	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function mypage() {
		$this->layout = 'user_new';

		$nationality = $this->OptionCommon->nationality;
		$marital_status = $this->OptionCommon->marital_status;
		$religion = $this->OptionCommon->religion;
		$language_skill = $this->OptionCommon->language_skill;
		$ms_skill = $this->OptionCommon->ms_skill_level;
		$computer_skill_level = $this->OptionCommon->computer_skill_level;
		$salary = $this->OptionCommon->salary_range;
		$availability = $this->OptionCommon->availability;
		$edu = $this->OptionCommon->education;
		$month = $this->OptionCommon->month;
		$language = $this->OptionCommon->language;
		$location = $this->Region->find('list', array('fields' => array('id', 'name')));
		$industry = $this->IndustryBig->find('list', array('fields' => array('id', 'label')));
		$job = $this->JobCategorie->find('list', array('fields' => array('id', 'label')));
		$jobSub = $this->JobCategorieSub->find('list', array('fields' => array('id', 'label')));

		$this->User->recursive = 2;
		$userInfo = $this->User->findById($this->Auth->user('id'));

		$this->set(compact(
			'nationality',
			'marital_status',
			'religion',
			'language_skill',
			'ms_skill',
			'computer_skill_level',
			'salary',
			'availability',
			'edu',
			'userInfo',
			'month',
			'location',
			'industry',
			'job',
			'jobSub',
			'language'
		));
	}

	// User Register (1) personal information
	public function personalInfo() {
		$this->layout = 'mypage';

		$birthyear = $this->OptionCommon->birthYear();
		$location = $this->Region->find('list', array(
			'fields' => array('id', 'name'),
		));

		$user_id = $this->Auth->user('id');
		$email = $this->Auth->user('email');
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		$country = $this->OptionCommon->country;
		$nationality = $this->OptionCommon->nationality;
		$religion = $this->OptionCommon->religion;
		$marital_status = $this->OptionCommon->marital_status;

		// set data to view
		$this->set(compact('day','month','year','country', 'nationality', 'religion', 'marital_status','email', 'location', 'birthyear'));

		if ($this->request->is(array('post', 'put'))) {
			$age = $this->OptionCommon->age;

			//left string fill 0 in month and day  if chr lessthan 2
			$month = str_pad($this->request->data['User']['month'], 2, '0', STR_PAD_LEFT);
			$day = str_pad($this->request->data['User']['day'], 2, '0', STR_PAD_LEFT);

			$error = checkdate($month, $day, $this->request->data['User']['year']);
			if ($error) {
				// for Calculating age
				$birthdayDate = $this->request->data['User']['year'].'-'.$month. '-'.$day;
				$from = new DateTime($birthdayDate );
				$to = new DateTime('today');
				$realAge = date_diff(date_create($birthdayDate), date_create('today'))->y;

				//  START for define age range according to your birthday date
				if ($realAge <= 19) {
					$Age = 1;
				} elseif ($realAge >= 50) {
					$Age = 5;
				} else {
					foreach ($age as $ageKey => $ageValue) {
						if (strstr($ageValue, "to")) {
							$ageValArray = explode('to', $ageValue);
							if ((int)$ageValArray[0] <= $realAge && (int)$ageValArray[1] >= $realAge) {
								$Age = $ageKey;
							}
						}
					}
				}

				$this->request->data['User']['age_range'] = $Age;

				// remove validate
				$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword','about_myself','subject','message');
				foreach ($validateAttrKey as $key => $value) {
					$this->User->validator()->remove($value);
				}
				try {
					$transaction = $this->TransactionManager->begin();

					$year = $this->request->data['User']['year'];
					$month = $this->request->data['User']['month'];
					$day = $this->request->data['User']['day'];
					$this->request->data['User']['birthday'] = $year.'-'.$month.'-'.$day;

					$this->User->id = $this->Auth->user('id');
					if (!$this->User->save($this->request->data)) {
						throw new Exception("ERROR OCCUR DURING INSERT PERSONAL INFORMATION");
					}

					$this->TransactionManager->commit($transaction);
					$this->redirect(array('action' => 'education'));
				} catch (Exception $e) {

					$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
					$this->log($e->getMessage(), LOG_ERR);
					$this->TransactionManager->rollback($transaction);
				}
			} else {
				$errors['day'][0] = 'Invalid Date.';
				$this->__convertToValidationErrors($errors);
			}
		}
	}

	public function personalInfoUpdate() {
		$this->layout = 'user_new';

		// Initial data for view
		$birthyear = $this->OptionCommon->birthYear();
		$location = $this->Region->find('list', array('fields' => array('id', 'name')));
		$user_id = $this->Auth->user('id');
		$email = $this->Auth->user('email');
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		$country = $this->OptionCommon->country;
		$nationality = $this->OptionCommon->nationality;
		$religion = $this->OptionCommon->religion;
		$marital_status = $this->OptionCommon->marital_status;

		$this->User->recursive = -1;
		$userInfo = $this->User->findById($this->Auth->user('id'));

		// set data to view
		$this->set(compact('day','month','year','country', 'nationality', 'religion', 'marital_status','email', 'location', 'birthyear', 'userInfo'));

		if ($this->request->is(array('post', 'put'))) {
			$age = $this->OptionCommon->age;

			//left string fill 0 in month and day  if chr lessthan 2
			$month = str_pad($this->request->data['User']['month'], 2, '0', STR_PAD_LEFT);
			$day = str_pad($this->request->data['User']['day'], 2, '0', STR_PAD_LEFT);

			$error = checkdate($month, $day, $this->request->data['User']['year']);

			if ($error) {
				// for Calculating age
				$birthdayDate = $this->request->data['User']['year'].'-'.$month. '-'.$day;

				$from = new DateTime($birthdayDate);
				$to = new DateTime('today');
				$realAge = date_diff(date_create($birthdayDate), date_create('today'))->y;

				// START for define age range according to your birthday date
				if ($realAge <= 19) {
					$Age = 1;
				} else if ($realAge >= 50) {
					$Age = 5;
				} else {
					foreach ($age as $ageKey => $ageValue) {
						if (strstr($ageValue, "to")) {
							$ageValArray = explode('to', $ageValue);
							if ((int)$ageValArray[0] <= $realAge && (int)$ageValArray[1] >= $realAge) {
								$Age = $ageKey;
							}
						}
					}
				}

				$this->request->data['User']['age_range'] = $Age;

				// remove validate
				$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword','about_myself','subject','message');
				foreach ($validateAttrKey as $key => $value) {
					$this->User->validator()->remove($value);
				}

				if (!empty($userInfo)) {
					$path = ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.'img'.DS.'User'.DS.$userInfo['User']['id'];
					if (is_dir($path)) {
						$files = array_diff(scandir($path), array('.','..'));
						foreach ($files as $file) {
							(is_dir("$path/$file")) ? delTree("$path/$file") : unlink("$path/$file");
						}
						rmdir($path);
					}
				}

				try {
					$transaction = $this->TransactionManager->begin();

					$year = $this->request->data['User']['year'];
					$month = $this->request->data['User']['month'];
					$day = $this->request->data['User']['day'];
					$this->request->data['User']['birthday'] = $year.'-'.$month.'-'.$day;

					$this->User->id = $this->Auth->user('id');
					if (!$this->User->save($this->request->data)) {
						throw new Exception("ERROR OCCUR DURING INSERT PERSONAL INFORMATION");
					}

					$this->TransactionManager->commit($transaction);
					$this->redirect(array('controller' => 'mypages', 'action' => 'mypage'));

				} catch (Exception $e) {

					$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
					$this->log($e->getMessage(), LOG_ERR);
					$this->TransactionManager->rollback($transaction);
				}
			} else {
				$errors['day'][0] = 'Invalid Date.';
				$this->__convertToValidationErrors($errors);
			}
		}

		if (empty($this->request->data)) {

			if (!empty($userInfo['User']['birthday'])) {
				$birthday = explode('-', $userInfo['User']['birthday']);
				$userInfo['User']['day'] = $birthday[2];
				$userInfo['User']['month'] = $birthday[1];
				$userInfo['User']['year'] = $birthday[0];
				$this->request->data = $userInfo;
			}
		}
	}

	public function education() {

		$this->layout = 'mypage';

		$education = $this->OptionCommon->education;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();

		$id = $this->Auth->user('id');

		$this->set(compact('education', 'month', 'year', 'id'));

		if ($this->request->is(array('post', 'put'))) {
			unset($this->request->data['toggle']);

			try {
				$transaction = $this->TransactionManager->begin();

				$error = false;

				foreach ($this->request->data['UserEducation'] as $key => $value) {
					$enrollment = strtotime($value['enroll_year'] . '-' . $value['enroll_month'] . '-01');

					if (!empty($value['gd_year']) && !empty($value['gd_month'])) {
						$graduation = strtotime($value['gd_year'] . '-' . $value['gd_month'] . '-01');

						if ($graduation <= $enrollment) {
							$errors[$key]['gd_month'][0] = 'Graduation date cannot be bigger than Enrollment date.';
							$error = true;
						}

						$this->request->data['UserEducation'][$key]['graduation'] = date('Y-m-d', $graduation);
					}
					$this->request->data['UserEducation'][$key]['user_id'] = $id;
					$this->request->data['UserEducation'][$key]['enrollment'] = date('Y-m-d', $enrollment);
					$this->request->data['UserEducation'][$key]['university_name'] = $value['university_name'];
					$this->request->data['UserEducation'][$key]['department'] = $value['department'];
					$this->request->data['UserEducation'][$key]['degree'] = $value['degree'];
					$this->request->data['UserEducation'][$key]['remarks'] = $value['remarks'];
				}

				if ($error === true) {
					$this->__convertToEducationValidationErrors($errors);
					throw new Exception('Graduation and Enrollment date error!');
				}

				if (!$this->UserEducation->saveAll($this->request->data['UserEducation'])) {
					throw new Exception("ERROR OCCUR DURING INSERT EDUCATION INFORMATION");
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'language'));
			} catch (Exception $e) {

				$requestData = $this->request->data;
				$this->set(compact('requestData'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}

	public function language() {

		$this->layout = 'mypage';

		$id = $this->Auth->user('id');
		$language_skill = $this->OptionCommon->language_skill;
		$language = $this->OptionCommon->language;

		$this->set(compact('language_skill','language', 'id'));

		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();

				// to remove other language that chosen nothing.
				foreach ($this->request->data['UserLanguageSkill'] as $key => $value) {
					if (empty($value['language'])) {
						unset($this->request->data['UserLanguageSkill'][$key]);
					}
				}

				if (!$this->UserLanguageSkill->saveAll($this->request->data['UserLanguageSkill'])) {
					throw new Exception("ERROR OCCUR DURING INSERT LANGUAGE INFORMATION");
				}

				$this->User->id = $this->Auth->User('id');
				if (!$this->User->save(array('User' => array('new_arrival' => 1)), array('validate' => false))) {
					throw new Exception("ERROR OCCUR DURING UPDATE NEW ARRIVAL COLUMN IN USER");
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('controller' => 'mypages', 'action' => 'mypage'));
			} catch (Exception $e) {

				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}

	public function language_update() {
		$this->layout = 'user_new';
		$current_user_id = $this->Auth->user('id');
		$language_skill = $this->OptionCommon->language_skill;
		$language = $this->OptionCommon->language;
		$user_language = $this->UserLanguageSkill->find('all', array(
			'conditions' => array(
				'UserLanguageSkill.user_id' => $current_user_id)
		));
		$languages = array();
		foreach ($user_language as $key => $value) {
			$languages['UserLanguageSkill'][$key] = $value['UserLanguageSkill'];
		}
		if (empty($this->request->data)) {
			$this->request->data = $languages;
		}
		$this->set(compact('language_skill','language', 'languages', 'current_user_id'));
		if ($this->request->is(array('post', 'put'))) {

			// to remove other language that chosen nothing.
			foreach ($this->request->data['UserLanguageSkill'] as $key => $value) {
				if (empty($value['language'])) {
					unset($this->request->data['UserLanguageSkill'][$key]);
				}
			}

			if (!empty($user_language)) {
				$this->UserLanguageSkill->deleteAll(array('UserLanguageSkill.user_id' => $current_user_id), false);
			}

			if ($this->UserLanguageSkill->saveAll($this->request->data['UserLanguageSkill'])) {
				$this->redirect(array('action' => 'mypage'));
			}
		}
	}

	public function education_update() {
		$this->layout = 'user_new';

		$current_user_id = $this->Auth->user('id');
		$education = $this->OptionCommon->education;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();

		$user_education = $this->UserEducation->find('all', array(
			'conditions' => array(
				'UserEducation.user_id' => $current_user_id
			)
		));

		$educations = array();
		foreach ($user_education as $key => $value) {
			$value['UserEducation']['enrollment'] = explode('-', $value['UserEducation']['enrollment']);
			unset($value['UserEducation']['enrollment'][2]);
			$value['UserEducation']['enroll_month'] = $value['UserEducation']['enrollment'][1];
			$value['UserEducation']['enroll_year'] = $value['UserEducation']['enrollment'][0];

			if ($value['UserEducation']['graduation'] != null) {
				$value['UserEducation']['enrollment'] = explode('-', $value['UserEducation']['graduation']);
				$value['UserEducation']['gd_month'] = $value['UserEducation']['enrollment'][1];
				$value['UserEducation']['gd_year'] = $value['UserEducation']['enrollment'][0];
			} else {
				$value['UserEducation']['toggle'] = true;
			}
			$educations['UserEducation'][$key] = $value['UserEducation'];
		}


		if (empty($this->request->data)) {
			$this->request->data = $educations;
		}

		$this->set(compact('education','month','year', 'educations', 'current_user_id'));


		if ($this->request->is(array('post', 'put'))) {
			if (!empty($user_education)) {
				$this->UserEducation->deleteAll(array('UserEducation.user_id' => $current_user_id), false);
			}

			try {
				$transaction = $this->TransactionManager->begin();

				foreach ($this->request->data['UserEducation'] as $key => $value) {
					$this->request->data['UserEducation'][$key]['user_id'] = $current_user_id;

					$error = false;
					// change the enrollment date to unix time.
					$enrollment = strtotime($value['enroll_year'] . '-' . $value['enroll_month'] . '-01');

					if (!empty($value['gd_year']) && !empty($value['gd_month'])) {
						// change the graduation date to unix time.
						$graduation = strtotime($value['gd_year'] . '-' . $value['gd_month'] . '-01');

						// validate the graduation date and enrollment data.
						if ($graduation <= $enrollment) {
							$errors[$key]['gd_month'][0] = 'Graduation date cannot be bigger than Enrollment date.';
							$error = true;
						}

						$this->request->data['UserEducation'][$key]['graduation'] = date('Y-m-d', $graduation);
					}
					$this->request->data['UserEducation'][$key]['enrollment'] = date('Y-m-d', $enrollment);
					$this->request->data['UserEducation'][$key]['university_name'] = $value['university_name'];
					$this->request->data['UserEducation'][$key]['department'] = $value['department'];
					$this->request->data['UserEducation'][$key]['degree'] = $value['degree'];
					$this->request->data['UserEducation'][$key]['remarks'] = $value['remarks'];
				}

				if ($error === true) {
					$this->__convertToEducationValidationErrors($errors);
					throw new Exception('Graduation and Enrollment date error!');
				}

				if (!$this->UserEducation->saveAll($this->request->data['UserEducation'])) {
					throw new Exception("ERROR OCCUR DURING INSERT EDUCATION INFORMATION");
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'mypage'));
			} catch (Exception $e) {
				$requestData = $this->request->data;
				$this->set(compact('requestData'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
	}

	public function ms_update() {
		$this->layout = 'user_new';
		$current_user_id = $this->Auth->user('id');
		$ms_skill_level = $this->OptionCommon->ms_skill_level;
		$computer_skill_level = $this->OptionCommon->computer_skill_level;
		$ms_info = $this->UserComputingSkill->find('all', array('conditions' => array('UserComputingSkill.user_id' => $current_user_id)));
		$ms_info_edit = array();
		foreach ($ms_info as $key => $value) {
			$ms_info_edit['UserComputingSkill'][$key] = $value['UserComputingSkill'];
		}
		if (empty($this->request->data)) {
			$this->request->data = $ms_info_edit;
		}
		$this->set(compact('ms_skill_level', 'computer_skill_level', 'ms_info_edit'));

		if ($this->request->is(array('post', 'put'))) {

			if (!empty($ms_info)) {
				$this->UserComputingSkill->deleteAll(array('UserComputingSkill.user_id' => $this->Auth->user('id')), false);
			}

			foreach ($this->request->data['UserComputingSkill'] as $key => $value) {
				if ($value['title'] =='') {
					unset($this->request->data['UserComputingSkill'][$key]);
				} else {
					$this->request->data['UserComputingSkill'][$key]['user_id'] = $current_user_id;
				}
			}
			if ($this->UserComputingSkill->saveAll($this->request->data['UserComputingSkill'])) {
				$this->redirect(array('action' => 'mypage'));
			}
		}
	}

	public function qualification_update() {
		$this->layout = 'user_new';

		$current_user_id = $this->Auth->user('id');
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();

		$ql_info = $this->UserQualification->find('all', array('conditions' => array('UserQualification.user_id' => $current_user_id)));

		$ql_info_edit = array();
		foreach ($ql_info as $key => $value) {
			$value['UserQualification']['qualification_date'] = explode('-', $value['UserQualification']['qualification_date']);
			$value['UserQualification']['start_year'] = $value['UserQualification']['qualification_date'][0];
			$value['UserQualification']['start_month'] = $value['UserQualification']['qualification_date'][1];
			$ql_info_edit['UserQualification'][$key] = $value['UserQualification'];
		}

		if (empty($this->request->data)) {
			$this->request->data = $ql_info_edit;
		}

		if ($this->request->is(array('post', 'put'))) {

			if (!empty($ql_info)) {
				$this->UserQualification->deleteAll(array('UserQualification.user_id' => $this->Auth->user('id')), false);
			}

			foreach ($this->request->data['UserQualification'] as $key => $value) {
				$this->request->data['UserQualification'][$key]['qualification_date'] = $value['start_year']."-". $value['start_month']."-00";
				$this->request->data['UserQualification'][$key]['user_id'] = $current_user_id;
			}

			try {
				$transaction = $this->TransactionManager->begin();

				if (!$this->UserQualification->saveAll($this->request->data['UserQualification'])) {
					throw new Exception("ERROR OCCUR DURING INSERT PERSONAL INFORMATION");
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('controller' => 'mypages', 'action' => 'mypage'));
			} catch (Exception $e) {

				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}
		$this->set(compact('month', 'year', 'ql_info_edit', 'current_user_id'));
	}

	public function instruction_update() {
		$this->layout = 'user_new';
		$current_user_id = $this->Auth->user('id');
		$month = $this->OptionCommon->month;
		$language = $this->OptionCommon->language;
		$year = $this->OptionCommon->year();
		$instr_info = $this->UserSpecialInstruction->find('all', array('conditions' => array('UserSpecialInstruction.user_id' => $current_user_id)));
		$instr_info_edit = array();
		foreach ($instr_info as $key => $value) {
			$instr_info_edit['UserSpecialInstruction'][$key] = $value['UserSpecialInstruction'];
		}
		if (empty($this->request->data)) {
			$this->request->data = $instr_info_edit;
		}
		if ($this->request->is(array('post', 'put'))) {

			if (!empty($instr_info)) {
				$this->UserSpecialInstruction->deleteAll(array('UserSpecialInstruction.user_id' => $this->Auth->user('id')), false);
			}

			foreach ($this->request->data['UserSpecialInstruction'] as $key => $value) {
				$this->request->data['UserSpecialInstruction'][$key]['user_id'] = $current_user_id;
			}
			if ($this->UserSpecialInstruction->saveAll($this->request->data['UserSpecialInstruction'])) {
				$this->redirect(array('action' => 'mypage'));
			}
		}
		$this->set(compact('month', 'year', 'instr_info_edit', 'language'));
	}

	public function core_skill_update() {

		$this->layout = 'user_new';

		$current_user_id = $this->Auth->user('id');
		$salary_range = $this->OptionCommon->salary_range;
		$carrer_change = $this->OptionCommon->carrer_change;
		$availability = $this->OptionCommon->availability;

		$core_skill_info = $this->UserCoreSkill->find('all', array('conditions' => array('UserCoreSkill.user_id' => $current_user_id)));

		$this->set(compact('salary_range', 'carrer_change', 'availability'));

		if ($this->request->is(array('post', 'put'))) {

			try {

				$transaction = $this->TransactionManager->begin();


				if (!empty($core_skill_info[0]['UserCoreSkill']['id'])) {
					$this->UserSubCoreSkill->deleteAll(array('UserSubCoreSkill.user_core_skill_id' => $core_skill_info[0]['UserCoreSkill']['id']), false);
					$this->UserCoreSkill->id = $core_skill_info[0]['UserCoreSkill']['id'];
				}

				$this->request->data['UserCoreSkill']['user_id'] = $this->Auth->user('id');

				if (!$this->UserCoreSkill->saveAssociated($this->request->data)) {
					throw new Exception("ERROR OCCUR DURING INSERT CORE SKILL INFORMATION");
				}

				$this->TransactionManager->commit($transaction);
				$this->redirect(array('controller' => 'mypages', 'action' => 'mypage'));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}

		if (empty($this->request->data)) {
			if (!empty($core_skill_info)) {
				$this->request->data['UserCoreSkill'] = $core_skill_info[0]['UserCoreSkill'];
				$this->request->data['UserSubCoreSkill'] = $core_skill_info[0]['UserSubCoreSkill'];
			}
		}
	}

	public function career_history_update() {
		$this->layout = 'user_new';

		//get the required data
			$current_user_id = $this->Auth->user('id');

			$month = $this->OptionCommon->month;
			$year = $this->OptionCommon->year();

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

			$career_info = $this->UserCareerHistory->find('all', array(
				'conditions' => array(
					'UserCareerHistory.user_id' => $current_user_id
				)
			));
		//get the required data

		//normalized the career_info data
			$career_info_edit = array();

			foreach ($career_info as $key1 => $value1) {

				$value1['UserCareerHistory']['current'] = $value1['UserCareerHistory']['company_current'];

				if (!empty($value1['UserProject'])) {
					foreach ($value1['UserProject'] as $key2 => $value2) {
						if (!empty($value2['period_start'])) {
							$explodePeriodStart = explode('-', $value2['period_start']);
							$value2['prj_start_year'] = $explodePeriodStart[0];
							$value2['prj_start_month'] = $explodePeriodStart[1];
						}

						if (!empty($value2['period_end'])) {
							$value2['period_end'] = explode('-', $value2['period_end']);
							$value2['prj_end_year'] = $value2['period_end'][0];
							$value2['prj_end_month'] = $value2['period_end'][1];
						}

						$value2['current'] = $value2['project_current'];

						$value1['UserProject'][$key2] = $value2;
					}
				}

				$value1['UserCareerHistory']['joined_y_m'] = explode('-', $value1['UserCareerHistory']['joined_y_m']);
				$value1['UserCareerHistory']['joined_year'] = $value1['UserCareerHistory']['joined_y_m'][0];
				$value1['UserCareerHistory']['joined_month'] = $value1['UserCareerHistory']['joined_y_m'][1];

				$value1['UserCareerHistory']['industry_small'] = $value1['UserCareerHistory']['industry_small_id'];
				$value1['UserCareerHistory']['industry_big'] = $value1['UserCareerHistory']['industry_big_id'];
				$value1['UserCareerHistory']['job_category'] = $value1['UserCareerHistory']['job_category_id'];
				$value1['UserCareerHistory']['job_category_sub'] = $value1['UserCareerHistory']['job_category_sub_id'];

				if (!empty($value1['UserCareerHistory']['resignation'])) {
					$value1['UserCareerHistory']['resignation'] = explode('-', $value1['UserCareerHistory']['resignation']);
					$value1['UserCareerHistory']['resigned_year'] = $value1['UserCareerHistory']['resignation'][0];
					$value1['UserCareerHistory']['resigned_month'] = $value1['UserCareerHistory']['resignation'][1];
				}

				$career_info_edit['UserCareerHistory'][$key1] = $value1['UserCareerHistory'];
				$career_info_edit['UserCareerHistory'][$key1]['UserProject'] = $value1['UserProject'];
			}
		//normalized the career_info data

		if (empty($this->request->data)) {
			$this->request->data = $career_info_edit;
		}

		if(!empty($career_info_edit)){
			$experience_count = sizeof($career_info_edit['UserCareerHistory']);
		}

		$this->set(compact('current_user_id', 'big_industry','small_industry','error','small_job','big_job','month','year','location', 'career_info_edit','experience_count'));

		if ($this->request->is(array('post', 'put'))) {

			if($this->request->data['toggle'] == 1){
				$this->redirect(array('action' => 'mypage'));
			} else {

				$requestData = $this->request->data;
				$experience_count = count($requestData['UserCareerHistory']);
				$error = false;

				try {
					$transaction = $this->TransactionManager->begin();

					foreach ($requestData['UserCareerHistory'] as $key1 => $value1) {
						// for company.
						$requestData['UserCareerHistory'][$key1]['industry_small_id'] = $value1['industry_small'];
						$requestData['UserCareerHistory'][$key1]['industry_big_id'] = $value1['industry_big'];
						$requestData['UserCareerHistory'][$key1]['job_category_id'] = $value1['job_category'];
						$requestData['UserCareerHistory'][$key1]['job_category_sub_id'] = $value1['job_category_sub'];
						$requestData['UserCareerHistory'][$key1]['company_current'] = $value1['current'];

						$joinedDate = strtotime($value1['joined_year'] . '-' . $value1['joined_month'] . '-01');
						$requestData['UserCareerHistory'][$key1]['joined_y_m'] = date('Y-m-d', $joinedDate);

						if ($value1['current'] == 0) {

							if (empty($value1['resigned_year']) || empty($value1['resigned_month'])) {
								$errorMessage[$key1]['resigned_month'][0] = 'Please fill the date or check the current!';
								$error = true;

							} else {
								$resignDate = strtotime($value1['resigned_year'] . '-' . $value1['resigned_month'] . '-01');
								$requestData['UserCareerHistory'][$key1]['resignation'] = date('Y-m-d', $resignDate);

								// validate the join and resignation date.
								if ($joinedDate > $resignDate) {
									$errorMessage[$key1]['resigned_month'][0] = 'Resignation date cannot be smaller than the Joined date!';
									$error = true;
								}
							}
						}

						// for project
						foreach ($value1['UserProject'] as $key2 => $value2) {

							if (
								empty($value2['title']) &&
								empty($value2['prj_start_month']) &&
								empty($value2['prj_start_year']) &&
								empty($value2['prj_end_month']) &&
								empty($value2['prj_end_year']) &&
								empty($value2['detail']) &&
								$value2['current'] == 0
							) {
								// nothing fill.
								unset($requestData['UserCareerHistory'][$key1]['UserProject'][$key2]);
							} else {

								$requestData['UserCareerHistory'][$key1]['UserProject'][$key2]['project_current'] = $value2['current'];

								// validatation 1.
								if (
									!empty($value2['prj_start_year']) &&
									!empty($value2['prj_start_month']) &&
									empty($value2['prj_end_year']) &&
									empty($value2['prj_end_month']) &&
									$value2['current'] == 0
								) {
									// no check the current and nothing fill in the project end month and year.
									$errorMessage[$key1]['UserProject'][$key2]['prj_end_month'][0] = 'Please fill the project end month or check the current.';
									$error = true;
								}

								// validatation 2.
								if (
									$value2['current'] == 1 ||
									!empty($value2['prj_end_year']) &&
									!empty($value2['prj_end_month'])
								) {
									// validate for start date is blank.
									if (empty($value2['prj_start_year']) && empty($value2['prj_start_month'])) {
										$errorMessage[$key1]['UserProject'][$key2]['prj_start_month'][0] = 'Please Insert Start Year and Month.';
										$error = true;
									} else {
										$prjStartDate = strtotime($value2['prj_start_year'] . '-' . $value2['prj_start_month'] . '-01');
										$requestData['UserCareerHistory'][$key1]['UserProject'][$key2]['period_start'] = date('Y-m-d', $prjStartDate);
									}

								}

								// validatation 3.
								if (
									!empty($value2['prj_end_year']) &&
									!empty($value2['prj_end_month']) &&
									!empty($value2['prj_start_year']) &&
									!empty($value2['prj_start_month'])
								) {
									$prjEndDate = strtotime($value2['prj_end_year'] . '-' . $value2['prj_end_month'] . '-01');
									$prjStartDate = strtotime($value2['prj_start_year'] . '-' . $value2['prj_start_month'] . '-01');

									// validate for start and end date.
									if ($prjStartDate > $prjEndDate) {
										$errorMessage[$key1]['UserProject'][$key2]['prj_start_month'][0] = 'Project End Date cannot be smaller than the Project Start Date!';
										$error = true;
									}

									$requestData['UserCareerHistory'][$key1]['UserProject'][$key2]['period_start'] = date('Y-m-d', $prjStartDate);
									$requestData['UserCareerHistory'][$key1]['UserProject'][$key2]['period_end'] = date('Y-m-d', $prjEndDate);
								}
							}
						}
					}

					if ($error === true) {
						$this->__convertToCareerHistoryValidationErrors($errorMessage);
						throw new Exception("Validate Error for Project or Company's date.");
					}

					if ($career_info) {
						$this->UserCareerHistory->deleteAll(array('UserCareerHistory.user_id' => $current_user_id));
					}

					// save to the user career history table.
					foreach ($requestData['UserCareerHistory'] as $key => $value) {
						if (!$this->UserCareerHistory->saveAssociated($value, array('deep' => true))) {
							throw new Exception("ERROR OCCUR DURING INSERT CAREER HISTORY.");
						}
					}

					$this->TransactionManager->commit($transaction);
					$this->redirect(array('action' => 'mypage'));
				} catch (Exception $e) {
					// return the data to the view.
					$this->set(compact('requestData', 'experience_count'));

					$this->log('File: ' . $e->getFile() . 'Line: ' . $e->getLine(), LOG_ERR);
					$this->log($e->getMessage(), LOG_ERR);
					$this->TransactionManager->rollback($transaction);
				}
			}
		}
	}

	public function profilePdf() {
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
		$userInfo = $this->User->findById($this->Auth->user('id'));
		$data = array_merge($data, $userInfo);

		$user_id = $userInfo['User']['jobseeker_id'];

		ini_set('memory_limit', '512M');

		$this->set(compact('data', 'user_id'));
	}

	private function __convertToValidationErrors($errors) {
		foreach ($errors as $key => $val) {
			$this->User->validationErrors[$key] = $val;
		}
	}

	private function __convertToEducationValidationErrors($errors) {

		foreach ($errors as $key => $val) {
			$this->UserEducation->validationErrors[$key] = $val;
		}
	}

	private function __convertToCareerHistoryValidationErrors($errors) {

		foreach ($errors as $key => $val) {
			$this->UserCareerHistory->validationErrors[$key] = $val;
		}
	}
}