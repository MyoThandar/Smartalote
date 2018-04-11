<?php

class MasterKeepUser extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);
	public $actsAs = array('Search.Searchable', 'Containable');

	public $filterArgs = array(
		'keyword' => array('type' => 'like', 'field' => array(
			'User.name',
			'User.jobseeker_id',
			'User.gender'
		))
	);
}