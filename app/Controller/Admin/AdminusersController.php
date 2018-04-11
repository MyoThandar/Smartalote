<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AdminAppController', 'Controller');
class AdminUsersController extends AdminAppController {
	public $uses = array('AdminUser');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'login_admin';
	}

	public function login() {
		if ($this->Session->check('Auth.admins')) {
			$this->redirect(array('controller' => 'admincompanys', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			$auth = $this->AdminUser->find('first', array(
				'conditions' => array(
					'name' => $this->request->data['AdminUser']['name'])
				));
			if(!empty($auth)){
				if ($this->Auth->login()) {
					if ($this->request->data['AdminUser']['remember_me'] == 1) {
						unset($this->request->data['AdminUser']['remember_me']);
						$this->Cookie->write('admin_rememberMe', $this->request->data['AdminUser'], true, '2 weeks');
					}
					$this->redirect(array('controller' => 'admincompanys', 'action' => 'index'));

				} else {
					$this->Session->setFlash('Please refill name and password');
				}
			} else {
				$this->Session->setFlash('Your name is not registered');
			}
		}
		$cookies = $this->Cookie->read('admin_rememberMe');
		$name = $cookies['name'] ;
		$password = $cookies['password'] ;
		$this->set(compact('name', 'password'));
	}

	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}

	// Main function for password reset
	public function remind($token = null, $user = null) {

		// Check token
		if (empty($token)) {
			$admin = false;
			if ($user) {
				$this->request->data = $user;
				$admin = true;
			}
			$this->_sendPasswordReset($admin);
		} else {
			$this->_resetPassword($token);
		}
	}

	// Send Password Reset
	protected function _sendPasswordReset($admin = null, $options = array()) {
		$defaults = array(
			'from' => 'passwordreset@smartalote.net',
			'subject' => "[SmartAlote] Password reset procedure of login account",
			'template' => 'adminuser_password_reset_request',
			'emailFormat' => CakeEmail::MESSAGE_TEXT,
			'layout' => 'default'
		);
		$options = array_merge($defaults, $options);
		if (!empty($this->request->data)) {
			$user = $this->{$this->modelClass}->passwordReset($this->request->data);
			if (!empty($user)) {
				$Email = $this->_getMailInstance();
				$Email->to($user["AdminUser"]['email']);
				$Email->from($options['from']);
				$Email->emailFormat($options['emailFormat']);
				$Email->subject($options['subject']);
				$Email->template($options['template'], $options['layout']);
				$Email->viewVars(array(
					'model' => $this->modelClass,
					'user' => $this->AdminUser->data,
					'token' => $this->AdminUser->data["AdminUser"]['password_token']));
				$Email->send();
				if ($admin) {
					$this->Session->setFlash(sprintf(
							__d('AdminUsers', '%s has been sent an email with instruction to reset their password.'),
							$user["AdminUser"]['email']));
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

	// Reset Password
	protected function _resetPassword($token) {
		$user = $this->{$this->modelClass}->checkPasswordToken($token);
		if (empty($user)) {
			$this->Session->setFlash("The URL is incorrect or expired.");
			$this->redirect(array('action' => 'remind'));
		}

		if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Set::merge($user, $this->request->data))) {
			$this->Session->setFlash("Password is changed");
			$this->redirect($this->Auth->loginAction);
		}
		$this->set('token', $token);
	}

	// Mail Instance
	protected function _getMailInstance() {
		$emailConfig = Configure::read('AdminUsers.emailConfig');
		if ($emailConfig) {
			return new CakeEmail($emailConfig);
		} else {
			return new CakeEmail('default');
		}
	}
}