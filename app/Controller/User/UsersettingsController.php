<?php
App::uses('UserAppController', 'Controller');
class UsersettingsController extends UserAppController {
	public $components = array('OptionCommon','Session');
	public $uses = array('User', 'TransactionManager','CmpHeadhunter','SubHeadhunter');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'user_new';
	}
	public function userSetting() {
		//Get Auth datas
		$id = $this->Auth->user('id');
		$userEmail = $this->User->find('first',
			array('conditions'=>array('User.id'=>$id),
				'fields' =>'User.email',
				'recursive' => -1));
		$email = $userEmail['User']['email'];

		$userDefaultPassword= $this->User->find('first',
			array('conditions'=>array('User.id'=>$id),
				'fields' =>'User.default_password',
				'recursive' => -1));
		$password = $userDefaultPassword['User']['default_password'];

		//Get country from optioncommon
		$countries = $this->OptionCommon->country;

		//Get nonedisclosure id of AuthId
		$userIdNondisclosure = $this->User->find('first',array(
			'conditions' => array('id' => $id),
			'fields' => 'non_disclosure',
			'recursive' => -1
			));


		if (!empty($userIdNondisclosure['User']['non_disclosure'])) {
			$blockCid = explode(',', $userIdNondisclosure['User']['non_disclosure']);

			//get all companies blocked by login user
			$cmpIDS = $this->CmpHeadhunter->find('list',array(
				'fields' => 'CmpHeadhunter.company_name',
				'conditions' => array(
					'not' => array('CmpHeadhunter.company_name' => null),
					'CmpHeadhunter.id' => $blockCid,
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0
					)
				));

			//get all headhunters blocked by login user
			$headIDS = $this->CmpHeadhunter->find('list',array(
				'fields' => 'CmpHeadhunter.headhunter_name',
				'conditions' => array(
					'CmpHeadhunter.company_name' => null,
					'CmpHeadhunter.id' => $blockCid,
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0
					)
				));

			$blockIds = $cmpIDS + $headIDS;


			//get all companies except company blocked by login user
			$allCompanies = $this->CmpHeadhunter->find('list',array(
				'fields' => 'CmpHeadhunter.company_name',
				'conditions' => array(
					'not' => array('CmpHeadhunter.id' => $blockCid,
						'CmpHeadhunter.company_name' => null),
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0
					)
				));

			//get all headhunter names except headhunter blocked by login user without does't not exist company name
			$allHeadhunters = $this->CmpHeadhunter->find('list', array(
				'fields' =>'CmpHeadhunter.headhunter_name',
				'conditions' => array(
					'not' => array('CmpHeadhunter.id' => $blockCid),
					'CmpHeadhunter.company_name' => null,
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0)
				));

			//plus company and headhunter
			$cmpName = $allCompanies + $allHeadhunters;

			$this->set(compact('email','password','id','cmpName','blockIds'));
		} else {

			//get all companies
			$allCompanies = $this->CmpHeadhunter->find('list', array(
				'fields' =>'company_name',
				'conditions' => array('not' => array('CmpHeadhunter.company_name' => null),
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0
					)
				));

			//get headhuntername without does't not exist company name
			$allHeadhunters = $this->CmpHeadhunter->find('list', array(
				'fields' =>'headhunter_name',
				'conditions' => array(
					'CmpHeadhunter.company_name' => null,
					'CmpHeadhunter.deactivate' => 0,
					'CmpHeadhunter.deleted' => 0)
				));


			//plus company and headhunter
			$cmpName = $allCompanies + $allHeadhunters;
			$this->set(compact('email','password','id','cmpName'));
		}

		if ($this->request->is(array('post','put'))) {

			//user emails for email unique
			$useremails = $this->User->find('list',array(
				'fields' => 'User.email',
				'conditions' => array('not' =>array('User.email' => $email))
				));

			//user edit which form
			switch ($this->request->data['User']['type']) {
				//email edit form
				case 'email_edit':
				$this->User->id = $id;
				$validateArray = array('email' , 'newpassword','about_myself','subject','message');
				foreach ($validateArray as $validateKey => $validateVal) {
					$this->User->validator()->remove($validateVal);
				}
				if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($this->request->data['User']['email']))) {
						 //validate email format
					$email = $this->request->data['User']['email'];
					$password = $this->request->data['User']['password'];
					$email_edit = 'email_edit';
					$this->set(compact('email_edit','email','password'));
					$this->Session->setFlash('You entered an invalid email address!', 'default', array('class' => 'red'));

						}else if (in_array($this->request->data['User']['email'], $useremails)) { // for email unique

							$email = $this->request->data['User']['email'];
							$password = $this->request->data['User']['password'];
							$email_edit = 'email_edit';
							$this->set(compact('email_edit','email','password'));
							$this->Session->setFlash('This email has already been registered! Please try again', 'default', array('class' => 'red'));

						}else if (strlen($this->request->data['User']['password']) <8) { //Password less than 8 digits

							$email = $this->request->data['User']['email'];
							$password = $this->request->data['User']['password'];
							$email_edit = 'email_edit';
							$this->set(compact('email_edit','email','password'));
							$this->Session->setFlash('Password must be more than 8 digits !', 'default', array('class' => 'red'));

						} else {
							$this->request->data['User']['default_password']= $this->request->data['User']['password'];
							 // debug( $this->request->data);

							if ($this->User->save($this->request->data)) {
								$userdata = $this->User->find('first', array(
									'conditions' => array('User.id' => $id)
									));
								$email = $userdata['User']['email'];
								$password = $userdata['User']['default_password'];

								$email_edit = 'email_edit';
								$this->set(compact('email_edit','email','password'));
								$this->Session->setFlash('Successfully changed!', 'default', array('class' => 'red'));
							}
						}

						break;
				//password edit form
						case 'change_pw':

						if ($this->request->data['User']['newpassword'] == $this->request->data['User']['confirmpassword'] && $this->request->data['User']['current_password'] == $password) {

						if (strlen($this->request->data['User']['newpassword']) < 8) { //less then 8
							$chg_pass = 'chg_pass';
							$this->set(compact('chg_pass'));
							$this->Session->setFlash('Newpassword and confirmpassword must be more than 8 digits !', 'default', array('class' => 'red'));
						} else {
							$this->request->data['User']['default_password'] = $this->request->data['User']['newpassword'];
							$this->request->data['User']['password'] = $this->request->data['User']['default_password'];
							$validateArray = array('email','about_myself','subject','message');
							foreach ($validateArray as $validateKey => $validateVal) {
								$this->User->validator()->remove($validateVal);
							}
							$this->User->id = $id;
							if ($this->User->save($this->request->data)) {
								$chg_pass = 'chg_pass';
								$this->set(compact('chg_pass'));
								$this->Session->setFlash('Successfully changed password!', 'default', array('class' => 'red'));
							}
						}

					} else {
						if ($this->request->data['User']['current_password'] != $password) {
							$chg_pass = 'chg_pass';
							$pass_confirm_same = 'not_same';
							$this->set(compact('chg_pass','pass_confirm_same'));
							$this->Session->setFlash('Please fill old password!', 'default', array('class' => 'red'));
						} else {
							$chg_pass = 'chg_pass';
							$pass_confirm_same = 'not_same';
							$this->set(compact('chg_pass','pass_confirm_same'));
							$this->Session->setFlash('Password and Confirm password does not match', 'default', array('class' => 'red'));
						}
					}
					break;
				//disclosure edit form
					case 'none_disc':
					$blockCmp = $this->request->data['User']['block_cmp'];
					if (!empty($blockCmp)) {
						if (!empty($userIdNondisclosure['User']['non_disclosure'])) {
							$userIdNondisclosure['User']['non_disclosure'] .= ','.$blockCmp;
							$this->request->data['User']['non_disclosure'] = $userIdNondisclosure['User']['non_disclosure'];
						} else {
							$this->request->data['User']['non_disclosure'] = $blockCmp;
						}

						$this->User->id = $id;
						unset($this->request->data['User']['none_disc']);
						unset($this->request->data['User']['block_cmp']);

						$validateArray = array('email','newpassword','about_myself','subject','message');
						foreach ($validateArray as $validateKey => $validateVal) {
							$this->User->validator()->remove($validateVal);
						}

						if ($this->User->save($this->request->data)) {
							$userIdNondisclosure = $this->User->find('first',array(
								'conditions' => array('id' => $id),
								'fields' => 'non_disclosure',
								'recursive' => -1
								));

							if (!empty($userIdNondisclosure['User']['non_disclosure'])) {

								$blockCid = explode(',', $userIdNondisclosure['User']['non_disclosure']);

									//get all companies blocked by login user
								$cmpIDS = $this->CmpHeadhunter->find('list',array(
									'fields' => 'CmpHeadhunter.company_name',
									'conditions' => array(
										'not' => array('CmpHeadhunter.company_name' => null),
										'CmpHeadhunter.id' => $blockCid,
										'CmpHeadhunter.deactivate' => 0,
										'CmpHeadhunter.deleted' => 0
										)
									));

									//get all headhunters blocked by login user
								$headIDS = $this->CmpHeadhunter->find('list',array(
									'fields' => 'CmpHeadhunter.headhunter_name',
									'conditions' => array(
										'CmpHeadhunter.company_name' => null,
										'CmpHeadhunter.id' => $blockCid,
										'CmpHeadhunter.deactivate' => 0,
										'CmpHeadhunter.deleted' => 0
										)
									));

								$blockIds = $cmpIDS + $headIDS;

									//get all companies except company blocked by login user
								$allCompanies = $this->CmpHeadhunter->find('list',array(
									'fields' => 'CmpHeadhunter.company_name',
									'conditions' => array(
										'not' => array('CmpHeadhunter.id' => $blockCid,
											'CmpHeadhunter.company_name' => null),
										'CmpHeadhunter.deactivate' => 0,
										'CmpHeadhunter.deleted' => 0
										)
									));

									//get all headhunter names except headhunter blocked by login user without does't not exist company name
								$allHeadhunters = $this->CmpHeadhunter->find('list', array(
									'fields' =>'CmpHeadhunter.headhunter_name',
									'conditions' => array(
										'not' => array('CmpHeadhunter.id' => $blockCid),
										'CmpHeadhunter.company_name' => null,
										'CmpHeadhunter.deactivate' => 0,
										'CmpHeadhunter.deleted' => 0)
									));

									//plus company and headhunter
								$cmpName = $allCompanies + $allHeadhunters;
								$non_disclosure = 'non_disclosure';
								$this->set(compact('non_disclosure','block_cmp','cmpName','blockIds'));
								$this->Session->setFlash('Companies below has been registered successfully.', 'default', array('class' => 'red'));
							}
						}

					} else {
						$non_disclosure = 'non_disclosure';
						$this->set(compact('non_disclosure','block_cmp','blockIds'));
						$this->Session->setFlash('Please fill company name!', 'default', array('class' => 'red'));
					}
					break;

					default:
				//widthdraw edit form


					if ($this->request->data['User']['password'] == $password) {
						$this->User->id = $id;

						$validateArray = array('about_myself','subject','message');
						foreach ($validateArray as $validateKey => $validateVal) {
							$this->User->validator()->remove($validateVal);
						}
						if($this->User->updateAll(array("withdraw" => 1),array("id" => $id))){
						// start send mail to me  from JobVillla

						// $emailTo = $email;
						// $email ='khaingkyu1994@gmail.com'; //SmartAlote mail
						// $subject = "success withdraw";
						// $body = "Successfully withdraw from SmartAlote!\n".
						// "http://192.168.33.34/user/logout";
						// $headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
						// $headers .= 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
						// mail($emailTo, $subject, $body, $headers);
						// $emailSent = true;


						// end send mail to me  from JobVillla

						$withdraw = 'withdraw';
						$this->set(compact('withdraw'));
						$this->Session->setFlash('You can not login because you left from SmartAlote.', 'default', array('class' => 'red'));
						$this->redirect(array('controller' => 'users','action'=>'logout'));
					}
				} else {
					$withdraw = 'withdraw';
					$this->set(compact('withdraw'));
					$this->Session->setFlash('Your password must be old password!', 'default', array('class' => 'red'));
				}
				break;
			}
		}

	}

	public function unBlock($id) {
		$userID = $this->Auth->user('id');
		$userIdNondisclosure = $this->User->find('first',array(
			'conditions' => array('id' => $userID),
			'fields' => 'non_disclosure',
			'recursive' => -1
			));
		$blockIds = explode(',', $userIdNondisclosure['User']['non_disclosure']);

		foreach ($blockIds as $blockIdsKey => $blockIdsVal) {
			if ($blockIdsVal != $id) { // remove delete ID
				$blockIdsValArray[]= $blockIdsVal;
			}
		}
		if (!empty($blockIdsValArray)) {
			$saveID = implode(",", $blockIdsValArray); // join comma IDs
		} else {
			$saveID= '';
		}
		$this->User->id=$userID;
		$this->User->saveField('non_disclosure', $saveID);
		$this->redirect(array('action' => 'userSetting'));
	}
}