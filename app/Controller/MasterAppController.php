<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class MasterAppController extends AppController {
	protected $_mergeParent = 'MasterAppController';
	public $components = array(
		'Session',
		'DebugKit.Toolbar',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'masterusers',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'masterjobs',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'masterusers',
				'action' => 'logout'
			),
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
						'username' => 'email',
						'password' => 'password',
					),
					'userModel' => 'CmpHeadhunter',
					'passwordHasher' => 'Blowfish',
				)
			),
			'authorize' => array(
				'Controller',
			)
		),
		'Cookie',
		'Search.Prg' => array(
			'commonProcess' => array(
				'paramType' => 'querystring',
				'filterEmpty' => true
			)
		)
	);

	public function beforeFilter() {
		$this->layout = 'master';
		AuthComponent::$sessionKey = 'Auth.masters';
		if (in_array($this->params['controller'],array('masterusers'))) {
			$this->Auth->allow('remind');
		}
		$this->loadModel('CmpHeadhunter');
		$LoginedInfo = $this->CmpHeadhunter->findById($this->Auth->user('id'));
		$LoginedUser = $this->Auth->user() ;
		$this->set(compact('LoginedUser', 'LoginedInfo'));
	}

	public function isAuthorized($user) {
		if ($this->Auth->loggedIn() && $this->Session->check('Auth.masters')) {
			return true;
		}
		return false;
	}
}