<div class="x_panel">
	<div class="x_title">
		<h2>Jobseeker Browse</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table class="table-st">
			<tr>
				<td colspan="3" class="labelbg">
					<div class="col-md-10 col-sm-10 col-xs-12">
						<?php echo "<label class='main-label'>Job overview</label>"; ?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="x_content">
		<table class="table-st">
			<!-- Jobseeker overview -->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<p>Job ID</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php echo $occ['Occupation']['job_id']; ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
						<section>
							<div class = "sectionTitle">
								<p>Job title</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php echo $occ['Occupation']['job_title']; ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
						<section>
							<div class = "sectionTitle">
								<p>Company/Headhunter ID</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php echo $occ['Occupation']['cmp_headhunter_id']; ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
						<section>
							<div class = "sectionTitle">
								<p>Company/Headhunter Name</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php if (!empty($company_info['CmpHeadhunter']['company_name'])) : ?>
											<?php echo $company_info['CmpHeadhunter']['company_name']; ?>
										<?php else : ?>
											<?php echo $company_info['CmpHeadhunter']['headhunter_name']; ?>
										<?php endif; ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
						<section>
							<div class = "sectionTitle">
								<p>Location</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php if (!empty($job_region)) : ?>
											<?php echo $job_region; ?>
										<?php endif; ?>
										<br/><?php echo $occ['Occupation']['location_big_id']; ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
						<section>
							<div class = "sectionTitle">
								<p>Job Category</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php echo $categoryb[ $occ['Occupation']['job_category_id']].' / '.$categorys[ $occ['Occupation']['job_category_sub_id']] ; ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
						<section>
							<div class = "sectionTitle">
								<p>Responsibility</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php echo nl2br($occ['Occupation']['responsibility']); ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
						<section>
							<div class = "sectionTitle">
								<p>Requirements</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php echo nl2br($occ['Occupation']['requirements']) ; ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
						<section>
							<div class = "sectionTitle">
								<p>Entry date</p>
							</div>
							<div class = "sectionContent">
								<article>
									<p>
										<?php echo date('d M Y',strtotime($occ['OccupationFavorite']['created']) ) ; ?>
									</p>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>
		</table>
	</div>
	<div class = "x_content">
		<table class = "table-st">
			<tr>
				<td colspan="3" class="labelbg">
					<div class="col-md-10 col-sm-10 col-xs-12">
						<?php echo "<label class='main-label'>Jobseeker Profile</label>"; ?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="x_content">
		<table class="table-st">
			<!-- Step 1 Profile -->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<h1>Profile</h1>
							</div>
							<div class = "sectionContent">
								<article>
									<?php if (!empty($userdata['User']['image'])) : ?>
										<div style="width: 165px;height: 150px;border:1px solid lightgray;position: relative;">
										<?php
											echo $this->Html->image(
												$userdata['User']['thumb_image_url'],
												array(
													'style' => 'max-width: 100%;max-height:100%;margin: auto;position: absolute;top: 0; left: 0; bottom: 0; right: 0;'
												)
											);
										?>
										</div>
									<?php endif ; ?>
									<h3>
										<?php echo $userdata['User']['name'] ; ?>
									</h3>
									<p>
										<?php echo 'Jobseker ID : '.$userdata['User']['jobseeker_id']; ?>
									</p>
									<p>
										<?php
											if ($userdata['User']['gender'] == 1) :
												echo "Gender : Male";
											elseif ($userdata['User']['gender'] == 2) :
												echo "Gender : Female";
											endif ;
										?>
									</p>
									<?php if(!empty($userdata['User']['birthday'])): ?>
										<p>
											<?php
												/****** Calculation age from birthday
												***** object oriented
												*********************************/
												$cal_age = date_diff(date_create($userdata['User']['birthday']), date_create('today'))->y ;
												echo 'Age : '.$cal_age.' years';
											?>
										</p>
									<?php endif; ?>
									<?php if (!empty($userdata['User']['nationality'])) : ?>
										<p>
											<?php echo 'Nationality : '.$nation[$userdata['User']['nationality']]; ?>
										</p>
									<?php endif; ?>
									<?php if (!empty($userdata['User']['religion'])) : ?>
										<p>
											<?php echo 'Religion : '.$religion[$userdata['User']['religion']] ; ?>
										</p>
									<?php endif; ?>
									<?php if (!empty($userdata['User']['marital_status'])) : ?>
										<p>
											<?php echo 'Marital status : '.$marital_status[$userdata['User']['marital_status']] ; ?>
										</p>
									<?php endif; ?>
								</article>
							</div>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>

			<!-- Step 2 Language Skill -->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<h1>Language Skill</h1>
							</div>
							<?php if (empty($user_language)) : ?>
								<div class = "sectionContent">
									<article>
										<p>No Information</p>
									</article>
								</div>
							<?php else : ?>
								<div class = "sectionContent">
									<article>
										<h3>Burmese Skill</h3>
										<?php if (!empty($user_language[0]['UserLanguageSkill']['skill'])) : ?>
											<p>
												<?php
													echo 'Level : '.$language_skill[$user_language[0]['UserLanguageSkill']['skill']];
												?>
											<?php endif; ?>
											<br/>
											<?php if (!empty($user_language[0]['UserLanguageSkill']['certificate'])) : ?>
												<span class="core_break"><?php echo 'Certificate : '.nl2br($user_language[0]['UserLanguageSkill']['certificate']); ?></span>
											</p>
										<?php endif; ?>
										<h3>English Skill</h3>
										<?php if (!empty($user_language[1]['UserLanguageSkill']['skill'])) : ?>
											<p>
												<?php echo
													'Level : '.$language_skill[$user_language[1]['UserLanguageSkill']['skill']];
												?>
											<?php endif; ?>
											<br/>
											<?php if (!empty($user_language[1]['UserLanguageSkill']['certificate'])) : ?>
												<span class="core_break"><?php echo 'Certificate : '.nl2br($user_language[1]['UserLanguageSkill']['certificate']); ?></span>
											</p>
										<?php endif; ?>
										<h3>Chinese Skill</h3>
										<?php if (!empty($user_language[2]['UserLanguageSkill']['skill'])) : ?>
											<p>
												<?php echo 'Level : '.$language_skill[$user_language[2]['UserLanguageSkill']['skill']]; ?>
											<?php endif; ?>
											<br/>
											<?php if (!empty($user_language[2]['UserLanguageSkill']['certificate'])) : ?>
												<span class="core_break"><?php echo 'Certificate : '.nl2br($user_language[2]['UserLanguageSkill']['certificate']); ?></span>
											</p>
										<?php endif; ?>
										<h3>Japanese Skill</h3>
										<?php if (!empty($user_language[3]['UserLanguageSkill']['skill'])) : ?>
											<p>
												<?php echo 'Level : '.$language_skill[$user_language[3]['UserLanguageSkill']['skill']]; ?>
											<?php endif; ?>
											<br/>
											<?php if (!empty($user_language[3]['UserLanguageSkill']['certificate'])) : ?>
												<span class="core_break"><?php echo 'Certificate : '.nl2br($user_language[3]['UserLanguageSkill']['certificate']); ?></span>
											</p>
										<?php endif; ?>
									</article>
								</div>
							<?php endif; ?>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>

			<!-- Step 3 Education -->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<h1>Education</h1>
							</div>
							<?php if (empty($user_edu)) : ?>
								<div class = "sectionContent">
									<article>
										<p>No Information</p>
									</article>
								</div>
							<?php else : ?>
								<div class = "sectionContent">
									<?php foreach ($user_edu as $edu_key => $edu_value) : ?>
										<article>
											<h3>
												<span class="core_break"><?php echo nl2br($edu_value['UserEducation']['university_name']); ?></span>
											</h3>
											<p class="core_break">
												<?php echo 'Department : '.nl2br($edu_value['UserEducation']['department']); ?>
											</p>
											<p>
												<?php echo 'Degree : '.$edu[$edu_value['UserEducation']['degree']]; ?>
											</p>
											<p>
												<?php echo 'Enrolled date : '.date('M Y', strtotime($edu_value['UserEducation']['enrollment'])); ?>
											</p>
											<p>
												<?php echo 'Graduated date : '.date('M Y', strtotime($edu_value['UserEducation']['graduation'])); ?>
											</p>
											<p class="core_break">
												<?php echo "Remarks :". nl2br($edu_value['UserEducation']['remarks']); ?>
											</p>
										</article>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>

			<!-- Step 4 Career history -->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<h1>Career history</h1>
							</div>
							<?php if (empty($user_career)) : ?>
								<div class = "sectionContent">
									<!-- <article> -->
										<p>No Information</p>
									<!-- </article> -->
								</div>
							<?php else : ?>
								<div class = "sectionContent">
									<?php foreach ($user_career as $career_key => $career_value) : ?>
										<article>
											<h3>
												<span class="core_break"><?php echo nl2br($career_value['UserCareerHistory']['company_name']); ?></span>
											</h3>
											<p>
												<span class="core_break"><?php echo 'Department : '.nl2br($career_value['UserCareerHistory']['department']); ?></span>
											</p>
											<p>
												<?php echo 'Position : '.$career_value['UserCareerHistory']['position']; ?>
											</p>
											<p>
												<?php echo 'Joined date : '.date('M Y', strtotime($career_value['UserCareerHistory']['joined_y_m'])); ?>
											</p>
											<p>
												<?php echo 'Resigned date : '.date('M Y', strtotime($career_value['UserCareerHistory']['resignation'])); ?>
											</p>
											<p style="width: 90%;">
												<?php echo 'Industry : '.$industryb[$career_value['UserCareerHistory']['industry_big_id']].' / '.$industrys[$career_value['UserCareerHistory']['industry_small_id']]; ?></p>
											<p style="width: 90%;">
												<?php echo 'Job category : '.$categoryb[$career_value['UserCareerHistory']['job_category_id']].' / '.$categorys[$career_value['UserCareerHistory']['job_category_sub_id']]; ?>
											</p>

											<?php foreach ($career_value['UserProject'] as $proj_key => $proj_value) : ?>
												<h3>
													<span class="core_break"><?php echo nl2br($proj_value['title']); ?></span>
												</h3>
												<p>
													<?php echo 'Period : '.date('M Y', strtotime($proj_value['period_start'])).'~'.date('M Y', strtotime($proj_value['period_end'])); ?>
												</p>
												<p class="core_break">
													<?php echo "Detail : ".nl2br($proj_value['detail']); ?>
													<?php endforeach; ?>
												</p>
										</article>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>

			<!-- Step 5 Microsoft Office (Computing Skill)-->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<h1>Microsoft Office</h1>
							</div>
							<?php if (empty($user_computing)) : ?>
								<div class = "sectionContent">
									<article>
										<p>No Information</p>
									</article>
								</div>
							<?php else : ?>
								<div class = "sectionContent">
									<?php foreach ($user_computing as $comkey => $comvalue) : ?>
										<article>
											<h3>
												<span class="core_break"><?php echo nl2br($comvalue['UserComputingSkill']['title']); ?></span>
											</h3>
											<p>
												<?php echo 'Level : '.$ms_skill[$comvalue['UserComputingSkill']['skill']]; ?>
											</p>
										</article>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>

			<!-- Step 6 Qualifications-->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<h1>Qualification</h1>
							</div>
							<?php if (empty($user_qualification)) : ?>
								<div class = "sectionContent">
									<article>
										<p>No Information</p>
									</article>
								</div>
							<?php else : ?>
								<div class = "sectionContent">
									<?php foreach ($user_qualification as $quali_key => $quali_value) : ?>
										<article>
											<h3>
												<span class="core_break"><?php echo nl2br($quali_value['UserQualification']['qualification_name']); ?></span>
											</h3>
											<p>
												<?php echo 'Qualified date : '.date('M Y', strtotime($quali_value['UserQualification']['qualification_date'])); ?>
											</p>
										</article>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>

			<!-- Step 7 Special instruction-->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<h1>Special instruction</h1>
							</div>
							<?php if (empty($user_instruction)) : ?>
								<div class = "sectionContent">
									<article>
										<p>No Information</p>
									</article>
								</div>
							<?php else : ?>
								<div class = "sectionContent">
									<?php foreach ($user_instruction as $instruct_key => $instruct_value) : ?>
										<article>
											<h3>
												<?php $specialtext = wordwrap($instruct_value['UserSpecialInstruction']['title'], 90, "<br/>", true); ?>
												<?php echo "$specialtext<br/>"; ?>
													</h3>
													<p class="core_break">
														<?php echo nl2br($instruct_value['UserSpecialInstruction']['detail']);?>
													</p>
										</article>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>

			<!-- Step 8 Expected salary, Executive summary, Core skill -->
				<tr>
					<body>
						<section>
							<div class = "sectionTitle">
								<h1>Expected salary, Executive summary, Core skill</h1>
							</div>
							<?php if (empty($user_core)) : ?>
								<div class = "sectionContent">
									<article>
										<p>No Information</p>
									</article>
								</div>
							<?php else : ?>
								<div class = "sectionContent">
									<article>
										<?php if (!empty($user_core[0]['UserCoreSkill']['expected_salary'])) : ?>
											<p>
												<?php echo 'Expected salary : '.$salary[$user_core[0]['UserCoreSkill']['expected_salary']]; ?>
											</p>
										<?php endif; ?>
										<!-- <p>
											<?php $newtext = wordwrap($instruct_value['UserSpecialInstruction']['detail'], 120, "<br/>", true); ?>
											<?php echo "$newtext<br/>"; ?>
										</p> -->
										<?php if (!empty($user_core[0]['UserCoreSkill']['current_salary'])) : ?>
											<p>
												<?php echo 'Current salary : '.$salary[$user_core[0]['UserCoreSkill']['current_salary']]; ?>
											</p>
										<?php endif; ?>
										<?php if (!empty($user_core[0]['UserCoreSkill']['current_benefits'])) : ?>
											<p class="core_break">
												<?php echo 'Current benefits : '.nl2br($user_core[0]['UserCoreSkill']['current_benefits']); ?>
											</p>
										<?php endif; ?>
										<?php if (!empty($user_core[0]['UserCoreSkill']['availability'])) : ?>
											<p>
												<?php echo 'Availability : '.$availability[$user_core[0]['UserCoreSkill']['availability']]; ?>
											</p>
										<?php endif; ?>
										<?php if (!empty($user_core[0]['UserCoreSkill']['executive_summary'])) : ?>
											<p class="core_break">
												<?php echo 'Executive summary : '.nl2br($user_core[0]['UserCoreSkill']['executive_summary']); ?>
											</p>
										<?php endif; ?>
										<?php if (!empty($user_core[0]['UserSubCoreSkill'])) : ?>
											<article><h3>Core Skill</h3></article>
											<?php foreach ($user_core[0]['UserSubCoreSkill'] as $key => $value) : ?>
												<p><?php echo $value['core_skill']; ?></p>
												<br/>
											<?php endforeach; ?>
										<?php endif; ?>
									</article>
								</div>
							<?php endif; ?>
							<div class = "clear"></div>
						</section>
					</body>
				</tr>
		</table>

		<div class = "ln_solid"></div>
		<div class = "col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
			<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
			<?php if ($company_info['CmpHeadhunter']['avaliable_mail'] > 0) : ?>
				<?php echo $this->Html->link('Send Message', "#myModal", array('class' => 'btn btn-orange btn-sm', "data-toggle" => "modal", 'id' => 'send-message')); ?>
			<?php else: ?>
				<?php echo $this->Html->link('Send Message', "#secondModal", array('class' => 'btn btn-orange btn-sm', "data-toggle" => "modal", 'id' => 'send-message')); ?>
			<?php endif; ?>
		</div>

	</div>
</div>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">New Message</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->Form->create('Message', array(
					'url' => array(
						'controller' => 'Masterjobseekers',
						'action' => 'sendmessage'
					),
					'class' => 'form-horizontal',
					'label' => false,
					'role' => 'form',
					'onsubmit' => "confirm('Do you send the message to the jobseeker? If you sent the message, 1 of the remaining number of  message transmission authority will decrease.');"
				)); ?>

					<div class="form-group">
						<label class="col-lg-2 control-label">To</label>
						<div class="col-lg-10">
								<?php echo $this->Form->input('name', array(
									'label' => false,
									'value'	=> $userdata['User']['name'],
									'class' => 'form-control js-example-basic-multiple'
								)); ?>
						</div>
					</div>
					<?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $userdata['User']['id'])); ?>
					<?php echo $this->Form->input('to', array('type' => 'hidden', 'value' => $userdata['User']['id'].':J'));?>

					<div class="form-group">
						<label class="col-lg-2 control-label">Subject</label>
						<div class="col-lg-10">
							<?php echo $this->Form->input('subject', array(
								'label' => false,
								'class' => 'form-control'
							)); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">Message</label>
						<div class="col-lg-10">
							<?php echo $this->Form->input('message_body', array(
								'type' => 'textarea',
								'label' => false,
								'rows' => 10,
								'cols' => 30,
								'class' => 'form-control'
							)); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">Job List</label>
						<div class="col-lg-10">
						<?php if (!empty($jobInfo_info)): ?>
							<?php foreach($jobInfo_info as $key => $val): ?>
								<div class="col-lg-12">
									<div class="checkbox">
										<label>
												<input type="checkbox" name="ch_id[]" value="<?php echo $val['Occupation']['id']; ?>"> <?php echo $this->Html->link($val['Occupation']['job_title'], array('controller' => 'masteroccupations', 'action' => 'browse', $val['Occupation']['id']), array('target' => '_blank')); ?>
										</label>
									</div>
								</div>
								<br/>
								<br/>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<?php echo $this->Form->button('Send', array('type' => 'submit', 'class' => 'btn btn-send')); ?>
						</div>
					</div>
					<?php echo $this->Form->input('saved',array(
							'type' => 'hidden',
							'label' => false,
							'value' => 'saved'
						));
					?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="secondModal" class="modal fade" style="display: none;">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
								<h4 class="modal-title">[Alert]</h4>
						</div>
						<div class="modal-body">
							<p style="color:#000">
							You currently do not have [message transmission authority (to jobseekers)]. If you would like to send message to jobseekers, please purchase additional [message transmission authority (to jobseekers)] at affordable price.
							<p>
							<br/>
							<p style="color:#000">
							You can send message to Smartalote administrator and request [send message permission (to jobseeker)] from below.
							</p>
							<br/>
							<br/>

							<a href="#thirdModal" data-toggle="modal" class="second-message">Message to administrator</a>

						</div>
				</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="thirdModal" class="modal fade" style="display: none;">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
								<h4 class="modal-title">Contact</h4>
						</div>
						<div class="modal-body">
								<?php echo $this->Form->create('Message', array(
									'url' => array(
										'controller' => 'masterjobseekers',
										'action' => 'contactMailTransmittion'
									),
									'class' => 'form-horizontal',
									'label' => false,
									'role' => 'form',
									'onsubmit' => "confirm('Do you send the message to the jobseeker? If you sent the message, 1 of the remaining number of  message transmission authority will decrease.');"
								)); ?>

										<div class="form-group">
											<label class="col-lg-2 control-label">To</label>
											<div class="col-lg-10">
													<?php echo $this->Form->input('name', array(
														'label' => false,
														'value'	=> $adminUser['AdminUser']['name'].'<Admin>',
														'class' => 'form-control js-example-basic-multiple',
														'readonly' => true
													)); ?>
											</div>
										</div>
										<?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $adminUser['AdminUser']['id'])); ?>
										<?php echo $this->Form->input('user', array('type' => 'hidden', 'value' => $userdata['User']['id'])); ?>
										<?php echo $this->Form->input('to', array('type' => 'hidden', 'value' => $adminUser['AdminUser']['id'].':A'));?>

										<div class="form-group">
											<label class="col-lg-2 control-label">Subject</label>
											<div class="col-lg-10">
												<?php echo $this->Form->input('subject', array(
													'label' => false,
													'class' => 'form-control',
													'required' => 'required'
												)); ?>
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label">Message</label>
											<div class="col-lg-10">
												<?php echo $this->Form->input('message_body', array(
													'type' => 'textarea',
													'label' => false,
													'rows' => 10,
													'cols' => 30,
													'class' => 'form-control',
													'required' => 'required'
												)); ?>
											</div>
										</div>

										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-10">
												<?php echo $this->Form->button('Send', array('type' => 'submit', 'class' => 'btn btn-send')); ?>
											</div>
										</div>
								<?php echo $this->Form->end(); ?>
						</div>
				</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(function() {
		$('.second-message').on('click', function() {
			$('#secondModal').attr('style', 'display:none;');
			$('.modal-backdrop').remove();
		})
	})
</script>

<style type="text/css" media="screen">
	table.table-st {
		width:100%;
	}
	table.table-st tr {
		border-bottom: 1px solid #D9DEE4;
	}
	table.table-st tbody tr td.left{
		width:93%;
		padding:10px;
	}
	table.table-st tbody tr td.right{
		width:71%;
		text-align: left;
		padding:10px;
	}
	.main-label {
		/*margin-left: 393px;*/
		margin-bottom: 0px;
		background-color: #DCDCDC;
		color: slategrey;
		height: 34px;
		padding-top: 4px;
	}
	.labelbg{
		background-color: #DDD;
		font-size: 17px;
		color: #fff;
	}
	section {
		border-top: 1px solid #dedede;
		padding: 20px 0 0;
	}

	section:first-child {
		border-top: 0;
	}

	section:last-child {
		padding: 20px 0 10px;
	}

	.sectionTitle {
		padding-bottom: 7px;
		margin-top: -12px;
		float: left;
		width: 25%;
	}

	.sectionContent {
		float: right;
		width: 72.5%;
	}

	.sectionTitle h1 {
		/*font-family: 'Rokkitt', Helvetica, Arial, sans-serif;*/
		font-style: normal;
		font-size: 1.4em;
		color: slategray;
	}

	.sectionContent h3 {
		/*font-family: 'Rokkitt', Helvetica, Arial, sans-serif;*/
		font-weight: 700;
		font-size: 1.3em;
		margin-bottom: 2px;
	}

	.subDetails {
		font-size: 0.8em;
		font-style: italic;
		margin-bottom: 3px;
	}

	.keySkills {
		list-style-type: none;
		-moz-column-count:3;
		-webkit-column-count:3;
		column-count:3;
		margin-bottom: 20px;
		font-size: 1em;
		color: slategray;
	}

	.keySkills ul li {
		margin-bottom: 3px;
	}

	@media all and (min-width: 602px) and (max-width: 800px) {
		#headshot {
			display: none;
		}

		.keySkills {
		-moz-column-count:2;
		-webkit-column-count:2;
		column-count:2;
		}
	}

	@media all and (max-width: 601px) {
		#cv {
			width: 95%;
			margin: 10px auto;
			min-width: 280px;
		}

		#headshot {
			display: none;
		}

		#name, #contactDetails {
			float: none;
			width: 100%;
			text-align: center;
		}

		.sectionTitle, .sectionContent {
			float: none;
			width: 100%;
		}

		.sectionTitle {
			margin-left: -2px;
			font-size: 1.25em;
		}

		.keySkills {
			-moz-column-count:2;
			-webkit-column-count:2;
			column-count:2;
		}
	}

	@media all and (max-width: 480px) {
		.mainDetails {
			padding: 15px 15px;
		}

		section {
			padding: 15px 0 0;
		}

		#mainArea {
			padding: 0 25px;
		}


		.keySkills {
		-moz-column-count:1;
		-webkit-column-count:1;
		column-count:1;
		}

		#name h1 {
			line-height: .8em;
			margin-bottom: 4px;
		}
	}

	@media print {
	#cv {
		width: 100%;
	}
	}

	@-webkit-keyframes reset {
		0% {
			opacity: 0;
		}
		100% {
			opacity: 0;
		}
	}

	@-webkit-keyframes fade-in {
		0% {
			opacity: 0;
		}
		40% {
			opacity: 0;
		}
		100% {
			opacity: 1;
		}
	}

	@-moz-keyframes reset {
		0% {
			opacity: 0;
		}
		100% {
			opacity: 0;
		}
	}

	@-moz-keyframes fade-in {
		0% {
			opacity: 0;
		}
		40% {
			opacity: 0;
		}
		100% {
			opacity: 1;
		}
	}

	@keyframes reset {
		0% {
			opacity: 0;
		}
		100% {
			opacity: 0;
		}
	}

	@keyframes fade-in {
		0% {
			opacity: 0;
		}
		40% {
			opacity: 0;
		}
		100% {
			opacity: 1;
		}
	}

	.instaFade {
		-webkit-animation-name: reset, fade-in;
		-webkit-animation-duration: 1.5s;
		-webkit-animation-timing-function: ease-in;

		-moz-animation-name: reset, fade-in;
		-moz-animation-duration: 1.5s;
		-moz-animation-timing-function: ease-in;

		animation-name: reset, fade-in;
		animation-duration: 1.5s;
		animation-timing-function: ease-in;
	}

	.quickFade {
		-webkit-animation-name: reset, fade-in;
		-webkit-animation-duration: 2.5s;
		-webkit-animation-timing-function: ease-in;

		-moz-animation-name: reset, fade-in;
		-moz-animation-duration: 2.5s;
		-moz-animation-timing-function: ease-in;

		animation-name: reset, fade-in;
		animation-duration: 2.5s;
		animation-timing-function: ease-in;
	}

	.delayOne {
		-webkit-animation-delay: 0, .5s;
		-moz-animation-delay: 0, .5s;
		animation-delay: 0, .5s;
	}

	.delayTwo {
		-webkit-animation-delay: 0, 1s;
		-moz-animation-delay: 0, 1s;
		animation-delay: 0, 1s;
	}

	.delayThree {
		-webkit-animation-delay: 0, 1.5s;
		-moz-animation-delay: 0, 1.5s;
		animation-delay: 0, 1.5s;
	}

	.delayFour {
		-webkit-animation-delay: 0, 2s;
		-moz-animation-delay: 0, 2s;
		animation-delay: 0, 2s;
	}

	.delayFive {
		-webkit-animation-delay: 0, 2.5s;
		-moz-animation-delay: 0, 2.5s;
		animation-delay: 0, 2.5s;
	}
</style>