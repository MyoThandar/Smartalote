<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class CmpHeadhunter extends AppModel {
	public $hasMany = array (
		'Occupation' => array(
			'className' => 'Occupation',
			'foreignKey' => 'ch_id'
		) ,
		'HeadhunterOtherLanguage'  => array(
			'className' => 'HeadhunterOtherLanguage',
			'foreignKey' => 'cmp_headhunter_id'
		)
	);

	public $validate = array(
		'company_name' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Your company name must be less than 100 words !',
			)
		),
		'company_phone' => array(
			'numeric' => array(
				'rule' => '/^[0-9]*$/',
				'message' => 'Please enter a valid phone number !',
				'allowEmpty' => false
			),
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Your company phone must be 6 to 20 digits !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Your company phone must be 6 to 20 digits !',
			)
		),
		'mobile' => array(
			'numeric' => array(
				'rule' => '/^[0-9]*$/',
				'message' => 'Please enter a valid phone number !',
				'allowEmpty' => true
			),
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Your mobile phone must be 6 to 20 digits !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Your mobile phone must be 6 to 20 digits !',
			)
		),
		'location' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Your location must be less than 100 words !',
			)
		),
		'region' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please choose region !',
				'required' => true
			)
		),
		'representative_postion' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill representative position !',
				'required' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => 'Your representative postion must be less than 50 words !',
			)
		),
		'representative_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill representative name !',
				'required' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => 'Your representative name must be less than 50 words !',
			)
		),
		'contact_position' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill contact position !',
				'required' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => 'Your contact position must be less than 50 words !',
			)
		),
		'contact_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill contact name !',
				'required' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength',50),
				'message' => 'Your contact name must be less than 50 words !',
			)
		),
		'email' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill contact email address !',
				'required' => true,
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please refill a valid contact email address !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				'message' => 'Your contact email address must be less than 60 words !',
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email address is already in use !',
			)
		),
		'overview' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter your overview !',
				'allowEmpty' => true
			)
		),
		'hp_address' => array(
			'notBlank' => array(
				'rule' => array('url','/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'),
				'message' => 'Please enter a valid URL format !',
				'allowEmpty' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength', 200),
				'message' => 'Your HP address must be less than 200 words !',
			)
		),
		'capital' => array(
			'numeric' => array(
				'rule' => '/^[ 0-9,]*$/',
				'allowEmpty' => true,
				'message' => 'Please enter only numbers !'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 19),
				'message' => 'Your capital must be less than 15 digits !',
			)
		),
		'number_of_employee' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please select employee number !',
				'required' => true
			)
		),
		'headhunter_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill headhunter name !',
				'required' => false
			),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Your headhunter name must be less than 100 words !',
			)
		),
		'education' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill Educaiton !',
				'required' => false
			)
		),
		'industry_big' => array(
			'rule' => 'check_at_least_one_industry_big',
			'message' => 'Please select industry !',
			'required' => true
		),
		'industry_small' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please select small industry name !',
				'allowEmpty' => false
			)
		),
		'logo' => array(
			'rule' => array('logoCheck'),
			'required' => true,
			'message' => 'Please choose a valid image !',
		),
		'about' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill about !',
				'allowEmpty' => true
			)
		),
		'profile' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill profile !',
				'allowEmpty' => true
			)
		),
		'self_pr' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill your self promotion !',
				'allowEmpty' => true
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
				'message' => 'Password must be 8 to 20 digits !',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Password must be 8 to 20 digits!',
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
		'password_update' => array(
			'minLength' => array(
				'rule' => array('minLength', 8),
				'message' => 'Password must be 8 to 20 digits !',
				'allowEmpty' => true,
				'required' => false
			),
			'maxLength' => array(
				'rule' => array('maxLength', 20),
				'message' => 'Password must be 8 to 20 digits !',
			)
		),
		'confirm_password_update' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => false,
				'on' => 'create',
				'message' => 'Please enter Confirm Password !',
			),
			'sameCheck' => array(
				'rule' => array('sameCheck', 'password_update'),
				'message' => 'Password and Confirm password must be same !',
			)
		),
		'establishment' => array(
			'rule' => array('check'),
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Wrong date!',
		),
	);

	// validate logo data.
	public function logoCheck($logo) {
		$ary_ext = array('jpg','jpeg','gif','png');
		$ext = substr(strtolower(strrchr($logo['logo'], '.')), 1);
		if(in_array($ext, $ary_ext)) {
			return true;
		}

		return false;
	}

	// validate establishment data.
	public function check($data) {
		$date = explode('-', $data['establishment']);
		$dateCheck = $this->validateDate($date[1], $date[2], $date[0]);

		if ($dateCheck) {
			return true;
		} else {
			return false;
		}
	}

	public function checkEmail($check){
		// $data array is passed using the form field name as the key
		// have to extract the value to make the function generic
		$value = array_values($check);
		$value = $value[0];
		return preg_match('/^[a-zA-Z0-9_\-@.]*$/', $value);
	}

	public function sameCheck($value , $field_name) {
		$v1 = array_shift($value);
		$v2 = $this->data[$this->name][$field_name];
		return $v1 == $v2;
	}

	// PasswordReset Function
	public function passwordReset($postData = array()) {
		$user = $this->find('first', array(
				'conditions' => array(
					$this->alias . '.deleted' => 0,
					$this->alias . '.email' => $postData[$this->alias]['email']
				)
			)
		);

		unset($user['CmpHeadhunter']['password']);

		if (!empty($user) && $user[$this->alias]['deleted'] == 0) {
			$sixtyMins = time() + 3600;
			$token = $this->generateToken();
			$user[$this->alias]['password_token'] = $token;
			$user[$this->alias]['password_token_expires'] = date('Y-m-d H:i:s', $sixtyMins);
			$user = $this->save($user, false);
			$this->data = $user;
			return $user;
		} else {
			$this->invalidate('email', "The email address you entered does not exist !");
		}
		return false;
	}

	// Check password token
	public function checkPasswordToken($token = null) {
		$user = $this->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->alias . '.deleted' => 0,
				$this->alias . '.password_token' => $token,
				$this->alias . '.password_token_expires >=' => date('Y-m-d H:i:s')
				)
			)
		);

		if (empty($user)) {
			return false;
		}
		return $user;
	}

	// Generate token
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

	public function resetPassword($postData = array()) {
		$result = false;
		$this->set($postData);
		if ($this->validates()) {
			$this->data['CmpHeadhunter']['password_token'] = null;
			$result = $this->save($this->data);
		}
		return $result;
	}

	public function beforeSave($options = array()) {
		if (!empty($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}

	public function beforeFind($queryData) {
		$queryData['conditions'][$this->alias.'.deleted'] = 0;
		return $queryData;
	}

	public function check_at_least_one_industry_big(){
		if(!empty($this->data['CmpHeadhunter']['industry_big'])) {
			return true;
		}
		return false;
	}

	public function validateDate($month,$day,$year) {
		if ((!empty($month) && !empty($day) && !empty($year)) &&
			checkdate($month, $day, $year)) {
			return true;
		}

		if (empty($month) && empty($day) && empty($year)) {
			return true;
		}

		return false;
	}

}