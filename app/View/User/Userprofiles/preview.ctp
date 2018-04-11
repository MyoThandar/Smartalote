<div class="container" style="margin-top:30px; background-color:">
	<div class="col-md-7">
		<div class="col-md-3" ></div>
		<div class="col-md-4 name_mobil" ><b><h3><?php if(!empty($userdata['User']['name'])) echo $userdata['User']['name'];?></h3></b></div>
	</div>
	<div class="col-md-9">
		<?php if (!empty($userdata['User']['image'])) : ?>
			<div class="col-md-2 col-xs-8 " >
				<?php echo $this->Html->image($userdata['User']['image'], array('alt' => 'story image','class'=>'img-thumbnail size_img_CV')); ?>
			</div>
		<?php endif; ?>

		<div class="col-md-4 col-xs-12 col-sm-12"  >
			<div class="col-md-6 col-xs-6 col-sm-6" >
				<label>Gender</label>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6">
				<p>
					<?php $gender=array(1=>'male',2=>'female');?>
					<?php if(!empty($userdata['User']['gender'])) echo ":". $gender[$userdata['User']['gender']];?>
				</p>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6" >
				<label>BirthdayDate</label>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6">
				<p>
					<?php if(!empty($userdata['User']['birthday'])) echo ":". date('d M Y', strtotime($userdata['User']['birthday']));?>
				</p>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6" >
				<label>Address</label>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6 ">
				<p>
					<?php if(!empty($userdata['User']['address'])) echo ":". $userdata['User']['address'];?>
					<?php if(empty($userdata['User']['address'])) echo ":"."EmptyData";?>
				</p>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6" >
				<label>PhoneNumber</label>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6">
				<p>
					<?php $phtypes=array(1=>'Home',2=>'Mobile',3=>'Work');?>
					<?php if(!empty($userdata['User']['phone_number']))
					echo ':&nbsp'. $userdata['User']['phone_number'];?>
					<?php if(empty($userdata['User']['phone_number']))
					echo ':'."EmptyData";?>
				</p>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6" >
				<label>Email</label>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6 ">
				<p>
					<?php if(!empty($userdata['User']['email']))  echo ":". $userdata['User']['email'];?>
				</p>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6" >
				<label>EmployeeID</label>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6">
				<p>
					<?php  if(!empty($userdata['User']['jobseeker_id']))  echo ":". $userdata['User']['jobseeker_id'];?>
				</p>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6" >
				<label>UpdatedDate</label>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6">
				<p>
					<?php if(!empty($userdata['User']['modified'])) echo ":".date('M Y', strtotime($userdata['User']['modified'])); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-9 col-xs-12 download_css">
		<?php echo $this->Html->link('Download', array('controller' => 'userprofiles', 'action' => 'profilePdf',$userdata['User']['id']),array('class'=>'btn btn-success col-md-2 col-xs-5 col-sm-2'));?>
		<?php echo $this->Html->link('Edit', array('controller' => 'userprofiles', 'action' => 'edit',$userdata['User']['id']),array('class'=>'btn btn-warning col-md-2 col-xs-5 col-sm-2'));?>
	</div>
</div>
<div class="container" style="" >
<!-- Language Skill -->
	<div class="col-md-12 " >
		<h4 class="head_line">Language Skill</h4>
		<p>
			<?php foreach($userdata['UserLanguageSkill'] as $key => $value):?>
				<?php if(!empty($value['language']) && !empty($value['skill'])):?>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo $value['language'];?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo ":". $language_skill[$value['skill']];?>
						</div>
					</div>
				<?php endif;?>
				<div class="clear"></div>
			<?php endforeach;?>
		</p>
	</div>

<!-- Education -->
	<div class="col-md-12 " >
		<h4 class="head_line">Education</h4>
		<p>
			<?php foreach($userdata['UserEducation'] as $key => $value):?>
				<div class="col-md-10" style="padding-left:30px;">
					<div class="col-md-3" style="padding-top:5px">
						<?php echo date('M Y', strtotime($value['enrollment'])).' ~ '.date('M Y', strtotime($value['graduation'])); ?>
					</div>
					<div class="col-md-6" style="padding-top:5px;" >
						<?php if(!empty($value['university_name'])) echo $value['university_name'];?><br>
						<?php if(!empty($value['department'])) echo $value['department'];?><br>
						<?php if(!empty($value['degree'])) echo $edu[$value['degree']];?>
					</div>
					<br><br><br>
				</div>
				<div class="clear"></div>
			<?php endforeach;?>
		</p>
	</div>

<!-- Career History -->
	<div class="col-md-12">
		<h4 class="head_line">Work Experience</h4>
		<p>
			<?php if (!empty($user_career)) : ?>
				<?php foreach ($user_career as $career_key => $career_value) : ?>
					<?php if ($career_key == 0) : ?>
							<div><?php echo " 1st Company"; ?></div>
						<?php elseif ($career_key == 1) : ?>
							<div >
								<?php echo " 2nd Company"; ?>
							</div>
						<?php elseif ($career_key == 2) : ?>
							<div>
								<?php echo " 3rd Company"; ?>
							</div>
						<?php else : ?>
							<div>
								<?php $career_key_plus =  $career_key+1;?>
								<?php echo $career_key_plus.'th Company' ;?>
							</div>
						<?php endif ; ?>
				<!-- Companies -->
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Company name"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $career_value['UserCareerHistory']['company_name']; ?>
						</div>
					</div>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Department"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $career_value['UserCareerHistory']['department']; ?>
						</div>
					</div>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Position"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $career_value['UserCareerHistory']['position']; ?>
						</div>
					</div>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Joined date"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo date('M Y', strtotime($career_value['UserCareerHistory']['joined_y_m'])); ?>
						</div>
					</div>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Resignation"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo date('M Y', strtotime($career_value['UserCareerHistory']['resignation'])); ?>
						</div>
					</div>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Industry"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $industryb[$career_value['UserCareerHistory']['industry_big_id']].' / '.$industrys[$career_value['UserCareerHistory']['industry_small_id']]; ?>
						</div>
					</div>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Jobcategory"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $categoryb[$career_value['UserCareerHistory']['job_category_id']].' / '.$categorys[$career_value['UserCareerHistory']['job_category_sub_id']]; ?>
						</div>
					</div>
				<!-- Project -->
					<?php  foreach ($career_value['UserProject'] as $proj_key => $proj_value) : ?>
						<?php if ($proj_key == 0) : ?>
							<div class="col-md-6"><?php echo " 1st Project"; ?></div>
						<?php elseif ($proj_key == 1) : ?>
							<div class="col-md-6"><?php echo " 2nd Project"; ?></div>
						<?php elseif ($proj_key == 2) : ?>
							<div class="col-md-6"><?php echo " 3rd Project"; ?></div>
						<?php  else : ?>
							<?php $proj_key_plus =  $proj_key+1;?>
							<div class="col-md-6"><?php  echo $proj_key_plus.'th Project' ;?></div>
						<?php endif ; ?>
						<div class="col-md-10" style="padding-left:30px;">
							<div class="col-md-3" style="padding-top:5px">
								<?php echo "Title"; ?>
							</div>
							<div class="col-md-6" style="padding-top:5px;" >
								<?php echo $proj_value['title']; ?>
							</div>
						</div>
						<div class="col-md-10" style="padding-left:30px;">
							<div class="col-md-3" style="padding-top:5px">
								<?php echo "Period"; ?>
							</div>
							<div class="col-md-6" style="padding-top:5px;" >
								<?php echo date('M Y', strtotime($proj_value['period_start'])).'~'.date('M Y', strtotime($proj_value['period_end'])); ?>
							</div>
						</div>
						<div class="col-md-10" style="padding-left:30px;">
							<div class="col-md-3" style="padding-top:5px">
								<?php echo "Detail"; ?>
							</div>
							<div class="col-md-6" style="padding-top:5px;" >
								<?php echo $proj_value['detail']; ?>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="clear"></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</p>
	</div>


<!--Microsoft office  -->
	<div class="col-md-12 " >
		<h4 class="head_line">Microsoft office</h4>
		<p>
			<?php if (!empty($user_computing)) : ?>
				<?php foreach ($user_computing as $comkey => $comvalue) : ?>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo $comvalue['UserComputingSkill']['title'];?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $ms_skill[$comvalue['UserComputingSkill']['skill']];?>
						</div>
					</div>
					<div class="clear"></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</p>
	</div>

<!-- Qualification -->
	<div class="col-md-12 " >
		<h4 class="head_line">Qualification</h4>
		<p>
			<?php if (!empty($user_qualification)) : ?>
				<?php foreach ($user_qualification as $quali_key => $quali_value) : ?>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "University name"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $quali_value['UserQualification']['qualification_name']; ?>
						</div>
					</div>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Qualification date"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $quali_value['UserQualification']['qualification_date']; ?>
						</div>
					</div>
					<div class="clear"></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</p>
	</div>

<!-- Special instruction -->
	<div class="col-md-12 " >
		<h4 class="head_line">Special instruction </h4>
		<p>
			<?php if (!empty($user_instruction)) : ?>
				<?php foreach ($user_instruction as $instruct_key => $instruct_value) : ?>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Title"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $instruct_value['UserSpecialInstruction']['title']; ?>
						</div>
					</div>
					<div class="col-md-10" style="padding-left:30px;">
						<div class="col-md-3" style="padding-top:5px">
							<?php echo "Detail"; ?>
						</div>
						<div class="col-md-6" style="padding-top:5px;" >
							<?php echo $instruct_value['UserSpecialInstruction']['detail']; ?>
						</div>
					</div>
					<div class="clear"></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</p>
	</div>

<!-- Expected salary, Executive summary, Core skill -->
	<div class="col-md-12 " >
		<h4 class="head_line">Expected salary, Executive summary, Core skill</h4>
		<p>
			<div class="col-md-10" style="padding-left:30px;">
				<div class="col-md-3" style="padding-top:5px">
					<?php echo "Expected salary"; ?>
				</div>
				<div class="col-md-6" style="padding-top:5px;" >
					<?php echo $salary[$user_core[0]['UserCoreSkill']['expected_salary']]; ?>
				</div>
			</div>
			<div class="col-md-10" style="padding-left:30px;">
				<div class="col-md-3" style="padding-top:5px">
					<?php echo "Current salary"; ?>
				</div>
				<div class="col-md-6" style="padding-top:5px;" >
					<?php echo $salary[$user_core[0]['UserCoreSkill']['current_salary']]; ?>
				</div>
			</div>
			<div class="col-md-10" style="padding-left:30px;">
				<div class="col-md-3" style="padding-top:5px">
					<?php echo "Current benefit"; ?>
				</div>
				<div class="col-md-6" style="padding-top:5px;" >
					<?php echo $user_core[0]['UserCoreSkill']['current_benefits']; ?>
				</div>
			</div>
			<div class="col-md-10" style="padding-left:30px;">
				<div class="col-md-3" style="padding-top:5px">
					<?php echo "Availability"; ?>
				</div>
				<div class="col-md-6" style="padding-top:5px;" >
					<?php if (!empty($user_core[0]['UserCoreSkill']['availiability'])) : ?>
						<?php echo $availability[$user_core[0]['UserCoreSkill']['availiability']]; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-md-10" style="padding-left:30px;">
				<div class="col-md-3" style="padding-top:5px">
					<?php echo "Executive summary"; ?>
				</div>
				<div class="col-md-6" style="padding-top:5px;" >
					<?php echo $user_core[0]['UserCoreSkill']['executive_summary']; ?>
				</div>
			</div>
			<div class="col-md-10" style="padding-left:30px;">
				<div class="col-md-3" style="padding-top:5px">
					<?php echo "Core skills"; ?>
				</div>
				<div class="col-md-6" style="padding-top:5px;" >
					<?php echo $user_core[0]['UserCoreSkill']['core_skill']; ?>
				</div>
			</div>
			<div class="clear"></div>
		</p>
	</div>
</div>