<?php

class Trash extends AppModel {

	public $belongsTo = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'message_id'
		),
		'Sender' => array(
			'className' => 'Sender',
			'foreignKey' => 'trash_mess_id',
			'conditions' => array('model_type' => 'Sender')
		),
		'Receiver' => array(
			'className' => 'Receiver',
			'foreignKey' => 'trash_mess_id',
			'conditions' => array('model_type' => 'Receiver')
		)
	);

	public function beforeFind($queryData) {
		$queryData['conditions'][$this->alias.'.deleted'] = 0;
		return $queryData;
	}
}
