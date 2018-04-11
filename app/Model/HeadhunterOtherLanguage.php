<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class HeadhunterOtherLanguage extends AppModel {
	var $belongsTo = array(
		'CmpHeadhunter' => array(
			'className' => 'CmpHeadhunter'
			)
		);
}