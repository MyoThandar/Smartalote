<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class UserCareerHistory extends AppModel {
	public $recursive = 1;
	public $hasMany = array (
		'UserProject' => array(
			'dependent' => true
		)
		);

}