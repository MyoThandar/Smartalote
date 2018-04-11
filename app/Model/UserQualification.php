<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class UserQualification extends AppModel {

	public $validate = array(
		'qualification_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill qualification name !',
				'required' => true
			)
		),
		'start_year' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill start year !',
				'required' => true
			)
		),
		'start_month' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill start month !',
				'required' => true
			)
		)
	);

}