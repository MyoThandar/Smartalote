<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class Pickup extends AppModel {

	public $validate = array(
		'company_name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill company name',
				'required' => true,
			)
		),
		'company_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'This company name is already picked up !',
				'required' => false,
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This company name is already picked up !',
			)
		),
		'day' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please choose start day',
				'required' => true,
			)
		),
		'month' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please choose start month !',
				'required' => true,
			)
		),
		'year' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please choose start year !',
				'required' => true,
			)
		),
		'term' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please choose allowed term for company !',
				'required' => true,
			)
		)
	);

}