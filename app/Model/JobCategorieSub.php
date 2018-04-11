<?php

class JobCategorieSub extends AppModel {

	public $belongsTo = array(
		'JobCategorie' => array(
			'className' => 'JobCategorie',
			'foreignKey' => 'job_category_id'
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