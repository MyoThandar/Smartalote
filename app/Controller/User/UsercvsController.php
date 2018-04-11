<?php
App::uses('UserAppController', 'Controller');
class UsercvsController extends  UserAppController {
	public $components = array('OptionCommon','Session');
	public $uses = array('User','UserEducation','UserComputingSkill','UserCoreSkill','UserExperience','UserLanguageSkill','IndustrySmall','IndustryBig','JobCategorie','JobCategorieSub','TransactionManager', 'UserCareerHistory', 'UserSpecialInstruction');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'user_new';
	}
	public function register_step_one(){
		$user_id = $this->Auth->user('id');
		$email = $this->Auth->user('email');
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		$country = $this->OptionCommon->country;
		$nationality = $this->OptionCommon->nationality;
		$religion = $this->OptionCommon->religion;
		$marital_status = $this->OptionCommon->marital_status;
		$this->set(compact('day','month','year','country', 'nationality', 'religion', 'marital_status','email'));
		$us = $this->User->find('list', array(
			'fields' => array('User.name'),
			));

		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			$this->request->data['User']['birthday'] = $this->request->data['User']['year'] ."-". $this->request->data['User']['month'] ."-". $this->request->data['User']['day'];
			$this->User->set($this->data);
			if ($this->request->data['User']['image']['name'] != '') {
				$file = $this->request->data['User']['image'];
				$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
				$arr_ext = array('jpg', 'jpeg', 'gif','png');
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/User/' . $file['name']);
					$this->request->data['User']['image'] = $file['name'];
				}
			}
			if ($this->User->validates()) {
				$this->Session->write('register_step_one', $this->data);
				$this->redirect(array('action'=>'register_step_two'));
			}

		}
	}

	public function register_step_one_edit(){
		$current_user_id = $this->Auth->user('id');
		$day = $this->OptionCommon->day;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		$country = $this->OptionCommon->country;
		$this->set(compact('day','month','year','country'));
		$this->User->recursive = -1;
		$curr_usr = $this->User->findById($current_user_id);
		if (!empty($curr_usr['User']['birthday'])) {
			$curr_usr['User']['birthday'] = explode('-', $curr_usr['User']['birthday']);
			$curr_usr['User']['year'] = $curr_usr['User']['birthday'][0];
			$curr_usr['User']['month'] = $curr_usr['User']['birthday'][1];
			$curr_usr['User']['day'] = $curr_usr['User']['birthday'][2];
		}
		if (!$this->request->data) {
			$this->request->data = $curr_usr;
		}
		if ($this->request->is(array('post', 'put'))) {

			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			$this->request->data['User']['birthday'] = $this->request->data['User']['year'] ."-". $this->request->data['User']['month'] ."-". $this->request->data['User']['day'];
			$this->User->set($this->data);

			if ($this->User->validates()) {
				$this->Session->write('register_step_one', $this->data);
				$this->redirect(array('action'=>'register_step_two_edit'));
			}
		}
	}

	public function register_step_two(){
		//'user_language_skills' Table
		$current_user_id = $this->Auth->user('id');
		$language_skill = $this->OptionCommon->language_skill;
		$language = $this->OptionCommon->language;
		$this->set(compact('language_skill','language'));
		$this->set(compact('day','month','year','country'));
		$curr_usr = $this->User->findById($current_user_id);
		if ($curr_usr['User']['birthday'] != null) {
			$curr_usr['User']['birthday'] = explode('-', $curr_usr['User']['birthday']);
			$curr_usr['User']['year'] = $curr_usr['User']['birthday'][0];
			$curr_usr['User']['month'] = $curr_usr['User']['birthday'][1];
			$curr_usr['User']['day'] = $curr_usr['User']['birthday'][2];
		}
		if (!$this->request->data) {
			$this->request->data = $curr_usr;
		}
		try {
			$transaction = $this->TransactionManager->begin();
			if ($this->request->is(array('post', 'put'))) {
				$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
				foreach ($validateAttrKey as $key => $value) {
					$this->User->validator()->remove($value);
				}
				$this->User->set($this->data);
				if ($this->User->validates()){
					$this->Session->write('register_step_two', $this->data);
					$register_step_two = $this->request->data;
					$this->redirect(array('action'=>'register_step_three'));
				}
			}
			$this->TransactionManager->commit($transaction);
		}catch (Exception $e) {
			$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
			$this->log($e->getMessage(), LOG_ERR);
			$this->TransactionManager->rollback($transaction);
			$this->Session->setFlash('Not Deleted');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function register_step_two_edit(){
		$current_user_id = $this->Auth->user('id');
		$language_skill = $this->OptionCommon->language_skill;
		$language = $this->OptionCommon->language;
		$curr_usr = $this->User->findById($current_user_id);
		$this->set(compact('language_skill','language', 'curr_usr'));
		if (!$this->request->data) {
			$this->request->data = $curr_usr;
		}
		try {
			$transaction = $this->TransactionManager->begin();
			if ($this->request->is(array('post', 'put'))) {
				$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
				foreach ($validateAttrKey as $key => $value) {
					$this->User->validator()->remove($value);
				}
				$this->User->set($this->data);
				if ($this->User->validates()){
					$this->Session->write('register_step_two', $this->data);
					$register_step_two = $this->request->data;
					$this->redirect(array('action'=>'register_step_three_edit'));
				}
			}
			$this->TransactionManager->commit($transaction);
		}catch (Exception $e) {
			$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
			$this->log($e->getMessage(), LOG_ERR);
			$this->TransactionManager->rollback($transaction);
			$this->Session->setFlash('Not Deleted');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function register_step_three_edit(){
		//Table(UserEducation)
		$current_user_id = $this->Auth->user('id');
		$education = $this->OptionCommon->education;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		$this->set(compact('education','month','year', ''));
		$curr_usr = $this->User->findById($current_user_id);
		if (!$this->request->data) {
			$this->request->data = $curr_usr;
		}
		$this->set(compact('curr_usr'));
		if ($this->request->is(array('post', 'put'))) {

			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			$data= $this->convertApplyDataToCakeData(@$this->request->data['UserEducation']);
			unset($this->request->data['UserEducation']);
			foreach ($data as $key => $value) {
				$this->request->data['UserEducation'][$key]['id'] = $value['id'];
				 $this->request->data['UserEducation'][$key]['start_period'] =  $value['start_year']."-". $value['start_month']."-00";
				$this->request->data['UserEducation'][$key]['end_period'] = $value['end_year']."-". $value['end_month']."-00";
				$this->request->data['UserEducation'][$key]['university_name'] = $value['university_name'];
				$this->request->data['UserEducation'][$key]['major'] = $value['major'];
				//$this->request->data['UserEducation'][$key]['graduate_level'] = $value['graduate_level'];
			}
			$this->UserEducation->set($this->data);
			if ($this->UserEducation->validates()) {
				$this->Session->write('register_step_three', $this->data);
				$this->redirect(array('action'=>'register_step_four_edit'));
			}
		}
	}

	//for change cakephp style data
	private function convertApplyDataToCakeData($data = array()){
		$resultData = array();
		foreach ($data as $field => $values)
			{
				foreach ($values as $key => $val)
					{
						$resultData[$key][$field] = $val;
					}
			}
		return $resultData;
	}
	public function register_step_three(){
		//Table(UserEducation)
		$education = $this->OptionCommon->education;
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		$this->set(compact('education','month','year'));
		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			foreach ($this->request->data['UserEducation'] as $key => $value) {
				$this->request->data['UserEducation'][$key]['enrollment'] =  $value['enroll_year']."-". $value['enroll_month']."-00";
				$this->request->data['UserEducation'][$key]['graduation'] = $value['gd_year']."-". $value['gd_month']."-00";
				$this->request->data['UserEducation'][$key]['university_name'] = $value['university_name'];
				$this->request->data['UserEducation'][$key]['department'] = $value['department'];
				$this->request->data['UserEducation'][$key]['degree'] = $value['degree'];
				$this->request->data['UserEducation'][$key]['remarks'] = $value['remarks'];
			}
			$this->UserEducation->set($this->data);
			if ($this->UserEducation->validates()) {
				$this->Session->write('register_step_three', $this->data);
				$this->redirect(array('action'=>'register_step_four'));
			}
		}
	}
	public function register_step_four(){
		//UserExperience (table name)
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		$location = $this->OptionCommon->location;
		$error = true;
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
		$this->set(compact('big_industry','small_industry','error','small_job','big_job','month','year','location'));
		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			if (empty($this->request->data['toggle'])) {
				foreach ($this->request->data['UserCareerHistory'] as $key => $value) {
					$this->request->data['UserCareerHistory'][$key]['joined_y_m'] =  $value['joined_year']."-". $value['joined_month']."-00";
					$this->request->data['UserCareerHistory'][$key]['resignation'] = $value['resigned_year']."-".$value['resigned_month']."-00";
					$this->request->data['UserCareerHistory'][$key]['company_name'] = $value['company_name'];
					foreach ($this->request->data['UserCareerHistory'][$key]['UserProject'] as $key_pr => $value_pr) {
						$this->request->data['UserCareerHistory'][$key]['UserProject'][$key_pr]['period_start'] = $value_pr['prj_start_year']."-".$value_pr['prj_start_month']."-00";
						$this->request->data['UserCareerHistory'][$key]['UserProject'][$key_pr]['period_end'] = $value_pr['prj_end_year']."-".$value_pr['prj_end_month']."-00";
					}
				}
				$this->UserCareerHistory->set($this->data);
				if ($this->UserCareerHistory->validates()) {
					$this->Session->write('register_step_four', $this->data);
					$this->redirect(array('action'=>'register_step_five'));
				}
			}else{
				$this->request->data['UserCareerHistory'] = array() ;
				$this->redirect(array('action'=>'register_step_five'));
			}
		}
	}

	public function register_step_four_edit(){
		//UserExperience (table name)
		$current_user_id = $this->Auth->user('id');
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		$location = $this->OptionCommon->location;
		$error = true;
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
		$this->set(compact('big_industry','small_industry','error','small_job','big_job','month','year','location'));
		$curr_usr = $this->User->findById($current_user_id);
		if (!$this->request->data) {
			$this->request->data = $curr_usr;
		}
		$this->set(compact('curr_usr'));
		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			if (empty($this->request->data['toggle'])) {
				$data= $this->convertApplyDataToCakeData(@$this->request->data['UserExperience']);
				unset($this->request->data['UserExperience']);
				foreach ($data as $key => $value) {
					$this->request->data['UserExperience'][$key]['id'] = $value['id'];
					$this->request->data['UserExperience'][$key]['start_cmp_period'] =  $value['endone_year']."-". $value['startone_month']."-00";
					$this->request->data['UserExperience'][$key]['end_cmp_period'] = $value['endtwo_year']."-". $value['starttwo_month']."-00";
					$this->request->data['UserExperience'][$key]['company_name'] = $value['company_name'];
					$this->request->data['UserExperience'][$key]['location'] = $value['location'];
					$this->request->data['UserExperience'][$key]['industry_big'] = $value['industry_big'];
					$this->request->data['UserExperience'][$key]['industry_small'] = $value['industry_small'];
					$this->request->data['UserExperience'][$key]['job_category'] = $value['job_category'];
					$this->request->data['UserExperience'][$key]['job_category_sub'] = $value['job_category_sub'];
					// $this->request->data['UserExperience'][$key]['job _description'] = $value['job _description'];
					$this->request->data['UserExperience'][$key]['department'] = $value['department'];
				}
				$this->UserExperience->set($this->data);
				if ($this->UserExperience->validates()) {
					$this->Session->write('register_step_four', $this->data);
					$this->redirect(array('action'=>'register_step_five_edit'));
				}
			}else{
				$this->request->data['UserExperience'] = array() ;
				$this->redirect(array('action'=>'register_step_five_edit'));
			}
		}
	}

	public function register_step_five(){
		//table name(UserCoreSkill,UserComputingSkill)
		$ms_skill_level = $this->OptionCommon->ms_skill_level;
		$computer_skill_level = $this->OptionCommon->computer_skill_level;
		$this->set(compact('ms_skill_level', 'computer_skill_level'));
		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			$this->Session->write('register_step_five', $this->data);
			$this->redirect(array('action'=>'register_step_six'));
		}
	}

	public function register_step_five_edit(){
		//table name(UserCoreSkill, UserComputingSkill)
		$current_user_id = $this->Auth->user('id');
		$carrer_change = $this->OptionCommon->carrer_change;
		$curr_usr = $this->User->findById($current_user_id);
		if (!$this->request->data) {
			$this->request->data = $curr_usr;
		}
		$this->set(compact('curr_usr', 'carrer_change'));
		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			$this->Session->write('register_step_five', $this->data);
			$this->redirect(array('action'=>'register_step_six_edit'));
		}
	}

	public function register_step_six(){
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			foreach ($this->request->data['UserQualification'] as $key => $value) {
				$this->request->data['UserQualification'][$key]['qualification_date'] = $value['qlf_start_year']."-". $value['qlf_start_month']."-00";
			}
			$this->Session->write('register_step_six', $this->data);
			$this->redirect(array('action'=>'register_step_seven'));
		}
		$this->set(compact('month', 'year'));
	}

	public function register_step_seven(){
		$month = $this->OptionCommon->month;
		$year = $this->OptionCommon->year();
		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			$this->Session->write('register_step_seven', $this->data);
			$this->redirect(array('action'=>'register_step_eight'));
		}
		$this->set(compact('month', 'year'));
	}

	public function register_step_six_edit(){
		$current_user_id = $this->Auth->user('id');
		$curr_usr = $this->User->findById($current_user_id);
		if (!$this->request->data) {
			$this->request->data = $curr_usr;
		}
		$this->set(compact('curr_usr'));
		if ($this->request->is(array('post', 'put'))) {
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			$this->Session->write('register_step_six', $this->data);
			$this->redirect(array('action'=>'register_step_seven_edit'));
		}
	}

	public function register_step_eight(){
		$test_array=array();
		$salary_range = $this->OptionCommon->salary_range;
		$carrer_change = $this->OptionCommon->carrer_change;
		$availability = $this->OptionCommon->availability;

		$this->set(compact('salary_range', 'carrer_change', 'availability'));

		$final_result = array();
		if ($this->request->is(array('post', 'put', 'patch'))) {
			$register_data_one = $this->Session->read('register_step_one');
			$register_data_two = $this->Session->read('register_step_two');
			$register_data_three = $this->Session->read('register_step_three');
			$register_data_four = $this->Session->read('register_step_four');
			$register_data_five= $this->Session->read('register_step_five');
			$register_data_six= $this->Session->read('register_step_six');
			$register_data_seven = $this->Session->read('register_step_seven');
			$this->request->data['UserCoreSkill']['core_skill'] = implode(',', $this->request->data['UserCoreSkill']['core_skill']);
			$this->Session->write('register_step_eight', $this->data);
			$register_data_eight = $this->Session->read('register_step_eight');
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			if(!empty($register_data_eight)){
				$final_result['User']= $register_data_one['User'];
				$final_result['User']['cv'] = '1';
				$final_result['UserLanguageSkill']=$register_data_two['UserLanguageSkill'];
				$final_result['UserEducation']=$register_data_three['UserEducation'];
				$final_result['UserCareerHistory']= $register_data_four['UserCareerHistory'];
				$final_result['UserComputingSkill']=$register_data_five['UserComputingSkill'];
				$final_result['UserQualification']=$register_data_six['UserQualification'];
				$final_result['UserSpecialInstruction']=$register_data_seven['UserSpecialInstruction'];
				$final_result['UserCoreSkill'][0]=$register_data_eight['UserCoreSkill'];
				$test_array = $final_result;
				$this->request->data = $test_array;
			}
			$this->User->create();
			$this->request->data['User']['id'] = $this->Auth->user('id');
			if ($this->User->saveAssociated($this->request->data, array('deep' => true))) {
				$this->redirect(array('action'=>'congrat'));
			}
		}
	}

	public function register_step_seven_edit(){
		$current_user_id = $this->Auth->user('id');
		$test_array=array();
		$salary_range = $this->OptionCommon->salary_range;
		$carrer_change = $this->OptionCommon->carrer_change;
		$this->set(compact('salary_range','carrer_change'));

		$final_result =array();
		$curr_usr = $this->User->findById($current_user_id);
		if (!$this->request->data) {
			$this->request->data = $curr_usr;
		}
		$this->set(compact('curr_usr'));
		if ($this->request->is(array('post', 'put'))) {
			$this->Session->write('register_step_seven', $this->data);
			$register_data_one = $this->Session->read('register_step_one');
			$register_data_two = $this->Session->read('register_step_two');
			$register_data_three = $this->Session->read('register_step_three');
			$register_data_four = $this->Session->read('register_step_four');
			$register_data_five= $this->Session->read('register_step_five');
			$register_data_six= $this->Session->read('register_step_six');
			$register_data_seven= $this->Session->read('register_step_seven');
			$validateAttrKey = array('email', 'password', 'confirm_password','current_password','newpassword','confirmpassword');
			foreach ($validateAttrKey as $key => $value) {
				$this->User->validator()->remove($value);
			}
			if(!empty($register_data_seven)){
				$final_result['User']= array_merge($register_data_one['User'],$register_data_six['User'],$register_data_seven['User']);
				$final_result['UserEducation']=$register_data_three['UserEducation'];
				if (isset($register_data_four['UserExperience'])) {
					$final_result['UserExperience']= $register_data_four['UserExperience'];
				}
				$final_result['UserLanguageSkill']=$register_data_two['UserLanguageSkill'];
				$final_result['UserComputingSkill'][0]=$register_data_five['UserComputingSkill'];
				$final_result['UserCoreSkill'][0]=$register_data_five['UserCoreSkill'];
			}
			$test_array = $final_result;
			$this->request->data = $test_array;
			$this->User->create();
			$this->request->data['User']['id'] = $this->Auth->user('id');
			if ($this->User->saveAssociated($this->request->data, array('deep' => true))) {
				$this->redirect(array('action'=>'congrat'));
			}
		}
	}

	public function congrat(){
		//for preview show
		$CV = 1;
		$this->Session->write('CV', $CV);

		$this->Session->delete('register_step_one');
		$this->Session->delete('register_step_two');
		$this->Session->delete('register_step_three');
		$this->Session->delete('register_step_four');
		$this->Session->delete('register_step_five');
		$this->Session->delete('register_step_six');
		$this->Session->delete('register_step_seven');
		$this->Session->delete('register_step_eight');
	}
}