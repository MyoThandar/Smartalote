<?php

class IndustrySmall extends AppModel {

	public $belongsTo = array(
		'IndustryBig' => array(
			'className' => 'IndustryBig',
			'foreignKey' => 'industry_big_id'
		)
	);

	public $validate = array(
		'label' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill label',
				'required' => true,
			)
		)
	);

	public function beforeFind($queryData) {
		$queryData['conditions'][$this->alias.'.deleted'] = 0;
		return $queryData;
	}
}