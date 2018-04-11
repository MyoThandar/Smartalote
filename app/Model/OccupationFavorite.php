<?php
class OccupationFavorite extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Occupation'
	);
	public $actsAs = array('Search.Searchable', 'Containable');

	public $filterArgs = array(
		'keyword' => array('type' => 'like', 'field' => array(
			'Occupation.job_id',
			'Occupation.job_title',
			'User.name',
			'User.jobseeker_id',
			'User.gender'))
	);

}