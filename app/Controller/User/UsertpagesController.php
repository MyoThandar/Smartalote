<?php
App::uses('UserAppController', 'Controller');
class UsertpagesController extends UserAppController {
	public $components = array('OptionCommon');
	public $uses = array('Occupation','CmpHeadhunter','JobCategorie','IndustryBig','OccupationApply','OccupationFavorite','Region','User','Pickup','Region','IndustrySmall','HeadhunterOtherLanguage','TransactionManager');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'usertopic';
		$this->Auth->allow('company_add','headhunter_add');
	}

	public function index() {
		//Get salaryRange from optioncommon
		$salary_range = $this->OptionCommon->salary_range;
		$user_id = $this->Auth->user('id');

		//for show latest job according to date
		$date = date("Y-m-d h:i:sa");
		$show_job_date = date('Y-m-d', strtotime($date. ' - 14 days'));

		//for select data job category
		$job_category = $this->JobCategorie->find('list', array(
			'fields' =>array('id', 'label'),
			'conditions' => array('JobCategorie.deleted' =>0)
			)
		);

		$industry = $this->IndustryBig->find('list', array(
			'fields' => array('id', 'label'),
			'conditions' => array('IndustryBig.deleted' => 0)
			)
		);

		$region = $this->Region->find('list', array(
			'fields' => array('id', 'name'),
			'conditions' => array('Region.deleted' => 0)
		));

		$job_lists = $this->Occupation->find('all', array(
			'conditions' => array(
				'Occupation.deactivate' => 0,
				'Occupation.deleted' => 0
			),
			'order' => array('Occupation.created' => 'DESC'),
		));

		foreach ($job_lists as $key => $val) {
			if (!empty($val['CmpHeadhunter']['logo'])) {
				if (!file_exists(WWW_ROOT . DS . 'img' . DS . $val['CmpHeadhunter']['logo'])) {
					$job_lists[$key]['CmpHeadhunter']['logo'] = 'common_photo.jpg';
				}
			} else {
				$job_lists[$key]['CmpHeadhunter']['logo'] = 'common_photo.jpg';
			}
		}


		$industry_id = array_keys($industry);
		$job_category_id = array_keys($job_category);
		$region_id = array_keys($region);

		// counting for industry
		$countIndustry =$this->Occupation->find('all', array(
			'fields' => array('COUNT(*) as count', 'industry_big_id'),
			'order' => array('COUNT(*) DESC'),
			'group' => array('Occupation.industry_big_id'),
			'recursive' =>-1,
			'conditions' => array(
				'Occupation.industry_big_id' => $industry_id,
				'Occupation.deactivate' => 0,
				'Occupation.deleted' => 0
			)
		));

		// counting for job category
		$countJobcategory =$this->Occupation->find('all', array(
			'fields' => array('COUNT(*) as count','job_category_id'),
			'order' => array('COUNT(*) DESC'),
			'group' => array('Occupation.job_category_id'),
			'recursive' =>-1,
			'conditions' => array(
				'Occupation.job_category_id' => $job_category_id ,
				'Occupation.deactivate' => 0,
				'Occupation.deleted' => 0
			)
		));

		// counting for region
		$countRegion =$this->Occupation->find('all', array(
			'fields' => array('COUNT(*) as count','location_small_id'),
			'order' => array('COUNT(*) DESC'),
			'group' => array('Occupation.location_small_id'),
			'recursive' =>-1,
			'conditions' => array(
				'Occupation.location_small_id' => $region_id,
				'Occupation.deactivate' => 0,
				'Occupation.deleted' => 0
			)
		));

		//for job_count
		if (!empty($alljob_show)) {
			$job_count = count($alljob_show);
		}
		// Picked up companies
		$picked_company = $this->Pickup->find('list',array(
			'conditions' => array(
				'Pickup.start_date <= ' => date('Y-m-d '),
				'Pickup.end_date >= ' => date('Y-m-d ')
				),
			'fields' => 'Pickup.company_id'
			)
		);

		// Logo list of picked up companies
		$company_logo = $this->CmpHeadhunter->find('list',array(
			'conditions' => array(
				'CmpHeadhunter.company_id' => $picked_company
				),
			'fields' => 'CmpHeadhunter.id, CmpHeadhunter.logo'
			)
		);

		foreach ($company_logo as $key => $val) {
			if (!file_exists(WWW_ROOT . DS . 'img' . DS . $val)) {
				$company_logo[$key] = 'common_photo.jpg';
			}
		}

		$this->set(compact(
			'user_id', 'job_lists', 'salary_range',
			'job_category', 'industry', 'region',
			'countIndustry', 'countJobcategory', 'countRegion',
			'company_logo'
		));

	}

	public function job_search() {

		$this->layout = 'user_new';
		//Get login userid
		$user_id = $this->Auth->user('id');

		//Get loginuserId of cv
		$userCV = $this->User->find('first',
			array('conditions' => array('User.id' => $user_id),
				'fields' => 'User.cv',
				'recursive' => -1
				));
		$cv = (!empty($userCV['User']['cv'])) ? $userCV['User']['cv'] : '';

		//Get location,salary_range fron optioncommon
		$salary_range = $this->OptionCommon->salary_range;

		//pagination limit
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 20;

		$job_category = $this->JobCategorie->find('list', array(
			'fields' => array('label'),
			'conditions' => array('JobCategorie.deleted' => 0)
			)
		);

		$industry = $this->IndustryBig->find('list', array(
			'fields' =>array('label'),
			'conditions' => array('IndustryBig.deleted' => 0)
			)
		);

		//get region for search
		$region = $this->Region->find('list', array(
			'fields' => array('name'),
			'conditions' => array('Region.deleted' => 0)
			)
		);

		// Picked up companies
		$picked_company = $this->Pickup->find('list',array(
			'conditions' => array(
				'Pickup.start_date <= ' => date('Y-m-d '),
				'Pickup.end_date >= ' => date('Y-m-d ')
				),
			'fields' => 'Pickup.company_id'
			)
		);

		// Logo list of picked up companies
		$company_logo = $this->CmpHeadhunter->find('list',array(
			'conditions' => array(
				'CmpHeadhunter.company_id' => $picked_company
				),
			'fields' => 'CmpHeadhunter.id, CmpHeadhunter.logo'
			)
		);

		foreach ($company_logo as $key => $val) {
			if (!file_exists(WWW_ROOT . DS . 'img' . DS . $val)) {
				$company_logo[$key] = 'common_photo.jpg';
			}
		}

		$this->Prg->commonProcess();
		$req = $this->passedArgs;

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'DESC'),
			'conditions' => array(
				$this->Occupation->parseCriteria($req),
				'Occupation.deleted' => 0,
				'Occupation.deactivate' => 0
			)
		);

		$job_lists = $this->paginate('Occupation');

		foreach ($job_lists as $key => $val) {
			if (!empty($val['CmpHeadhunter']['logo'])) {
				if (!file_exists(WWW_ROOT . DS . 'img' . DS . $val['CmpHeadhunter']['logo'])) {
					$job_lists[$key]['CmpHeadhunter']['logo'] = 'common_photo.jpg';
				}
			} else {
				$job_lists[$key]['CmpHeadhunter']['logo'] = 'common_photo.jpg';
			}
		}

		//all applied occupations by login user
		$appliedOccuaptions = $this->OccupationApply->find('list',array(
			'conditions' => array('OccupationApply.user_id' => $user_id),
			'fields' => array('OccupationApply.occupation_id')
			));

		//all saved occupations by login user
		$savedOccuaptions = $this->OccupationFavorite->find('list',array(
			'conditions' => array('OccupationFavorite.user_id' => $user_id),
			'fields' => array('OccupationFavorite.occupation_id')
			));

		$this->set(compact('job_lists','job_category','salary_range', 'industry', 'appliedOccuaptions', 'savedOccuaptions','region','company_logo', 'user_id','limit'));

	}

	public function top_com_info($id=null) {
		$this->layout = 'user_new';
		$user_id = $this->Auth->user('id');
		$salary_range = $this->OptionCommon->salary_range;

		//get language,language_skill, employee,education from optioncomon
		$language = $this->OptionCommon->language;
		$language_skill = $this->OptionCommon->language_skill;
		$employee = $this->OptionCommon->employee;
		$education = $this->OptionCommon->education;

		//get company or headhunter informations
		$cmpInfo = $this->CmpHeadhunter->find('all',array(
			'conditions' => array(
				'CmpHeadhunter.id' => $id)
			));


		//get region
		$regions = $this->Region->find('list', array(
			'fields' => array('name'),
			'conditions' => array('Region.deleted' => 0)
			)
		);

		//get IndustryBig
		$IndustryBig = $this->IndustryBig->find('list',array(
			'fields' => array('IndustryBig.id','IndustryBig.label')
			));

		//get IndustrySmall
		$IndustrySmall = $this->IndustrySmall->find('list',array(
			'fields' => array('IndustrySmall.id','IndustrySmall.label')
			));

		//Get other language headhunter of occupation
		$headhunterlanguages = $this->HeadhunterOtherLanguage->find('all',array(
			'conditions' => array(
				'HeadhunterOtherLanguage.cmp_headhunter_id' => $id
				),
			'recursive' => -1
			));
// debug($id);
		$joblist = $this->Occupation->find('all', array(
			'conditions' => array(
				'Occupation.ch_id' => $id,
				'Occupation.deactivate' => 0
			),
			'order' => array('Occupation.created' => 'DESC')
		));
// debug($joblist);

		$this->set(compact('cmpInfo','regions','IndustryBig','IndustrySmall','employee','education','language','headhunterlanguages','language_skill','user_id','joblist','salary_range'));

	}

	public function company_add() { //company register from usersite
		$this->layout = 'user_new';

		$location_list = $this->Region->find('all',array(
			'fields' => 'name'));

		foreach ($location_list as $lockey => $locvalue) {
			$location[$lockey+1] = $locvalue['Region']['name'];
		}

		$employee= $this->OptionCommon->employee;

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
			));

		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
			));

		$error = false;

		$this->set(compact('location','employee','big_industry','small_industry','error'));

		if ($this->request->is(array('post', 'put'))) {

			try {
				$transaction = $this->TransactionManager->begin();

				// validate the upload file.
				if (!empty($this->request->data['CmpHeadhunter']['logo']['name'])) {
					$tmpName = $this->request->data['CmpHeadhunter']['logo']['tmp_name'];
					$name = $this->request->data['CmpHeadhunter']['logo']['name'];
					unset($this->request->data['CmpHeadhunter']['logo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['CmpHeadhunter']['logo'] = $name;


				} elseif (array_key_exists('image', $this->request->data['CmpHeadhunter'])) {

					$name = $this->request->data['CmpHeadhunter']['image'];
					unset($this->request->data['CmpHeadhunter']['logo']);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				}

				$lastcompanyID = $this->CmpHeadhunter->find('first',array('conditions' => array('type' => 1), 'order' => array('id' => 'DESC'),'fields' => 'company_id'));


				if (!empty($lastcompanyID['CmpHeadhunter']['company_id'])) {

					$temp = substr($lastcompanyID['CmpHeadhunter']['company_id'], 2);
					$num = $temp+1;
					$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);

				} else {
					$num = 1;
					$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);

				}

				$prefix = 'CO';
				$UserCode = $prefix.$CompanyID;

				$this->request->data['CmpHeadhunter']['company_id'] = $UserCode;

				$this->request->data['CmpHeadhunter']['deactivate'] = 1;

				$this->request->data['CmpHeadhunter']['type'] = 1;

				// save to the database.
				$this->CmpHeadhunter->create();

				if (!$this->CmpHeadhunter->saveAssociated($this->request->data, array('deep' => true))) {
					$this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				$email = $this->request->data['CmpHeadhunter']['email'];

					error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

					$mainEmail = 'admin@smartalote.net';


					$subject = "【SmartAlote】 Notice For New Company Account Registration";

					$body = "Company ID : ".$UserCode."\n\n".
					"Company Name : " .$this->request->data['CmpHeadhunter']['company_name']."\n\n".
					"Contact person name : ".$this->request->data['CmpHeadhunter']['contact_name']."\n\n".
					" Email : ".$this->request->data['CmpHeadhunter']['email']."\n\n".
					" Phone Number : " .$this->request->data['CmpHeadhunter']['company_phone']."\n\n".
					"http://192.168.33.34/master/logout";

					$headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
					$admin = mail($mainEmail, $subject, $body, $headers);

				// ================================================

					$responseSubject = "【SmartAlote】 Registration application receipt and future procedures";

					$responseBody = "This mail has been sent automatically from SmartAlote.\n\n".

					"Thank you so much for applying for SmartAlote company / headhunter registration. Separately, you will be informed about procedures to start using SmartAlote Recruiter Portal.\n\n".

					"Currently SmartAlote has been well received by many job seekers, companies and head hunters, and it may take several days for the SmartAlote team to contact you. Please await for next contact from us.\n\n\n\n".

					"【Procedures】 \n\n".
					"1.Submission of Registration request form : DONE\n".
					"2. Registered E-mail address confirmation : DONE\n".
					"3. Guidance of Terms & Conditions from SmartAlote team\n".
					"4. Activation of your ID & Password\n".
					"5. Start usage of SmartAlote Recruiter’s Portal\n\n\n\n".
					"* Customers who do not remember this email\n".
					"It is possible that other person mistakenly entered your email address and \n".
					"the email was erroneously delivered. Sorry to trouble you, but please disregard this mail.\n\n".
					"------------------------------------\n\n".
					"SmartAlote\n".
					"http://smartalote.com\n".
					"------------------------------------"
					;

					$responseHeaders = 'From: ' .' <'.$mainEmail.'>' . "\r\n" . 'Reply-To: ' . $mainEmail;
					$user = mail($email, $responseSubject, $responseBody, $responseHeaders);

					$this->TransactionManager->commit($transaction);
					$this->redirect(array('controller'=>'usertpages','action' => 'employer_success'));


			} catch (Exception $e) {

				$image = $this->request->data['CmpHeadhunter']['logo'];
				$this->set(compact('text','image'));

				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
			}
		}

	}

	public function headhunter_add() { //company register from usersite
		$this->layout = 'user_new';
		$company = '' ;

		if (!empty($this->request->data['CmpHeadhunter']['company_name'])) {
			$company = $this->request->data['CmpHeadhunter']['company_name'];
		}

		$location_list = $this->Region->find('all',array(
			'fields' => 'name'));


		foreach ($location_list as $lockey => $locvalue) {
			$location[$lockey+1] = $locvalue['Region']['name'];
		}

		$education = $this->OptionCommon->education;

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
			$industry1 = $this->request->data['CmpHeadhunter']['industry_big'];
		}

		$this->set(compact('company','location','education','big_industry','industry1'));

		if ($this->request->is(array('post', 'put'))) {

			$lastcompanyID = $this->CmpHeadhunter->find('first',array('conditions' => array('type' => 0), 'order' => array('id' => 'DESC'),'fields' => 'company_id'));

			if (!empty($lastcompanyID['CmpHeadhunter']['company_id'])) {
				$temp = substr($lastcompanyID['CmpHeadhunter']['company_id'], 2);
				$num = $temp+1;
				$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);

			} else {
				$num = 1;
				$CompanyID = str_pad($num, 6, '0', STR_PAD_LEFT);

			}
			$prefix = 'HH';
			$UserCode = $prefix.$CompanyID;

			$this->request->data['CmpHeadhunter']['company_id'] = $UserCode;

			$this->request->data['CmpHeadhunter']['type'] = 0;

			$this->request->data['CmpHeadhunter']['deactivate'] = 1;

			try {
				$transaction = $this->TransactionManager->begin();

				// validate the upload file.
				if (!empty($this->request->data['CmpHeadhunter']['logo']['name'])) {
					$tmpName = $this->request->data['CmpHeadhunter']['logo']['tmp_name'];
					$name = $this->request->data['CmpHeadhunter']['logo']['name'];
					unset($this->request->data['CmpHeadhunter']['logo']);

					move_uploaded_file($tmpName, WWW_ROOT . '/img/' . $name);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				} elseif (array_key_exists('image', $this->request->data['CmpHeadhunter'])) {
					$name = $this->request->data['CmpHeadhunter']['image'];
					unset($this->request->data['CmpHeadhunter']['logo']);
					$this->request->data['CmpHeadhunter']['logo'] = $name;

				}

				$industry_str = '' ;

				if (!empty($this->request->data['CmpHeadhunter']['industry_big'])) {
					foreach ($this->request->data['CmpHeadhunter']['industry_big'] as $bigkey => $bigvalue) {
						$industry_str .= $bigvalue . ',';
					}
				}
				if (!empty($this->request->data)) {
					$bigarr = $this->request->data['CmpHeadhunter']['industry_big'];
				}

				$this->request->data['CmpHeadhunter']['industry_big'] = $industry_str ;

				$invalidFields = array('representative_postion','representative_name','contact_position','contact_name','number_of_employee');

				foreach ($invalidFields as $invalidFieldskey => $invalidFieldsvalue) {

					$this->CmpHeadhunter->validator()->remove($invalidFieldsvalue);

				}

				$this->CmpHeadhunter->create();

				if (!$this->CmpHeadhunter->saveAssociated($this->request->data, array('deep' => true))) {
					$this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD Tag');
				}

				//will send mail to your registered email
				$email = $this->request->data['CmpHeadhunter']['email'];

					error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

					$mainEmail = 'admin@smartalote.net';


					$subject = "【SmartAlote】 Notice For New Headhunter Account Registration";

					$body = "Company ID : ".$UserCode."\n\n".
					"Headhunter Name : " .$this->request->data['CmpHeadhunter']['headhunter_name']."\n\n".
					" Email : ".$this->request->data['CmpHeadhunter']['email']."\n\n".
					" Phone Number : " .$this->request->data['CmpHeadhunter']['company_phone']."\n\n".
					"http://192.168.33.34/master/logout";

					$headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
					mail($mainEmail, $subject, $body, $headers);

					$responseSubject = "【SmartAlote】 Registration application receipt and future procedures";

					$responseBody = "This mail has been sent automatically from SmartAlote.\n\n".

					"Thank you so much for applying for SmartAlote company / headhunter registration. Separately, you will be informed about procedures to start using SmartAlote Recruiter Portal.\n\n".

					"Currently SmartAlote has been well received by many job seekers, companies and head hunters, and it may take several days for the SmartAlote team to contact you. Please await for next contact from us.\n\n\n\n".

					"【Procedures】 \n\n".
					"1. Submission of Registration request form : DONE\n".
					"2. Registered E-mail address confirmation : DONE\n".
					"3. Guidance of Terms & Conditions from SmartAlote team\n".
					"4. Activation of your ID & Password\n".
					"5. Start usage of SmartAlote Recruiter’s Portal\n\n\n\n".
					"* Customers who do not remember this email\n".
					"It is possible that other person mistakenly entered your email address and \n".
					"the email was erroneously delivered. Sorry to trouble you, but please disregard this mail.\n\n".
					"------------------------------------\n\n".
					"SmartAlote\n".
					"http://smartalote.com\n".
					"------------------------------------\n"
					;

					$headers = 'From: ' .' <'.$mainEmail.'>' . "\r\n" . 'Reply-To: ' . $mainEmail;
					$user = mail($email, $responseSubject, $responseBody, $headers);

					$this->TransactionManager->commit($transaction);
					$this->redirect(array('controller'=>'usertpages','action' => 'employer_success'));

			} catch (Exception $e) {

				$this->request->data['CmpHeadhunter']['industry_big'] = $bigarr;
				$image = $this->request->data['CmpHeadhunter']['logo'];
				$requestData = $this->request->data;

				if (empty($this->request->data['CmpHeadhunter']['company_name'])) {
					$company = 'empty' ;
				}

				$this->set(compact('image', 'requestData','company', 'industry1'));

				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}

		}
	}

	public function employer_success() {
		$this->layout = 'user_new';
	}
}