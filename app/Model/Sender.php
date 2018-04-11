<?php

class Sender extends AppModel {

	public $hasMany = array(
		'Receiver'=> array(
			'className' => 'Receiver',
			'foreignKey' => 'sender_id'
		)
	);

	public $belongsTo = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'message_id'
		),
		'AdminUser' => array(
			'className' => 'AdminUser',
			'foreignKey' => 'creator_id'
		)
	);

	public $actsAs = array('Containable');

	public function beforeFind($queryData) {
		$queryData['conditions'][$this->alias.'.deleted'] = 0;
		return $queryData;
	}
}