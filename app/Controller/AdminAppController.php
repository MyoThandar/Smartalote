<?php
class AdminAppController extends AppController {
	protected $_mergeParent = 'AdminAppController';
	public $actsAs = array('Containable');

	public $components = array(
		'Session',
		'DebugKit.Toolbar',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'adminusers',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'admincompanys',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'adminusers',
				'action' => 'login'
			),
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
						'username' => 'name',
						'password' => 'password'
					),
					'userModel' => 'AdminUser',
					'passwordHasher' => 'Blowfish'
				)
			),
			'authorize' => array(
				'Controller',
			)
		 ),
		'Cookie'
	);

	public function beforeFilter() {
		$this->layout = 'admin';
		AuthComponent::$sessionKey = 'Auth.admins';
		if(in_array($this->params['controller'],array('adminusers','adminvjobs'))){
			$this->Auth->allow('remind');
		}
		$this->Cookie->name = 'admin_rememberMe';
		$this->Cookie->secure = false; // i.e. only sent if using secure HTTP
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		$this->Cookie->type('rijndael');
		$this->set('LoginedUser', $this->Auth->user());
	}

	public function isAuthorized($user) {
		if ($this->Auth->loggedIn() && $this->Session->check('Auth.admins')) {
			return true;
		}
		return false;
	}
}