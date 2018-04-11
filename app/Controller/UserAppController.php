<?php
session_start();
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class UserAppController extends AppController {
	protected $_mergeParent = 'UserAppController';
	public $is_mobile = false;
	public $layouts = array('desktop', 'mobile');
	public $components = array(
		'Session',
		'DebugKit.Toolbar',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'users',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
						'username' => 'email',
						'password' => 'password',
					),
					'userModel' => 'User',
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
		),
	);

	public function beforeFilter() {
		$this->layout = 'users';
		AuthComponent::$sessionKey = 'Auth.users';
		if(in_array($this->params['controller'],array('users'))){
			$this->Auth->allow('remind');
		}
		$this->Cookie->name = 'rememberMe';
		$this->Cookie->secure = false; // i.e. only sent if using secure HTTP
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		$this->Cookie->type('rijndael');
		$this->set('LoginedUser', $this->Auth->user());
		$this->Auth->allow('privacy_policy','term_condition','add','registration_success','employer_success','remind','index','contactus','job_search','employer_add','help','receipt','detail','request_password_change', 'top_com_info');

		// Flag whether the layout is being "forced" i.e overwritten/controlled by the user (true or false)
		$forceLayout = $this->Cookie->read('Options.forceLayout');
		// Identify the layout the user wishes to "force" (mobile or desktop)
		$forcedLayout = $this->Cookie->read('Options.forcedLayout');

		// Check URL paramaters for ?forcedLayout=desktop or ?forcedLayout=mobile and persist this decision in a COOKIE
		if( isset($this->params->query['forcedLayout']) && in_array($this->params->query['forcedLayout'], $this->layouts) ) {
			$forceLayout = true;
			$forcedLayout = $this->params->query['forcedLayout'];
			$this->Cookie->write('Options.forceLayout', $forceLayout);
			$this->Cookie->write('Options.forcedLayout', $forcedLayout);
		}

		// We use CakePHP's built in "mobile" User-Agent detection (a pretty basic list of UA's see: /lib/Cake/Network/CakeRequest.php)
		// Note: For more robust detection consider using "Mobile Detect" (https://github.com/serbanghita/Mobile-Detect) or WURL (http://wurfl.sourceforge.net/)
		if( ( $forceLayout && $forcedLayout == 'mobile' ) || ( !$forceLayout && $this->request->is('mobile'))) {
			$this->is_mobile = true;
			$this->autoRender = false; // take care of rendering in the afterFilter()
		}
		$this->set('is_mobile', $this->is_mobile);
	}

	public function afterFilter() {
		// if in mobile mode, check for a vaild layout and/or view and use it
		if($this->is_mobile && !$this->request->is('ajax')) {
			$has_mobile_view_file = file_exists( ROOT . DS . APP_DIR . DS . 'View' . DS . $this->name . DS . 'mobile' . DS . $this->action . '.ctp' );
			$has_mobile_layout_file = file_exists( ROOT . DS . APP_DIR . DS . 'View' . DS . 'Layouts' . DS . 'mobile' . DS . $this->layout . '.ctp' );
			$view_file = ( $has_mobile_view_file ? 'mobile' . DS : '' ) . $this->action;
			$layout_file = ( $has_mobile_layout_file ? 'mobile' . DS : '' ) . $this->layout;
			$this->render( $view_file, $layout_file );
		}
	}

	public function isAuthorized($user) {
		if ($this->Auth->loggedIn() && $this->Session->check('Auth.users')) {
			return true;
		}
		return false;
	}

	public function beforeRender() {
		parent::beforeRender();
		$step1 = $this->Session->read('register_step_one');
		$step2 = $this->Session->read('register_step_two');
		$step3 = $this->Session->read('register_step_three');
		$step4 = $this->Session->read('register_step_four');
		$step5 = $this->Session->read('register_step_five');
		$step6 = $this->Session->read('register_step_six');
		$step7 = $this->Session->read('register_step_seven');
		$this->set(compact('step1','step2','step3','step4','step5','step6','step7'));
	}
}