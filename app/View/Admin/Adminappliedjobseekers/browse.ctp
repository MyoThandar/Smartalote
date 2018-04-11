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
			<!-- Job overview -->
				<tr>
					<body>
						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Job ID
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($occ['Occupation']['job_id'])): ?>
									<?php echo $occ['Occupation']['job_id']; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Job title
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($occ['Occupation']['job_title'])): ?>
									<?php echo $occ['Occupation']['job_title']; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Company/Headhunter ID
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($occ['Occupation']['cmp_headhunter_id'])): ?>
									<?php echo $occ['Occupation']['cmp_headhunter_id']; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Company/Headhunter Name
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($company_info['CmpHeadhunter']['company_name'])) : ?>
									<?php echo $company_info['CmpHeadhunter']['company_name']; ?>
								<?php else : ?>
									<?php echo $company_info['CmpHeadhunter']['headhunter_name']; ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Location
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php if (!empty($job_region)) : ?>
									<?php echo $job_region; ?>
								<?php endif; ?>
								<br/><?php echo $occ['Occupation']['location_big_id']; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Job Category
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php echo $categoryb[ $occ['Occupation']['job_category_id']].' / '.$categorys[ $occ['Occupation']['job_category_sub_id']] ; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Responsibility
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php echo nl2br($occ['Occupation']['responsibility']); ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Requirements
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php echo nl2br($occ['Occupation']['requirements']) ; ?>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
							<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
								Entry date
							</div>
							<div class="col-sm-1 col-xs-1" >
								&ratio;
							</div>
							<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px ">
								<?php echo date('d M Y',strtotime($occ['OccupationApply']['created']) ) ; ?>
							</div>
						</div>
					</body>
				</tr>
		</table>
	</div>

	<div class = "x_content" style="border-top-style: groove;padding-top: 14px;">
		<table class = "table-st">
			<tr style="border-bottom: none;">
				<td colspan="3">
					<div class="col-md-10 col-sm-10 col-xs-12" style="font-size: 19px;margin-left: -11px;">
						<?php echo "<label>Jobseeker Profile</label>"; ?>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div class = "x_content">
		<table class = "table-st">
			<tr>
				<td colspan="3" class="labelbg">
					<div class="col-md-1 col-xs-3" style="margin-top: 4px;">
						<span class="number-mark">1</span>
					</div>
					<div class="col-md-10 col-sm-10 col-xs-12 text-mark">
						<?php echo "<label class='main-label'>Personal Info</label>"; ?>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div class="x_content">
		<table class="table-st">
			<!-- Profile -->
			<tr>
				<body>
					<section style="border: none;">
						<div class = "sectionContent">
							<article>
								<?php if (!empty($userdata['User']['image'])) : ?>
									<div class = "resize-img" style="float: left;margin-left: -269px;margin-top: 0%;width: 200px;height: 200px;border: medium solid lightgray;overflow: hidden;position: relative;">
										<?php echo $this->Html->image($userdata['User']['image_url'], array('id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
									</div>
								<?php endif ; ?>

								<?php if (!empty($userdata['User']['image'])) : ?>
									<div class="col-md-12" style="margin-left: -7%;margin-top: -2%;">
								<?php else : ?>
									<div class="col-md-12" style="margin-left: -38%;margin-top: -2%;">
								<?php endif ; ?>

									<h3 style="color: #73879C;">
										<?php echo $userdata['User']['name'] ; ?>
									</h3>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Jobseeker ID
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['jobseeker_id'])): ?>
												<?php echo $userdata['User']['jobseeker_id']; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Gender
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['gender'])): ?>
												<?php $gender=array(1=>'male',2=>'female');?>
												<?php echo $gender[$userdata['User']['gender']]; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Age
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['birthday'])): ?>
												<?php
													/****** Calculation age from birthday
													***** object oriented
													*********************************/
													$cal_age = date_diff(date_create($userdata['User']['birthday']), date_create('today'))->y ;
													echo $cal_age.' years';
												?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Nationality
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['nationality'])): ?>
												<?php echo $nation[$userdata['User']['nationality']]; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Region
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['location'])): ?>
												<?php echo $location[$userdata['User']['location']]; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Address
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['address'])): ?>
												<?php echo nl2br($userdata['User']['address']); ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Phone Number
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['phone_number'])): ?>
												<?php echo $userdata['User']['phone_number']; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Email
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['email'])): ?>
												<?php echo $userdata['User']['email']; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Religion
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['religion'])): ?>
												<?php echo $religion[$userdata['User']['religion']]; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: -3%;line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Religion
										</div>
										<div class="col-sm-1 col-xs-1">
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_rwo" style="margin:0px;padding:0px;">
											<?php if (!empty($userdata['User']['marital_status'])): ?>
												<?php echo $marital_status[$userdata['User']['marital_status']]; ?>
											<?php endif; ?>
										</div>
									</div>

								</div>
							</article>
						</div>
					</section>
				</body>
			</tr>

			<!-- Expected salary, Executive summary, Core skill -->
			<tr>
				<body>
					<section style="border: none;">

						<div class = "x_content">
							<table class = "table-st">
								<tr>
									<td colspan="3" class="labelbg">
										<div class="col-md-1 col-xs-3" style="margin-top: 4px;">
											<span class="number-mark">2</span>
										</div>
										<div class="col-md-10 col-sm-10 col-xs-12 text-mark">
											<?php echo "<label class='main-label'>Executive summary</label>"; ?>
										</div>
									</td>
								</tr>
							</table>
						</div>

						<?php if (empty($user_instruction)) : ?>
							<div>
								<article>
									<p>No Information</p>
								</article>
							</div>
						<?php else : ?>
							<div style="float: left;margin-top: 0%;margin-left: 1%;">
								<article>
									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Expected salary
										</div>
										<div class="col-sm-1 col-xs-1" >
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_three" style="margin:0px;padding:0px ">
											<?php if (!empty($user_core[0]['UserCoreSkill']['expected_salary'])): ?>
												<?php echo $salary[$user_core[0]['UserCoreSkill']['expected_salary']]; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Current salary
										</div>
										<div class="col-sm-1 col-xs-1" >
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_three" style="margin:0px;padding:0px ">
											<?php if (!empty($user_core[0]['UserCoreSkill']['current_salary'])): ?>
												<?php echo $salary[$user_core[0]['UserCoreSkill']['current_salary']]; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Current benefits
										</div>
										<div class="col-sm-1 col-xs-1" >
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_three" style="margin:0px;padding:0px ">
											<?php if (!empty($user_core[0]['UserCoreSkill']['current_benefits'])): ?>
												<?php echo nl2br($user_core[0]['UserCoreSkill']['current_benefits']); ?>
											<?php endif; ?>
										</div>
									</div>

									<!-- <?php if (!empty($user_core[0]['UserCoreSkill']['current_benefits'])) : ?>
										<p class="core_break">
											<?php echo 'Current benefits : '.nl2br($user_core[0]['UserCoreSkill']['current_benefits']); ?>
										</p>
									<?php endif; ?> -->

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Avability
										</div>
										<div class="col-sm-1 col-xs-1" >
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_three" style="margin:0px;padding:0px ">
											<?php if (!empty($user_core[0]['UserCoreSkill']['availiability'])): ?>
												<?php echo $availability[$user_core[0]['UserCoreSkill']['availiability']]; ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
										<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
											Executive summary
										</div>
										<div class="col-sm-1 col-xs-1" >
											&ratio;
										</div>
										<div class="col-md-8 col-sm-5 col-xs-5 word_break_three" style="margin:0px;padding:0px ">
											<?php if (!empty($user_core[0]['UserCoreSkill']['executive_summary'])): ?>
												<?php echo nl2br($user_core[0]['UserCoreSkill']['executive_summary']); ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: -2%;line-height: 2.5em;margin-left: 10px;margin-bottom: 1%;">
										<div class="col-md-11 txt-bold core-skill">
											<h3 class="career-hist-title" style="margin-top: 1%;font-size: 17px;margin-bottom: 0%;">Core skill</h3>
										</div>

										<div class="col-md-12 none_padding" style="margin-left: 3%;">
											<ul class="sub-core-skill core_break word_break_rwo" >
												<?php if (!empty($user_core[0]['UserSubCoreSkill'])): ?>
													<?php foreach ($user_core[0]['UserSubCoreSkill'] as $key => $val) : ?>
														<?php if (!empty($val['core_skill'])): ?>
															<li><?php echo $val['core_skill']; ?></li>
														<?php endif; ?>
													<?php endforeach; ?>
												<?php endif; ?>
											</ul>
										</div>
									</div>

								</article>
							</div>
						<?php endif; ?>

					</section>
				</body>
			</tr>

			<!-- Career history -->
			<tr>
				<body>
					<section style="border: none;">
						<div class = "x_content">
							<table class = "table-st">
								<tr>
									<td colspan="3" class="labelbg">
										<div class="col-md-1 col-xs-3" style="margin-top: 4px;">
											<span class="number-mark">3</span>
										</div>
										<div class="col-md-10 col-sm-10 col-xs-12 text-mark">
											<?php echo "<label class='main-label'>Career history</label>"; ?>
										</div>
									</td>
								</tr>
							</table>
						</div>

						<div class="row" style="margin-top: -20px;">
							<?php if (!empty($user_career)): ?>
								<?php foreach ($user_career as $key => $val): ?>
									<div class="career col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-left: 2%;">
										<div class="col-md-12 col-sm-12 col-xs-12 " style="word-break: break-all;margin-bottom: -1%;">
											<h3 class="career-hist-title " style="font-size: 17px;"><?php echo nl2br($val['UserCareerHistory']['company_name']); ?></h3>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
											<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
												Department
											</div>
											<div class="col-sm-1 col-xs-1" >
												&ratio;
											</div>
											<div class="col-md-8 col-sm-5 col-xs-5" style="margin:0px;padding:0px ">
												<?php if (!empty($val['UserCareerHistory']['department'])): ?>
													<?php echo $val['UserCareerHistory']['department']; ?>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
											<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
												Position
											</div>
											<div class="col-sm-1 col-xs-1" >
												&ratio;
											</div>
											<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
												<?php if (!empty($val['UserCareerHistory']['position'])): ?>
													<?php echo $val['UserCareerHistory']['position']; ?>
												<?php endif; ?>
											</div>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
											<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
												Joined
											</div>
											<div class="col-sm-1 col-xs-1" >
												&ratio;
											</div>
											<div class="col-md-8 col-sm-3 col-xs-3 current_break word_break_rwo" style="margin:0px;padding:0px ">
												<?php
													if (!empty($val['UserCareerHistory']['joined_y_m'])) {
														$data1 = explode('-', $val['UserCareerHistory']['joined_y_m']);
														$joined_y_m = $month[(int)$data1[1]]. ' ' . $data1[0];
													}
												?>
												<?php if (!empty($joined_y_m)): ?>
													<?php echo $joined_y_m; ?>
												<?php endif; ?>
											</div>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
											<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
												Resignation
											</div>
											<div class="col-sm-1 col-xs-1">
												&ratio;
											</div>
											<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
												<?php
													if (!empty($val['UserCareerHistory']['resignation'])) {
														$data1 = explode('-', $val['UserCareerHistory']['resignation']);
														$resignation = $month[(int)$data1[1]]. ' ' . $data1[0];
													} elseif ($val['UserCareerHistory']['company_current'] == 1) {
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

										<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
											<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
												Industry
											</div>
											<div class="col-sm-1 col-xs-1 ">
												&ratio;
											</div>
											<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
												<?php if (!empty($val['UserCareerHistory']['industry_big_id'])): ?>
													<?php echo $industry[$val['UserCareerHistory']['industry_big_id']]; ?>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
											<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
												Job category
											</div>
											<div class="col-sm-1 col-xs-1 ">
												&ratio;
											</div>
											<div class="col-md-8 col-sm-3 col-xs-3 current_break word_break_rwo" style="margin:0px;padding:0px ">
												<?php if (!empty($val['UserCareerHistory']['job_category_id'])): ?>
													<?php echo $job[$val['UserCareerHistory']['job_category_id']]; ?>
												<?php endif; ?>
											</div>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
											<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
												Job Sub-category
											</div>
											<div class="col-sm-1 col-xs-1" >
												&ratio;
											</div>
											<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
												<?php if (!empty($val['UserCareerHistory']['job_category_sub_id'])): ?>
													<?php echo $jobSub[$val['UserCareerHistory']['job_category_sub_id']]; ?>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: -2%;line-height: 2.5em;margin-left: 10px;margin-bottom: 1%;">
											<div class="col-md-11 txt-bold core-skill">
												Project
											</div>
											<div class="col-md-12" style="line-height: 2.5em;margin-bottom: -3%;">
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

																<div class="pro-detail word_break_mobile">
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

						<!-- Step 3 Education -->
						<tr>
							<body>
								<section style="border: none;">
									<div class = "x_content">
										<table class = "table-st">
											<tr>
												<td colspan="3" class="labelbg">
													<div class="col-md-1 col-xs-3" style="margin-top: 4px;">
														<span class="number-mark">4</span>
													</div>
													<div class="col-md-10 col-sm-10 col-xs-12 text-mark">
														<?php echo "<label class='main-label'>Education</label>"; ?>
													</div>
												</td>
											</tr>
										</table>
									</div>

									<div class="row">
										<?php if (!empty($user_edu)): ?>
											<?php foreach ($user_edu as $key => $val): ?>
											<div class="education col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;margin-bottom: -3%;margin-left: 2%;">

												<div class="col-md-12 col-sm-12 col-xs-12" style="word-break: break-all;margin-top: 0%;">
													<h3 class="career-hist-title " style="font-size: 17px;margin-bottom: -1%;">
														<?php if (!empty($val['UserEducation']['university_name'])): ?>
															<?php echo $val['UserEducation']['university_name']; ?>
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
													<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
														<?php if (!empty($val['UserEducation']['department'])): ?>
															<?php echo $val['UserEducation']['department']; ?>
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
													<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
														<?php if (!empty($val['UserEducation']['degree'])): ?>
														<?php echo $edu[$val['UserEducation']['degree']]; ?>
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
													<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
														<?php
														if (!empty($val['UserEducation']['enrollment'])) {
															$data1 = explode('-', $val['UserEducation']['enrollment']);
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
													<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break_rwo" style="margin:0px;padding:0px ">
														<?php
														if (!empty($val['UserEducation']['graduation'])) {
															$graduation = explode('-', $val['UserEducation']['graduation']);
															$graduation_date = $month[(int)$graduation[1]]. ' ' . $graduation[0];
															echo $graduation_date;
														} else {
															echo 'Still in University';
														}
													?>
													</div>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12 ">
													<div class="col-md-3 col-sm-12 col-xs-12 txt-bold none_padding">
														Remarks
													</div>
													<div class="col-sm-1 col-xs-1">
														&ratio;
													</div>

													<div class="col-md-8 col-sm-12 col-xs-12 current_break word_break_rwo" style="margin:0px;padding:0px ">
														<?php if (!empty($val['UserEducation']['remarks'])): ?>
															<?php echo nl2br($val['UserEducation']['remarks']); ?>
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
							</body>
						</tr>

						<!-- Qualifications-->
						<tr>
							<body>
								<section style="border: none;">
									<div class = "x_content">
										<table class = "table-st">
											<tr>
												<td colspan="3" class="labelbg">
													<div class="col-md-1 col-xs-3" style="margin-top: 4px;">
														<span class="number-mark">5</span>
													</div>
													<div class="col-md-10 col-sm-10 col-xs-12 text-mark">
														<?php echo "<label class='main-label'>Qualification</label>"; ?>
													</div>
												</td>
											</tr>
										</table>
									</div>

									<div class="row" style="margin-bottom: -10px;">
										<?php if (!empty($user_qualification)): ?>
											<?php foreach ($user_qualification as $key => $val): ?>
												<div class="qualification" style="margin-top: -2%;margin-left: 2%;">
													<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
														<div class="col-md-12 col-sm-12 col-xs-12 moble_word_break" style="word-wrap: break-word;">
															<h3 class="career-hist-title" style="font-size: 17px;"><?php echo $val['UserQualification']['qualification_name']; ?></h3>
														</div>
													</div>
													<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="margin-top: -1%;">
														<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
															Date
														</div>
														<div class="col-sm-1 col-xs-1">
															&ratio;
														</div>
														<div class="col-md-8 col-sm-5 col-xs-5 current_break " style="margin:0px;padding:0px ">
															<?php
																if (!empty($val['UserQualification']['qualification_date'])) {
																	$data1 = explode('-', $val['UserQualification']['qualification_date']);
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
							</body>
						</tr>

						<!-- Language Skill -->
						<tr>
							<body>
								<section style="border: none;">
									<div class = "x_content">
										<table class = "table-st">
											<tr>
												<td colspan="3" class="labelbg">
													<div class="col-md-1 col-xs-3" style="margin-top: 4px;">
														<span class="number-mark">6</span>
													</div>
													<div class="col-md-10 col-sm-10 col-xs-12 text-mark">
														<?php echo "<label class='main-label'>Language Skill</label>"; ?>
													</div>
												</td>
											</tr>
										</table>
									</div>

									<div class="row" style="margin-top: -8%;margin-bottom: -2%;">
										<?php if (!empty($user_language)): ?>
											<?php foreach ($user_language as $key => $val): ?>
												<div class="qualification" style="margin-left: 2%;">
													<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
														<div class="col-md-12 col-sm-12 col-xs-12 word_break_three" style="margin-bottom: -2%;">
															<?php if(!empty($language_skill[$val['UserLanguageSkill']['skill']])):?>
																<h3 class="career-hist-title" style="font-size: 17px;">
																<?php
																	if (preg_match("/^[0-9]*$/",substr($val['UserLanguageSkill']['skill'], 0, 1))) {
																		echo $language[$val['UserLanguageSkill']['skill']];
																	} else {
																		echo $val['UserLanguageSkill']['skill'];
																	}
																?>
																</h3>
															<?php endif;?>
														</div>
													</div>

													<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;margin-bottom: -1%;">
														<div class="col-md-3 col-sm-4 col-xs-4 txt-bold">
															<?php if(!empty($val['UserLanguageSkill']['skill'])):?>
																<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
																	Skill
																</div>
															<?php endif;?>
														</div>
														<?php if(!empty($language_skill[$val['UserLanguageSkill']['skill']])):?>
															<div class="col-sm-1 col-xs-1">
																&ratio;
															</div>
														<?php endif;?>
														<?php if(!empty($language_skill[$val['UserLanguageSkill']['skill']])):?>
															<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break word_break_rwo" style="margin:0px;padding:0px ">
																<?php if(!empty($language_skill[$val['UserLanguageSkill']['skill']])):?>
																	<?php echo $language_skill[$val['UserLanguageSkill']['skill']]; ?>
																<?php endif ; ?>
															</div>
														<?php endif;?>
													</div>

													<div class="col-md-12 col-sm-12 col-xs-12 none_padding" style="line-height: 2.5em;">
														<div class="col-md-3 col-sm-4 col-xs-4 txt-bold">
															<?php if(!empty($language_skill[$val['UserLanguageSkill']['skill']])):?>
																<div class="col-md-3 col-sm-5 col-xs-5 txt-bold">
																	Certification
																</div>
															<?php endif;?>
														</div>
														<?php if(!empty($language_skill[$val['UserLanguageSkill']['skill']])):?>
															<div class="col-sm-1 col-xs-1 ">
																&ratio;
															</div>
														<?php endif;?>
														<?php if(!empty($language_skill[$val['UserLanguageSkill']['skill']])):?>
															<div class="col-md-8 col-sm-5 col-xs-5 current_break word_break word_break_rwo" style="margin:0px;padding:0px ">
																<?php if(!empty($language_skill[$val['UserLanguageSkill']['skill']])):?>
																	<?php if (!empty($val['UserLanguageSkill']['certificate'])): ?>
																		<?php echo $val['UserLanguageSkill']['certificate']; ?>
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
							</body>
						</tr>


					</section>
				</body>
			</tr>

			<!-- Microsoft Office (Computing Skill)-->
			<tr>
				<body>
					<section style="border: none;">
						<div class = "x_content">
							<table class = "table-st">
								<tr>
									<td colspan="3" class="labelbg">
										<div class="col-md-1 col-xs-3" style="margin-top: 4px;">
											<span class="number-mark">7</span>
										</div>
										<div class="col-md-10 col-sm-10 col-xs-12 text-mark">
											<?php echo "<label class='main-label'>Computer skill</label>"; ?>
										</div>
									</td>
								</tr>
							</table>
						</div>

						<div class="row" style="margin-left: 2%;">
							<?php if (!empty($user_computing)): ?>

								<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
									<div class="col-md-11 col-sm-12 col-xs-12 title-cmp" style="margin-top: -2%;">
										<h3 class="career-hist-title" style="margin-top: 3%;font-size: 17px;margin-bottom: 0%;">Microsoft Office</h3>
									</div>
								</div>

								<?php foreach ($user_computing as $key => $val): ?>
									<?php if ($key < 3): ?>
										<div class="computing" style="margin-left: 2%;">
											<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
												<div class="col-md-3 col-sm-5 col-xs-5 txt-bold ">
													<?php if (!empty($val['UserComputingSkill']['title'])): ?>
														<?php echo $val['UserComputingSkill']['title']; ?>
													<?php endif; ?>
												</div>
												<div class="col-sm-1 col-xs-1">
													&ratio;
												</div>
												<div class="col-md-8 col-sm-5 col-xs-5 current_break" style="margin:0px;padding:0px ">
													<?php if (!empty($val['UserComputingSkill']['skill'])): ?>
														<?php echo $ms_skill[$val['UserComputingSkill']['skill']]; ?>
													<?php endif ; ?>
												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>

								<?php foreach ($user_computing as $key => $val): ?>
									<?php if ($key > 2) : ?>
										<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
											<div class="col-md-11 col-sm-12 col-xs-12 title-cmp">
												<h2>Others </h2>
											</div>
										</div>
										<?php break; ?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php foreach ($user_computing as $key => $val): ?>
									<?php if ($key > 2): ?>
										<?php if (!empty($val['UserComputingSkill']['title'])): ?>
											<div class="computing" style="margin-left: 2%;">
												<div class="col-md-12 col-sm-12 col-xs-12 none_padding">
													<div class="col-md-3 col-sm-5 col-xs-5 txt-bold other_break word_break_rwo">
														<?php echo $val['UserComputingSkill']['title']; ?>
													</div>
													<div class="col-sm-1 col-xs-1">
														&ratio;
													</div>
													<div class="col-md-8 col-sm-5 col-xs-5 current_break " style="margin:0px;padding:0px ">
														<?php if (!empty($val['UserComputingSkill']['skill'])): ?>
															<?php echo $computer_skill_level[$val['UserComputingSkill']['skill']]; ?>
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
				</body>
			</tr>

			<!-- Special instruction-->
			<tr>
				<body>
					<section style="border: none;">
						<div class = "x_content">
							<table class = "table-st">
								<tr>
									<td colspan="3" class="labelbg">
										<div class="col-md-1 col-xs-3" style="margin-top: 4px;">
											<span class="number-mark">8</span>
										</div>
										<div class="col-md-10 col-sm-10 col-xs-12 text-mark">
											<?php echo "<label class='main-label'>Special instruction</label>"; ?>
										</div>
									</td>
								</tr>
							</table>
						</div>

						<div class="row" style="margin-top: -2%;margin-left: 2%;">
							<?php if (!empty($user_instruction)): ?>
								<?php foreach ($user_instruction as $key => $val): ?>
									<div class="col-md-12 col-sm-12 col-xs-12  none_padding">
										<div class="col-md-12 col-sm-12 col-xs-12 title-instruction">
											<h3 style="word-wrap: break-word;font-size: 17px;">
												<?php if($val['UserSpecialInstruction']['title']): ?>
													<?php echo $val['UserSpecialInstruction']['title']; ?>
												<?php endif; ?>
											</h3>
										</div>
									</div>
									<div class="computing">
										<div class="col-md-12 col-sm-12 col-xs-12 ">
											<div class="col-md-12 col-sm-12 col-xs-12  core_break word_break_rwo none_padding">
												<?php if (!empty($val['UserSpecialInstruction']['title']) && !empty($val['UserSpecialInstruction']['detail'])): ?>
													<?php echo nl2br($val['UserSpecialInstruction']['detail']); ?>
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
				</body>
			</tr>
		</table>

		<div class="ln_solid"></div>
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
			<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
		</div>
	</div>
</div>

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
		margin-top: -11px;
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

	/*--------------- Career History ------------------*/
	h2.career-hist-title {
		font-weight: bolder;
	}

	div.career {
		display: inline-block;
	}

	div.sub-project {
		margin-left: 20px;
		margin-bottom: -1%;
	}

	div.sub-project div.pro-detail {
		margin-left: 0px;
		margin-bottom: 2%;
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
		color: #73879C;
	}

	.title-cmp h2 {
		font-weight: bold;
		color: #73879C;
	}

	.title-cmp {
		border-bottom: 2px solid #808080;
		margin-bottom: 10px;
	}

	.title-instruction h3{
		font-weight: bold;
		color: #73879C;
	}

	.txt-detail {
		margin-left: 20px;
	}

	button.btn, a.btn {
		margin: auto;
		transition: all 0.5s;
	}

	.core_break {
		width: 70em;
		word-wrap: break-word;
	}

	/*--------------- Executive summary ------------------*/
	div.core-skill {
		margin-top: 20px;
		margin-bottom: 10px;
		border-bottom: 2px solid #808080;
	}

	ul.sub-core-skill {
		list-style-type: disc;
		line-height: 2;
		/*margin-left: 30px*/
	}
	/*----------------------------------------------------*/

	.no-message {
		margin-top: -1%;
		margin-left: 1%;
		margin-bottom: -1%;
	}

	.number-mark {
		color: #73879C;
		border: 2px solid #73879C;
		border-radius: 50%;
		padding: 1px 8px;
	}
	.text-mark {
		margin-left: -44px;
	}
</style>