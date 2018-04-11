<?php

class JobCategorie extends AppModel {

	public $hasMany = array (
		'JobCategorieSub'
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