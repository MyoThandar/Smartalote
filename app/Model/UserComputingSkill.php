<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class UserComputingSkill extends AppModel {
	 public $validate = array(
		'label' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill label !',
				'allowEmpty' =>false,
			),
		 ),
	);
}