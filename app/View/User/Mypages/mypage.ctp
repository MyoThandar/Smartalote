<div class="container cborder">
	<section class="cv-top">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -2%;margin-top: 1%;">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="cv-top-left">
						<h2 class="cv-name">
							<?php if (!empty($userInfo['User']['name'])): ?>
								<b><?php echo $userInfo['User']['name']; ?></b>
							<?php endif; ?>
						</h2>
					</div>
				</div>

				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="cv-top-right pull-right">
						<span class="cv-id">
							Employee ID :
							<?php if (!empty($userInfo['User']['jobseeker_id'])): ?>
								<?php echo $userInfo['User']['jobseeker_id']; ?>
							<?php endif; ?>
						</span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="cv-download-btn">
							<?php echo $this->Html->link(__('Download CV'), array('controller' => 'mypages', 'action' => 'profilePdf', 'ext' => 'pdf', $userInfo['User']['id']), array('class' => 'btn btn-orange'));?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="cv-personal-info" >
		<div class="row" >
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12 cv-title">
					<div class="col-md-4 col-xs-9 mypage-header" style="margin-top: 0.25em;">
						<h3>
							<div class="col-md-2 col-xs-3">
								<span>1</span>
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-xs hidden-sm">
								Personal Info
							</div>
							<div class="col-md-10 col-xs-7 long-header hidden-md hidden-lg" >
								<h4 style="margin-top: 4px !important;">Personal Info</h4>
							</div>
						</h3>
					</div>
					<div class="col-md-3 col-xs-2 mypage-button">
						<h3>
							<?php
								echo $this->Html->link('Edit', array(
									'controller' => 'mypages',
									'action' => 'personalInfoUpdate'), array(
									'class' => 'btn btn-blue short-header'
								));
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="row" style="border: 1px solid red;"> -->
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php if (!empty($userInfo['User']['image_url'])): ?>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<div class = "resize-img" style="width: 200px; height: 200px; border: 2px solid #084B8A; overflow: hidden; position: relative;margin-left: -7%;">
							<?php echo $this->Html->image($userInfo['User']['image_url'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($userInfo['User']['image_url'])) : ?>
					<div class="col-md-9 col-sm-12 col-xs-12 none_padding" style="margin-left: -7%;">
				<?php else : ?>
					<div class="col-md-9 col-sm-12 col-xs-12 none_padding" style="margin-left: -5%;">
				<?php endif; ?>

					<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Gender
						</div>
						<div class="col-sm-1 col-xs-1">
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
							<?php if (!empty($userInfo['User']['gender'])): ?>
								<?php $gender=array(1=>'male',2=>'female');?>
								<?php echo $gender[$userInfo['User']['gender']]; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 none_padding" >
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Birth date
						</div>
						<div class="col-sm-1 col-xs-1">
							&ratio;
						</div>
						<div class="col-md-10 col-scol-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['birthday'])): ?>
								<?php echo date('d M Y', strtotime($userInfo['User']['birthday'])); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Nationality
						</div>
						<div class="col-sm-1 col-xs-1" >
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['nationality'])): ?>
								<?php echo $nationality[$userInfo['User']['nationality']]; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Region
						</div>
						<div class="col-sm-1 col-xs-1">
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['location'])): ?>
								<?php echo $location[$userInfo['User']['location']]; ?>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="padding-bottom: 4px;">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Address
						</div>
						<div class="col-sm-1 col-xs-1">
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['address'])): ?>
								<?php echo nl2br($userInfo['User']['address']); ?>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 none_padding" >
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Phone Number
						</div>
						<div class="col-sm-1 col-xs-1" >
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['phone_number'])): ?>
								<?php echo $userInfo['User']['phone_number']; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 none_padding" >
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Email
						</div>
						<div class="col-sm-1 col-xs-1 " >
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['email'])): ?>
								<?php echo $userInfo['User']['email']; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Religion
						</div>
						<div class="col-sm-1 col-xs-1">
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['religion'])): ?>
								<?php echo $religion[$userInfo['User']['religion']]; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 none_padding" >
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Marital status
						</div>
						<div class="col-sm-1 col-xs-1" >
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['marital_status'])): ?>
								<?php echo $marital_status[$userInfo['User']['marital_status']]; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 none_padding" >
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Updated Date
						</div>
						<div class="col-sm-1 col-xs-1" >
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($userInfo['User']['modified'])): ?>
								<?php echo date('d M Y', strtotime($userInfo['User']['modified'])); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12" style="height: 20px;"></div>
		<!-- </div> -->
	</section>

	<section class="cv-executive-summ">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12 cv-title">
					<div class="col-md-4 col-xs-9 mypage-header" style="margin-top: 0.25em;">
						<h3>
							<div class="col-md-2 col-xs-3">
								<span>2</span>
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-sm hidden-xs">
								Executive summary
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-md hidden-lg">
								<h4 style="margin-top: 4px !important;">Executive summary</h4>
							</div>
						</h3>
					</div>
					<div class="col-md-3 col-xs-2 mypage-button">
						<h3>
							<?php
								echo $this->Html->link('Edit', array(
									'controller' => 'mypages',
									'action' => 'core_skill_update'), array(
									'class' => 'btn btn-blue long-header'
								));
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: -1%;">
			<!-- <div class="col-md-9 col-sm-12 col-xs-12"> -->
			<?php if (!empty($userInfo['UserCoreSkill'])): ?>
				<div class="col-md-12 col-sm-12 col-xs-12 none_padding" >
					<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
						Expected salary
					</div>
					<div class="col-sm-1 col-xs-1" >
						&ratio;
					</div>
					<div class="col-md-10 col-sm-5 col-xs-5 word_break_three" style="margin:0px;padding:0px ">
						<?php if (!empty($userInfo['UserCoreSkill'][0]['expected_salary'])): ?>
							<?php echo $salary[$userInfo['UserCoreSkill'][0]['expected_salary']]; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
					<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
						Current salary
					</div>
					<div class="col-sm-1 col-xs-1 ">
						&ratio;
					</div>
					<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
						<?php if (!empty($userInfo['UserCoreSkill'][0]['current_salary'])): ?>
							<?php echo $salary[$userInfo['UserCoreSkill'][0]['current_salary']]; ?>
						<?php endif; ?>
					</div>
				</div>
				<!-- style="padding-bottom: 10px;" -->
				<div class="col-md-12 col-sm-12 col-xs-12 none_padding" >
					<div class="col-md-3 col-sm-5 col-xs-5 txt-bold hidden-sm hidden-xs">
						Current benefits
					</div>
					<div class="col-sm-12 col-xs-12 txt-bold hidden-md hidden-lg">
						<h4 style="margin-bottom: 1%;">Current benefits</h4>
					</div>
					<div class="col-sm-1 col-xs-1 hidden-xs hidden-sm" >
						&ratio;
					</div>
					<div class="col-md-10 col-sm-12 col-xs-12 current_break word_break_mobile " style="margin:0px;padding:0px ">
						<?php if (!empty($userInfo['UserCoreSkill'][0]['current_benefits'])): ?>
							<?php echo nl2br($userInfo['UserCoreSkill'][0]['current_benefits']); ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
					<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
						Availability
					</div>
					<div class="col-sm-1 col-xs-1" >
						&ratio;
					</div>
					<div class="col-md-10 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
						<?php if (!empty($userInfo['UserCoreSkill'][0]['availability'])): ?>
							<?php echo $availability[$userInfo['UserCoreSkill'][0]['availability']]; ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
					<div class="col-md-3 col-sm-5 col-xs-5 txt-bold hidden-sm hidden-xs">
						Executive summary
					</div>
					<div class="col-sm-12 col-xs-12 txt-bold hidden-md hidden-lg">
						<h4 style="margin-bottom: 1%;">Executive summary</h4>
					</div>
					<div class="col-sm-1 col-xs-1 hidden-xs hidden-sm" >
						&ratio;
					</div>
					<div class="col-md-10 col-sm-12 col-xs-12 current_break word_break_mobile " style="margin:0px;padding:0px ">
						<?php if (!empty($userInfo['UserCoreSkill'][0]['executive_summary'])): ?>
							<?php echo nl2br($userInfo['UserCoreSkill'][0]['executive_summary']); ?>
						<?php endif; ?>
					</div>
				</div>


				<div class="col-md-12 col-sm-12 col-xs-12 " style="margin-top: -1%;">
					<div class="col-md-12 txt-bold core-skill" >
						Core skill
					</div>
					<div class="col-md-12 none_padding">
						<ul class="sub-core-skill core_break word_break_rwo" >
							<?php if (!empty($userInfo['UserCoreSkill'][0]['UserSubCoreSkill'])): ?>
								<?php foreach ($userInfo['UserCoreSkill'][0]['UserSubCoreSkill'] as $key => $val) : ?>
									<?php if (!empty($val['core_skill'])): ?>
										<li><?php echo $val['core_skill']; ?></li>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			<!-- </div> -->
			<?php else: ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					No information
				</div>
			<?php endif; ?>
		</div>
	</section>
	<section class="cv-career-hist">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12 cv-title">
					<div class="col-md-4 col-xs-9 mypage-header" style="margin-top: 0.25em;">
						<h3>
							<div class="col-md-2 col-xs-3">
								<span>3</span>
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-sm hidden-xs">
								Career history
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-md hidden-lg">
								<h4 style="margin-top: 4px !important;">Career history</h4>
							</div>
						</h3>
					</div>
					<div class="col-md-3 col-xs-2 mypage-button">
						<h3>
							<?php
								echo $this->Html->link('Edit', array(
									'controller' => 'mypages',
									'action' => 'career_history_update'), array(
									'class' => 'btn btn-blue short-header'
								));
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: -20px;">
			<?php if (!empty($userInfo['UserCareerHistory'])): ?>
				<?php foreach ($userInfo['UserCareerHistory'] as $key => $val): ?>
					<div class="career col-md-12 col-sm-12 col-xs-12 none_padding">
						<div class="col-md-12 col-sm-12 col-xs-12 " style="word-break: break-all;">
							<!-- <div class="col-md-12 col-sm-12 col-xs-12 word_break_rwo" style="border: 1px solid green;"> -->
								<h3 class="career-hist-title " style="font-size: 20px;"><?php echo nl2br($val['company_name']); ?></h3>
							<!-- </div> -->
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Department
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5" style="margin:0px;padding:0px ">
								<?php if (!empty($val['department'])): ?>
									<?php echo $val['department']; ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Position
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($val['position'])): ?>
									<?php echo $val['position']; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Joined
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-10 col-sm-3 col-xs-3 current_break word_break_rwo" style="margin:0px;padding:0px ">
								<?php
									if (!empty($val['joined_y_m'])) {
										$data1 = explode('-', $val['joined_y_m']);
										$joined_y_m = $month[(int)$data1[1]]. ' ' . $data1[0];
									}
								?>
								<?php if (!empty($joined_y_m)): ?>
									<?php echo $joined_y_m; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Resignation
							</div>
							<div class="col-sm-1 col-xs-1">
								&ratio;
							</div>
							<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
								<?php
									if (!empty($val['resignation'])) {
										$data1 = explode('-', $val['resignation']);
										$resignation = $month[(int)$data1[1]]. ' ' . $data1[0];
									} elseif ($val['company_current'] == 1) {
										$resignation = 'current';
									} else {
										$resignation = null;
									}
								?>
								<?php if (!empty($resignation)): ?>
									<?php echo $resignation; ?>
								<?php else : ?>
									<?php echo "Current"; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Industry
							</div>
							<div class="col-sm-1 col-xs-1 ">
								&ratio;
							</div>
							<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($val['industry_big_id'])): ?>
									<?php echo $industry[$val['industry_big_id']]; ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Job category
							</div>
							<div class="col-sm-1 col-xs-1 ">
								&ratio;
							</div>
							<div class="col-md-10 col-sm-3 col-xs-3 current_break word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($val['job_category_id'])): ?>
									<?php echo $job[$val['job_category_id']]; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Job Sub-category
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($val['job_category_sub_id'])): ?>
									<?php echo $jobSub[$val['job_category_sub_id']]; ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-12 txt-bold core-skill">
								Project
							</div>
							<div class="col-md-12">
								<div class="project core_break">
									<?php if (!empty($val['UserProject'])): ?>
										<?php foreach ($val['UserProject'] as $pkey => $pval) : ?>
											<div class="sub-project ">
												<?php
													if ($pval['period_start']) {
														$data1 = explode('-', $pval['period_start']);
														$period_start = $month[(int)$data1[1]] . ' ' . $data1[0];
													}

													if ($pval['period_end']) {
														$data2 = explode('-', $pval['period_end']);
														$period_end = $month[(int)$data2[1]] . ' ' . $data2[0];
													} elseif ($pval['project_current'] == 1) {
														$period_end = 'current';
													} else {
														$period_end = null;
													}
												?>

												<h4 class="moble_word_break">
													<?php echo $pval['title']; ?>&nbsp;&nbsp;
													<?php
													if (isset($period_start)) {
														echo '(' . $period_start . ' 〜 ' . $period_end . ')';
													}
													?>
												</h4>

												<div class="pro-detail word_break_mobile hidden-md hidden-lg" style="margin-left: -4%;">
													<?php if (!empty($pval['detail'])): ?>
														<?php echo nl2br($pval['detail']); ?>
													<?php endif; ?>
												</div>

												<div class="pro-detail word_break_mobile hidden-sm hidden-xs">
													<?php if (!empty($pval['detail'])): ?>
														<?php echo nl2br($pval['detail']); ?>
													<?php endif; ?>
												</div>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="col-md-12 col-sm-12 col-xs-12"><br>
					No working experience yet
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- 4 Education -->
	<section class="cv-education">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12 cv-title">
					<div class="col-md-4 col-xs-9 mypage-header" style="margin-top: 0.25em;">
						<h3>
							<div class="col-md-2 col-xs-3">
								<span>4</span>
							</div>
							<div class="col-md-10 col-xs-6 hidden-xs hidden-sm">
								Education
							</div>
							<div class="col-md-10 col-xs-6 hidden-md hidden-lg">
								<h4 style="margin-top: 4px !important;">Education</h4>
							</div>
						</h3>
					</div>
					<div class="col-md-3 col-xs-2 mypage-button">
						<h3>
							<?php
								echo $this->Html->link('Edit', array(
									'controller' => 'mypages',
									'action' => 'education_update'), array(
									'class' => 'btn btn-blue short-header'
								));
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php if (!empty($userInfo['UserEducation'])): ?>
				<?php foreach ($userInfo['UserEducation'] as $key => $val): ?>
				<div class="education col-md-12 col-sm-12 col-xs-12 none_padding">

					<div class="col-md-12 col-sm-12 col-xs-12 " style="word-break: break-all;margin-top: -2%;">
						<h3 class="career-hist-title " style="font-size: 20px;">
							<?php if (!empty($val['university_name'])): ?>
								<?php echo $val['university_name']; ?>
							<?php endif; ?>
						</h3>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 none_padding ">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Department
						</div>
						<div class="col-sm-1 col-xs-1">
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($val['department'])): ?>
								<?php echo $val['department']; ?>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Degree
						</div>
						<div class="col-sm-1 col-xs-1" >
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($val['degree'])): ?>
							<?php echo $edu[$val['degree']]; ?>
						<?php endif; ?>
						</div>
					</div>


					<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Enrollment
						</div>
						<div class="col-sm-1 col-xs-1" >
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
							<?php
							if (!empty($val['enrollment'])) {
								$data1 = explode('-', $val['enrollment']);
								$enroll = $month[(int)$data1[1]]. ' ' . $data1[0];
								echo $enroll;
							}
						?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
						<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
							Graduation
						</div>
						<div class="col-sm-1 col-xs-1" >
							&ratio;
						</div>
						<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
							<?php
							if (!empty($val['graduation'])) {
								$graduation = explode('-', $val['graduation']);
								$graduation_date = $month[(int)$graduation[1]]. ' ' . $graduation[0];
								echo $graduation_date;
							} else {
								echo 'Still in University';
							}
						?>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 ">
					<!-- 	for PC view -->
						<div class="col-md-3 col-sm-12 col-xs-12 txt-bold none_padding hidden-sm hidden-xs">
							Remarks
						</div>
					<!-- 	for mobile view -->
						<div class="col-md-3 col-sm-12 col-xs-12 txt-bold none_padding hidden-md hidden-lg">
							<h4>Remarks</h4>
						</div>
						<div class="col-sm-1 col-xs-1 hidden-sm hidden-xs" >
							&ratio;
						</div>

						<div class="col-md-10 col-sm-12 col-xs-12 current_break word_break_rwo" style="margin:0px;padding:0px ">
							<?php if (!empty($val['remarks'])): ?>
								<?php echo nl2br($val['remarks']); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12" style="height: 15px;"> </div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					No information
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- 5 Qualification -->
	<section class="cv-qualification">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12 cv-title">
					<div class="col-md-4 col-xs-9 mypage-header" style="margin-top: 0.25em;">
						<h3>
							<div class="col-md-2 col-xs-3">
								<span>5</span>
							</div>
							<div class="col-md-10 col-xs-6 hidden-xs hidden-sm">
								Qualification
							</div>
							<div class="col-md-10 col-xs-6 hidden-md hidden-lg">
								<h4 style="margin-top: 4px !important;">Qualification</h4>
							</div>
						</h3>
					</div>
					<div class="col-md-3 col-xs-2 mypage-button">
						<h3>
							<?php
								echo $this->Html->link('Edit', array(
									'controller' => 'mypages',
									'action' => 'qualification_update'), array(
									'class' => 'btn btn-blue short-header'
								));
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php if (!empty($userInfo['UserQualification'])): ?>
				<?php foreach ($userInfo['UserQualification'] as $key => $val): ?>
					<div class="qualification" style="margin-top: -2%;">
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding hidden-lg hidden-md" style="margin-top: -5%;">
							<div class="col-md-12 col-sm-12 col-xs-12 moble_word_break" style="word-wrap: break-word;">
								<h3 class="career-hist-title" style="font-size: 20px;"><?php echo $val['qualification_name']; ?></h3>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding hidden-sm hidden-xs">
							<div class="col-md-12 col-sm-12 col-xs-12 moble_word_break" style="word-wrap: break-word;">
								<h3 class="career-hist-title" style="font-size: 20px;"><?php echo $val['qualification_name']; ?></h3>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Date
							</div>
							<div class="col-sm-1 col-xs-1">
								&ratio;
							</div>
							<div class="col-md-10 col-sm-5 col-xs-5 current_break " style="margin:0px;padding:0px ">
								<?php
									if (!empty($val['qualification_date'])) {
										$data1 = explode('-', $val['qualification_date']);
										$qualification_date = $month[(int)$data1[1]]. ' ' . $data1[0];
									}
								?>
								<?php if (!empty($qualification_date)): ?>
									<?php echo $qualification_date; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					No information
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- 6 Language skill -->
	<section class="cv-language-skill">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12 cv-title">
					<div class="col-md-4 col-xs-9 mypage-header" style="margin-top: 0.25em;">
						<h3>
							<div class="col-md-2 col-xs-3">
								<span>6</span>
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-sm hidden-xs">
								Language skill
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-lg hidden-md">
								<h4 style="margin-top: 4px !important;">Language skill</h4>
							</div>
						</h3>
					</div>
					<div class="col-md-3 col-xs-2 mypage-button">
						<h3>
							<?php
								echo $this->Html->link('Edit', array(
									'controller' => 'mypages',
									'action' => 'language_update'), array(
									'class' => 'btn btn-blue short-header'
								));
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: -8%;">
			<?php if (!empty($userInfo['UserLanguageSkill'])): ?>
				<?php foreach ($userInfo['UserLanguageSkill'] as $key => $val): ?>
					<div class="qualification">
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-12 col-sm-12 col-xs-12 word_break_three">
								<?php if(!empty($language_skill[$val['skill']])):?>
									<h3 class="career-hist-title" style="font-size: 20px;">
									<?php
										if (preg_match("/^[0-9]*$/",substr($val['language'], 0, 1))) {
											echo $language[$val['language']];
										} else {
											echo $val['language'];
										}
									?>
									</h3>
								<?php endif;?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-4 col-xs-4 txt-bold">
								<?php if(!empty($val['skill'])):?>
									<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
										Skill
									</div>
								<?php endif;?>
							</div>
							<?php if(!empty($language_skill[$val['skill']])):?>
								<div class="col-sm-1 col-xs-1">
									&ratio;
								</div>
							<?php endif;?>
							<?php if(!empty($language_skill[$val['skill']])):?>
								<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break word_break_rwo" style="margin:0px;padding:0px ">
									<?php if(!empty($language_skill[$val['skill']])):?>
										<?php echo $language_skill[$val['skill']]; ?>
									<?php endif ; ?>
								</div>
							<?php endif;?>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-3 col-sm-4 col-xs-4 txt-bold">
								<?php if(!empty($language_skill[$val['skill']])):?>
									<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
										Certification
									</div>
								<?php endif;?>
							</div>
							<?php if(!empty($language_skill[$val['skill']])):?>
								<div class="col-sm-1 col-xs-1 ">
									&ratio;
								</div>
							<?php endif;?>
							<?php if(!empty($language_skill[$val['skill']])):?>
								<div class="col-md-10 col-sm-5 col-xs-5 current_break word_break word_break_rwo" style="margin:0px;padding:0px ">
									<?php if(!empty($language_skill[$val['skill']])):?>
										<?php if (!empty($val['certificate'])): ?>
											<?php echo $val['certificate']; ?>
										<?php endif ; ?>
									<?php endif ; ?>
								</div>
							<?php endif;?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					No information
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- 7 Computing skill -->
	<section class="cv-computing-skill" style="margin-bottom: 4%;">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12 cv-title">
					<div class="col-md-4 col-xs-9 mypage-header" style="margin-top: 0.25em;">
						<h3>
							<div class="col-md-2 col-xs-3">
								<span>7</span>
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-xs hidden-sm">
								Computer skill
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-lg hidden-md">
								<h4 style="margin-top: 4px !important;">Computer skill</h4>
							</div>
						</h3>
					</div>
					<div class="col-md-3 col-xs-2 mypage-button">
						<h3>
							<?php
								echo $this->Html->link('Edit', array(
									'controller' => 'mypages',
									'action' => 'ms_update'), array(
									'class' => 'btn btn-blue short-header'
								));
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php if (!empty($userInfo['UserComputingSkill'])): ?>

				<div class="col-md-12 col-sm-12 col-xs-12 none_padding hidden-md hidden-lg">
					<div class="col-md-12 col-sm-12 col-xs-12 title-cmp" style="margin-top: -6%;">
						<h3 class="career-hist-title" style="font-size: 20px;">Microsoft Office</h3>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 none_padding hidden-xs hidden-sm">
					<div class="col-md-12 col-sm-12 col-xs-12 title-cmp" style="margin-top: -2%;">
						<h3 class="career-hist-title" style="font-size: 20px;">Microsoft Office</h3>
					</div>
				</div>
			<!-- 	<div class="col-md-12 txt-bold core-skill">
					Project
				</div> -->

				<?php foreach ($userInfo['UserComputingSkill'] as $key => $val): ?>
					<?php if ($key < 3): ?>
						<div class="computing ">
							<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
								<div class="col-md-3 col-sm-5 col-xs-5 txt-bold ">
									<?php if (!empty($val['title'])): ?>
										<?php echo $val['title']; ?>
									<?php endif; ?>
								</div>
								<div class="col-sm-1 col-xs-1 " >
									&ratio;
								</div>
								<div class="col-md-10 col-sm-5 col-xs-5 current_break" style="margin:0px;padding:0px ">
									<?php if (!empty($val['skill'])): ?>
										<?php echo $ms_skill[$val['skill']]; ?>
									<?php endif ; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php foreach ($userInfo['UserComputingSkill'] as $key => $val): ?>
					<?php if ($key > 2) : ?>
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
							<div class="col-md-12 col-sm-12 col-xs-12 title-cmp">
								<h3 class="career-hist-title" style="font-size: 20px;">Other</h3>
							</div>
						</div>
						<?php break; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php foreach ($userInfo['UserComputingSkill'] as $key => $val): ?>
					<?php if ($key > 2): ?>
						<?php if (!empty($val['title'])): ?>
							<div class="computing">
								<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
									<div class="col-md-3 col-sm-5 col-xs-5 txt-bold other_break word_break_rwo">
										<?php echo $val['title']; ?>
									</div>
									<div class="col-sm-1 col-xs-1">
										&ratio;
									</div>
									<div class="col-md-10 col-sm-5 col-xs-5 current_break " style="margin:0px;padding:0px ">
										<?php if (!empty($val['skill'])): ?>
											<?php echo $computer_skill_level[$val['skill']]; ?>
										<?php endif ; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					No information
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- 8 Special instruction -->
	<section class="cv-instruction-skill">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: -2%;">
				<div class="col-md-12 col-sm-12 col-xs-12 cv-title">
					<div class="col-md-4 col-xs-9 mypage-header" style="margin-top: 0.25em;">
						<h3>
							<div class="col-md-2 col-xs-3">
								<span>8</span>
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-sm hidden-xs">
								Special instruction
							</div>
							<div class="col-md-10 col-xs-6 long-header hidden-lg hidden-md">
								<h4  style="margin-top: 4px !important;">Special instruction</h4>
							</div>
						</h3>
					</div>
					<div class="col-md-3 col-xs-2 mypage-button">
						<h3>
							<?php
								echo $this->Html->link('Edit', array(
									'controller' => 'mypages',
									'action' => 'instruction_update'), array(
									'class' => 'btn btn-blue long-header'
								));
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: -2%;">
			<?php if (!empty($userInfo['UserSpecialInstruction'])): ?>
				<?php foreach ($userInfo['UserSpecialInstruction'] as $key => $val): ?>
					<div class="col-md-12 col-sm-12 col-xs-12  none_padding">
						<div class="col-md-12 col-sm-12 col-xs-12 title-instruction">
							<h3 style="word-wrap: break-word;font-size: 20px;margin-top: 1%;" class="hidden-md hidden-lg">
								<?php if($val['title']): ?>
									<?php echo $val['title']; ?>
								<?php endif; ?>
							</h3>
							<h3 style="word-wrap: break-word;font-size: 20px;" class="hidden-sm hidden-xs">
								<?php if($val['title']): ?>
									<?php echo $val['title']; ?>
								<?php endif; ?>
							</h3>
						</div>
					</div>
					<div class="computing">
						<div class="col-md-12 col-sm-12 col-xs-12 ">
							<div class="col-md-12 col-sm-12 col-xs-12  core_break word_break_rwo none_padding">
								<?php if (!empty($val['title']) && !empty($val['detail'])): ?>
									<?php echo nl2br($val['detail']); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					No information
				</div>
			<?php endif; ?>
		</div>
	</section>
</div>
<style type="text/css" media="screen">
	.container {
		margin-top: 20px;
	}

	h2.cv-name {
		margin-top: 1%;
		color: #084B8A;
		font-weight: bolder;
	}

	.cv-top-right {
		margin-top: 1%;
	}

	.cv-top-right .cv-id {
		color: #084B8A;
		font-weight: bold;
	}

	section.cv-personal-info {
		margin-top: 30px;
	}

	.cv-profile {
		width: 85%;
		min-height: 237px;
		height: 85%;
		border: 3px solid #084B8A;
		background-color: #fff;
		padding: 3px;
		position: relative;
		left: 0px;
		height: 100%;
		background-position: 50% 50%;
		text-align: center;
		width: 85%;
		height: 85%;
	}

	.cv-profile img {
		width: 90%;
		height: 90%;
		margin: auto;
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
	}

	.row {
		margin-bottom: 20px;
	}

	.cv-title {
		border-radius: 6px;
		color: #fff;
		background-color: #084B8A;
	}

	.cv-title h3 {
		margin-top: 10px;
		font-weight: bolder;
	}


	/*--------------- Common -----------------------------*/
	@media screen and (min-width: 600px) {
		div.txt-bold {
			font-size: 12pt;
			line-height: 28px;
			font-weight: bold;
		}

	}

	/*--------------- Personal Information ---------------*/
	.cv-title h3 span {
		border: 2px solid #fff;
		border-radius: 50%;
		padding: 1px 8px;
	}

	/*----------------------------------------------------*/

	/*--------------- Executive summary ------------------*/
	div.core-skill {
		margin-top: 20px;
		margin-bottom: 10px;
		border-bottom: 2px solid #084B8A;
	}

	ul.sub-core-skill {
		list-style-type: disc;
		line-height: 2;
		/*margin-left: 30px*/
	}
	/*----------------------------------------------------*/

	/*--------------- Career History ------------------*/
	h2.career-hist-title {
		font-weight: bolder;
	}

	div.career {
		display: inline-block;
	}

	div.sub-project {
		margin-left: 20px;
		margin-bottom: 20px;
	}

	div.sub-project div.pro-detail {
		margin-left: 0px;
	}

	div.sub-project h4 {
		font-weight: bolder;
	}

	/*----------------------------------------------------*/

	/*----------------- Education ------------------------*/
	.education {
		display: inline-block;
	}

	h3.career-hist-title {
		font-weight: bold;
	}

	.title-cmp h2 {
		font-weight: bold;
	}

	.title-cmp {
		border-bottom: 2px solid #084B8A;
		margin-bottom: 10px;
	}

	.title-instruction h3{
		font-weight: bold;
	}

	.txt-detail {
		margin-left: 20px;
	}

	button.btn, a.btn {
		margin: auto;
		transition: all 0.5s;
	}

	/* Container Border */
	.cborder {
		border: 3px solid #084B8A;
		border-radius: 10px;
		margin-top: 3%;
		margin-bottom: -3%;
	}

	@media screen and (max-width: 768px) and (max-width: 992px) {
		.cborder {
			border: 3px solid #084B8A;
			border-radius: 10px;
			margin-top: 3%;
			margin-bottom: 4%;
		}
	}

</style>

<script type="text/javascript">
	$(document).ready(function() {
		OnImageLoad();
		//image required alert
		$("#imageSubmit").click(function(){
			var name = $('#file-7').val().split('\\').pop();
			name = name.split('.')[0];
			if (!name) {
				alert("Please choose photo !!");
			}
		});

		function OnImageLoad() {
			var img = $('.preview');
			if (img.length != 0) {
				// what's the size of this image and it's parent
				var w = parseInt($(img).css("width").replace('px',''));
				var h = parseInt($(img).css("height").replace('px',''));
				var tw = $(img).parent().width();
				var th = $(img).parent().height();
				// compute the new size and offsets
				var result = ScaleImage(w, h, tw, th, true);
				// adjust the image coordinates and size
				img.css("width", result.width);
				img.css('height', result.height);
				$(img).css("left", result.targetleft);
				$(img).css("top", result.targettop);
			}
		}

		function ScaleImage(srcwidth, srcheight, targetwidth, targetheight, fLetterBox) {
			var result = { width: 0, height: 0, fScaleToTargetWidth: true };

			if ((srcwidth <= 0) || (srcheight <= 0) || (targetwidth <= 0) || (targetheight <= 0)) {
				return result;
			}

			// scale to the target width
			var scaleX1 = targetwidth;
			var scaleY1 = (srcheight * targetwidth) / srcwidth;

			// scale to the target height
			var scaleX2 = (srcwidth * targetheight) / srcheight;
			var scaleY2 = targetheight;

			// now figure out which one we should use
			var fScaleOnWidth = (scaleX2 > targetwidth);
			if (fScaleOnWidth) {
				fScaleOnWidth = fLetterBox;
			}
			else {
				fScaleOnWidth = !fLetterBox;
			}

			if (fScaleOnWidth) {
				result.width = Math.floor(scaleX1);
				result.height = Math.floor(scaleY1);
				result.fScaleToTargetWidth = true;
			}
			else {
				result.width = Math.floor(scaleX2);
				result.height = Math.floor(scaleY2);
				result.fScaleToTargetWidth = false;
			}
			result.targetleft = Math.floor((targetwidth - result.width) / 2);
			result.targettop = Math.floor((targetheight - result.height) / 2);
			return result;
		}

	});
</script>