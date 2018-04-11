<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class UserEducation extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);

	public $validate = array(
		'start_month' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill month !',
				'allowEmpty' => true,
			)
		),
		'start_year' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill year !',
				'allowEmpty' => true,
			)
		),
		'end_month' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill month !',
				'allowEmpty' => true,
			)
		),
		'end_year' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill year !',
				'allowEmpty' => true,
			)
		),
		'university_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill university name !',
				'allowEmpty' => true,
			)
		),
		'major' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill major !',
				'allowEmpty' => true,
			)
		)
	);
}