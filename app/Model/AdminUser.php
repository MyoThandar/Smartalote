<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class AdminUser extends AppModel {
	public $validate = array(
		'email' => array(
			'notEmpty' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter your email.',
				),
			),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter your password.',
				)
			)
		);

	// Save password from reset password page
	public function passwordReset($postData = array()) {
		$user = $this->find('first' ,array(
				'conditions' => array(
					$this->alias . '.email' => $postData[$this->alias]['email']
				)
			)
		);

		unset($user['AdminUser']['password']);

		if (!empty($user) && $user[$this->alias]['deleted'] == 0) {
			$sixtyMins = time() + 3600;
			$token = $this->generateToken();
			$user[$this->alias]['password_token'] = $token;
			$user[$this->alias]['password_token_expires'] = date('Y-m-d H:i:s', $sixtyMins);
			// $user[$this->alias]['id'] = $user['AdminUser']['id'];
			$user = $this->save($user, false);
			$this->data = $user;
			return $user;
		} else {
			$this->invalidate('email', "The email address you entered does not exist !");
		}
		return false;
	}

	// Check password token after click reset password link from mail
	public function checkPasswordToken($token = null) {

		// Find User with password_token = $token and password_token_expires = now()
		$user = $this->find('first', array(
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

	//Password Reseting
	public function resetPassword($postData = array()) {
		$result = false;
		$this->set($postData);
		$this->validates = false ;
		if ($this->validates()) {
			$this->data['AdminUser']['default_password'] = $postData['AdminUser']['password'];
			$this->data['AdminUser']['password_token'] = null;
			$result = $this->save($this->data);
		}
		return $result;
	}

	// Generate Token for password Reset
	public function generateToken($length = 10) {

		// Initialize possible character
		$possible = '0123456789abcdefghijklmnopqrstuvwxyz';

		// Genterate token
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
	}
}