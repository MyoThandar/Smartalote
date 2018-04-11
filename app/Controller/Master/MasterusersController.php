<?php
App::uses('MasterAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class MasterUsersController extends MasterAppController {

	public $components = array('RequestHandler','OptionCommon');
	public $uses = array('CmpHeadhunter', 'TransactionManager');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'login';
	}

	public function login() {
		$this->Cookie->name = 'rememberMe'; //Remember email and password
		$this->Cookie->secure = false; // i.e. only sent if using secure HTTP
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		$this->Cookie->type('rijndael');

		if ($this->Session->check('Auth.masters')) {
			$this->redirect(array('controller' => 'masteroccupations', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			$auth = $this->CmpHeadhunter->find('first', array('conditions' => array(
			'email' => $this->request->data['CmpHeadhunter']['email'])));
			if(!empty($auth)){
				if ($auth['CmpHeadhunter']['deactivate'] != 1) {
					if ($this->Auth->login()) {
						if ($this->request->data['CmpHeadhunter']['remember_me'] == 1) {
							unset($this->request->data['CmpHeadhunter']['remember_me']);
							$this->request->data['CmpHeadhunter']['email'] = $this->request->data['CmpHeadhunter']['email'];
							$this->request->data['CmpHeadhunter']['password'] = $this->request->data['CmpHeadhunter']['password'];
							$this->Cookie->write('rememberMe', $this->request->data['CmpHeadhunter'], true, '2 weeks');
						}
						$type=AuthComponent::user('type');
						if($type==true){
							$this->redirect(array('controller' => 'masteroccupations', 'action' => 'index'));
						}else{
							$this->redirect(array('controller' => 'masterheadhunters', 'action' => 'index'));
						}

					} else {
						$this->Session->setFlash('Please refill email and password');
					}
				} else {
					$this->Session->setFlash('Can not log in!');
				}
			} else {
				$this->Session->setFlash('Your email address is not registered');
			}
		}
		$cookies = $this->Cookie->read('rememberMe');
		$email = $cookies['email'] ;
		$password = $cookies['password'] ;
		$this->set(compact('email', 'password'));
	}

	public function remind($token = null, $user = null) {
		if (empty($token)) {
			$master = false;
			if ($user) {
				$this->request->data = $user;
				$master = true;
			}
			$this->_sendPasswordReset($master);
		} else {
			$this->_resetPassword($token);
		}
	}

	protected function _sendPasswordReset($master = null, $options = array()) {
		$defaults = array(
			'from' => 'passwordreset@smartalote.net',
			'subject' => "[SmartAlote] Password reset procedure of login account",
			'template' => 'masteruser_password_reset_request',
			'emailFormat' => CakeEmail::MESSAGE_TEXT,
			'layout' => 'default'
		);
		$options = array_merge($defaults, $options);
		if (!empty($this->request->data)) {
			$user = $this->{$this->modelClass}->passwordReset($this->request->data);
			if (!empty($user)) {
				$Email = $this->_getMailInstance();
				$Email->to($user["CmpHeadhunter"]['email']);
				$Email->from($options['from']);
				$Email->emailFormat($options['emailFormat']);
				$Email->subject($options['subject']);
				$Email->template($options['template'], $options['layout']);
				$Email->viewVars(array(
					'model' => $this->modelClass,
					'user' => $this->CmpHeadhunter->data,
					'token' => $this->CmpHeadhunter->data["CmpHeadhunter"]['password_token']));
				$Email->send();
				if ($master) {
					$this->Session->setFlash(sprintf(
							__d('users', '%s has been sent an email with instruction to reset their password.'),
							$user["CmpHeadhunter"]['email']));
					$this->redirect(array('action' => 'login'));
				} else {
					$this->Session->setFlash("SmartAlote sent an email to change your password.
						Please change your password within 1 hour according to the message.");
					$this->redirect(array('action' => 'login'));
				}
			} else {
				$this->Session->setFlash("This email address is not currently in use");
				$this->redirect($this->referer('/'));
			}
		}
		$this->render('request_password_change');
	}

	protected function _resetPassword($token) {
		$user = $this->{$this->modelClass}->checkPasswordToken($token);
		if (empty($user)) {
			$this->Session->setFlash("The URL is incorrect or expired.");
			$this->redirect(array('action' => 'remind'));
		}
		$validateAttrKey = array('headhunter_name', 'education', 'industry_big','industry_small', 'number_of_employee','email','region','location','logo','representative_postion','representative_name','contact_position','contact_name','confirm_password_update','password_update','hp_address','capital','company_name','company_phone','mobile');

		foreach ($validateAttrKey as $key => $value) {
			$this->CmpHeadhunter->validator()->remove($value);
		}
		if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Set::merge($user['CmpHeadhunter'], $this->request->data['CmpHeadhunter']))) {
			$this->Session->setFlash("Password is changed");
			$this->redirect($this->Auth->loginAction);
		}
		$this->set('token', $token);
	}

	protected function _getMailInstance() {
		$emailConfig = Configure::read('Users.emailConfig');
		if ($emailConfig) {
			return new CakeEmail($emailConfig);
		} else {
			return new CakeEmail('default');
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

}