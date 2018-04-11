<?php

class UserCoreSkill extends AppModel {
	public $hasMany = array (
		'UserSubCoreSkill'
	);
}