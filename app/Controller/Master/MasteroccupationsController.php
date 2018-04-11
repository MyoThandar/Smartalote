<?php
App::uses('MasterAppController', 'Controller');
// Import CakePdf
App::uses('CakePdf', 'CakePdf.Pdf');
class MasteroccupationsController extends MasterAppController {
	public $components = array('OptionCommon');
	public $uses = array('Region','Occupation','CmpHeadhunter','User','UserEducation','UserQualification','UserLanguageSkill','UserCareerHistory','UserComputingSkill','UserSpecialInstruction','UserCoreSkill','IndustryBig','IndustrySmall','JobCategorie','JobCategorieSub','OccupationApply','OccupationFavorite','HeadhunterOtherLanguage','SubHeadhunter','TransactionManager','Message');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'master';
	}

	public function index(){
		$user = $this->Auth->user('id');

		/* logined user is Headhunter or not ? */
		$cmp_id = $this->CmpHeadhunter->find('list', array(
			'conditions' => array(
				'CmpHeadhunter.id' =>$user
				),
			'fields' => array('company_id'),
		));
		foreach ($cmp_id as $key => $value) {
			$result = substr($value, 0,2);
		}
		if (!empty($result)) {
			if ($result == 'HH') { // if logined user is headhunter
				$cmp_id = $this->CmpHeadhunter->find('list', array(
					'conditions' => array(
						'CmpHeadhunter.id' =>$user,
						'CmpHeadhunter.deactivate' => 0,
						'CmpHeadhunter.deleted' => 0
					),
					'fields' => array('company_id'),
				));
			}
		}


		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';

		$fav = array(); //User list of favorite to this job
		$app = array(); //User list of applied to this job

		/* Occupation of logined user */
		$occid = $this->Occupation->find('all',array(
			'conditions' => array(
				'Occupation.cmp_headhunter_id' => $cmp_id,
				'Occupation.deleted' => 0
			),
			'fields' => 'id'));

		/* User list of favorite and applied to this job */
		foreach ($occid as $ckey => $cvalue) {
			$like = $this->OccupationFavorite->find('all',array(
				'conditions' => array(
					'OccupationFavorite.occupation_id' => $cvalue['Occupation']['id'] )));
			$applied = $this->OccupationApply->find('all',array(
				'conditions' => array(
					'OccupationApply.occupation_id' => $cvalue['Occupation']['id'] )));
			$applied_count= 0 ;
			$like_count= 0 ;
			foreach ($like as $likekey => $likevalue) {
				$like_count++ ;
			}
			foreach ($applied as $appliedkey => $appliedvalue) {
				$applied_count++ ;
			}
			$fav[$cvalue['Occupation']['id']] = $like_count;
			$app[$cvalue['Occupation']['id']] = $applied_count;
		}

		// Searching by Job ID
		$this->Occupation->virtualFields['cojob_id'] = 'CONCAT(Occupation.cmp_headhunter_id, "-", Occupation.job_id)';

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'DESC'),
			'conditions' => array(
				array(
					'Occupation.cmp_headhunter_id ' => $cmp_id,
					'Occupation.deleted ' => 0
				),
				'OR' => array(
					array('Occupation.cojob_id LIKE' => '%'.$keyword.'%'),
					array('Occupation.job_title LIKE' => '%'.$keyword.'%'),
					array('Occupation.job_id LIKE' => '%'.$keyword.'%'),
					array('Occupation.cmp_headhunter_id LIKE' => '%'.$keyword.'%'),
					array('Occupation.number_of_keep LIKE' => '%'.$keyword.'%'),
					array('Occupation.number_of_applicant LIKE' => '%'.$keyword.'%'),
				)
			)
		);

		$pag = $this->paginate('Occupation');
		$this->set(compact('pag','limit','fav','app'));
	}

/* deactivate and activate for occupations */
	public function approved($id = null) {
		$approved = $this->Occupation->findById($id);
		$this->Occupation->id = $id;
		if ($approved['Occupation']['deactivate'] == true) {
			$this->Occupation->saveField('deactivate', '0');
		} else {
			if (!$this->Occupation->save(array('Occupation' => array('deactivate' => 1, 'deactivate_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				throw new Exception('ERROR COULD NOT STOP OCCUPATION DATA');
			}
		}
		$this->redirect( array('action' => 'index'));
	}
/* deactivate and activate for occupations */

/* delete for occupations */
	public function delete($id = null) {
		try {
			$transaction = $this->TransactionManager->begin();
			if (empty($id)) {
				throw new Exception('ERROR OCCUPATION ID NOT EXISTS');
			}
			$this->Occupation->id = $id;
			if (!$this->Occupation->exists()) {
				throw new Exception('ERROR OCCUPATION DATA NOT EXISTS');
			}
			if (!$this->Occupation->save(array('Occupation' => array('deleted' => 1, 'deleted_date' => date('Y-m-d H:i:s'))), array('validate' => false))) {
				 throw new Exception('ERROR COULD NOT DELETE OCCUPATION DATA');
			}
			$this->TransactionManager->commit($transaction);
		} catch (Exception $e) {
			$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
			$this->log($e->getMessage(), LOG_ERR);
			$this->TransactionManager->rollback($transaction);
			$this->redirect(array('action' => 'index'));
		}
		$this->redirect(array('action' => 'index'));
	}
/* delete for occupations */

/* registration for occupations */
	public function add() {
		$user = $this->Auth->user();
		$salary_range = $this->OptionCommon->salary_range;
		$no_of_employee = $this->OptionCommon->employee;
		$education = $this->OptionCommon->education;
		$language_skill = $this->OptionCommon->headhunter_language_skill;
		$main_language_skill = $this->OptionCommon->language_skill;
		$language = $this->OptionCommon->language;
		$no_of_employee = $this->OptionCommon->employee;
		$datas = array();
		$small_location= $this->Region->find('list', array(
			'fields' => array('Region.id', 'Region.name', 'Region.home_abroad'),
			'order' => array('Region.id' => 'ASC')
		));

		// Auto complement of companies
		$company = $this->SubHeadhunter->find('all',array(
			'conditions' => array(
				'SubHeadhunter.company_id' => $user['company_id']
			)
		));

		$company_list = $this->SubHeadhunter->find('list',array(
			'conditions' => array(
				'SubHeadhunter.company_id' => $user['company_id']
			),
			'fields' => array('id','company_name')
		));

		$com_list = array();
		$i = 0;
		foreach ($company_list as $key => $value) {

			if ($value != null) {
				if (!empty($value)) {
					if (strlen($value) > 50) {
						$com_list[$key] = mb_substr($value,0,50,'UTF-8') . "...";
					} else {
						$com_list[$key] = $value;
					}
				}
			}
		}

		/* Latest job id */
		$prefix = $user['company_id'] ;

		$lastjobID = $this->Occupation->find('list',array(
			'conditions' => array(
				'Occupation.cmp_headhunter_id' => $user['company_id']
			),
			'order' => array('Occupation.id' => 'ASC'),
			'fields' => 'job_id'
		));

		// for ch_id for useroccupation
		$lastcompanyID = $this->CmpHeadhunter->find('first',array( 'order' => array('id' => 'DESC'),'fields' => 'id'));

		if (!empty($lastjobID)) {
			$lastjobID = end($lastjobID);
			$temp = substr($lastjobID, 2) ;
			$num = $lastjobID + 1 ;
			$jobID = str_pad($num, 4, '0', STR_PAD_LEFT) ;
		} else {
			$num = 1;
			$jobID = str_pad($num, 4, '0', STR_PAD_LEFT);
		}
		$UserCode = $prefix . '-' . $jobID;

		/* Small industry list */
		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
		));

		/* Big industry list */
		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
			));

		/* Small jobcategory list */
		$small_jobcategory = $this->JobCategorieSub->find('list', array(
			'fields' => array('JobCategorieSub.id', 'JobCategorieSub.label', 'JobCategorieSub.job_category_id'),
			'order' => array('JobCategorieSub.job_category_id' => 'ASC')
			));

		/* Big jobcategory list */
		$big_jobcategory = $this->JobCategorie->find('list', array(
			'fields' => array('JobCategorie.id', 'JobCategorie.label'),
			'order' => array('JobCategorie.id' => 'ASC')
			));

		/* Region of company/headhunter */
		$company_region = $this->Region->findById($user['region']);

		/* Industries of company */
		$small = $user['industry_small'];
		$industry_data = $this->IndustrySmall->findById($small);

		/* Industries of headhunter */
		$big_data = rtrim($user['industry_big'],",");
		$big_code = explode(',', $big_data);

		$industries = array();
		foreach ($big_code as $codekey => $codevalue) {
			if (!empty($big_industry[$codevalue])) {
				$industries[$codevalue] = $big_industry[$codevalue] ;
			}
		}

		/* Education of Headhunter */
		$edu = '' ;
		if (!empty($user['education'])) {
			$edu = $education[$user['education']] ;
		}

		/* Language skills of Headhunter */
		if (!empty($user['burmese_level'])) {
			$bskill = $main_language_skill[$user['burmese_level']] ;
		}
		if (!empty($user['english_level'])) {
			$eskill = $main_language_skill[$user['english_level']] ;
		}
		if (!empty($user['chinese_level'])) {
			$cskill = $main_language_skill[$user['chinese_level']] ;
		}
		if (!empty($user['japanese_level'])) {
			$jskill = $main_language_skill[$user['japanese_level']] ;
		}

		/* Other Language skills of Headhunter */
		$other_skills = $this->HeadhunterOtherLanguage->find('all',array(
			'conditions' => array(
				'HeadhunterOtherLanguage.cmp_headhunter_id' => $user['id']
			)
		));

		$language_key = array() ;
		foreach ($other_skills as $skill_key => $skill_value) {
			$language_key[$skill_value['HeadhunterOtherLanguage']['lang_type']] = $skill_value['HeadhunterOtherLanguage']['lang_skill'];
		}

		// region list for selected company info
		$region = $this->Region->find('list',array('fields' => array('id' ,'name')));

		$error = false ;

		$this->set(compact('salary_range','small_industry','big_industry','small_jobcategory','big_jobcategory','error','user','UserCode','prefix','small_location','company_region','no_of_employee','industry_data','edu','industries','bskill','eskill','cskill','jskill','language','language_skill','language_key','company','company_list','com_list','user','datas','region','no_of_employee','main_language_skill'));

		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();

				$locationError = false;
				$image = false;
				$error = false;
				$aryExt = array('jpg','jpeg','gif','png');

				// data validate and nomalize.
				for ($i=1; $i < 4; $i++) {

					// normalize.
					if (!empty($this->request->data['Occupation']['image' . $i]['name'])) {
						$file = $this->request->data['Occupation']['image' . $i];
						$image = true;
					} elseif (
						array_key_exists('logo' . $i, $this->request->data['Occupation']) &&
						!empty($this->request->data['Occupation']['logo' . $i])
					) {
						$file['name'] = $this->request->data['Occupation']['logo' . $i];
						$image = true;
					} else {
						$this->request->data['Occupation']['image' . $i] = '';
						$image = false;
					}

					// validation.
					if ($image === true) {
						$this->request->data['Occupation']['image' . $i] = $file['name'];

						$imageExtension = substr(strtolower(strrchr($file['name'], '.')), 1);
						if (!in_array($imageExtension, $aryExt)) {
							$error = true;
							$errors['image' . $i][0] = 'Invalid file type. Please choose picture only.';
						} else {
							if (array_key_exists('tmp_name', $file)) {
								move_uploaded_file($file['tmp_name'], WWW_ROOT . '/img/' . $file['name']);
							}
						}
					}
				}

				if ($error === true) {
					// company's info when validation error occurrs
					if (!empty($this->request->data['Occupation']['sub_headhunter_id'])) {
						$datas = $this->SubHeadhunter->findById($this->request->data['Occupation']['sub_headhunter_id']);
					}

					$this->__convertToValidationErrors($errors);
					throw new Exception('Invalid file type.');
				}

				$j = 1;
				for ($i=1; $i < 4; $i++) {
					if (!empty($this->request->data['Occupation']['image' . $i])) {
						$temp = $this->request->data['Occupation']['image' . $i];
						$this->request->data['Occupation']['image' . $i] = '';
						$this->request->data['Occupation']['image' . $j] = $temp;
						$j++;
					}
				}

				if (!empty($this->request->data['Occupation']['location_small_id'])) {
					$this->Region->id = $this->request->data['Occupation']['location_small_id'] ;
				}

				$this->request->data['Occupation']['cmp_headhunter_id'] = $user['company_id'] ;
				$this->request->data['Occupation']['job_id'] = $jobID ;
				$this->request->data['Occupation']['ch_id'] = $user['id'];

				if (!$this->Occupation->save($this->request->data)) {
					throw new Exception('ERROR COULD NOT ADD Tag');
				}
				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$requestData = $this->request->data;
				$this->set(compact('requestData', 'error','datas'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}
		}
	}

// autocomplement selected
	public function ajaxTest() {
		$employee = $this->OptionCommon->employee;
		$this->autoRender = FALSE;

		if ($this->request->is('ajax')) {

			if ($this->data['id']) {
				$companyInfo = $this->SubHeadhunter->findById($this->data['id']);

				if ($companyInfo['SubHeadhunter']['number_of_employee']) {
					$companyInfo['SubHeadhunter']['number_of_employee'] = $employee[$companyInfo['SubHeadhunter']['number_of_employee']];
				}

				if ($companyInfo['SubHeadhunter']['industry_small_id']) {
					$industry_small = $this->IndustrySmall->findById($companyInfo['SubHeadhunter']['industry_small_id']);

					$industry = $industry_small['IndustrySmall']['label'] . ' / ' . $industry_small['IndustryBig']['label'];
					$companyInfo['SubHeadhunter']['industry'] = $industry;
				} else {
					$companyInfo['SubHeadhunter']['industry'] = '';
				}

				if ($companyInfo['SubHeadhunter']['region']) {
					$region = $this->Region->findById($companyInfo['SubHeadhunter']['region']);
					$companyInfo['SubHeadhunter']['region'] = $region['Region']['name'];
				}

				if ($companyInfo['SubHeadhunter']['overview']) {
					$companyInfo['SubHeadhunter']['overview'] = nl2br($companyInfo['SubHeadhunter']['overview']);
				}

				return json_encode($companyInfo);
			}
		}
	}

/* Editing for occupations */
	public function edit($id = null) {
		$error = true;
		$user = $this->Auth->user();
		$salary_range = $this->OptionCommon->salary_range;
		$no_of_employee = $this->OptionCommon->employee;

		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action' => 'index'));
		}
		// $this->Occupation->recursive = -1;

		$datas = $this->Occupation->findById($id);

		// Auto complement of companies
		$company = $this->SubHeadhunter->find('all',array(
			'conditions' => array(
				'SubHeadhunter.company_id' => $user['company_id']
			)
		));

		$company_list = $this->SubHeadhunter->find('list',array(
			'conditions' => array(
				'SubHeadhunter.company_id' => $user['company_id']
			),
			'fields' => array('id','company_name')
		));

		$com_list = array();
		$i = 0;
		foreach ($company_list as $key => $value) {
			if ($value != null) {
				if (!empty($value)) {
					if (strlen($value) > 50) {
						$com_list[$key] = mb_substr($value,0,50,'UTF-8') . "...";
					} else {
						$com_list[$key] = $value;
					}
				}
			}
		}

		/* favorite occupations list */
		$fav = $this->OccupationFavorite->find('all',array(
			'conditions' => array(
				'occupation_id' => $id)));

		/* applied occupations list */
		$app = $this->OccupationApply->find('all',array(
			'conditions' => array(
				'occupation_id' => $id)));

		$region = $this->Region->find('list',array('fields' => array('id' ,'name')));

		if (!$this->request->data) {
			$this->request->data = $datas;
		}

		// for occupation data of preview to be filled automactically in the edit form when the user clicks the back button of the preview page
		if ($this->Session->check('back_to_edit')) {
			$this->request->data = $this->Session->read('back_to_edit');
			$back_data = $this->request->data;
			$this->Session->delete('back_to_edit');
		}

		$small_location= $this->Region->find('list', array(
			'fields' => array('Region.id', 'Region.name', 'Region.home_abroad'),
			'order' => array('Region.id' => 'ASC')
		));

		$small_industry = $this->IndustrySmall->find('list', array(
			'fields' => array('IndustrySmall.id', 'IndustrySmall.label', 'IndustrySmall.industry_big_id'),
			'order' => array('IndustrySmall.industry_big_id' => 'ASC')
		));

		$big_industry = $this->IndustryBig->find('list', array(
			'fields' => array('IndustryBig.id', 'IndustryBig.label'),
			'order' => array('IndustryBig.id' => 'ASC')
		));

		$small_jobcategory = $this->JobCategorieSub->find('list', array(
			'fields' => array('JobCategorieSub.id', 'JobCategorieSub.label', 'JobCategorieSub.job_category_id'),
			'order' => array('JobCategorieSub.job_category_id' => 'ASC')
		));

		$big_jobcategory = $this->JobCategorie->find('list', array(
			'fields' => array('JobCategorie.id', 'JobCategorie.label'),
			'order' => array('JobCategorie.id' => 'ASC')
		));

		$company_name = $this->CmpHeadhunter->find('list', array('fields'=>array('CmpHeadhunter.company_name' ),
			'conditions' => array('CmpHeadhunter.company_id' => $datas['Occupation']['cmp_headhunter_id'])
		));

		$this->set(compact('big_industry','small_industry','small_jobcategory','big_jobcategory','datas','salary_range','company_name','small_location','fav','app','user','back_data', 'error','com_list','no_of_employee','region'));

		$img = array() ;
		if ($this->request->is(array('post', 'put'))) {
			try {
				$transaction = $this->TransactionManager->begin();

				$requestData = $this->request->data;

				$error = false;
				$image = false;
				$aryExt = array('jpg','jpeg','gif','png');

				// data validate and nomalize.
				for ($i=1; $i < 4; $i++) {
					if (
						!empty($requestData['Occupation']['removed' . $i]) &&
						empty($requestData['Occupation']['image' . $i]['name'])
					) {
						$requestData['Occupation']['image' . $i] = '';
						$requestData['Occupation']['image_origin' . $i] = '';

						continue;
					}

					if (
						array_key_exists('name', $requestData['Occupation']['image' . $i]) &&
						!empty($requestData['Occupation']['image' . $i]['name'])
					) {
						$file = $requestData['Occupation']['image' . $i];
						$image = true;

					} elseif (!empty($requestData['Occupation']['image_origin' . $i])) {
						$file['name'] = $requestData['Occupation']['image_origin' . $i];
						$requestData['Occupation']['image' . $i] = $file['name'];
						$image = true;

					} else {
						$requestData['Occupation']['image' . $i] = '';
						$image = false;
					}

					// validation.
					if ($image === true) {
						$requestData['Occupation']['image' . $i] = $file['name'];

						$imageExtension = substr(strtolower(strrchr($file['name'], '.')), 1);
						if (!in_array($imageExtension, $aryExt)) {
							$error = true;
							$errors['image' . $i][0] = 'Invalid file type. Please choose picture only.';
						} else {
							if (array_key_exists('tmp_name', $file)) {
								move_uploaded_file($file['tmp_name'], WWW_ROOT . '/img/' . $file['name']);
							}
						}
					}
				}

				if ($error === true) {
					// company's info when validation error occurrs
					if (!empty($this->request->data['Occupation']['sub_headhunter_id'])) {
						$tmp_data =$this->SubHeadhunter->findById($this->request->data['Occupation']['sub_headhunter_id']);
						$datas['SubHeadhunter'] = $tmp_data['SubHeadhunter'];
					}
					$this->__convertToValidationErrors($errors);
					throw new Exception('Invalid file type.');
				}
				// for the data refilled by the user to be shown in the preview page
				// check if the user click the preview button
				if (isset($_POST['preview'])) {
					// save new data inside session
					$this->Session->write('preview_data', $this->request->data);
					$this->redirect(array('action' => 'preview'));
				}

				$j = 1;
				for ($i=1; $i < 4; $i++) {
					if (!empty($requestData['Occupation']['image' . $i])) {
						$temp = $requestData['Occupation']['image' . $i];
						$requestData['Occupation']['image' . $i] = '';
						$requestData['Occupation']['image' . $j] = $temp;
						$j++;
					}
				}

				$requestData['Occupation']['modified'] = date('Y-m-d h:i:s');
				if (!$this->Occupation->save($requestData)) {
					$this->set('error', 'true');
					throw new Exception('ERROR COULD NOT ADD Tag');
				}
				$this->TransactionManager->commit($transaction);
				$this->redirect(array('action' => 'index'));

			} catch (Exception $e) {
				$this->set(compact('requestData', 'error','datas'));
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->TransactionManager->rollback($transaction);
				return;
			}
		}
	}
/* Editing for occupations */

/* preview for occupations */
	public function preview() {
		$user = $this->Auth->user();
		$salary_range = $this->OptionCommon->salary_range;
		$no_of_employee = $this->OptionCommon->employee;

		/* Get new occupation data filled by user */
		$datas = $this->Session->read('preview_data');

		/* Get company informations */
		if (!empty($datas['Occupation']['sub_headhunter_id'])) {
			$subheadhunterInfo =$this->SubHeadhunter->findById($datas['Occupation']['sub_headhunter_id']);
		}

		$editData = $datas['Occupation'];
		/* all favorite occupation informations */
		$fav = $this->OccupationFavorite->find('all',array(
			'conditions' => array(
				'OccupationFavorite.occupation_id' => $datas['Occupation']['id'])));

		/* all applied occupation informations */
		$app = $this->OccupationApply->find('all',array(
			'conditions' => array(
				'OccupationApply.occupation_id' => $datas['Occupation']['id'])));

		/* all region informations */
		$region = $this->Region->find('list',array('fields' => array('id' ,'name')));

		/* company informations */
		if (!empty($subheadhunterInfo['SubHeadhunter']['industry_small_id'])) {
			$industry_data = $this->IndustrySmall->findById($subheadhunterInfo['SubHeadhunter']['industry_small_id']);
		}

		$job_category_id = $datas['Occupation']['job_category_id']; //job category id
		$job_category_sub_id = $datas['Occupation']['job_category_sub_id']; //job sub category id

		/* all job category name */
		$job_category_name = $this->JobCategorie->find('list', array('fields'=>array('JobCategorie.label' ),
			'conditions' => array('JobCategorie.id' => $job_category_id)
			));

		/* all sub job category name */
		$job_category_sub_name = $this->JobCategorieSub->find('list', array('fields'=>array('JobCategorieSub.label' ),
			'conditions' => array('JobCategorieSub.id' => $job_category_sub_id)
			));

		$this->set(compact('datas','industry_data','job_category_name','job_category_sub_name','salary_range','region','fav','app','user', 'editData','subheadhunterInfo','no_of_employee'));

		/* For images changed for preview to be shown in the edit page */

		if ($this->request->is('post')) {
			/* Save button is clicked */
			if (isset($_POST['save'])) {

				if ($this->request->is(array('post', 'put'))) {
					try {
						$transaction = $this->TransactionManager->begin();
						for ($i=1; $i < 4; $i++) {
							if (!empty($datas['Occupation']['removed'.$i])) {
								if ($datas['Occupation']['image'.$i]['name'] != '') {
									$img = $datas['Occupation']['image'.$i]['name'];
									unset($datas['Occupation']['image'.$i]);
									$datas['Occupation']['image'.$i] = $img;
								} else {
									$datas['Occupation']['image'.$i] = '' ;
								}
							} else {
								if ($datas['Occupation']['image'.$i]['name'] != '') {
									$img = $datas['Occupation']['image'.$i]['name'];
									unset($datas['Occupation']['image'.$i]);
									$datas['Occupation']['image'.$i] = $img;
								} else {
									unset($datas['Occupation']['image'.$i]);
									$datas['Occupation']['image'.$i] = $datas['Occupation']['image_origin'.$i];
								}
							}
						}
						$datas['Occupation']['modified'] = date('Y-m-d h:i:s');
						if (!$this->Occupation->save($datas)) {
							$this->set('error', 'true');
							throw new Exception('ERROR COULD NOT EDIT');
						}
						$this->TransactionManager->commit($transaction);
					} catch (Exception $e) {
						$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
						$this->log($e->getMessage(), LOG_ERR);
						$this->TransactionManager->rollback($transaction);
						return;
					}
					$this->redirect(array('action' => 'index'));
				}
			} else {
				for ($i=1; $i < 4; $i++) {
					if (!empty($datas['Occupation']['removed'.$i])) {
						if ($datas['Occupation']['image'.$i]['name'] != '') {
							$img = $datas['Occupation']['image'.$i]['name'];
							unset($datas['Occupation']['image'.$i]);
							$datas['Occupation']['image'.$i] = $img;
						} else {
							$datas['Occupation']['image'.$i] = '' ;
						}
					} else {
						if ($datas['Occupation']['image'.$i]['name'] != '') {
							$img = $datas['Occupation']['image'.$i]['name'];
							unset($datas['Occupation']['image'.$i]);
							$datas['Occupation']['image'.$i] = $img;
						} else {
							unset($datas['Occupation']['image'.$i]);
							$datas['Occupation']['image'.$i] = $datas['Occupation']['image_origin'.$i];
						}
					}
				}

				/* Get company informations */
				if (!empty($datas['Occupation']['sub_headhunter_id'])) {
					$subheadhunterInfo =$this->SubHeadhunter->findById($datas['Occupation']['sub_headhunter_id']);
					$datas['SubHeadhunter'] = $subheadhunterInfo['SubHeadhunter'];
				}

				// For new data filled by user to be shown, when the user clicks the back button
				$this->Session->write('back_to_edit', $datas);
				$this->redirect(array('action' => 'edit', $datas['Occupation']['id']));
			}
		}
	}
/* preview for occupations */

/* three images remove in occupation editing */
	public function imageremove($id = null) {
		$img = $this->params['named']['value'];
		$image = $this->Occupation->findById($id);
		$this->Occupation->id = $id;
		if (!empty($image['Occupation'][$img])){
			$this->Occupation->saveField($img, null);
		}
		$this->redirect($this->referer());
	}
/* three images remove in occupation editing */

/* List of jobseekers who put favorite to this job */
	public function keeper($id = null) {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';
		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'DESC'),
			'conditions' => array(
				'OccupationFavorite.occupation_id' => $id)
		);
		$pag = $this->paginate('OccupationFavorite');
		$this->set(compact('pag','limit'));
	}
/* List of jobseekers who put favorite to this job */

/* Detail informations of jobseeker who put favorite to this job */
	public function keeperBrowse($id = null) {
		// Getting the commonly used informations of carrer-change period, final-education and language-skill, written in OptionCommonComponent
		$nation = $this->OptionCommon->nationality ;
		$marital_status = $this->OptionCommon->marital_status ;
		$religion = $this->OptionCommon->religion ;
		$language_skill = $this->OptionCommon->language_skill ;
		$ms_skill = $this->OptionCommon->ms_skill_level ;
		$salary = $this->OptionCommon->salary_range ;
		$availability = $this->OptionCommon->availability ;
		$edu = $this->OptionCommon->education ;

		// Extending the association-level for using all of user's informations
		$this->OccupationFavorite->recursive = 2;

		// Getting the total informations of user
		// $application_info = $this->OccupationFavorite->findById($id);

		$occ = $this->OccupationFavorite->findByUser_id($id);

		$userdata = $this->User->findByid($occ['OccupationFavorite']['user_id']); //User personal info

		$user_language = $this->UserLanguageSkill->find('all', array(
			'conditions' => array(
				'UserLanguageSkill.user_id' => $occ['OccupationFavorite']['user_id']),
			'fields' => array('skill','certificate')
		));

		$user_edu = $this->UserEducation->find('all', array(
			'conditions' => array(
				'UserEducation.user_id' => $occ['OccupationFavorite']['user_id']),
			'fields' => array(
				'university_name','department','degree','enrollment','graduation','remarks')
		));

		$user_career = $this->UserCareerHistory->find('all',array(
			'conditions' => array(
				'UserCareerHistory.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		$user_computing = $this->UserComputingSkill->find('all',array(
			'conditions' => array(
				'UserComputingSkill.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		$user_qualification = $this->UserQualification->find('all',array(
			'conditions' => array(
				'UserQualification.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		$user_instruction = $this->UserSpecialInstruction->find('all',array(
			'conditions' => array(
				'UserSpecialInstruction.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		$user_core = $this->UserCoreSkill->find('all',array(
			'conditions' => array(
				'UserCoreSkill.user_id' => $occ['OccupationFavorite']['user_id'])
			));

		// Getting the total industries for determination which industries are included in user's information
		$industryb = $this->IndustryBig->find('list',array(
			'fields' => 'IndustryBig.label'));
		$industrys = $this->IndustrySmall->find('list',array(
			'fields' => 'IndustrySmall.label'));

		// Getting the total job-categories for determination which job-categories are included in user's information
		$categoryb = $this->JobCategorie->find('list',array(
			'fields' => 'JobCategorie.label'));
		$categorys = $this->JobCategorieSub->find('list',array(
			'fields' => 'JobCategorieSub.label'));

		// Jobseeker's location
		$location = $this->Region->find('list',array(
			'fields' => array('id','name')
			)
		);

		// Company informations
		$company_info = $this->CmpHeadhunter->findByCompany_id($occ['Occupation']['cmp_headhunter_id']);

		// Sending the user-information and others for display
		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','industryb','industrys','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill','occ','location','company_info'));
		}
/* Detail informations of jobseeker who put favorite to this job */

/* List of jobseekers who applied to this job */
	public function applicant($id = null) {
		$limit = (!empty($this->params->query['limit'])) ? $this->params->query['limit'] : 50;
		$keyword = (!empty($this->params->query['keyword'])) ? trim($this->params->query['keyword']) : '';

		$this->paginate = array(
			'paramType' => 'querystring',
			'limit' => $limit,
			'order' => array('id' => 'DESC'),
			'conditions' => array(
				'OccupationApply.occupation_id' => $id)
		);

		$pag = $this->paginate('OccupationApply');

		$this->set(compact('pag','limit'));
	}

/* Detail informations of jobseeker who applied to this job */
	public function applicantBrowse($id = null) {
		// For showing error message and the other page instead of requested page because the ID is not provided
		if (!$id) {
			$this->Session->setFlash('Enter user ID', "error");
			$this->redirect(array('action' => 'index'));
		}

		// Getting the commonly used informations of carrer-change period, final-education and language-skill, written in OptionCommonComponent
		$nation = $this->OptionCommon->nationality ;
		$marital_status = $this->OptionCommon->marital_status ;
		$religion = $this->OptionCommon->religion ;
		$language_skill = $this->OptionCommon->language_skill ;
		$ms_skill = $this->OptionCommon->ms_skill_level ;
		$salary = $this->OptionCommon->salary_range ;
		$availability = $this->OptionCommon->availability ;
		$edu = $this->OptionCommon->education ;

		// Extending the association-level for using all of user's informations
		$this->OccupationApply->recursive = 2;

		$occ = $this->OccupationApply->findByid($id);

		$userdata = $this->User->findByid($occ['OccupationApply']['user_id']); //User personal info

		$user_language = $this->UserLanguageSkill->find('all', array(
			'conditions' => array(
				'UserLanguageSkill.user_id' => $occ['OccupationApply']['user_id']),
			'fields' => array('skill','certificate')
		));

		$user_edu = $this->UserEducation->find('all', array(
			'conditions' => array(
				'UserEducation.user_id' => $occ['OccupationApply']['user_id']),
			'fields' => array(
				'university_name','department','degree','enrollment','graduation','remarks')
		));

		$user_career = $this->UserCareerHistory->find('all',array(
			'conditions' => array(
				'UserCareerHistory.user_id' => $occ['OccupationApply']['user_id'])
			));

		$user_computing = $this->UserComputingSkill->find('all',array(
			'conditions' => array(
				'UserComputingSkill.user_id' => $occ['OccupationApply']['user_id'])
			));

		$user_qualification = $this->UserQualification->find('all',array(
			'conditions' => array(
				'UserQualification.user_id' => $occ['OccupationApply']['user_id'])
			));

		$user_instruction = $this->UserSpecialInstruction->find('all',array(
			'conditions' => array(
				'UserSpecialInstruction.user_id' => $occ['OccupationApply']['user_id'])
			));

		$user_core = $this->UserCoreSkill->find('all',array(
			'conditions' => array(
				'UserCoreSkill.user_id' => $occ['OccupationApply']['user_id'])
			));

		// Getting the total industries for determination which industries are included in user's information
		$industryb = $this->IndustryBig->find('list',array(
			'fields' => 'IndustryBig.label'));
		$industrys = $this->IndustrySmall->find('list',array(
			'fields' => 'IndustrySmall.label'));

		//Job's Region
		$region = $this->Region->findById($occ['Occupation']['location_small_id']);
		if ($region) {
			$job_region = $region['Region']['name'];
		}

		// Getting the total job-categories for determination which job-categories are included in user's information
		$categoryb = $this->JobCategorie->find('list',array(
			'fields' => 'JobCategorie.label'));
		$categorys = $this->JobCategorieSub->find('list',array(
			'fields' => 'JobCategorieSub.label'));

		// Company informations
		$company_info = $this->CmpHeadhunter->findById($occ['OccupationApply']['cmp_headhunter_id']);

		// Sending the user-information and others for display
		$this->set(compact('userdata','user_edu','user_quli','user_language','user_career','user_computing','ms_skill','user_qualification','user_instruction','user_core','salary','availability','industryb','industrys','categoryb','categorys','edu','carrer_change','language','nation','marital_status','religion','language_skill','occ','company_info','job_region')
		);
	}

/* Job Detail informations */
	public function browse($id) {
		$user = $this->Auth->user();
		$salary = $this->OptionCommon->salary_range;
		$no_of_employee = $this->OptionCommon->employee;
		$salary_range = '';
		$regionname = '' ;

		if (!$id) {
			$this->Session->setFlash('Enter company ID。', "error");
			$this->redirect(array('action' => 'index'));
		}
		$occdata = $this->Occupation->findByid($id);

		$reg = $this->Region->findByid($occdata['SubHeadhunter']['region']);
		if (!empty($reg)) {
			$regionname = $reg['Region']['name'];
		}

		$industry_data = $this->IndustrySmall->findById($occdata['SubHeadhunter']['industry_small_id']);

		$cmp = $this->CmpHeadhunter->find('all',array(
			'conditions' => array (
				'company_id' => $occdata['Occupation']['cmp_headhunter_id'])));

		if ($cmp[0]['CmpHeadhunter']['type'] == 0) {
			$cmp_name = $cmp[0]['CmpHeadhunter']['headhunter_name'] ;
		} elseif ($cmp[0]['CmpHeadhunter']['type'] == 1) {
			$cmp_name = $cmp[0]['CmpHeadhunter']['company_name'] ;
		}
		if ($occdata['Occupation']['salary_range']) {
			$salary_range = $salary[$occdata['Occupation']['salary_range']];
		}

		$region_id=$occdata['Occupation']['location_small_id'];
		$this->Region->id = $region_id;
		$region_name = $this->Region->field('name');
		$job = $this->JobCategorieSub->findById($occdata['Occupation']['job_category_sub_id']);
		$industry = $this->IndustrySmall->findById($occdata['Occupation']['industry_small_id']);

		$fav = array();
		$app = array();
		$like = $this->OccupationFavorite->find('all',array(
			'conditions' => array(
				'OccupationFavorite.occupation_id' => $id)));
		$applied = $this->OccupationApply->find('all',array(
			'conditions' => array(
				'OccupationApply.occupation_id' => $id )));
		$applied_count= 0 ;
		$like_count= 0 ;
		foreach ($like as $likekey => $likevalue) {
			$like_count++ ;
		}
		foreach ($applied as $appliedkey => $appliedvalue) {
			$applied_count++ ;
		}

		$this->set(compact('occdata','region_name','job','cmp_name','industry','salary_range','like_count','applied_count','user','regionname','industry_data','no_of_employee'));
	}

	private function __convertToValidationErrors($errors) {
		foreach ($errors as $key => $val) {
			$this->Occupation->validationErrors[$key] = $val;
		}
	}

	// save the state if the user's contact has been viewed.
	public function contact_viewed() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$this->OccupationApply->id = $this->request->data['id'];
			if ($this->OccupationApply->saveField('status', '5')) {
				return true;
			}
		}
	}

	// save the state if the user has contacted.
	public function mark_contacted() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$this->OccupationApply->id = $this->request->data['id'];
			if ($this->OccupationApply->saveField('status', '2')) {
				return true;
			}
		}
	}

	// save the state if the user has been adopted.
	// public function adoption() {
	// 	$this->autoRender = false;
	// 	if ($this->request->is('ajax')) {
	// 		$this->OccupationApply->id = $this->request->data['id'];
	// 		if ($this->OccupationApply->saveField('status', '3')) {
	// 			return true;
	// 		}
	// 	}
	// }

	// save the state if the user has been adopted.
	public function adoption() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			//adopted status and date
			$adopted_info = array(
				'id' => $this->request->data['id'],
				'status' => 3,
				'adopted_date' => date('Y-m-d'));

			if ($this->OccupationApply->saveAll($adopted_info)) {
				return true;
			}
		}
	}

	// save the state if the user has been refused.
	public function not_adopted() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$this->OccupationApply->id = $this->request->data['id'];
			if ($this->OccupationApply->saveField('status', '4')) {
				return true;
			}
		}
	}

	public function contact() {
		$this->autoRender = false;

		if ($this->request->is('post')) {

			// get current logged in user type
			$loggedInUserType = $this->Auth->user('company_id');
			$loggedInUserType = $loggedInUserType[0];

			$data = array();

			// initial data for insert to messages table
			$data['Message']['subject'] = $this->request->data['Message']['subject'];
			$data['Message']['message_body'] = nl2br($this->request->data['Message']['message_body']);
			$data['Message']['label'] = $loggedInUserType;

			$data['Sender'][0]['to'] = $this->request->data['Message']['to'];
			$data['Sender'][0]['from'] = $this->Auth->user('email');
			$data['Sender'][0]['creator_id'] = $this->Auth->user('id');
			$data['Sender'][0]['sender_user_type'] = $loggedInUserType;
			$data['Sender'][0]['name'] = $this->request->data['Message']['name'];
			$data['Sender'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['Message_body'] = nl2br($this->request->data['Message']['message_body']);

			// initial data for insert to receiver table
			$data['Sender'][0]['Receiver'][0]['recipient_id'] = $this->request->data['Message']['user_id'];
			$data['Sender'][0]['Receiver'][0]['receiver_user_type'] = 'J';
			$data['Sender'][0]['Receiver'][0]['sender_user_type'] = $loggedInUserType;
			$data['Sender'][0]['Receiver'][0]['name'] = ($this->Auth->user('type') == 1) ? $this->Auth->user('company_name') : $this->Auth->user('headhunter_name');
			$data['Sender'][0]['Receiver'][0]['subject'] = $this->request->data['Message']['subject'];
			$data['Sender'][0]['Receiver'][0]['Message_body'] = nl2br($this->request->data['Message']['message_body']);


			switch ($this->Auth->user('mail_limit')) {
				case 1:
					$mail_limit = 10;
					break;
				case 2:
					$mail_limit = 30;
					break;
				case 3:
					$mail_limit = 50;
					break;
				case 4:
					$mail_limit = 100;
					break;
				case 5:
					$mail_limit = 200;
					break;
				default:
					break;
			}

			$cmpHeadHunterData = $this->CmpHeadhunter->findById($this->Auth->user('id'));
			$mail_limit = $cmpHeadHunterData['CmpHeadhunter']['total_mail'];
			$sent_mail = $cmpHeadHunterData['CmpHeadhunter']['sent_mail'];

			if (!empty($mail_limit)) {
				$total_mail_count = (int)$mail_limit;
				$sent_mail_count  = $sent_mail + 1;
				$avaliable_mail_count  = $total_mail_count - $sent_mail_count;
			}

			$cmpData = array('CmpHeadhunter' => array(
				'total_mail' => $total_mail_count,
				'sent_mail'  => $sent_mail_count,
				'avaliable_mail' => $avaliable_mail_count
			));

			try {

				$transaction = $this->TransactionManager->begin();

				if (!$this->Message->saveAssociated($data, array('deep' => true))) {
					throw new Exception('ERROR COULD NOT SENT THE MESSAGE');
				}

				$this->OccupationApply->id = $this->request->data['Message']['occupation_id'];
				if (!$this->OccupationApply->saveField('status', '2')) {
					throw new Exception('ERROR COULD CHANGE OCCUPATION APPLY STATUS');
				}

				$this->CmpHeadhunter->id = $this->Auth->user('id');
				if (!$this->CmpHeadhunter->save($cmpData, array('validate' => false))) {
					throw new Exception('ERROR COULD CHANGE CmpHeadhunter');
				}

				$this->TransactionManager->commit($transaction);
				$this->Session->setFlash('Message has been sent', 'success');
				$this->redirect(array('controller' => 'masteroccupations', 'action' => 'applicantBrowse', $this->request->data['Message']['occupation_id']));

			} catch (Exception $e) {
				$this->log('File : ' . $e->getFile() . ' Line : ' . $e->getLine(), LOG_ERR);
				$this->log($e->getMessage(), LOG_ERR);
				$this->Session->setFlash('message couldn\'t sent', 'error');
				$this->TransactionManager->rollback($transaction);
			}

		}
	}
}