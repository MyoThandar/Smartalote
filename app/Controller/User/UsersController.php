<?php

App::uses('UserAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'facebook', array('file' => 'facebook'. DS . 'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php'));

class UsersController extends UserAppController {

	public $components = array('RequestHandler','OptionCommon', 'Security');
	public $uses = array('User', 'CmpHeadhunter', 'Region', 'IndustryBig', 'IndustrySmall', 'TransactionManager');

	private $key = "Qb2KFqy7Amf5VMu4Jt8Cg0Dce1OGsj9HSah6Lir3";

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'user_new';
		$this->Auth->allow('login','add','facebookLogin', 'fbcallback', 'logout', 'activate');
	}


	public function add(){
		if ($this->request->is(array('post', 'put'))) {

				// create ramdom number for jobseeker id
				$randomNum = mt_rand(0000001, 9999999);
				$jobseekerId ='JS' .$randomNum;

				// for account activate
				$activateToken = uniqid();

				// hash date for one time registration url
				$expireDate = strtotime("+24 hour");
				$hashKey = Security::encrypt($expireDate, $this->key);

				$data = $this->request->data;
				$data['User']['jobseeker_id'] = $jobseekerId;
				$data['User']['activate_token'] = $activateToken;
				$data['User']['activate'] = 1;
				$data['User']['register_expired'] = $expireDate;

				try {
					$transaction = $this->TransactionManager->begin();

					$this->User->validator()->remove('current_password');
					$this->User->validator()->remove('newpassword');
					$this->User->validator()->remove('confirmpassword');
					$this->User->validator()->remove('about_myself');
					$this->User->validator()->remove('subject');
					$this->User->validator()->remove('message');

					if(!$this->User->save($data)) {
						throw new Exception("ERROR OCCUR DURING REGISTER OF USER INFORMATION");
					}

					$defaults = array(
						'from' => 'admin@smartalote.net',
						'subject' => "[SmartAlote] Procedure for completing account registration",
						'template' => 'user_activate_request',
						'emailFormat' => CakeEmail::MESSAGE_TEXT,
						'layout' => 'activate'
					);


					$Email = $this->_getMailInstance();
					$Email->to($data['User']['email']);
					$Email->from($defaults['from']);
					$Email->emailFormat($defaults['emailFormat']);
					$Email->subject($defaults['subject']);
					$Email->template($defaults['template'], $defaults['layout']);
					$Email->viewVars(array(
						'email' => $data['User']['email'],
						'token' => $activateToken,
						'expired' => $hashKey));

					if (!$Email->send()) {
						throw new Exception("ERROR OCCUR DURING SEND ACTIVATE MAIL TO USER");
					}

					$this->TransactionManager->commit($transaction);

					$this->redirect(array('controller'=>'users','action' => 'registration_success'));

				} catch (Exception $e) {
					$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
					$this->log($e->getMessage(), LOG_ERR);
					$this->TransactionManager->rollback($transaction);
				}

		}
	}

	public function activate() {
		$this->autoRender = false;

		$error_flg = false;

		if ($this->request->is('get')) {

			// get date_add()
			$email = $this->params['url']['email'];
			$activate_token = $this->params['url']['activate_token'];
			$expired = $this->params['url']['expired'];
			$decryptExpiredDateTime = Security::decrypt($expired, $this->key, $hmacSalt = null);

			// retrieve user by email, activate_token, register_expired
			$userInfo = $this->User->find('first', array(
				'conditions' => array(
					'email' => $email,
					'activate_token' => $activate_token,
					'register_expired' => $decryptExpiredDateTime,
					'activate' => 1
				),
				'recursive' => -1
			));


			if (empty($email) || empty($activate_token) || empty($expired)) {
				$this->User->delete($userInfo['User']['id']);
				$this->Session->setFlash('Invalid URL!. Register again', 'error');
				$this->redirect(array('controller'=>'users','action' => 'add'));
			}

			$expiredDateTime = date('d-m-Y H:i', $decryptExpiredDateTime);
			$expiredCheckDateTime = date('d-m-Y H:i');

			// check URL is expired or not
			if ($expiredDateTime < $expiredCheckDateTime) {
				$this->User->delete($userInfo['User']['id']);
				$this->Session->setFlash('Your URL is expired. Register again', 'error');
				$this->redirect(array('controller'=>'users','action' => 'add'));
			}

			if (empty($userInfo)) {
				$this->Session->setFlash('Your account has already activated.', 'error');
				$this->redirect(array('controller'=>'users','action' => 'login'));
			}

			$this->User->id = $userInfo['User']['id'];
			if (!$this->User->save(array('User' => array('activate' => 0)), array('validate' => false))) {
				throw new NotFoundException("ERROR ACTIVATE ACCOUNT");
			}

			$this->Session->setFlash('Your account has been activated.<br/> Please enter email and password below and login', 'success');
			$this->redirect(array('controller'=>'users','action' => 'login'));

		}

	}

	public function registration_success(){
	}

	public function login() {
		if ($this->Session->check('Auth.users')) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			$auth = $this->User->find('first', array('conditions' => array(
				'email' => $this->request->data['User']['email'])));

				if(!empty($auth)){

					if ($auth['User']['withdraw'] != 1) {

						if ($auth['User']['activate'] != 1) {

							if ($this->Auth->login()) {

								// if user checked remember me checkbox, save to cookie
								if ($this->request->data['User']['remember_me'] == 1) {
									$this->request->data['User']['email'] = $this->request->data['User']['email'];
									$this->request->data['User']['password'] = $this->request->data['User']['password'];
									$this->Cookie->write('rememberMe', $this->request->data['User'], true, '2 weeks');
								}

								// if logged user is new go to personalInfo, old user go to mypage
								if ($this->Auth->user('new_arrival') == 0) {
									$this->redirect(array('controller'=>'mypages','action' => 'personalInfo'));
								} else {
									$this->redirect(array('controller'=>'mypages','action' => 'mypage'));
								}

							} else {
								$this->Session->setFlash('Please refill email and password', 'error');
							}
						} else {
							$this->Session->setFlash('You can\'t login because your account is not activated', 'error');
						}

					} else{
						$this->Session->setFlash('You can\'t login because you withdraw your account', 'error');
					}

				} else {
					$this->Session->setFlash('Your email address is not registered', 'error');
				}
			}

			$cookies = $this->Cookie->read('rememberMe');
			if(isset($cookies['remember_me'])){
				$remember_me = $cookies['remember_me'];
			}
			$email = $cookies['email'] ;
			$password = $cookies['password'] ;
			$this->set(compact('email', 'password','remember_me'));
	}

	public function facebookLogin() {

		// disable auto render view
		$this->autoRender = false;

		// config of facebook
		// app_id => app id from facebook app, app_secret => app secret from facebook app, default_graph_version
		$fb = new Facebook\Facebook([
			'app_id' => '1954672254763121',
			'app_secret' => '0e4050a67949e14f0bf196785a6c67cc',
			'default_graph_version' => 'v2.9',
		]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://www.bizphant.dev/user/facebook/fallback', $permissions);
		$this->redirect($loginUrl);
	}

	public function fbcallback() {

		$this->autoRender = false;
		$fb = new Facebook\Facebook([
			'app_id' => '1954672254763121', // Replace {app-id} with your app id
			'app_secret' => '0e4050a67949e14f0bf196785a6c67cc',
			'default_graph_version' => 'v2.9',
		]);

		$helper = $fb->getRedirectLoginHelper();

		try {
			// get access token after login to facebook
			$accessToken = $helper->getAccessToken();

		} catch(Facebook\Exceptions\FacebookResponseException $e) {

			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();

		} catch(Facebook\Exceptions\FacebookSDKException $e) {

			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();

		}

		if (empty($accessToken)) {
			if ($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				$this->log("Error: " . $helper->getError() . "\n");
				$this->log("Error Code: " . $helper->getErrorCode() . "\n");
				$this->log("Error Reason: " . $helper->getErrorReason() . "\n");
				$this->log("Error Description: " . $helper->getErrorDescription() . "\n");
			} else {
				header('HTTP/1.0 400 Bad Request');
				echo 'Bad request';
			}
			exit;
		}

		// Logged in
		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);

		// Get user’s Facebook ID
		$userId = $tokenMetadata->getField('user_id');
		$response = $fb->get('/me?fields=id,name,email,picture', $accessToken);
		$userNode = $response->getGraphUser()->AsArray();

		$userInfo = $this->User->findByFacebookId($userNode['id']);
		if (empty($userInfo) && !empty($userNode)) {
			$randomID = mt_rand(0000001,9999999);//generate random number of given between range
			$seekerID='JS' .$randomID;
			$data = array(
				'User' => array(
					'facebook_id' => $userNode['id'],
					'name' => $userNode['name'],
					'email' => $userNode['email'],
					'password' => mt_rand(),
					'jobseeker_id' => $seekerID
				)
			);

			$check_email_duplicate = $this->User->findByEmail($userNode['email']);
			if (!empty($check_email_duplicate)) {
				$this->Session->setFlash("Email is already taken.", 'error');
				$this->redirect(array('controller'=>'users','action' => 'login'));
			}

			if (!$this->User->save($data, array('validate' => false))) {
				throw new Exception("ERROR SAVING DATA OF FACEBOOK LOGIN");
			}

			$loginInfo = $this->User->findByFacebookId($userNode['id']);
			if (!empty($loginInfo)) {
				if ($this->Auth->login($loginInfo['User'])) {
					if ($this->Auth->user('new_arrival') == 0) {
						$this->redirect(array('controller'=>'mypages','action' => 'personalInfo'));
					} else {
						$this->redirect(array('controller'=>'mypages','action' => 'mypage'));
					}
				}
			}
		} else {
			if ($this->Auth->login($userInfo['User'])) {
				if ($this->Auth->user('new_arrival') == 0) {
					$this->redirect(array('controller'=>'mypages','action' => 'personalInfo'));
				} else {
					$this->redirect(array('controller'=>'mypages','action' => 'mypage'));
				}
			}
		}
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action' => 'login'));
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
			'template' => 'user_password_reset_request',
			'emailFormat' => CakeEmail::MESSAGE_TEXT,
			'layout' => 'default'
			);
		$options = array_merge($defaults, $options);
		if (!empty($this->request->data)) {
			$user = $this->{$this->modelClass}->passwordReset($this->request->data);
			if (!empty($user)) {
				$Email = $this->_getMailInstance();
				$Email->to($user["User"]['email']);
				$Email->from($options['from']);
				$Email->emailFormat($options['emailFormat']);
				$Email->subject($options['subject']);
				$Email->template($options['template'], $options['layout']);
				$Email->viewVars(array(
					'model' => $this->modelClass,
					'user' => $this->User->data,
					'token' => $this->User->data["User"]['password_token']));
				$Email->send();
				if ($master) {
					$this->Session->setFlash(sprintf(
						__d('users', '%s has been sent an email with instruction to reset their password.'),
						$user["User"]['email']));
					$this->redirect(array('action' => 'login'));
				} else {
					$this->Session->setFlash("SmartAlote sent an email to change your password.
						Please change your password within 1 hour according to the message.");
					$this->redirect(array('action' => 'login'));
				}
			} else {
				$this->Session->setFlash("This email address is not currently in use");
				if ($this->is_mobile) {
					return;
				} else {
					$this->redirect($this->referer('/'));
				}
			}
		}
		$this->render('remind');
	}

	public function _resetPassword($token) {
		$user = $this->{$this->modelClass}->checkPasswordToken($token);
		if (empty($user)) {
			$this->Session->setFlash("The URL is incorrect or expired.");
			$this->redirect(array('action' => 'remind'));
		}
		if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Set::merge($user, $this->request->data))) {
			$this->Session->setFlash("Password is changed");
			$this->redirect($this->Auth->loginAction);
		}
		if ($this->is_mobile) {
			$this->redirect($this->render('request_password_change'));
		} else {
			$this->render('request_password_change');
		}
	}

	protected function _getMailInstance() {
		$emailConfig = Configure::read('Users.emailConfig');
		if ($emailConfig) {
			return new CakeEmail($emailConfig);
		} else {
			return new CakeEmail('default');
		}
	}

}
