<?php

class Receiver extends AppModel {
	public $belongsTo = array(
		'Sender' => array(
			'className' => 'Sender',
			'foreignKey' => 'sender_id',
		)
	);

	public function beforeFind($queryData) {
		$queryData['conditions'][$this->alias.'.deleted'] = 0;
		return $queryData;
	}
}