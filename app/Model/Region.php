<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class Region extends AppModel {
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please fill region name',
				'required' => false
			)
		),
		'home_abroad' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => ' Please choose home and  abroad',
				'required' => false
			)
		)
	);

}