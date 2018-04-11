<?php
class Occupation extends AppModel {
	public $hasMany = array(
		'OccupationApply',
		'OccupationFavorite'
	);

	public $actsAs = array('Search.Searchable', 'Containable');

	public $filterArgs = array(
		'keyword' => array('type' => 'like', 'field' => array('job_title','job_id')),
		'location_small_id' => array('type' => 'value'),
		'industry_big_id' => array('type' => 'value'),
		'industry_small_id' => array('type' => 'value'),
		'job_category_id' => array('type' => 'value'),
		'job_category_sub_id' => array('type' => 'value'),
		'salary_range' => array('type' => 'value'),
	);

	public $belongsTo = array(
		'CmpHeadhunter' => array(
			'className' => 'CmpHeadhunter',
			'foreignKey' => 'ch_id'
		),
		'SubHeadhunter' => array(
			'className' => 'SubHeadhunter',
			'foreignKey' => 'sub_headhunter_id'),
		'IndustryBig' => array(
			'className' => 'IndustryBig',
			'foreignKey' => 'industry_big_id'
			),
		'IndustrySmall' => array(
			'className' => 'IndustrySmall',
			'foreignKey' => 'industry_small_id'
			),
		'JobCategorie' => array(
			'className' => 'JobCategorie',
			'foreignKey' => 'job_category_id'
		),
		'JobCategorieSub' => array(
			'className' => 'JobCategorieSub',
			'foreignKey' => 'job_category_sub_id'
		),
		'Region' => array(
			'className' => 'Region',
			'foreignKey' => 'location_small_id'
		)
	);

	public $validate = array(
		'job_title' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill job title  !',
				'required' => true
				),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Your job title must be less than 100 words !',
			)
		),
		'responsibility' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill responsibility !',
				'allowEmpty' => true
				),
			'maxLength' => array(
				'rule' => array('maxLength', 3000),
				'message' => 'Your job Responsibility must be less than 3,000 words !',
				)
			),
		'requirements' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill requirements !',
				'allowEmpty' => true
				),
			'maxLength' => array(
				'rule' => array('maxLength', 3000),
				'message' => 'Your job Requirements must be less than 3,000 words !',
				)
			),
		'industry_big_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please select big industry name !',
				'allowEmpty' => false
				)
			),
		'industry_small_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please select small industry name !',
				'allowEmpty' => false
				)
			),
		'job_category_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please select big job category name !',
				'allowEmpty' => false
				)
			),
		'job_category_sub_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please select job sub category name !',
				'allowEmpty' => false
				)
			)
		);
}