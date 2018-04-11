<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('UserCareerHistory', array('type' => 'file', 'class' => ' form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3 >Career history</h3>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3 >Career history</h3>
				</div>
			</div>
		</div>

		<?php if(isset($experience_count)): ?>
			<?php echo $this->Form->input('', array('type' => 'hidden','value' => $experience_count,'class'=> 'experience_count')); ?>
		<?php else:?>
			<?php echo $this->Form->input('', array('type' => 'hidden','value' => '','class'=> 'experience_count')); ?>
		<?php endif;?>


		<div class="form-group" >
			<h4 class="col-md-4 col-xs-1 control-label checkbox_experience" >
				<?php if(isset($experience_count)):?>
					<?php
						echo $this->Form->input('independents', array(
							'type' => 'checkbox',
							'id' => 'toggleElement',
							'name' => "toggle",
							'onchange' => "toggleStatus()" ,
							'label' => false ,
							'style' => 'margin-top: -12px;',
							'format' => array('independent')
						));
					?>
				<?php else:?>
					<?php
						echo $this->Form->input('independents', array(
							'type' => 'checkbox',
							'id'=>'toggleElement',
							'name' => "toggle",
							'onchange' => "toggleStatus()" ,
							'label' => false ,
							'style' => 'margin-top: -12px;',
							'checked' => true,
							'format' => array('independent')
						));
					?>
				<?php endif;?>
			</h4>

			<div class="col-md-6 col-xs-10 no_experience">
				<div class="input-group col-md-8 col-sm-6 col-xs-12">
					<h5 style="font-size: 16px !important;"><?php echo $this->Form->label('', 'If you have no experiences', array('class' => 'control-label'));?></h5>
				</div>
			</div>
		</div>

		<?php
			if (!empty($career_info_edit) || !empty($requestData)) {
				$career_info_edit = !empty($requestData) ? $requestData : $career_info_edit;
			}
		?>

		<!-- <span>※Please fill from recently worked company.</span> -->
		<div class="applyForm" id="elementsToOperateOn">
		<!-- <?php echo $this->Form->input('group_id', array('textbox' => true, 'value'=> $experience_count)); ?> -->
			<?php if (!empty($career_info_edit['UserCareerHistory'])): ?>
				<?php $j = 0; ?>
				<?php foreach ($career_info_edit['UserCareerHistory'] as $key => $value) : ?>
					<div  id=<?php echo "apply_form[" . $key . "]"; ?> class = 'apply-form'>
					<?php echo $this->Form->input('UserCareerHistory.' . $key . '.user_id', array('type' => 'hidden')); ?>

						<div class="form-group">
							<div class="col-md-4 control-label cv_three_font letter_color">
								Company Name
								<span class="error">*</span>
							</div>
							<div class="col-md-6 selectContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<?php
										echo $this->Form->input('UserCareerHistory.' . $key . '.company_name', array(
											'type' => 'text',
											'required' => true,
											'id'=>'cmp_nameid',
											'label' => false,
											'class' => 'form-control select_height',
											'autocomplete' => 'off',
											'placeholder' => 'e.g.) SmartAlote Company Limited',
											'style' => 'border-color: #C0C0C0;border-radius:3px;width: 104%;'
										));
									?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-4 control-label cv_three_font letter_color">Department</div>
							<div class="col-md-6 selectContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<?php
										echo $this->Form->input('UserCareerHistory.' . $key . '.department', array(
											'type' => 'text',
											'id'=>'depart_id',
											'label' => false,
											'class' => 'form-control select_height',
											'autocomplete' => 'off' ,
											'placeholder' => 'e.g.) Marketing Department',
											'style' => 'border-color: #C0C0C0;border-radius:3px;width: 104%;'
										));
									?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-4 control-label cv_three_font letter_color">Position</div>
							<div class="col-md-6 selectContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<?php
										echo $this->Form->input('UserCareerHistory.' . $key . '.position', array(
											'type' => 'text',
											'label' => false,
											'class' => 'form-control select_height',
											'autocomplete' => 'off' ,
											'placeholder' => 'e.g.) Senior staff, Team manager, Account executive etc.',
											'style' => 'border-color: #C0C0C0;border-radius:3px;width: 104%;'
										));
									?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-4 control-label cv_three_font letter_color letter_color">
								Joined Year/Month
								<span class="error">*</span>
							</div>
							<div class="col-md-6 selectContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<div class="col-md-4 form-group">
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.joined_month', array(
												'type'=>'select','id'=>'smonth',
												'options'=>$month,
												'required' => true,
												'empty'=>'Month',
												'label'=>false,
												'class' => 'form-control cv_one_email select_height',
												'style' => 'border-radius:3px;width: 104%;'
											));
										?>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4 form-group">
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.joined_year', array(
												'type'=>'select',
												'id'=>'syear',
												'required' => true,
												'options' => $year,
												'empty'=>'Year',
												'class' => 'form-control select_height',
												'label'=>false,
												'style' => 'border-radius:3px;width: 104%;'
											));
										?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-4 control-label cv_three_font letter_color letter_color">
								Resignation
								<span class="error">*</span>
							</div>
							<div class="col-md-6 selectContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<div class="col-md-4 form-group">
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.resigned_month', array(
												'type'=>'select',
												'id'=>'smonth',
												'options'=>$month,
												'empty'=>'Month',
												'label'=>false,
												'disabled' => $value['current'],
												'class' => 'form-control cv_one_email select_height',
												'style' => 'border-radius:3px;width: 104%;'
											));
										?>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-4 form-group">
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.resigned_year', array(
												'type'=>'select',
												'id'=>'syear',
												'options'=>$year,
												'empty'=>'Year',
												'disabled' => $value['current'],
												'class' => 'form-control select_height',
												'label'=>false,
												'style' => 'border-radius:3px;width: 104%;'
											));
										?>
									</div>
									<!-- <div class="col-md-3 form-group main_current" >
										<label class="control control--checkbox sub_current"> Current
											<?php
												echo $this->Form->input('UserCareerHistory.' . $key . '.current', array(
													'type' => 'checkbox',
													'class'=> 'resign',
													'label' => false,
													'checked' => $value['current'],
													'onchange' => 'onClick(this)',
												));
											?>
											<div class="control__indicator"></div>
										</label>
									</div> -->
									<div class="col-md-5 form-group">
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.current', array(
												'type' => 'checkbox',
												'class'=> 'resign',
												'label' => array(
													'text' => 'Current',
													'class' => 'currentDesign'
												),
												'checked' => $value['current'],
												'onchange' => 'onClick(this)',
											));
										?>
									</div>
								</div>
							</div>
						</div>

						<?php $small_value = $value['industry_small']; ?>
						<div class="form-group">
							<div class="col-md-4 control-label cv_three_font letter_color">
								Industry
								<span class="error">*</span>
							</div>
							<div class='col-md-8'>
								<div class="col-md-3">
									<div class='form-group'>
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.industry_big', array(
												'type'=>'select',
												'required' => true,
												'empty' => 'Choose Industry',
												'class' => 'form-control industry_big_normal select_height jobcate_width' ,
												'style' => 'width: 104%',
												'options'=>$big_industry,
												'label'=>false
											));
										?>
									</div>
								</div>
								<div class="col-md-3 cv_four_jc jb_margin"><!-- margin-left:40px -->
									<div class='form-group' id="indi_small_one" >
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.industry_small', array(
												'type'=>'select',
												'empty' => 'Choose Sub-category',
												'class' => 'form-control select_height jobcate_width',
												'style' => 'width: 104%',
												'label'=>false
											));
										?>
									</div>
									<div class="form-group indi_small_two" >
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.industry_small', array(
												'type' => 'select',
												'empty' => 'Choose Sub-category',
												'label' => false,
												'class' => 'form-control select_height',
												'style' => 'width: 104%',
												'div' => array('class' => 'small-industry-blank')
											));
										?>
										<?php foreach ($small_industry as $key_in_small => $val): ?>
											<?php
												echo $this->Form->input('UserCareerHistory.' . $key . '.industry_small', array(
													'type' => 'select',
													'empty' => 'Choose Sub-category',
													'options' => $val,
													'label' => false,
													'value' => $small_value,
													'class' => 'form-control select_height jobcate_width',
													'style' => 'width: 104%',
													'div' => array('class' => 'industry-small industry-small-' . $key_in_small)
												));
											?>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>

						<?php $small_value1 = $value['job_category_sub']; ?>
						<div class="form-group">
							<div class="col-md-4 control-label cv_three_font letter_color">
								Job Category
								<span class="error">*</span>
							</div>
							<div class='col-md-8'>
								<div class="col-md-3">
									<div class='form-group'>
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.job_category', array(
												'type'=>'select',
												'empty' => 'Choose Job',
												'required' => true,
												'class' => 'form-control job_category_big_normal select_height jobcate_width',
												'style' => 'width: 104%',
												'options'=>$big_job,
												'label'=>false
											));
										?>
									</div>
								</div>
								<div class="col-md-3 cv_four_jc jb_margin"><!-- margin-left:40px -->
									<div class='form-group' id="sub_job_one">
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.job_category_sub', array(
												'type'=>'select',
												'empty' => 'Choose Sub-category',
												'class' => 'form-control select_height',
												'style' => 'width: 104%',
												'label'=>false
											));
										?>
									</div>
									<div class='form-group sub_job_two'>
										<?php
											echo $this->Form->input('UserCareerHistory.' . $key . '.job_category_sub', array(
												'type' => 'select',
												'empty' => 'Choose Sub-category',
												'label' => false,
												'class' => 'form-control select_height',
												'style' => 'width: 104%',
												'div' => array('class' => 'small-job-blank')
											));
										?>
										<?php foreach ($small_job as $jkey => $jval): ?>
											<?php
												echo $this->Form->input('UserCareerHistory.' . $key . '.job_category_sub', array(
													'type' => 'select',
													'empty' => 'Choose Sub-category',
													'options' => $jval,
													'value' => $small_value1,
													'label' => false,
													'class' => 'form-control select_height jobcate_width',
													'style' => 'width: 104%',
													'div' => array('class' => 'small-job small-job-' . $jkey)
												));
											?>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>

						<?php $i = 0; ?>
						<?php if(!empty($value['UserProject'])): ?>
							<?php foreach ($value['UserProject'] as $key_prj => $value_prj) : ?>
								<?php
									echo $this->Form->input('UserCareerHistory.' . $key . '.UserProject.' . $key_prj . '.id', array(
										'type' => 'hidden'
									));
								?>
								<div id=<?php echo "prj_apply_form[" . $key . "][" . $key_prj . "]"; ?> class="prj_apply_form">
									<div class="form-group">
										<div class="col-md-4 control-label cv_three_font letter_color">Project</div>
										<div class="col-md-6 selectContainer">

											<div class="form-group">
												<div class="col-md-10 col-sm-12 col-xs-12">
													<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group">Title</div>
													<div class="col-md-1"></div>
													<div class="col-md-9 col-sm-8 col-xs-10 input-group align">
													<!-- <div class="col-md-9 col-sm-9 col-xs-9 form-group"> -->
														<?php
															echo $this->Form->input('UserCareerHistory.' . $key . '.UserProject.' .
																$key_prj . '.title', array(
																	'type' => 'text',
																	'label' => false,
																	'class' => 'form-control select_height',
																	'autocomplete' => 'off',
																	'placeholder' => 'e.g.) Internal ICT system renewal project',
																	'style' => 'border-color: #C0C0C0;border-radius:3px;width: 104%;'
																)
															);
														?>
													</div>
												</div>
											</div>

											<div class="clear"></div>

											<div class="form-group">
												<div class="col-md-10 col-sm-12 col-xs-12">
													<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group">Start</div>
													<div class="col-md-1"></div>
													<div class="input-group col-md-10 col-sm-6 col-xs-12 align">
														<div class="col-md-4 col-sm-4 col-xs-11 form-group">
															<?php
																echo $this->Form->input('UserCareerHistory.' . $key . '.UserProject.' . $key_prj . '.prj_start_month', array(
																		'type' => 'select',
																		'id' => 'smonth',
																		'options' => $month,
																		'empty' => 'Month',
																		'label' => false,
																		'class' => 'form-control cv_one_email select_height',
																		'style' => 'border-radius:3px;width:106%;'
																	)
																);
															?>
														</div>
														<div class="col-md-1"></div>
														<div class="col-md-4 col-sm-4 col-xs-11 form-group">
															<?php
																echo $this->Form->input('UserCareerHistory.' . $key . '.UserProject.' . $key_prj . '.prj_start_year', array(
																		'type'=>'select',
																		'id'=>'syear',
																		'options'=>$year,
																		'empty'=>'Year',
																		'class' => 'form-control select_height',
																		'label'=>false,
																		'style'=>'border-radius:3px;width:106%;'
																	)
																);
															?>
														</div>
													</div>
												</div>
											</div>

											<div class="clear"></div>

											<div class="form-group mobile_bottom">
												<div class="col-md-10 col-sm-12 col-xs-12">
													<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group">End</div>
													<div class="col-md-1"></div>
													<div class="input-group col-md-10 col-sm-6 col-xs-12 align">
														<div class="col-md-4 col-sm-4 col-xs-11 form-group">
															<?php
																echo $this->Form->input('UserCareerHistory.' . $key . '.UserProject.' . $key_prj . '.prj_end_month', array(
																		'type'=>'select',
																		'id'=>'smonth',
																		'options'=>$month,
																		'empty'=>'Month',
																		'label'=>false,
																		'class' => 'form-control cv_one_email select_height',
																		'style' => 'border-radius:3px;width:106%;',
																		'disabled' => $value_prj['current']
																	)
																);
															?>
														</div>
														<div class="col-md-1"></div>
														<div class="col-md-4 col-sm-4 col-xs-11 form-group">
															<?php
																echo $this->Form->input('UserCareerHistory.' . $key . '.UserProject.' . $key_prj . '.prj_end_year', array(
																		'type'=>'select',
																		'id'=>'syear',
																		'options'=>$year,
																		'empty'=>'Year',
																		'class' => 'form-control select_height',
																		'label'=>false,
																		'style'=>'border-radius:3px;width:106%;',
																		'disabled' => $value_prj['current']
																	)
																);
															?>
														</div>


														<div class="col-md-5 col-sm-4 col-xs-11 form-group" >
															<?php
																echo $this->Form->input('UserCareerHistory.' . $key .'.UserProject.' .
																	$key_prj . '.current', array(
																		'type' => 'checkbox',
																		'class'=> 'support',
																		'label' => array(
																			'text' => 'Current',
																			'class' => 'currentDesign',
																		),
																		'checked' => $value_prj['current'],
																		'onchange' => 'onChange(this)',
																	)
																);
															?>
														</div>
													</div>
												</div>
											</div>

											<div class="hidden-xs clear"></div>

											<div class="form-group" >
												<div class="col-md-10 col-sm-12 col-xs-10">
													<div class="col-md-1 control-label project_group">Detail</div>
													<div class="col-md-1"></div>

													<div class="col-md-9 col-sm-6 col-xs-12 input-group align">
														<?php
															echo $this->Form->input('UserCareerHistory.' . $key . '.UserProject.' .
																$key_prj . '.detail', array(
																	'type' => 'textarea',
																	'id'=>'jd_id',
																	'label' => false,
																	'class' => 'form-control',
																	'autocomplete' => 'off' ,
																	'placeholder' => '',
																	'style' => 'border-color: #C0C0C0 ;border-radius:3px;width:106%;'
																)
															);
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group col-md-9"></div>
									<div class="form-group col-md-8 minus_proj minus_carrier">
										<?php
										echo $this->Html->link(
											'<span class="btn btn-info remove_project fa fa-minus" style="height:30px;"></span>&nbsp;&nbsp;Delete project',
											'javascript:;',
											array(
												'class' => 'project-close-form',
												'escape' => false,
												'style' =>'display:' . ($i > 0 ? 'block' : 'none') . ';color:black;',
												)
											);
											?>
									</div>
								</div>
								<?php $i++; ?>
							<?php endforeach; ?>

						<?php else: ?>

							<?php echo $this->Form->input('UserCareerHistory.0.UserProject.0.id', array('type' => 'hidden')); ?>
							<div id=<?php echo "prj_apply_form[" . $key . "][0]"; ?> class="prj_apply_form">
								<div class="form-group">
									<div class="col-md-4 control-label cv_three_font letter_color">Project</div>
									<div class="col-md-6 selectContainer">

										<div class="form-group">
											<div class="col-md-10 col-sm-12 col-xs-12">
												<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group">Title</div>
												<div class="col-md-1"></div>
												<div class="col-md-9 col-sm-8 col-xs-10 input-group align">
												<!-- <div class="col-md-9 col-sm-9 col-xs-9 form-group"> -->
													<?php
														echo $this->Form->input('UserCareerHistory.' . $key . '.UserProject.0.title', array(
																'type' => 'text',
																'label' => false,
																'class' => 'form-control select_height',
																'autocomplete' => 'off' ,
																'placeholder' => 'e.g.) Internal ICT system renewal project',
																'style' => 'border-color: #C0C0C0; border-radius:3px;width:104%;'
															)
														);
													?>
												</div>
											</div>
										</div>

										<div class="clear"></div>

										<div class="form-group">
											<div class="col-md-10 col-sm-12 col-xs-12">
												<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group">Start</div>
												<div class="col-md-1"></div>
												<div class="input-group col-md-10 col-sm-6 col-xs-12 align">
													<div class="col-md-4 col-sm-4 col-xs-11 form-group">
														<?php
															echo $this->Form->input('UserCareerHistory.' . $key .'.UserProject.0.prj_start_month', array(
																	'type'=>'select',
																	'id'=>'smonth',
																	'options'=>$month,
																	'empty'=>'Month',
																	'label'=>false,
																	'class' => 'form-control cv_one_email select_height',
																	'style' => 'border-radius:3px;width:106%;'
																)
															); ?>
													</div>
													<div class="col-md-1"></div>
													<div class="col-md-4 col-sm-4 col-xs-11 form-group">
														<?php
															echo $this->Form->input('UserCareerHistory.' . $key .'.UserProject.0.prj_start_year', array(
																	'type'=>'select',
																	'id'=>'syear',
																	'options'=>$year,
																	'empty'=>'Year',
																	'class' => 'form-control select_height',
																	'label'=>false,
																	'style' => 'border-radius:3px;width:106%;'
																)
															);
														?>
													</div>
												</div>
											</div>
										</div>

										<div class="clear"></div>

										<div class="form-group mobile_bottom">
											<div class="col-md-10 col-sm-12 col-xs-12">
												<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group">End</div>
												<div class="col-md-1"></div>

												<div class="input-group col-md-10 col-sm-6 col-xs-12 align">
													<div class="col-md-4 col-sm-4 col-xs-11 form-group">
													<!-- <div class="col-md-4 form-group endMonthYear" > -->
														<?php
															echo $this->Form->input('UserCareerHistory.' . $key .'.UserProject.0.prj_end_month', array(
																	'type'=>'select',
																	'id'=>'smonth',
																	'options'=>$month,
																	'empty'=>'Month',
																	'label'=>false,
																	'class' => 'form-control cv_one_email select_height',
																	'style' => 'border-radius:3px;width:106%;'
																)
															);
														 ?>
													</div>
													<div class="col-md-1"></div>

													<div class="col-md-4 col-sm-4 col-xs-11 form-group">
														<?php
														echo $this->Form->input('UserCareerHistory.' . $key .'.UserProject.0.prj_end_year', array(
															'type'=>'select',
															'id'=>'syear',
															'options'=>$year,
															'empty'=>'Year',
															'class' => 'form-control  cv_one_email select_height',
															'label'=>false,
															'style' => 'border-radius:3px;width:106%;'
															)
														);
														?>
													</div>

													<div class="col-md-5 col-sm-4 col-xs-11 form-group">
														<?php
															echo $this->Form->input('UserCareerHistory.0.UserProject.0.current', array(
																'type' => 'checkbox',
																'class'=> 'support',
																'label' => array(
																	'text' => 'Current',
																	'class' => 'currentDesign',
																),
																'onchange' => 'onChange(this)',
															));
														?>
													</div>
												</div>
											</div>
										</div>

										<div class="clear"></div>

										<div class="form-group">
											<div class="col-md-10 col-sm-12 col-xs-10">
												<div class="col-md-1 control-label project_group">Detail</div>
												<div class="col-md-1"></div>
												<div class="col-md-9 col-sm-6 col-xs-12 input-group align">
													<?php
														echo $this->Form->input('UserCareerHistory.' . $key .'.UserProject.0.detail', array(
																'type' => 'textarea',
																'id'=>'jd_id',
																'label' => false,
																'class' => 'form-control',
																'autocomplete' => 'off' ,
																'placeholder' => '',
																'style' => 'border-color: #C0C0C0 ;border-radius:3px;width:106%;'
															)
														);
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-9"></div>

								 <div class="form-group col-md-8 career_minus minus_carrier" >
									<?php
										echo $this->Html->link(
											'<span class="btn btn-info fa fa-minus" style="height:30px;"></span>&nbsp;&nbsp;Delete project',
											'javascript:;',
											array(
												'class' => 'project-close-form ',
												'escape' => false,
												'style' => 'display:none;color:black;',
											)
										);
									?>
								</div>

							</div>
						<?php endif; ?>

						<div class="form-group col-md-8" id="language-add-btn">
							<span class="btn btn-info plus_carrier" id="add_project" >
								<i class="fa fa-plus" ></i>
							</span>&nbsp;&nbsp;
							Add Project
						</div>

						<div class="form-group col-md-8"></div>

						<div class="form-group col-md-8 minus_car minus_carrier" >
							<?php
							echo $this->Html->link(
								'<span class="btn btn-primary remove_exercise fa fa-minus" style="height: 32px;padding-top:9px;"></span>&nbsp;&nbsp;&nbsp;Delete Company',

								'javascript:;',
								array(
									'class' => 'close-form',
									'escape' => false,
									'style' => 'display:' . ($j > 0 ? 'block' : 'none') . ';color:black;',
									)
								);
								?>
						</div>

					</div>
				<?php $j++; ?>
				<?php endforeach; ?>

			<?php else: ?>
				<div id='apply_form[0]' class = 'apply-form'>
					<?php
						echo $this->Form->input('UserCareerHistory.0.user_id', array(
							'type' => 'hidden',
							'value' => $current_user_id
						));
					?>
					<div class="form-group">
						<div class="col-md-4 control-label cv_three_font letter_color">
							Company Name
							<span class="error">*</span>
						</div>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<?php
									echo $this->Form->input('UserCareerHistory.0.company_name', array(
										'type' => 'text',
										'id'=>'cmp_nameid',
										'required' => true,
										'label' => false,
										'class' => 'form-control select_height sel_width',
										'autocomplete' => 'off' ,
										'placeholder' => 'e.g.) SmartAlote Company Limited',
										'style' => 'border-color: #C0C0C0;border-radius:3px;width: 104%;'
									));
								?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-4 control-label cv_three_font letter_color">Department</div>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<?php
									echo $this->Form->input('UserCareerHistory.0.department', array(
										'type' => 'text',
										'id'=>'depart_id',
										'label' => false,
										'class' => 'form-control select_height',
										'autocomplete' => 'off' ,
										'placeholder' => 'e.g.) Marketing Department',
										'style' => 'border-color: #C0C0C0;border-radius:3px;width: 104%;'
									));
								?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-4 control-label cv_three_font letter_color">Position</div>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<?php
									echo $this->Form->input('UserCareerHistory.0.position', array(
										'type' => 'text',
										'label' => false,
										'class' => 'form-control select_height',
										'autocomplete' => 'off' ,
										'placeholder' => 'e.g.) Senior staff, Team manager, Account executive etc.',
										'style' => 'border-color: #C0C0C0;border-radius:3px;width: 104%;'
									));
								?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-4 control-label cv_three_font letter_color letter_color" >
							Joined Year/Month
							<span class="error">*</span>
						</div>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<div class="col-md-4 form-group">
									<?php
										echo $this->Form->input('UserCareerHistory.0.joined_month', array(
											'type'=>'select',
											'id'=>'smonth',
											'required' => true,
											'options'=>$month,
											'empty'=>'Month',
											'label'=>false,
											'class' => 'form-control cv_one_email select_height',
											'style' => 'border-radius:3px;width: 104%;'
										));
									?>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-4 form-group">
									<?php
										echo  $this->Form->input('UserCareerHistory.0.joined_year', array(
											'type'=>'select',
											'id'=>'syear',
											'required' => true,
											'options'=>$year,
											'empty'=>'Year',
											'class' => 'form-control select_height',
											'label'=>false,
											'style' => 'border-radius:3px;width: 104%;'
										));
									?>
								</div>
							</div>
						</div>

						<div class="col-md-4 control-label cv_three_font letter_color letter_color">
							Resignation
							<span class="error">*</span>
						</div>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<div class="col-md-4 form-group">
									<?php
										echo $this->Form->input('UserCareerHistory.0.resigned_month', array(
											'type'=>'select',
											'id'=>'smonth',
											'options'=>$month,
											'empty'=>'Month',
											'label'=>false,
											'class' => 'form-control cv_one_email select_height',
											'style' => 'border-radius:3px;width: 104%;'
										));
									?>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-4 form-group">
									<?php
										echo  $this->Form->input('UserCareerHistory.0.resigned_year', array(
											'type' => 'select',
											'id' => 'syear',
											'options' => $year,
											'empty' => 'Year',
											'class' => 'form-control select_height',
											'label' => false,
											'style' => 'border-radius:3px;width: 104%;'
										));
									?>
								</div>

								<div class="col-md-5 form-group">
									<?php
										echo $this->Form->input('UserCareerHistory.0.current', array(
											'type' => 'checkbox',
											'class'=> 'resign',
											'label' => array(
												'text' => 'Current',
												'class' => 'currentDesign',
											),
											'onchange' => 'onClick(this)',

										));
									?>
								</div>
							</div>
						</div>


						<div class="col-md-4 control-label cv_three_font letter_color">
							Industry
							<span class="error">*</span>
						</div>
						<div class='col-md-8'>
							<div class="col-md-3">
								<div class='form-group'>
									<?php
										echo $this->Form->input('UserCareerHistory.0.industry_big', array(
											'type'=>'select',
											'empty' => 'Choose Industry',
											'required' => true,
											'class' => 'form-control industry_big_normal select_height jobcate_width' ,
											'style' => 'width:104%',
											'options'=>$big_industry,
											'label'=>false
										));
									?>
								</div>
							</div>
							<div class="col-md-3 cv_four_jc jb_margin"><!-- margin-left:40px -->
								<div class='form-group' id="indi_small_one" >
									<?php
										echo $this->Form->input('UserCareerHistory.0.industry_small', array(
											'type'=>'select',
											'empty' => 'Choose Sub-category',
											'class' => 'form-control select_height jobcate_width',
											'style' => 'width:104%',
											'label'=>false
										));
									?>
								</div>
								<div class="form-group indi_small_two" >
									<?php
										echo $this->Form->input('UserCareerHistory.0.industry_small', array(
											'type' => 'select',
											'empty' => 'Choose Sub-category',
											'label' => false,
											'class' => 'form-control select_height',
											'style' => 'width:104%',
											'div' => array('class' => 'small-industry-blank')
										));
									?>
									<?php  foreach ($small_industry as $key_in_small => $val): ?>
										<?php
											echo  $this->Form->input('UserCareerHistory.0.industry_small', array(
												'type' => 'select',
												'empty' => 'Choose Sub-category',
												'options' => $val,
												'label' => false,
												'class' => 'form-control select_height jobcate_width',
												'style' => 'width:104%',
												'div' => array('class' => 'industry-small industry-small-'.$key_in_small)
											));
										?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>

						<div class="col-md-4 control-label cv_three_font letter_color">
							Job Category
							<span class="error">*</span>
						</div>
						<div class='col-md-8'>
							<div class="col-md-3">
								<div class='form-group'>
									<?php
										echo  $this->Form->input('UserCareerHistory.0.job_category', array(
											'type'=>'select',
											'empty' => 'Choose Job',
											'required' => true,
											'class' => 'form-control job_category_big_normal select_height jobcate_width',
											'style' => 'width:104%',
											'options' => $big_job,
											'label'=>false
										));
									?>
								</div>
							</div>
							<div class="col-md-3 cv_four_jc jb_margin">
								<div class='form-group' id="sub_job_one">
									<?php
										echo $this->Form->input('UserCareerHistory.0.job_category_sub', array(
											'type' => 'select',
											'empty' => 'Choose Sub-category',
											'label' => false,
											'class' => 'form-control select_height jobcate_width',
											'style' => 'width:104%',
											'div' => array('class' => 'small-job-blank')
										));
									?>
								</div>
								<div class='form-group sub_job_two'>
									<?php
										echo $this->Form->input('UserCareerHistory.0.job_category_sub', array(
											'type' => 'select',
											'empty' => 'Choose Sub-category',
											'label' => false,
											'class' => 'form-control select_height',
											'style' => 'width:104%',
											'div' => array('class' => 'small-job-blank')
										));
									?>
									<?php foreach ($small_job as $jkey => $jval): ?>
										<?php
											echo  $this->Form->input('UserCareerHistory.0.job_category_sub', array(
												'type' => 'select',
												'empty' => 'Choose Sub-category',
												'options' => $jval,
												'label' => false,
												'class' => 'form-control select_height jobcate_width',
												'style' => 'width:104%',
												'div' => array('class' => 'small-job small-job-' . $jkey)
											));
										?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>


					<?php echo $this->Form->input('UserCareerHistory.0.UserProject.0.id', array('type' => 'hidden')); ?>
					<div id="prj_apply_form[0][0]" class="prj_apply_form">
						<div class="form-group" >
							<div class="col-md-4 control-label cv_three_font letter_color">Project</div>
							<div class="col-md-6 selectContainer">
								<div class="form-group">
									<div class="col-md-10 col-sm-12 col-xs-12">
										<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group">Title</div>
										<div class="col-md-1"></div>
										<div class="col-md-9 col-sm-8 col-xs-10 input-group align">
											<?php
												echo $this->Form->input('UserCareerHistory.0.UserProject.0.title', array(
													'type' => 'text',
													'label' => false,
													'class' => 'form-control select_height',
													'autocomplete' => 'off' ,
													'placeholder' => 'e.g.) Internal ICT system renewal project',
													'style' => 'border-color: #C0C0C0; border-radius:3px;width: 104%;'
												));
											?>
										</div>
									</div>
								</div>

								 <div class="form-group">
									<div class="col-md-10 col-sm-12 col-xs-12">
										<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group" ">Start</div>
										<div class="col-md-1"></div>
										<div class="input-group col-md-10 col-sm-6 col-xs-12 align">
											<div class="col-md-4 col-sm-4 col-xs-11 form-group">
												<?php
													echo $this->Form->input('UserCareerHistory.0.UserProject.0.prj_start_month', array
														(
															'type'=>'select',
															'id'=>'smonth',
															'options'=>$month,
															'empty'=>'Month',
															'label'=>false,
															'class' => 'form-control cv_one_email select_height',
															'style' => 'border-radius:3px;width: 104%;'
														)
													);
												?>
											</div>
											<div class="col-md-1"></div>
											<div class="col-md-4 col-sm-4 col-xs-11 form-group">
												<?php
													echo $this->Form->input('UserCareerHistory.0.UserProject.0.prj_start_year', array(
														'type'=>'select',
														'id'=>'syear',
														'options'=>$year,
														'empty'=>'Year',
														'class' => 'form-control select_height',
														'label'=>false,
														'style' => 'border-radius:3px;width: 104%;'
													));
												?>
											</div>
										</div>
									</div>
								</div>


								 <div class="form-group mobile_bottom">
									<div class="col-md-10 col-sm-12 col-xs-12">
										<div class="col-md-1 col-sm-8 col-xs-8 control-label project_group">End</div>
										<div class="col-md-1"></div>
										<div class="input-group col-md-10 col-sm-6 col-xs-12 align">
											<div class="col-md-4 col-sm-4 col-xs-11 form-group">
												<?php
													echo $this->Form->input('UserCareerHistory.0.UserProject.0.prj_end_month', array(
														'type'=>'select',
														'id'=>'smonth',
														'options'=>$month,
														'empty'=>'Month',
														'label'=>false,
														'class' => 'form-control cv_one_email select_height',
														'style' => 'border-radius:3px;width: 104%;'
													));
												?>
											</div>
											<div class="col-md-1"></div>
											<div class="col-md-4 col-sm-4 col-xs-11 form-group">
												<?php
													echo $this->Form->input('UserCareerHistory.0.UserProject.0.prj_end_year', array(
														'type'=>'select',
														'id'=>'syear',
														'options'=>$year,
														'empty'=>'Year',
														'class' => 'form-control  cv_one_email select_height',
														'label'=>false,
														'style' => 'border-radius:3px;width: 104%;'
													));
												?>
											</div>

											<div class="col-md-5 col-sm-4 col-xs-11 form-group">
												<?php
													echo $this->Form->input('UserCareerHistory.0.UserProject.0.current', array(
														'type' => 'checkbox',
														'class'=> 'support',
														'label' => array(
															'text' => 'Current',
															'class' => 'currentDesign',
														),
														'onchange' => 'onChange(this)',
													));
												?>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-10 col-sm-12 col-xs-10">
										<div class="col-md-1 control-label project_group">Detail</div>
										<div class="col-md-1"></div>
										<div class="col-md-9 col-sm-6 col-xs-12 input-group align">
											<?php
												echo $this->Form->input('UserCareerHistory.0.UserProject.0.detail', array(
													'type' => 'textarea',
													'id'=>'jd_id',
													'label' => false,
													'class' => 'form-control',
													'autocomplete' => 'off' ,
													'placeholder' => '',
													'style' => 'border-color: #C0C0C0 ;border-radius:3px;width: 104%;'
												));
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-9"></div>
						<div class=" form-group col-md-8 project-close-form career_minus minus_carrier" style="display: none;">
							<span class="btn btn-info  remove-project ">
								<i class="fa fa-minus" ></i>
							</span>&nbsp;&nbsp;
							Delete Project
						</div>
					</div>

					<div class="form-group col-md-8" id="language-add-btn">
						<span class="btn btn-info plus_carrier" id="add_project">
							<i class="fa fa-plus" ></i>
						</span>&nbsp;&nbsp;
						Add Project
					</div>


					<div class="col-md-8"></div>

					<div class="form-group col-md-8 minus_car minus_carrier">
						<?php
						echo $this->Html->link(
							'<span class="btn btn-primary remove_exercise fa fa-minus" style="height: 32px;padding-top:9px;"></span>&nbsp;&nbsp;&nbsp;Delete Company',
							'javascript:;',
							array(
								'class' => 'close-form',
								'escape' => false,
								'style' => 'display:none;color:black;',
								)
							);
							?>
						</div>
				</div>
			<?php endif; ?>

			<?php if(isset($experience_count)):?>
				<?php if($experience_count < 5):?>
					<div class="form-group col-md-5" id="language-add-btn" >
						<span class="btn btn-primary career_company_plus" id="add_exercise" style="">
							<i class="fa fa-plus" ></i>
						</span>&nbsp;&nbsp;
						Add Company
					</div>
				<?php else:?>
					<div class="form-group col-md-5" id="language-add-btn" style="display: none;">
						<span class="btn btn-primary career_company_plus" id="add_exercise" style="">
							<i class="fa fa-plus" ></i>
						</span>&nbsp;&nbsp;
						Add Company
					</div>
				<?php endif;?>
			<?php else:?>
				<div class="form-group col-md-5" id="language-add-btn" >
					<span class="btn btn-primary career_company_plus" id="add_exercise" style="">
						<i class="fa fa-plus" ></i>
					</span>&nbsp;&nbsp;
					Add Company
				</div>
			<?php endif;?>
		</div>

		<div class="col-md-12 col-sm-6 col-xs-12 btn_save_cancel" >
			<div class="col-md-3"></div>
			<div class="col-md-3 btn_cancel">
				<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'mypages', 'action' => 'mypage'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'cv-cancel')); ?>
			</div>
			<div class="hidden-md hidden-lg height_btn" ></div>
			<div class="col-md-3 btn_save">
				<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'cv-save','id' => 'save' , 'autocomplete' => 'off')); ?>
			</div>
		</div>
	<?php echo $this->Form->end(); ?>
</div>

<style>
	.align {
		margin-left: 15px;
	}
	.currentDesign {
		margin-left: 6px;
		font-size: 16px;
		margin-top: 9px;
	}

	.heading, .error-message {
		color: red;
	}
	/*PC view*/
	@media screen and (min-width: 600px) {
		div .jb_margin {
			margin-left:40px;
		}
		.main_current {
			margin-left: 25px !important; margin-top: 7px;
		}

		.sub_current{
			margin-left: 25px !important;
		}

		.checkbox_experience {
			margin-left: 44px !important;
		}
		.no_experience{
			margin-left: -19px;
		}
		.support, .resign {
			margin-left: 20px !important;
			margin-top: 10px !important;
		}
		a:hover { text-decoration: none !important;} ;
		.project_group {
			padding-left: 0px !important;
		}

	}

	/*mobile view*/
	@media screen and (max-width: 600px) {
		.main_current {
			margin-left: 2px !important; margin-top: 7px;
		}

		.sub_current{
			margin-left: 25px !important;
		}

		a:hover { text-decoration: none !important;} ;
	}
</style>

<script type="text/javascript">
//auto disable for all
	$( window ).on( "load", function() {
		if($(".experience_count").val() == ''){
			$('#elementsToOperateOn :input').attr('disabled', true);
			$('#add_exercise').attr('disabled',true);
			$('#add_project').attr('disabled',true);
		}
	});
//for choose select box for Industry
	$('.indi_small_two').hide();
	$('#indi_small_one').show();

	// for project's current check box.
	function onChange(obj) {
		if ($(obj).is(':checked')) {

			$(obj).parent().parent().find('select').children('option').removeAttr('selected');

			$(obj).parent().parent().find('select option[value=""]').attr('selected', true);
			$(obj).parent().parent().find('select').attr('disabled', true);
		} else {
			$(obj).parent().parent().find('select').attr('disabled', false);
		}
	}

	// for company's current check box.
	function onClick(obj) {
		if ($(obj).is(':checked')) {

			$(obj).parent().parent().find('select').children('option').removeAttr('selected');

			$(obj).parent().parent().find('select option[value=""]').attr('selected', true);
			$(obj).parent().parent().find('select').attr('disabled', true);
		} else {
			$(obj).parent().parent().find('select').attr('disabled', false);
		}
	}

	$(document).ready(function(){
		$('select[class*="industry_big_normal"]').each(function(ind, obj){
			var industryId = $(this).val();
			$(this).parents('.apply-form').find('.indi_small_two').show();
			$(this).parents('.apply-form').find('#indi_small_one').hide();
			$(this).parents('.apply-form').find('.industry-small').show();
			$(this).parents('.apply-form').find('.small-industry-blank').hide();
			$(this).parents('.apply-form').find('.small-industry-blank').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.industry-small').children().hide();
			$(this).parents('.apply-form').find('.industry-small').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.industry-small-'+industryId).children().show();
			$(this).parents('.apply-form').find('.industry-small-'+industryId).children('select').removeAttr('disabled');
		});

		$('select[class*="job_category_big_normal"]').each(function(ind, obj){
			var jobId = $(this).val();
			$(this).parents('.apply-form').find('.sub_job_two').show();
			$(this).parents('.apply-form').find('#sub_job_one').hide();
			$(this).parents('.apply-form').find('.small-job').show();
			$(this).parents('.apply-form').find('.small-job-blank').hide();
			$(this).parents('.apply-form').find('.small-job-blank').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.small-job').children().hide();
			$(this).parents('.apply-form').find('.small-job').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.small-job-'+jobId).children().show();
			$(this).parents('.apply-form').find('.small-job-'+jobId).children('select').removeAttr('disabled');
		});
	});

	$(document).on('change','select[class*="industry_big_normal"]',function() {
		var industryId = $(this).val();
		if (industryId == "") {
			$(this).parents('.apply-form').find('.small-industry-blank').show();
			$(this).parents('.apply-form').find('.industry-small').hide();
			$(this).parents('.apply-form').find('.industry-small').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.small-industry-blank').children('select').removeAttr('disabled');
		} else {
			$(this).parents('.apply-form').find('.indi_small_two').show();
			$(this).parents('.apply-form').find('#indi_small_one').hide();
			$(this).parents('.apply-form').find('.industry-small').show();
			$(this).parents('.apply-form').find('.small-industry-blank').hide();
			$(this).parents('.apply-form').find('.small-industry-blank').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.industry-small').children().hide();
			$(this).parents('.apply-form').find('.industry-small').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.industry-small-'+industryId).children().show();
			$(this).parents('.apply-form').find('.industry-small-'+industryId).children('select').removeAttr('disabled');
		}
	});

	//for choose select box for Job
	$('.sub_job_two').hide();
	$('#sub_job_one').show();

	$(document).on('change','select[class*="job_category_big_normal"]',function() {
		var jobId = $(this).val();
		if (jobId == "") {
			$(this).parents('.apply-form').find('.small-job-blank').show();
			$(this).parents('.apply-form').find('.small-job').hide();
			$(this).parents('.apply-form').find('.small-job').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.small-job-blank').children('select').removeAttr('disabled');
		} else {
			$(this).parents('.apply-form').find('.sub_job_two').show();
			$(this).parents('.apply-form').find('#sub_job_one').hide();
			$(this).parents('.apply-form').find('.small-job').show();
			$(this).parents('.apply-form').find('.small-job-blank').hide();
			$(this).parents('.apply-form').find('.small-job-blank').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.small-job').children().hide();
			$(this).parents('.apply-form').find('.small-job').children('select').attr('disabled', 'disabled');
			$(this).parents('.apply-form').find('.small-job-'+jobId).children().show();
			$(this).parents('.apply-form').find('.small-job-'+jobId).children('select').removeAttr('disabled');
		}
	});

////////////////////////////////////
//for plus button clone

	// add company
	$(document).on('click', '#add_exercise', function(){
		// if($('.apply-form').length == 4){
		// 	// $('#add_exercise').hide();
		// 	// $('#language-add-btn').hide();
		// }
		var cnt = $('.apply-form').length -1;
		if (cnt == 4) return;
		var add = $(this).parents('.applyForm').children('#apply_form\\[' + cnt + '\\]');

		cnt++;
		add
		.clone()
		.hide()
		.insertAfter(add)
		.attr('id', 'apply_form[' + cnt + ']')
		.find('input, textarea, select, label').each(function(idx, obj) {
			// for attribute label.
			if ($(obj).prop('tagName').toLowerCase() == 'label') {

				$(obj).attr({
					for: $(obj).attr('for').replace(/[0-9]+$/, cnt),
				});
			}
			else {
				// for select and input.
				$(obj).attr({
					id: $(obj).attr('id').replace(/[0-9]+$/, cnt),
					name: $(obj).attr('name').replace(/\[UserCareerHistory\]\[[0-9]\]/, '[UserCareerHistory][' + cnt + ']').replace(/\[UserCareerHistory\]\[[0-9]\]\[UserProject\]/, '[UserCareerHistory][' + cnt + '][UserProject]')
				});

				$(obj).attr("disabled", false);
				// can't give empty value to hidden input.
				if ($(obj).attr('type') != 'hidden' && $(obj).attr('type') != 'checkbox') {
					$(obj).val('');
				}

				if (cnt == 4) {
					$(obj).parents().children().children('#add_exercise').parent().hide();
				}
			}
			// for attribute text.
			if ($(obj).attr('type') == 'text'){
				$(obj).val('');
			}

			if ($(obj).attr('type') == 'checkbox'){
				$(obj).prop('checked', false);
			}
			// for attribute textarea.
			if($(obj).prop('tagName').toLowerCase() == 'textarea')
			{
				$(obj).val('');
			}

			$(obj).removeClass('form-error');
			$(obj).parents('.form-group').removeClass('error has-error');

			$(obj).parents().children().remove('.error-message');

			$(obj).parent().children('span').remove();
		});

		var clone = $('#apply_form\\[' + cnt + '\\]');
		clone.find('.prj_apply_form').attr('id', 'prj_apply_form['+ cnt +'][0]');
		clone.find(".prj_apply_form:not(:first)").remove();
		clone.find('.close-form').show();
		clone.find('#UserCareerHistory0UserProject0Id').val('');
		clone.slideDown('fast');
	});

	// remove company
	$(document).on('click', '.remove_exercise', function(){
		var removeObj = $(this).parents('.apply-form');
		// if($('.apply-form').length == 5){
		// 	$('#add_exercise').show();
		// }
		removeObj.fadeOut('fast', function() {
			removeObj.remove();

			cnt = 0;
			$("[id^='apply_form']").each(function(idx, obj) {
				if ($(obj).attr('id') != 'apply_form[0]') {
					cnt++;

					$(obj)
					.attr('id', 'apply_form[' + cnt + ']')
					.find('input, textarea, select').each(function(idx, obj) {
						// for select and input.
						$(obj).attr({
							id: $(obj).attr('id').replace(/[0-9]+$/, cnt),
							name: $(obj).attr('name').replace(/\[UserCareerHistory\]\[[0-9]\]/, '[UserCareerHistory][' + cnt + ']').replace(/\[UserCareerHistory\]\[[0-9]\]\[UserProject\]/, '[UserCareerHistory][' + cnt + '][UserProject]')
						});
					});

					// $(obj).children().attr({
					// 	name: $(obj)
					// 		.children('.form-group')
					// 		.attr('name')
					// 		.replace(/\[UserCareerHistory\]\[[0-9]\]/, '[UserCareerHistory][' + cnt + ']')
					// 		.replace(/\[UserCareerHistory\]\[[0-9]\]\[UserProject\]/, '[UserCareerHistory][' + cnt + '][UserProject]')
					// });

					counter = 0;
					$("[id^='prj_apply_form[" + (cnt+1) + "]']").each(function(idx, obj) {
						$(obj)
						.attr('id', 'prj_apply_form[' + cnt + '][' + counter + ']')
						counter++;
					});
				}

				if (cnt != 4) {
					$(obj).parents().children('#language-add-btn').show();
				}
			});

		});
	});

	// add project
	$(document).on('click', '#add_project', function(){

		var main_career_history = $(this).parent().parent();
		var counter = main_career_history.find('.prj_apply_form').length - 1;

		if (counter == 4) return;
		var curr_index = $('.apply-form').index(main_career_history);

		var add = $(document).find('#prj_apply_form\\[' + curr_index+ '\\]\\[' + counter + '\\]');
		counter++;
		add
		.clone()
		.insertAfter(add)
		.attr('id', 'prj_apply_form[' + curr_index+ '][' + counter+ ']')
		.find('input, textarea, select, label, checkbox').each(function(idx, obj) {
			if ($(obj).prop('tagName').toLowerCase() == 'label') {
				$(obj).attr({
					for: $(obj).attr('for').replace(/[0-9]+$/, counter),
				});
			}
			else {
				$(obj).attr({
					id: $(obj).attr('id').replace(/[0-9]+$/, counter),
					name: $(obj).attr('name').replace(/\[UserProject\]\[[0-9]\]/, '[UserProject][' + counter + ']')
				});
				$(obj).val('');
				$(obj).attr("disabled", false);
			}

			if ($(obj).attr('type') == 'checkbox'){
				$(obj).prop('checked', false);
				$(obj).val(1);
			}

			if ($(obj).attr('type') == 'text'){
				$(obj).val('');
			}
			if($(obj).prop('tagName').toLowerCase() == 'textarea')
			{
				$(obj).val('');
			}
			$(obj).removeClass('form-error');$(obj).parents('.form-group').removeClass('error has-error');
			$(obj).parents().children().remove('.error-message');
			$(obj).parent().children('span').remove();
		});

		var clone = $('#prj_apply_form\\[' + curr_index+ '\\]\\[' + counter+ '\\]');
		clone.find('.project-close-form').show();
		clone.slideDown('fast');
	});

	// remove project
	$(document).on('click', '.project-close-form', function(){
		var main_career_history = $(this).parent().parent().parent();
		var removeObj = $(this).parents('.prj_apply_form');

		removeObj.fadeOut('fast', function() {
			removeObj.remove();
			// 番号振り直し
			var counter = 0;
			var curr_index = $('.apply-form').index(main_career_history);

			$("[id^='prj_apply_form[" + curr_index + "]']").each(function(idx, obj) {
				if ($(obj).attr('id') != 'prj_apply_form[' + curr_index + '][' + counter + ']') {
					counter++;
					$(obj)
						.attr('id', 'prj_apply_form[' + curr_index + '][' + counter + ']');
				}
			});

		});
	});

	function toggleStatus() {
		if ($('#toggleElement').is(':checked')) {
			$('#elementsToOperateOn :input').attr('disabled', true);
			$('#add_exercise').attr('disabled',true);
			$('#add_project').attr('disabled',true);
		} else {
			$('#elementsToOperateOn :input').removeAttr('disabled');
			$('#add_exercise').removeAttr('disabled');
			$('#add_project').removeAttr('disabled');
		}
	}

	// redesign the validation error message.
	$(document).ready(function() {
		if ($('.error-message').length) {

			// get the parent div.
			var par = $('.error-message').parent().parent();
			// detach the div.
			var validateMessage = $('.error-message').detach();
			validateMessage.addClass('col-md-12 col-xs-12');
			validateMessage.css('margin-top', '-2%');
			validateMessage.css('margin-left', '-3%');

			// add detached div to its corresponding parent div.
			$.each(par, function(index, value) {
				par[index].append(validateMessage[index]);
			});
		}
	});
</script>