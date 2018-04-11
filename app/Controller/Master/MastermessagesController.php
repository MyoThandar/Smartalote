<?php
App::uses('MasterAppController', 'Controller');
class MastermessagesController extends MasterAppController {
	public $components = array('RequestHandler','OptionCommon', 'Paginator');
	public $uses = array('Message', 'Sender', 'Receiver', 'Trash', 'Occupation', 'AdminUser', 'User', 'CmpHeadhunter', 'TransactionManager');


	public function beforeFilter(){
		parent::beforeFilter();
		$cmpAndUserNameInfo = $this->Message->getAdminAndUserInfo();
		// Prepare array id:type = name<example@email.com>
		// Use array for multiple selection in message compose [to] field
		$data = array();
		foreach ($cmpAndUserNameInfo as $key => $val) {
			$data[$val[0]['id'].':'.$val[0]['type']] = $val['0']['name'] . ' <' . $val['0']['jobseeker_id'] . '>';
		}

		$this->set(compact('data'));
	}

	public function index(){
		$messageLabel = $this->OptionCommon->message_label;

		// get current logged in user type
		$loggedInUserType = $this->Auth->user('type');
		$loggedInUserType = ($loggedInUserType == 0) ? 'H' : 'C';

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => 50,
			'conditions' => array(
				'recipient_id' => $this->Auth->user('id'),
				'receiver_user_type' => $loggedInUserType
			),
			'order' => array('id' => 'DESC')
		);
		$receiverDatas = $this->paginate('Receiver');

		$messages = $this->Message->find('all', array('recursive' => -1));


		// Repair array index
		// array('id' => array())
		$arr = array();
		foreach ($messages as $key => $val) {
			$arr[$val['Message']['id']] = $val['Message'];
		}
		unset($messages);
		$messages = $arr;

		foreach ($receiverDatas as $key => $val) {
			$userInfo = $this->_getReceiptionUser($val['Sender']['sender_user_type']);
			$receiverDatas[$key]['Sender']['from_mail'] = $userInfo[$val['Sender']['creator_id']];

			$receiverDatas[$key]['Message'] = $messages[$val['Sender']['message_id']];
		}

		$this->set(compact('receiverDatas', 'messageLabel'));
	}

	public function composeMessage() {
		$this->autoRender = false;

		if ($this->request->is('post')) {

			// get variable from view (array list of [to])
			$arrList = $this->viewVars['data'];

			// get current logged in user type
			$loggedInUserType = $this->Auth->user('type');
			$loggedInUserType = ($loggedInUserType == 0) ? 'H' : 'C';

			$data = array();

			// initial data for insert to messages table
			$data['Message']['subject'] = $this->request->data['Message']['subject'];
			$data['Message']['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Message']['label'] = $loggedInUserType;


			// initial data for insert to sender table
			if (!empty($this->request->data['Message']['to'])) {
				$str = '';
				foreach ($this->request->data['Message']['to'] as $key => $val) {
					if ((count($this->request->data['Message']['to']) - 1) != $key) {
						$str .= $val.',';
					} else {
						$str .= $val;
					}
				}
			}
			$creator_id = $this->Auth->user('id');

			$data['Sender'][0]['to'] = $str;
			$data['Sender'][0]['from'] = $this->Auth->user('email');
			$data['Sender'][0]['creator_id'] = $creator_id;
			$data['Sender'][0]['sender_user_type'] = $loggedInUserType;

			$data['Sender'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['message_body'] = nl2br($this->request->data['Message']['message_body']);

			// initial data for insert to receiver table
			if (!empty($this->request->data['Message']['to'])) {
				$name = '';
				$label = '';
				$name_rec = '';
				foreach ($this->request->data['Message']['to'] as $key => $val) {
					$explodeData = explode(':', $val);
					$info = $this->get_name($explodeData[0], $explodeData[1]);

					switch($loggedInUserType) {
						case "C": $label = "Company"; $name_rec = $this->Auth->user('company_name'); break;
						case "H": $label = "Headhunter"; $name_rec = $this->Auth->user('headhunter_name'); break;
					}

					$data['Sender'][0]['Receiver'][$key]['recipient_id'] = $explodeData[0];
					$data['Sender'][0]['Receiver'][$key]['receiver_user_type'] = $explodeData[1];
					$data['Sender'][0]['Receiver'][$key]['sender_user_type'] = $loggedInUserType;

					$data['Sender'][0]['Receiver'][$key]['name'] = $name_rec;
					$data['Sender'][0]['Receiver'][$key]['subject'] = $this->request->data['Message']['subject'];
					$data['Sender'][0]['Receiver'][$key]['message_body'] = nl2br($this->request->data['Message']['message_body']);

					$data['Sender'][0]['Receiver'][$key]['label'] = $label;
					$name .= $info[$explodeData[0]].',';
				}

				$data['Sender'][0]['name'] = $name;
			}

			try {

				$transaction = $this->TransactionManager->begin();

				if (!$this->Message->saveAssociated($data, array('deep' => true))) {
					throw new Exception('ERROR COULD NOT SENT THE MESSAGE');
				}

				$this->TransactionManager->commit($transaction);

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->Session->setFlash('message couldn\'t sent', 'error');
				$this->TransactionManager->rollback($transaction);
			}

			$this->Session->setFlash('Message has been sent', 'success');
			$this->redirect(array('controller' => 'mastermessages', 'action' => 'index'));
		}
	}

	public function replyMessage() {
		$this->autoRender = false;

		if ($this->request->is('post')) {

			// get current logged in user type
			$loggedInUserType = $this->Auth->user('type');
			$loggedInUserType = ($loggedInUserType == 0) ? 'H' : 'C';

			$data = array();

			// initial data for insert to messages table
			$data['Message']['subject'] = $this->request->data['Message']['subject'];
			$data['Message']['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Message']['reply_to'] = !empty($this->request->data['Message']['reply_to']) ? $this->request->data['Message']['message_id'].','.$this->request->data['Message']['reply_to'] : $this->request->data['Message']['message_id'];
			$data['Message']['label'] = $loggedInUserType;

			$creator_id = $this->Auth->user('id');

			$label = '';
			$name_rec = '';
			switch($loggedInUserType) {
				case "C": $label = "Company"; $name_rec = $this->Auth->user('company_name'); break;
				case "H": $label = "Headhunter"; $name_rec = $this->Auth->user('headhunter_name'); break;
			}

			$explodeData = explode(':', $this->request->data['Message']['to']);
			$info = $this->get_name($explodeData[0], $explodeData[1]);

			$data['Sender'][0]['to'] = $this->request->data['Message']['to'];
			$data['Sender'][0]['from'] = $this->Auth->user('email');
			$data['Sender'][0]['creator_id'] = $creator_id;
			$data['Sender'][0]['sender_user_type'] = $loggedInUserType;
			$data['Sender'][0]['name'] = $info[$explodeData[0]];
			$data['Sender'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['message_body'] = nl2br($this->request->data['Message']['message_body']);

			$data['Sender'][0]['Receiver'][0]['recipient_id'] = $explodeData[0];
			$data['Sender'][0]['Receiver'][0]['receiver_user_type'] = $explodeData[1];
			$data['Sender'][0]['Receiver'][0]['sender_user_type'] = $loggedInUserType;

			$data['Sender'][0]['Receiver'][0]['name'] = $name_rec;
			$data['Sender'][0]['Receiver'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['Receiver'][0]['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Sender'][0]['Receiver'][0]['label'] = $label;


			try {

				$transaction = $this->TransactionManager->begin();

				if (!$this->Message->saveAssociated($data, array('deep' => true))) {
					throw new Exception('ERROR COULD NOT SENT THE MESSAGE');
				}

				$this->TransactionManager->commit($transaction);

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->Session->setFlash('message couldn\'t sent', 'error');
				$this->TransactionManager->rollback($transaction);
			}

			$this->Session->setFlash('Message has been sent', 'success');
			if ($this->request->data['Message']['screen_type'] == "inbox") {
				$this->redirect(array('controller' => 'mastermessages', 'action' => 'index'));
			}
		}
	}

	public function sentMessage() {

		$messageLabel = $this->OptionCommon->message_label;

		// get current logged in user type
		$loggedInUserType = $this->Auth->user('type');
		$loggedInUserType = ($loggedInUserType == 0) ? 'H' : 'C';

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => 50,
			'conditions' => array('creator_id' => $this->Auth->user('id'), 'sender_user_type' => $loggedInUserType),
			'order' => array('id' => 'DESC')
		);
		$senderDatas = $this->paginate('Sender');

		foreach ($senderDatas as $key1 => $val1) {
			foreach ($val1['Receiver'] as $key2 => $val2) {
				$userInfo = $this->_getReceiptionUser($val2['receiver_user_type']);
				$senderDatas[$key1]['Receiver'][$key2]['reception_mail'] = $userInfo[$val2['recipient_id']];
			}
		}


		$this->set(compact('senderDatas', 'messageLabel'));
	}

	public function detailMessage($type = null, $id = null) {

		if (empty($type) || empty($id)) {
			$this->redirect(array('controller' => 'mastermessages', 'action' => 'index'));
		}

		$messFlg = '';
		switch($type) {
			case 'send':
				$messFlg = 'To';
				$mgeDetails = $this->Sender->findById($id);
				$job_info = array();
				foreach ($mgeDetails['Receiver'] as $key => $val) {
					$userInfo = $this->_getReceiptionUser($val['receiver_user_type']);
					$mgeDetails['Receiver'][$key]['reception_mail'] = $userInfo[$val['recipient_id']];
					if (!empty($val['job_id'])) {
						if (strpos($val['job_id'], ',') !== false){
							$explode = explode(',', $val['job_id']);
							foreach ($explode as $jkey => $jval) {
								$job = $this->Occupation->findById($jval);
								$job_info[] = $job;
							}
						} else {

							$job = $this->Occupation->findById($val['job_id']);
							$job_info[] = $job;
						}
					}
				}

				$messages = $this->Message->find('first', array(
					'conditions' => array('id' => $mgeDetails['Sender']['message_id']),
					'recursive' => -1
				));

				$replyMessage = array();
				if (!empty($messages['Message']['reply_to'])) {
					if (strpos($messages['Message']['reply_to'], ',') == true) {
						$replyMessId = explode(',', $messages['Message']['reply_to']);
						foreach ($replyMessId as $key => $val) {
							$replyMessage[$key] = $this->Message->find('first', array(
								'conditions' => array('id' => $val),
							));

							$send_user = $this->_getReceiptionUser($replyMessage[$key]['Sender'][0]['sender_user_type']);
							$data = explode('&lt;', $send_user[$replyMessage[$key]['Sender'][0]['creator_id']]);
							$replyMessage[$key]['Reply']['username'] = $data[0];
						}
					} else {
						$replyMessage[] = $this->Message->find('first', array(
								'conditions' => array('id' => $messages['Message']['reply_to'])
						));

						$send_user = $this->_getReceiptionUser($replyMessage[0]['Sender'][0]['sender_user_type']);
						$data = explode('&lt;', $send_user[$replyMessage[0]['Sender'][0]['creator_id']]);
						$replyMessage[0]['Reply']['username'] = $data[0];
					}
				}
			break;
			case 'inbox':
				$messFlg = 'From';
				$mgeReceiver = $this->Receiver->findById($id);

				$this->Receiver->id = $id;
				$this->Receiver->save(array('Receiver' => array('is_read' => 1)), array('validate' => false));

				$messages = $this->Message->find('first', array(
					'conditions' => array('id' => $mgeReceiver['Sender']['message_id']),
					'recursive' => -1));

				$replyMessage = array();
				if (!empty($messages['Message']['reply_to'])) {
					if (strpos($messages['Message']['reply_to'], ',') == true) {
						$replyMessId = explode(',', $messages['Message']['reply_to']);
						foreach ($replyMessId as $key => $val) {
							$replyMessage[$key] = $this->Message->find('first', array(
								'conditions' => array('id' => $val),
							));

							$send_user = $this->_getReceiptionUser($replyMessage[$key]['Sender'][0]['sender_user_type']);
							$data = explode('&lt;', $send_user[$replyMessage[$key]['Sender'][0]['creator_id']]);
							$replyMessage[$key]['Reply']['username'] = $data[0];
						}
					} else {
						$replyMessage[] = $this->Message->find('first', array(
								'conditions' => array('id' => $messages['Message']['reply_to'])
						));

						$send_user = $this->_getReceiptionUser($replyMessage[0]['Sender'][0]['sender_user_type']);
						$data = explode('&lt;', $send_user[$replyMessage[0]['Sender'][0]['creator_id']]);
						$replyMessage[0]['Reply']['username'] = $data[0];
					}
				}

				$userInfo = $this->_getReceiptionUser($mgeReceiver['Sender']['sender_user_type']);
				$mgeReceiver['Sender']['reception_mail'] = $userInfo[$mgeReceiver['Sender']['creator_id']];
				$mgeReceiver['Message'] = $messages['Message'];

			break;

		}

		$this->set(compact('mgeDetails', 'mgeReceiver', 'messFlg', 'replyMessage', 'job_info'));
	}


	/*
	* Get user or cmp_headhunter
	* format array(id => name <email)
	*
	* @param $type (J => jobseeder, C => company, H => headhunter)
	* @return array(id => name <email)
	*/
	private function _getReceiptionUser($type = null) {
		if (empty($type)) {
			return false;
		}

		// get user according to $type.
		switch ($type) {
			case 'A':
					$this->AdminUser->virtualFields['reciption'] = 'CONCAT(name, "&lt;", "Admin")';
					$userInfo = $this->AdminUser->find('list', array(
						'fields' => array('id', 'reciption'),
					));
				break;

			case 'J':
					$this->User->virtualFields['reciption'] = 'CONCAT(name, "&lt;", jobseeker_id)';
					$userInfo = $this->User->find('list', array(
						'fields' => array('id', 'reciption'),
					));
				break;

			case 'C':
					$this->CmpHeadhunter->virtualFields['reciption'] = 'CONCAT(company_name, "&lt;", company_id)';
					$userInfo = $this->CmpHeadhunter->find('list', array(
						'fields' => array('id', 'reciption'),
						'condition' => array('type' => 0),
						'order' => array('id' => 'DESC')
					));
				break;

			case 'H':
					$this->CmpHeadhunter->virtualFields['reciption'] = 'CONCAT(headhunter_name, "&lt;", company_id)';
					$userInfo = $this->CmpHeadhunter->find('list', array(
						'fields' => array('id', 'reciption'),
						'condition' => array('type' => 1),
						'order' => array('id' => 'DESC')
					));
				break;
		}

		return $userInfo;

	}


	public function trashMessage() {

		$messageLabel = $this->OptionCommon->message_label;
		$currUserInfo = $this->Auth->user('company_id');
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => 50,
			'conditions' => array(
				'Trash.trash_user_id' => $this->Auth->user('id'),
				'Trash.trash_user_type' => $currUserInfo[0]
			),
			'order' => array('id' => 'DESC')
		);
		$trashDatas = $this->paginate('Trash');

		$data = array();

		foreach ($trashDatas as $key => $val) {

			$data['Trash'][$key]['trash_id'] = $val['Trash']['id'];
			$data['Trash'][$key]['message_subject'] = $val['Message']['subject'];
			$data['Trash'][$key]['created_date'] = $val['Trash']['created'];

			if (!empty($val['Sender']['id'])) {

				$senderInfo = $this->Sender->find('first', array(
					'conditions' => array('Sender.id' => $val['Sender']['id']),
					'callbacks' => false
				));

				$mail = '';

				$data['Trash'][$key]['sender_id'] = $val['Sender']['id'];
				$data['Trash'][$key]['mail_type'] = "To";

				foreach ($senderInfo['Receiver'] as $skey => $sval) {
					$userInfo = $this->_getReceiptionUser($sval['receiver_user_type']);
					$explodeData = explode('&lt;', $userInfo[$sval['recipient_id']]);
					$mail .= $explodeData[0].',';
					$data['Trash'][$key]['mail'] = $mail;
				}
			}

			if (!empty($val['Receiver']['id'])) {
				$receiverInfo = $this->Receiver->find('first', array(
					'conditions' => array('Receiver.id' => $val['Receiver']['id']),
					'callbacks' => false
				));

				$mail = '';

				$data['Trash'][$key]['receiver_id'] = $val['Receiver']['id'];
				$data['Trash'][$key]['mail_type'] = "From";

				$userInfo = $this->_getReceiptionUser($receiverInfo['Sender']['sender_user_type']);
				$explodeData = explode('&lt;', $userInfo[$receiverInfo['Sender']['creator_id']]);
				$mail = $explodeData[0];
				$data['Trash'][$key]['mail'] = $mail;

			}

		}

		unset($trashDatas);

		$trashDatas = $data;

		$this->set(compact('trashDatas', 'messageLabel'));
	}

	public function trashDetail($type = null, $id = null) {

		if (empty($type) || empty($id)) {
			$this->redirect(array('action' => 'index'));
		}

		$messFlg = '';
		switch($type) {
			case 'send':
				$messFlg = 'To';

				$mgeDetails = $this->Sender->find('first', array(
					'conditions' => array('Sender.id' => $id),
					'callbacks' => false
				));

				foreach ($mgeDetails['Receiver'] as $key => $val) {
					$userInfo = $this->_getReceiptionUser($val['receiver_user_type']);
					$mgeDetails['Receiver'][$key]['reception_mail'] = $userInfo[$val['recipient_id']];
				}

				$messages = $this->Message->find('first', array(
					'conditions' => array('id' => $mgeDetails['Sender']['message_id']),
					'recursive' => -1
				));

				$replyMessage = array();
				if (!empty($messages['Message']['reply_to'])) {
					if (strpos($messages['Message']['reply_to'], ',') == true) {
						$replyMessId = explode(',', $messages['Message']['reply_to']);
						foreach ($replyMessId as $key => $val) {
							$replyMessage[$key] = $this->Message->find('first', array(
								'conditions' => array('id' => $val),
							));

							$send_user = $this->_getReceiptionUser($replyMessage[$key]['Sender'][0]['sender_user_type']);
							$data = explode('&lt;', $send_user[$replyMessage[$key]['Sender'][0]['creator_id']]);
							$replyMessage[$key]['Reply']['username'] = $data[0];
						}
					} else {
						$replyMessage[] = $this->Message->find('first', array(
								'conditions' => array('id' => $messages['Message']['reply_to'])
						));

						$send_user = $this->_getReceiptionUser($replyMessage[0]['Sender'][0]['sender_user_type']);
						$data = explode('&lt;', $send_user[$replyMessage[0]['Sender'][0]['creator_id']]);
						$replyMessage[0]['Reply']['username'] = $data[0];
					}
				}

			break;
			case 'inbox':
				$messFlg = 'From';

				$mgeReceiver = $this->Receiver->find('first', array(
						'conditions' => array('Receiver.id' => $id),
						'callbacks' => false
					));

				$messages = $this->Message->find('first', array(
					'conditions' => array('id' => $mgeReceiver['Sender']['message_id']),
					'recursive' => -1));

				$replyMessage = array();
				if (!empty($messages['Message']['reply_to'])) {
					if (strpos($messages['Message']['reply_to'], ',') == true) {
						$replyMessId = explode(',', $messages['Message']['reply_to']);
						foreach ($replyMessId as $key => $val) {
							$replyMessage[$key] = $this->Message->find('first', array(
								'conditions' => array('id' => $val),
							));

							$send_user = $this->_getReceiptionUser($replyMessage[$key]['Sender'][0]['sender_user_type']);
							$data = explode('&lt;', $send_user[$replyMessage[$key]['Sender'][0]['creator_id']]);
							$replyMessage[$key]['Reply']['username'] = $data[0];
						}
					} else {
						$replyMessage[] = $this->Message->find('first', array(
								'conditions' => array('id' => $messages['Message']['reply_to'])
						));

						$send_user = $this->_getReceiptionUser($replyMessage[0]['Sender'][0]['sender_user_type']);
						$data = explode('&lt;', $send_user[$replyMessage[0]['Sender'][0]['creator_id']]);
						$replyMessage[0]['Reply']['username'] = $data[0];
					}
				}

				$userInfo = $this->_getReceiptionUser($mgeReceiver['Sender']['sender_user_type']);
				$mgeReceiver['Sender']['reception_mail'] = $userInfo[$mgeReceiver['Sender']['creator_id']];
				$mgeReceiver['Message'] = $messages['Message'];

			break;

		}

		$this->set(compact('mgeDetails', 'mgeReceiver', 'messFlg', 'replyMessage'));
	}

	// Delete message from trash
	public function deleteAllTrashMessages() {
		$this->autoRender = false;
		if ($this->request->is(array('post', 'put'))){
			$date = date('Y-m-d H:i:s');
			if ($this->Trash->updateAll(
				array('Trash.deleted' => 1, 'Trash.deleted_date' => "'".$date."'"),
				array('Trash.id' => $this->request->data['checkbox'])
			)) {
					$this->Session->setFlash('Successfully Deleted', 'success');
					$this->redirect(array('controller' => 'mastermessages', 'action' => 'trashMessage'));
				}
		}
	}

	// Delete message from list of Outbox
	public function deleteAllMessages() {
		$this->autoRender = false;
		if ($this->request->is(array('post', 'put'))){
			$currUserInfo = $this->Auth->user('company_id');
			$date = date('Y-m-d H:i:s');
			if ($this->Sender->updateAll(
				array('Sender.deleted' => 1, 'Sender.deleted_date' => "'".$date."'"),
				array('Sender.id' => $this->request->data['checkbox'])
			)) {
				foreach($this->request->data['checkbox'] as $key => $val) {

					$senderInfo = $this->Sender->find('first', array(
						'conditions' => array('Sender.id' => $val),
						'recursive' => -1,
						'callbacks' => false
					));

					$name = '';
					if ($this->Auth->user('type') == 1) {
						$name = $this->Auth->user('company_name');
					} else {
						$name = $this->Auth->user('headhunter_name');
					}

					$data = array('Trash' => array(
						'trash_mess_id' => (int)$senderInfo['Sender']['id'],
						'message_id' => (int)$senderInfo['Sender']['message_id'],
						'user_type' => $senderInfo['Sender']['sender_user_type'],
						'model_type' => "Sender",
						'trash_user_id' => $this->Auth->user('id'),
						'trash_user_type' => $currUserInfo[0],
						'subject' => $senderInfo['Sender']['subject'],
						'message_body' => $senderInfo['Sender']['message_body'],
						'from_name' => $name,
						'to_name' => $senderInfo['Sender']['name']
					));

					$this->Trash->create();
					$this->Trash->save($data);
				}

				$this->redirect(array('controller' => 'mastermessages', 'action' => 'sentMessage'));
			}
		}
	}

	// Delete message from list of Outbox
	public function deleteAllInboxMessages() {
		$this->autoRender = false;
		if ($this->request->is(array('post', 'put'))){
			$date = date('Y-m-d H:i:s');
			$currUserInfo = $this->Auth->user('company_id');
			if ($this->Receiver->updateAll(
				array('Receiver.deleted' => 1, 'Receiver.deleted_date' => "'".$date."'"),
				array('Receiver.id' => $this->request->data['checkbox'])
			)) {
				foreach($this->request->data['checkbox'] as $key => $val) {

					$receiverInfo = $this->Receiver->find('first', array(
						'conditions' => array('Receiver.id' => $val),
						'recursive' => -1,
						'callbacks' => false
					));

					$senderInfo = $this->Sender->find('first', array(
						'conditions' => array('Sender.id' => $receiverInfo['Receiver']['sender_id']),
						'recursive' => -1,
						'callbacks' => false
					));

					$name = '';
					if ($this->Auth->user('type') == 1) {
						$name = $this->Auth->user('company_name');
					} else {
						$name = $this->Auth->user('headhunter_name');
					}

					$data = array('Trash' => array(
						'trash_mess_id' => (int)$receiverInfo['Receiver']['id'],
						'message_id' => (int)$senderInfo['Sender']['message_id'],
						'user_type' => $receiverInfo['Receiver']['sender_user_type'],
						'model_type' => "Receiver",
						'trash_user_id' => $this->Auth->user('id'),
						'trash_user_type' => $currUserInfo[0],
						'subject' => $receiverInfo['Receiver']['subject'],
						'message_body' => $receiverInfo['Receiver']['message_body'],
						'from_name' => $name,
						'to_name' => $receiverInfo['Receiver']['name']
					));

					$this->Trash->create();
					$this->Trash->save($data);
				}

				$this->redirect(array('controller' => 'mastermessages', 'action' => 'index'));
			}
		}
	}

	public function get_name($id, $type) {

		// get user according to $type.
		switch ($type) {
			case 'A':
					$info = $this->AdminUser->find('list', array(
						'fields' => array('id', 'name'),
						'conditions' => array(
							'id' => $id
						)
					));
				break;

			case 'J':
					$info = $this->User->find('list', array(
						'fields' => array('id', 'name'),
						'conditions' => array(
							'id' => $id
						)
					));
				break;

			case 'C':

					$info = $this->CmpHeadhunter->find('list', array(
						'fields' => array('id', 'company_name'),
						'condition' => array(
							'id' => $id,
							'type' => 0
						)
					));
				break;

			case 'H':
					$info = $this->CmpHeadhunter->find('list', array(
						'fields' => array('id', 'headhunter_name'),
						'condition' => array(
							'id' => $id,
							'type' => 1
						)
					));
				break;
		}

		return $info;

	}
}