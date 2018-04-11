<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {
	public $hasMany = array (
		'UserEducation' => array('order' => array('enrollment' => 'asc')),
		'UserLanguageSkill',
		'UserQualification',
		'UserCoreSkill',
		'UserComputingSkill',
		'OccupationApply',
		'OccupationFavorite',
		'UserCareerHistory',
		'UserSpecialInstruction',
		'MasterKeepUser'
	);

	public $actsAs = array(
		'Search.Searchable',
		'Containable',
		'Upload.Upload' => array(
			'image' => array(
				'path' => '{ROOT}webroot{DS}img{DS}user{DS}{primaryKey}{DS}',
				'nameCallback' => 'changeFileName',
				'thumbnails' => true,
				'quality' => 95,
				'thumbnailMethod' => 'php',
				'thumbnailSizes' => array(
					'thumb' => '233x225',
					'pdf' => '150x150'
				)
			)
		)
	);

	public function changeFileName() {
		$newName = 'user_profile_';
		if (!empty($this->data[$this->alias]['id'])) {
			$nextId = $this->data[$this->alias]['id'];
			return $newName.$nextId.'.jpg';
		} else {
			$result = $this->query("SHOW TABLE STATUS LIKE 'users'");
			$next = $result[0]['TABLES']['Auto_increment'];
			return $newName.$next.'.jpg';
		}
	}

	public $filterArgs = array(
		'keyword' => array('type' => 'like', 'field' => array(
			'User.name'
		)),
		'age_range' => array('type' => 'value'),
		'gender' => array('type' => 'query', 'method' => 'gender_search'),
		'religion' => array('type' => 'query', 'method' => 'religion_search'),
		'degree' => array('type' => 'query', 'method' => 'degree_search'),
		'marital_status' => array('type' => 'query', 'method' => 'marital_status_search'),
		'nationality' => array('type' => 'query', 'method' => 'nationality_search'),
		'location' => array('type' => 'query', 'method' => 'location_search'),
		'industry_big_id'=> array('type' => 'query', 'method' => 'industry_big_search'),
		'industry_small_id'=> array('type' => 'query', 'method' => 'industry_small_search'),
		'job_category_id'=> array('type' => 'query', 'method' => 'job_category_search'),
		'job_category_sub_id'=> array('type' => 'query', 'method' => 'job_category_sub_search'),
		'eng_level'=> array('type' => 'query', 'method' => 'eng_level_search'),
		'bm_level'=> array('type' => 'query', 'method' => 'bm_level_search'),
		'chn_level'=> array('type' => 'query', 'method' => 'chn_level_search'),
		'jp_level'=> array('type' => 'query', 'method' => 'jp_level_search'),
		'other'=> array('type' => 'query', 'method' => 'other_search'),
		'excel_skill'=> array('type' => 'query', 'method' => 'excel_skill_search'),
		'word_skill'=> array('type' => 'query', 'method' => 'word_skill_search'),
		'powerpoint_skill'=> array('type' => 'query', 'method' => 'powerpoint_skill_search'),
		'expected_salary' => array('type' => 'query', 'method' => 'expected_salary_search'),
		'current_salary' => array('type' => 'query', 'method' => 'current_salary_search'),
		'availability' => array('type' => 'query', 'method' => 'availability_search'),
		'master_id' => array('type' => 'query', 'method' => 'non_disclosure_filter'),
	);

	public function degree_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_educations where User.id = user_educations.user_id AND user_educations.degree <= (?))' => array($data['degree']));
		return $conditions;
	}

	public function industry_big_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_career_histories where User.id = user_career_histories.user_id AND user_career_histories.industry_big_id = (?))' => array($data['industry_big_id']));
		return $conditions;
	}

	public function industry_small_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_career_histories where User.id = user_career_histories.user_id AND user_career_histories.industry_small_id = (?))' => array($data['industry_small_id']));
		return $conditions;
	}

	public function job_category_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_career_histories where User.id = user_career_histories.user_id AND user_career_histories.job_category_id = (?))' => array($data['job_category_id']));
		return $conditions;
	}

	public function job_category_sub_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_career_histories where User.id = user_career_histories.user_id AND user_career_histories.job_category_sub_id = (?))' => array($data['job_category_sub_id']));
		return $conditions;
	}

	public function eng_level_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_language_skills where User.id = user_language_skills.user_id AND user_language_skills.language = "English" AND user_language_skills.skill <= (?))' => array($data['eng_level']));
		return $conditions;
	}

	public function bm_level_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_language_skills where User.id = user_language_skills.user_id AND user_language_skills.language = "Burmese" AND user_language_skills.skill <= (?))' => array($data['bm_level']));
		return $conditions;
	}

	public function chn_level_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_language_skills where User.id = user_language_skills.user_id AND user_language_skills.language = "Chinese" AND user_language_skills.skill <= (?))' => array($data['chn_level']));
		return $conditions;
	}

	public function jp_level_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_language_skills where User.id = user_language_skills.user_id AND user_language_skills.language = "Japanese" AND user_language_skills.skill <= (?))' => array($data['jp_level']));
		return $conditions;
	}

	public function other_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_language_skills where User.id = user_language_skills.user_id AND user_language_skills.language = (?))' => array($data['other']));
		return $conditions;
	}

	public function gender_search($data = array()) {
		$conditions = array('User.gender' => $data['gender']);
		return $conditions;
	}

	public function religion_search($data = array()) {
		$conditions = array('User.religion' => $data['religion']);
		return $conditions;
	}

	public function marital_status_search($data = array()) {
		$conditions = array('User.marital_status' => $data['marital_status']);
		return $conditions;
	}

	public function nationality_search($data = array()) {
		$conditions = array('User.nationality' => $data['nationality']);
		return $conditions;
	}

	public function location_search($data = array()) {
		$conditions = array('User.location' => $data['location']);
		return $conditions;
	}

	public function excel_skill_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_computing_skills where User.id = user_computing_skills.user_id AND user_computing_skills.title = "Excel" AND user_computing_skills.skill >= (?))' => array($data['excel_skill']));
		return $conditions;
	}

	public function word_skill_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_computing_skills where User.id = user_computing_skills.user_id AND user_computing_skills.title = "Word" AND user_computing_skills.skill >= (?))' => array($data['word_skill']));
		return $conditions;
	}

	public function powerpoint_skill_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_computing_skills where User.id = user_computing_skills.user_id AND user_computing_skills.title = "Power Point" AND user_computing_skills.skill >= (?))' => array($data['powerpoint_skill']));
		return $conditions;
	}

	public function expected_salary_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_core_skills where User.id = user_core_skills.user_id AND user_core_skills.expected_salary = (?))' => array($data['expected_salary']));
		return $conditions;
	}

	public function current_salary_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_core_skills where User.id = user_core_skills.user_id AND user_core_skills.current_salary = (?))' => array($data['current_salary']));
		return $conditions;
	}

	public function availability_search($data = array()) {
		$conditions = array('EXISTS (SELECT DISTINCT user_id from user_core_skills where User.id = user_core_skills.user_id AND user_core_skills.availability = (?))' => array($data['availability']));
		return $conditions;
	}

	public function non_disclosure_filter ($data = array()) {
		$conditions = array('NOT FIND_IN_SET('.$data['master_id'].',non_disclosure)','withdraw' => 0,'deleted' =>false);
		return $conditions;
	}

	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill name !',
				'required' => false
			)
		),
		'gender' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please select gender type!',
				'required' => false
			)
		),
		'day' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill day !',
				'required' => false
			)
		),
		'month' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill month !',
				'required' => false
			)
		),
		'year' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill year !',
				'required' => false
			)
		),
		'expected_income' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill expected_income!',
				'required' => false
			)
		),
		'email' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill email address !',
				'required' => true,
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please refill valid email address !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				'message' => 'Your email must be less than 60 !',
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email has already been registered!',
			)
		),
		'password' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'on' => 'create',
				'message' => 'Please enter password !',
			),
			'minLength' => array(
				'rule' => array('minLength', 8),
				'message' => 'Password must be more than 8 digits !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Password must be less than 20 !',
			)
		),
		'confirm_password' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'on' => 'create',
				'message' => 'Please enter confirm password !',
			),
			'sameCheck' => array(
				'rule' => array('sameCheck', 'password'),
				'message' => 'Password and confirm password must be same !',
			)
		),
		'current_password' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'on' => 'create',
				'message' => 'Please enter current_password !',
			)
		),
		'newpassword' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'on' => 'create',
				'message' => 'Please enter newpassword !',
			)
		),
		'confirmpassword' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'on' => 'create',
				'message' => 'Please enter newpassword !',
			)
		),
		'about_myself' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'message' => 'Select about yourself !',
			)
		),
		'subject' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'message' => 'Forgot your subject !',
			)
		),
		'message' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'message' => 'You forgot to enter a message !',
			)
		)
	);

	public function afterFind($results, $primary = false) {

		if (!empty($results)) {
			foreach ($results as $key => $val) {

				if (!empty($val['User']['image'])) {
					$results[$key]['User']['image_url'] = '/img/user/'.$val['User']['id'].'/'.$val['User']['image'];
					$results[$key]['User']['thumb_image_url'] = '/img/user/'.$val['User']['id'].'/thumb_'. $val['User']['image'];
					$results[$key]['User']['pdf'] = '/var/www/html/app/webroot/img/user/'.$val['User']['id'].'/'. $val['User']['image'];
				}
			}
		}
		return $results;
	}

	public function sameCheck($value , $field_name) { //Confirm Password
		$v1 = array_shift($value);
		$v2 = $this->data[$this->name][$field_name];
		return $v1 == $v2;
	}

	public function passwordReset($postData = array()) {
		$user = $this->find('first',array('conditions' => array(
			$this->alias.'.email' => $postData[$this->alias]['email'])));

		unset($user['User']['password']);

		if (!empty($user) && $user[$this->alias]['withdraw'] == 0) {
			$sixtyMins = time() + 3600;
			$token = $this->generateToken();
			$user[$this->alias]['password_token'] = $token;
			$user[$this->alias]['password_token_expires'] = date('Y-m-d H:i:s', $sixtyMins);
			$user = $this->save($user, false);
			$this->data = $user;
			return $user;
		}
		return false;
	}

	public function checkPasswordToken($token = null) {
		$user = $this->find('first', array(
			'conditions' => array(
				$this->alias . '.deleted' => 0,
				$this->alias . '.password_token' => $token,
				$this->alias . '.password_token_expires >=' => date('Y-m-d H:i:s'))
			)
		);
		if (empty($user)) {
			return false;
		}
		return $user;
	}

	public function resetPassword($postData = array()) {
		$result = false;
		$this->set($postData);
		$validarray=array('name','gender','expected_income','about_myself','subject','message');
		foreach ($validarray as $key => $value) {
			$this->validator()->remove($value);
		}
		$this->validates = false ;
		if ($this->validates()) {
			$this->data['User']['default_password'] = $postData['User']['confirm_password'];
			$this->data['User']['password_token'] = null;
			$result = $this->save($this->data);
		}
		return $result;
	}

	public function generateToken($length = 10) {
		$possible = '0123456789abcdefghijklmnopqrstuvwxyz';
		$token = "";
		$i = 0;

		while ($i < $length) {
			$char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
			if (!stristr($token, $char)) {
				$token .= $char;
				$i++;
			}
		}
		return $token;
	}

	public function beforeSave($options = array()) {
		if (!empty($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
		return parent::beforeSave($options);
	}
}