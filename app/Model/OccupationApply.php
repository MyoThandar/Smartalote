<?php
class OccupationApply extends AppModel {
	public $belongsTo = array(
		'Occupation',
		'User'
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