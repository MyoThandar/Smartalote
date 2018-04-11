<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class SubHeadhunter extends AppModel {

	public $hasMany = array(
		'Occupation'
	);

	public function beforeFind($queryData) {
		$queryData['conditions'][$this->alias.'.deleted'] = 0;
		return $queryData;
	}

	public $validate = array(
		'company_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please choose company name !',
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
				'rule' =>  array('email'),
				'message' => 'Please fill email format !',
				'required' => true,
			),
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				'message' => 'Your email must be less than 60 !',
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email address is already in use !',
			)
		),
		'location' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter location !',
				'required' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Your location must be less than 100 words !',
			)
		),
		'industry_big_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please choose  bigindustry!',
				'required' => true,
			),
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
		'representative_postion' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill representative position !',
				'allowEmpty' => true
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
				'allowEmpty' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => 'Your representative name must be less than 50 words !',
			)
		),
		'overview' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter your overview !',
				'allowEmpty' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength', 3000),
				'message' => 'Your overview message must be less than 3,000 words !',
			)
		),
		'logo' => array(
			'rule' => array('logoCheck'),
			'required' => true,
			'message' => 'Please choose a valid image !',
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

