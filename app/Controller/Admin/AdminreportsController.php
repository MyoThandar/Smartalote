<?php

App::uses('AdminAppController', 'Controller');

class AdminReportsController extends AdminAppController {
	public $components = array('OptionCommon');
	public $uses = array('CmpHeadhunter','Occupation','OccupationApply','User','UserEducation','IndustryBig','IndustrySmall','TransactionManager');

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function index() {
		$month = $this->OptionCommon->month;
		$today = date("Y-m-d");
		if (!empty($this->params['pass'][0])) {
			$limit = $this->params['pass'][0] ;
		}else {
			$limit = substr($today, 0,7);
		}
// Summary of the numbers
		$company = $this->calc_company($limit);
		$previous_company = $this->calc_company(date('Y-m', strtotime($limit." -1 month")));
		$headhunter = $this->calc_headhunter($limit);
		$previous_headhunter = $this->calc_headhunter(date('Y-m', strtotime($limit." -1 month")));
		$occupation = $this->calc_occupation($limit);
		$previous_occupation = $this->calc_occupation(date('Y-m', strtotime($limit." -1 month")));
		$customer = $this->calc_customer($limit);
		$previous_customer = $this->calc_customer(date('Y-m', strtotime($limit." -1 month")));
		$scustomer = $this->calc_scustomer($limit);
		$previous_scustomer = $this->calc_scustomer(date('Y-m', strtotime($limit." -1 month")));

//Registered Customers (detail)
		$doctor = $this->calc_doctor($limit);
		$previous_doctor = $this->calc_doctor(date('Y-m', strtotime($limit." -1 month")));
		$MBA = $this->calc_MBA($limit);
		$previous_MBA = $this->calc_MBA(date('Y-m', strtotime($limit." -1 month")));
		$master = $this->calc_master($limit);
		$previous_master = $this->calc_master(date('Y-m', strtotime($limit." -1 month")));
		$bachelor = $this->calc_bachelor($limit);
		$previous_bachelor = $this->calc_bachelor(date('Y-m', strtotime($limit." -1 month")));
		$eduother = $this->calc_eduother($limit);
		$previous_eduother = $this->calc_eduother(date('Y-m', strtotime($limit." -1 month")));

// Registered Job (detail)
		$big = $this->IndustryBig->find('all');
		// debug($big);
		$industry = $this->calc_industry($limit);
		$previous_industry = $this->calc_industry(date('Y-m', strtotime($limit." -1 month")));


		$this->set(compact('month','today','limit','company','headhunter','occupation','customer','scustomer','previous_company','previous_headhunter','previous_occupation','previous_customer','previous_scustomer','doctor','previous_doctor','MBA','previous_MBA','master','previous_master','bachelor','previous_bachelor','highschool','previous_highschool','eduother','previous_eduother','big','industry','previous_industry'));
	}

	private function calc_company($newlimit) {
		$company = $this->CmpHeadhunter->find('list',array( //Registered Companies
			'conditions' => array(
				'CmpHeadhunter.created LIKE' => $newlimit.'%',
				'CmpHeadhunter.type' => 1,
				'not' => array('CmpHeadhunter.deactivate' => 1,
					'CmpHeadhunter.deleted' => 1)
				),
			'fields' => 'created'));

		$company_count = array();
		for ($p=1; $p <=31 ; $p++) {
			$num_length = strlen((string)$p);
			if ($num_length == 1) {
				$p = '0'.$p ;
				$company_count[$p] = 0 ;
			}else{
				$p = (string)$p;
				$company_count[$p] = 0;
			}
		}
		foreach ($company as $key => $value) {
			$val = explode(' ', $value);
			$ex = explode('-', $val[0]);
			$company_count[$ex[2]]++;
		}
		$ctotal_count = 0 ;
		foreach ($company_count as $key => $value) {
			$ctotal_count += $value;
		}
		$company_count['total'] = $ctotal_count;
		return $company_count;
	}

	private function calc_headhunter($newlimit){
		$headhunter = $this->CmpHeadhunter->find('list',array( //Registered Headhunters
			'conditions' => array(
				'CmpHeadhunter.created LIKE' => $newlimit.'%',
				'CmpHeadhunter.type' => 0,
				'not' => array('CmpHeadhunter.deactivate' => 1,'CmpHeadhunter.deleted' => 1)),
			'fields' => 'created'));
		$headhunter_count = array();
		for ($h=1; $h <=31 ; $h++) {
			$num_length = strlen((string)$h);
			if ($num_length == 1) {
				$h = '0'.$h ;
				$headhunter_count[$h] = 0 ;
			}else{
				$h = (string)$h;
				$headhunter_count[$h] = 0;
			}
		}
		foreach ($headhunter as $hhkey => $hhvalue) {
			$hhval = explode(' ', $hhvalue);
			$hhex = explode('-', $hhval[0]);
			$headhunter_count[$hhex[2]]++;
		}
		$htotal_count = 0 ;
		foreach ($headhunter_count as $key => $value) {
			$htotal_count += $value;
		}
		$headhunter_count['total'] = $htotal_count ;
		return $headhunter_count;
	}

	private function calc_occupation($newlimit){
		$occupation = $this->Occupation->find('list',array( //Registered Jobs
			'conditions' => array(
				'Occupation.created LIKE' => $newlimit.'%',
				'not' => array('Occupation.deactivate' => 1 , 'Occupation.deleted' => 1)),
			'fields' => 'created'));
		$occupation_count = array();
		for ($occ=1; $occ <=31 ; $occ++) {
			$num_length = strlen((string)$occ);
			if ($num_length == 1) {
				$occ = '0'.$occ ;
				$occupation_count[$occ] = 0 ;
			}else{
				$occ = (string)$occ;
				$occupation_count[$occ] = 0;
			}
		}
		foreach ($occupation as $occkey => $occvalue) {
			$occval = explode(' ', $occvalue);
			$occex = explode('-', $occval[0]);
			$occupation_count[$occex[2]]++;
		}
		$occtotal_count = 0 ;
		foreach ($occupation_count as $key => $value) {
			$occtotal_count += $value;
		}
		$occupation_count['total'] = $occtotal_count;
		return $occupation_count;
	}

	private function calc_customer($newlimit){
		$customer = $this->User->find('list',array( //Registered Customers
			'conditions' => array(
				'User.created LIKE' => $newlimit.'%',
				'not' => array('User.deleted' => 1, 'User.withdraw' => 1)),
			'fields' => 'created'));
		$customer_count = array();
		for ($cs=1; $cs <=31 ; $cs++) {
			$num_length = strlen((string)$cs);
			if ($num_length == 1) {
				$cs = '0'.$cs ;
				$customer_count[$cs] = 0 ;
			}else{
				$cs = (string)$cs;
				$customer_count[$cs] = 0;
			}
		}
		foreach ($customer as $cskey => $csvalue) {
			$csval = explode(' ', $csvalue);
			$csex = explode('-', $csval[0]);
			$customer_count[$csex[2]]++;
		}
		$custotal_count = 0 ;
		foreach ($customer_count as $key => $value) {
			$custotal_count += $value;
		}
		$customer_count['total'] = $custotal_count;
		return $customer_count;
	}

	private function calc_scustomer($newlimit){
		$successful_customer = $this->OccupationApply->find('list',array( //Successful Customers
			'conditions' => array(
				'OccupationApply.modified LIKE' => $newlimit.'%',
				'OccupationApply.status' => 3),
			'fields' => 'modified'));
		$successful_count = array();
		for ($success=1; $success <=31 ; $success++) {
			$num_length = strlen((string)$success);
			if ($num_length == 1) {
				$success = '0'.$success ;
				$successful_count[$success] = 0 ;
			}else{
				$success = (string)$success;
				$successful_count[$success] = 0;
			}
		}
		foreach ($successful_customer as $successkey => $successvalue) {
			$successval = explode(' ', $successvalue);
			$successex = explode('-', $successval[0]);
			$successful_count[$successex[2]]++;
		}
		$succtotal_count = 0 ;
		foreach ($successful_count as $key => $value) {
			$succtotal_count += $value;
		}
		$successful_count['total'] = $succtotal_count;
		return $successful_count;
	}

	private function calc_doctor($newlimit){
		$edu_doctor = $this->UserEducation->find('list',array( //Registered Customers (Doctor)
			'joins' => array(
				array(
					'alias' => 'User',
					'table' => 'users',
					'foreignKey' => false,
					'conditions' => array(
						'User.id = UserEducation.user_id'
					),
				)
			),
			'conditions' => array(
				'User.withdraw' => 0,
				'User.deleted' => 0,
				'UserEducation.modified LIKE' => $newlimit.'%',
				'UserEducation.degree' => 1),
			'fields' => 'modified'
		));

		if (!empty($edu_doctor)) {
			$doctor_count = array();
			for ($doc=1; $doc <=31 ; $doc++) {
				$num_length = strlen((string)$doc);
				if ($num_length == 1) {
					$doc = '0' . $doc ;
					$doctor_count[$doc] = 0 ;
				}else{
					$doc = (string)$doc;
					$doctor_count[$doc] = 0;
				}
			}
			foreach ($edu_doctor as $dockey => $docvalue) {
				$docval = explode(' ', $docvalue);
				$docex = explode('-', $docval[0]);
				$doctor_count[$docex[2]]++;
			}
			$doctotal_count = 0 ;
			foreach ($doctor_count as $key => $value) {
				$doctotal_count += $value;
			}
			$doctor_count['total'] = $doctotal_count;
			return $doctor_count;
		}
	}

	private function calc_MBA($newlimit){
		$edu_MBA = $this->UserEducation->find('list',array( //Registered Customers (MBA)
			'joins' => array(
				array(
					'alias' => 'User',
					'table' => 'users',
					'conditions' => array(
						'User.id = UserEducation.user_id'
					),
				)
			),
			'conditions' => array(
				'User.withdraw' => 0,
				'User.deleted' => 0,
				'UserEducation.modified LIKE' => $newlimit.'%',
				'UserEducation.degree' => 2),
			'fields' => 'modified'
		));

		if (!empty($edu_MBA)) {
			$MBA_count = array();
			for ($mba=1; $mba <=31 ; $mba++) {
				$num_length = strlen((string)$mba);
				if ($num_length == 1) {
					$mba = '0'.$mba ;
					$MBA_count[$mba] = 0 ;
				}else{
					$mba = (string)$mba;
					$MBA_count[$mba] = 0;
				}
			}
			foreach ($edu_MBA as $mbakey => $mbavalue) {
				$mbaval = explode(' ', $mbavalue);
				$mbaex = explode('-', $mbaval[0]);
				$MBA_count[$mbaex[2]]++;
			}
			$mbatotal_count = 0 ;
			foreach ($MBA_count as $key => $value) {
				$mbatotal_count += $value;
			}
			$MBA_count['total'] = $mbatotal_count;
			return $MBA_count;
		}
	}

	private function calc_master($newlimit){
		$edu_master = $this->UserEducation->find('list',array( //Registered Customers (Master)
			'joins' => array(
				array(
					'alias' => 'User',
					'table' => 'users',
					'conditions' => array(
						'User.id = UserEducation.user_id'
					),
				)
			),
			'conditions' => array(
				'User.withdraw' => 0,
				'User.deleted' => 0,
				'UserEducation.modified LIKE' => $newlimit.'%',
				'UserEducation.degree' => 3),
			'fields' => 'modified'
		));

		if (!empty($edu_master)) {
			$master_count = array();
			for ($master=1; $master <=31 ; $master++) {
				$num_length = strlen((string)$master);
				if ($num_length == 1) {
					$master = '0'.$master ;
					$master_count[$master] = 0 ;
				}else{
					$master = (string)$master;
					$master_count[$master] = 0;
				}
			}
			foreach ($edu_master as $masterkey => $mastervalue) {
				$masterval = explode(' ', $mastervalue);
				$masterex = explode('-', $masterval[0]);
				$master_count[$masterex[2]]++;
			}
			$mastertotal_count = 0 ;
			foreach ($master_count as $key => $value) {
				$mastertotal_count += $value;
			}
			$master_count['total'] = $mastertotal_count;
			return $master_count;
		}
	}

	private function calc_bachelor($newlimit){
		$edu_bachelor = $this->UserEducation->find('list',array( //Registered Customers (Bachelor)
			'joins' => array(
				array(
					'alias' => 'User',
					'table' => 'users',
					'conditions' => array(
						'User.id = UserEducation.user_id'
					),
				)
			),
			'conditions' => array(
				'User.withdraw' => 0,
				'User.deleted' => 0,
				'UserEducation.modified LIKE' => $newlimit.'%',
				'UserEducation.degree' => 4),
			'fields' => 'modified'
		));

		if (!empty($edu_bachelor)) {
			$bachelor_count = array();
			for ($bac=1; $bac <=31 ; $bac++) {
				$num_length = strlen((string)$bac);
				if ($num_length == 1) {
					$bac = '0'.$bac ;
					$bachelor_count[$bac] = 0 ;
				}else{
					$bac = (string)$bac;
					$bachelor_count[$bac] = 0;
				}
			}
			foreach ($edu_bachelor as $backey => $bacvalue) {
				$bacval = explode(' ', $bacvalue);
				$bacex = explode('-', $bacval[0]);
				$bachelor_count[$bacex[2]]++;
			}
			$bactotal_count = 0 ;
			foreach ($bachelor_count as $key => $value) {
				$bactotal_count += $value;
			}
			$bachelor_count['total'] = $bactotal_count;
			return $bachelor_count;
		}
	}

	private function calc_eduother($newlimit){
		$edu_other = $this->UserEducation->find('list',array( //Registered Customers (Others)
			'joins' => array(
				array(
					'alias' => 'User',
					'table' => 'users',
					'conditions' => array(
						'User.id = UserEducation.user_id'
					),
				)
			),
			'conditions' => array(
				'User.withdraw' => 0,
				'User.deleted' => 0,
				'UserEducation.modified LIKE' => $newlimit.'%',
				'UserEducation.degree' => 5),
			'fields' => 'modified'
		));

		if (!empty($edu_other)) {
			$other_count = array();
			for ($other=1; $other <=31 ; $other++) {
				$num_length = strlen((string)$other);
				if ($num_length == 1) {
					$other = '0'.$other ;
					$other_count[$other] = 0 ;
				}else{
					$other = (string)$other;
					$other_count[$other] = 0;
				}
			}
			foreach ($edu_other as $otherkey => $othervalue) {
				$otherval = explode(' ', $othervalue);
				$otherex = explode('-', $otherval[0]);
				$other_count[$otherex[2]]++;
			}
			$othertotal_count = 0 ;
			foreach ($other_count as $key => $value) {
				$othertotal_count += $value;
			}
			$other_count['total'] = $othertotal_count;
			return $other_count;
		}
	}

	private function calc_industry($newlimit){ //Registered Job (detail)
		/*debug($newlimit);*/
		$job = $this->Occupation->find('all',array(
				'conditions' => array(
					'Occupation.created LIKE' => $newlimit.'%',
					// 'Occupation.type' => 1,
					'not'=>array('Occupation.deactivate' => 1,'Occupation.deleted' => 1),
				),
				'fields' =>array(
					'Occupation.created','Occupation.industry_small_id')
			));
		/*debug($job);*/
		$small_id = array();
		foreach ($job as $key => $value) {
			$small_id[$value['Occupation']['id']] = $value['Occupation']['industry_small_id'];
		}

		$industry = $this->IndustrySmall->find('list', array(
					'conditions' => array(
						'IndustrySmall.id' => $small_id),
					'fields' => array(
						'IndustrySmall.id'
					)
				)
			);

		$industry_tmp = array();

		foreach ($industry as $key => $invalue) {
			$count = array();
			for ($in=1; $in <=31 ; $in++) {
				$num_length = strlen((string)$in);
				if ($num_length == 1) {
					$in = '0'.$in ;
					$count[$in] = 0 ;
				}else{
					$in = (string)$in;
					$count[$in] = 0;
				}
			} //empty array

			foreach ($job as $jobkey => $jobvalue) {
				if ($jobvalue['Occupation']['industry_small_id'] == $invalue ) {
					$otherval = explode(' ', $jobvalue['Occupation']['created']);
					$otherex = explode('-', $otherval[0]);
					$count[$otherex[2]]++;
				}
			}
			$total = 0 ;
			foreach ($count as $countkey => $countvalue) {
				$total += $countvalue;
			}
			$count['total'] = $total;

			$industry_tmp[$invalue] = $count;
		}
		return $industry_tmp;
	}
}