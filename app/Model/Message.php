<?php

class Message extends AppModel {

	public $hasMany = array(
		'Sender'
	);

	/*
	* get id, name, email from cmp_headhunter and user
	* use autocomplete in [to] field of message compose
	*/
	public function getCmpAndUserInfo() {
		$data = $this->query(
			"SELECT id, company_name as `name`, headhunter_name as `headhunter_name`, company_id as 'code', 'C' as 'type' FROM cmp_headhunters WHERE deleted = 0 AND deactivate = 0
			UNION ALL SELECT id, name as `name`, '' as `headhunter_name`, jobseeker_id as 'code', 'J' as 'type' FROM users WHERE deleted = 0 AND activate = 0 AND withdraw = 0"
		);

		return $data;
	}


	/*
	* get id, name, email from cmp_headhunter and user
	* use autocomplete in [to] field of message compose
	*/
	public function getAdminAndUserInfo() {
		$data = $this->query(
			"SELECT id, name, 'admin' as 'jobseeker_id', 'A' as 'type' FROM admin_users WHERE deleted = 0
			UNION ALL SELECT id, name, jobseeker_id, 'J' as 'type' FROM users WHERE deleted = 0 AND activate = 0 AND withdraw = 0"
		);

		return $data;
	}

	// /*
	// * get sender and receiver deleted message
	// */
	// public function getTrashMessage() {
	// 	$data = $this->query(
	// 		"SELECT id, message_id, sender_user_type  FROM sender WHERE deleted = 1
	// 		UNION ALL SELECT id, message_id, '' as 'company_id', email, 'J' as 'type' FROM users WHERE deleted = 0"
	// 	);

	// 	return $data;
	// }
}