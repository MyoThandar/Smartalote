<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<?php echo $this->Session->flash(); ?>
<div class="x_panel">
	<div class="x_title">
		<h2>Job Edit</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
		<?php echo $this->Form->create('Occupation', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'demo-form2', 'autocomplete' => 'off')); ?>

		<!-- Company informations -->
			<?php if ($user['type'] == 0) : ?>
				<div class="x_content">
					<table class="table-st">
						<tr>
							<td colspan="3" class="labelbg">
								<div class="col-md-10 col-sm-10 col-xs-12">
									<?php echo "<label class='main-label'>Company Information</label>"; ?>
								</div>
							</td>
						</tr>
					</table>
				</div>

				<div class="form-group">
					<?php
						echo $this->Form->label('company_name', 'Company Name <span class="required">*</span>', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
						));
					?>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php
							echo $this->Form->input('company_name', array(
								'type' => 'select',
								'label' => false,
								'options' => $com_list,
								'empty' => '' ,
								'class' => 'form-control col-md-7 col-xs-12',
								'id' => 'autoselect',
								'default' => $datas['Occupation']['sub_headhunter_id']
							));
						?>
					</div>

					<div>
						<div class="contact-info">
							<div class="form-group">
								<br/><br/><br/><br/><br/>
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
								<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="address">
									<?php if (!empty($back_data)) : ?>
										<?php echo $back_data['SubHeadhunter']['location'].'<br/>'.$region[$back_data['SubHeadhunter']['region']]; ?>
									<?php else : ?>
										<?php echo $datas['SubHeadhunter']['location'].'<br/>'.$region[$datas['SubHeadhunter']['region']]; ?>
									<?php endif; ?>
								</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Company logo </label>
								<?php if (!empty($back_data)) : ?>
									<?php $logo = "/img/".$back_data['SubHeadhunter']['logo'] ; ?>
								<?php else : ?>
									<?php $logo = "/img/".$datas['SubHeadhunter']['logo'] ; ?>
								<?php endif; ?>
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php if (!empty($logo)) : ?>
										<?php echo $this->Html->image($logo, array('alt' => 'story image', 'id' => 'logo', "style" => "position: absolute;", "class" => "preview")); ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Representative position </label>
								<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="representative-postion">
									<?php if (!empty($back_data)) : ?>
										<?php echo $back_data['SubHeadhunter']['representative_postion']; ?>
									<?php else : ?>
										<?php echo $datas['SubHeadhunter']['representative_postion']; ?>
									<?php endif; ?>
								</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Representative name </label>
								<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="representative-name">
									<?php if (!empty($back_data)) : ?>
										<?php echo $back_data['SubHeadhunter']['representative_name']; ?>
									<?php else : ?>
										<?php echo $datas['SubHeadhunter']['representative_name']; ?>
									<?php endif; ?>
								</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Industry </label>
								<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="industry">
									<?php if (!empty($back_data)) : ?>
										<?php
											echo $big_industry[$back_data['SubHeadhunter']['industry_big_id']]
												.' / '.
												$small_industry[$back_data['SubHeadhunter']['industry_big_id']][$back_data['SubHeadhunter']['industry_small_id']];
										?>
									<?php else : ?>
										<?php
											echo $big_industry[$datas['SubHeadhunter']['industry_big_id']]
												.' / '.
												$small_industry[$datas['SubHeadhunter']['industry_big_id']][$datas['SubHeadhunter']['industry_small_id']];
										?>
									<?php endif; ?>
								</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Establishment </label>
								<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="establishment">
									<?php if (!empty($back_data)) : ?>
										<?php echo $back_data['SubHeadhunter']['establishment']; ?>
									<?php else : ?>
										<?php echo $datas['SubHeadhunter']['establishment']; ?>
									<?php endif; ?>
								</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Business overview </label>
								<label class=col-md-3 col-sm-3 col-xs-3" style="width: 50%;padding-top: 9px;" id="overview">
									<?php if (!empty($back_data)) : ?>
										<?php echo $back_data['SubHeadhunter']['overview']; ?>
									<?php else : ?>
										<?php echo $datas['SubHeadhunter']['overview']; ?>
									<?php endif; ?>
								</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">HP address</label>
								<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;">
									<a id="hp-address" href="<?php if(!empty($back_data)) echo $back_data['SubHeadhunter']['hp_address']; else echo $datas['SubHeadhunter']['hp_address']; ?>" style="color: blue;">
										<?php if (!empty($back_data)) : ?>
											<?php echo $back_data['SubHeadhunter']['hp_address']; ?>
										<?php else : ?>
											<?php echo $datas['SubHeadhunter']['hp_address']; ?>
										<?php endif; ?>
									</a>
								</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Capital</label>
								<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="capital">
									<?php if (!empty($back_data)) : ?>
										<?php if ($back_data['SubHeadhunter']['capital_type'] == 1) : ?>
											<?php $capital_type = 'MMK'; ?>
										<?php elseif($back_data['SubHeadhunter']['capital_type'] == 2) : ?>
											<?php $capital_type = 'USD'; ?>
										<?php endif; ?>
										<?php echo $back_data['SubHeadhunter']['capital'].' '.$capital_type; ?>
									<?php else : ?>
										<?php if ($datas['SubHeadhunter']['capital_type'] == 1) : ?>
											<?php $capital_type = 'MMK'; ?>
										<?php elseif($datas['SubHeadhunter']['capital_type'] == 2) : ?>
											<?php $capital_type = 'USD'; ?>
										<?php endif; ?>
										<?php echo $datas['SubHeadhunter']['capital'].' '.$capital_type; ?>
									<?php endif; ?>
								</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Number of employee</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="number-of-employee">
									<?php if (!empty($back_data['SubHeadhunter']['number_of_employee']) || !empty($datas['SubHeadhunter']['number_of_employee'])) : ?>
										<?php if (!empty($back_data)) : ?>
											<?php echo $no_of_employee[$back_data['SubHeadhunter']['number_of_employee']]; ?>
										<?php else : ?>
											<?php echo $no_of_employee[$datas['SubHeadhunter']['number_of_employee']]; ?>
										<?php endif; ?>
									<?php endif; ?>
								</label>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

		<!-- Job informations -->
			<div class="x_content">
				<table class="table-st">
					<tr>
						<td colspan="3" class="labelbg">
							<div class="col-md-10 col-sm-10 col-xs-12">
								<?php echo "<label class='main-label'>Job Information</label>"; ?>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<br/>

			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<div class="form-group">
				<?php echo $this->Form->label('job_id', 'Job ID', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('job_id', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '', 'disabled' => true)); ?>
					<!-- for job_id to be shown in preview page -->
					<?php echo $this->Form->input('job_id', array('type' => 'hidden')); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label('company_id', 'Company/Headhunter Id', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('cmp_headhunter_id', array('type' => 'text','value' => $user['company_id'], 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '', 'disabled' => true)); ?>
					<!-- for cmp_headhunter_id to be shown in preview page -->
					<?php echo $this->Form->input('cmp_headhunter_id', array('type' => 'hidden')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('company_name', 'Company/Headhunter Name', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						if (!empty($user['company_name'])) {
							$co_name = $user['company_name'];
						} elseif (!empty($user['headhunter_name'])) {
							$co_name = $user['headhunter_name'];
						}
					?>

					<?php
						echo $this->Form->input('cmp_headhunter_id', array(
							'type' => 'text',
							'value' => $co_name,
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'disabled' => true
						));
					?>
					<!-- for cmp_headhunter_id to be shown in preview page -->
					<?php echo $this->Form->input('cmp_headhunter_id', array('type' => 'hidden')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('image1', 'Photo', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12'));
				?>
				<div class="col-md-8 col-sm-8 col-xs-12">

					<!-- Upload 1st image -->

						<!-- If Click "Back" button from preview page OR If validation error has occured  -->
								<?php
									if (isset($back_data) || isset($requestData)) {
										$OccupationImage1 = isset($back_data) ? $back_data['Occupation']['image1'] : $requestData['Occupation']['image1'];
										$OccupationImage2 = isset($back_data) ? $back_data['Occupation']['image2'] : $requestData['Occupation']['image2'];
										$OccupationImage3 = isset($back_data) ? $back_data['Occupation']['image3'] : $requestData['Occupation']['image3'];
									} else {
										$OccupationImage1 = $this->Form->value('image1');
										$OccupationImage2 = $this->Form->value('image2');
										$OccupationImage3 = $this->Form->value('image3');
									}
								?>
						<!-- If Click "Back" button from preview page OR If validation error has occured  -->

							<?php if (!empty($OccupationImage1)) : ?>
								<div class = "resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($OccupationImage1, array('alt' => 'story image', 'id' => 'previewHolder1', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							<?php else : ?>
								<div>
									<img id = "previewHolder1" class="hide preview" style="position: absolute;"/>
								</div>
							<?php endif ; ?>

							<a href="#" id="img-remove1" class="btn btn-blue col-md-2 delete" style = "display: <?php echo !empty($OccupationImage1) ? 'block':'none' ; ?>">Delete</a>
							<label for="file-1" class="btn btn-default">
								<span></span>
								<strong>
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
										<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
									</svg> Choose a file&hellip;
								</strong>
							</label>
							<span id="img1-name"><?php echo $OccupationImage1; ?></span>

							<?php
								echo $this->Form->input('image1',array(
									'type'=>'file',
									'label' => false,
									'id' => 'file-1',
									'style' => 'display:none'
								));
							?>

							<?php
								echo $this->Form->input('removed1', array(
									'type'=>'hidden',
									'class' => 'removed1',
									'value' => ''
								));
							?>

							<!-- for origin images to be shown in preview if the user did not change the images -->
							<?php
								echo $this->Form->input('image_origin1',array('type'=>'hidden', 'value'=> $OccupationImage1));
							?>
						<br/>
					<!-- Upload 1st image -->

					<!-- Upload 2nd image -->

					<!-- If click "Back" button  -->
					<?php if (!empty($OccupationImage2)) : ?>
						<div class = "resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
							<?php echo $this->Html->image($OccupationImage2, array('alt' => 'story image', 'id' => 'previewHolder2', "style" => "position: absolute;", "class" => "preview")); ?>
						</div>
					<?php else: ?>
						<div>
							<img id = "previewHolder2" alt = "Uploaded Image Preview Holder" class="hide preview" style="position: absolute;" />
						</div>
					<?php endif; ?>

					<a href="#" id="img-remove2" class="btn btn-blue col-md-2 delete" style = "display: <?php echo !empty($OccupationImage2) ? 'block':'none' ; ?>">Delete</a>
					<label for="file-2" class="btn btn-default">
					<span></span>
					<strong>
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
							<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
						</svg> Choose a file&hellip;
					</strong></label>
					<span id="img2-name"><?php echo $OccupationImage2; ?></span>

					<?php
						echo $this->Form->input('image2',array(
							'type'=>'file',
							'label' => false,
							'id' => 'file-2',
							'style' => 'display:none'
						));
					?>

					<?php echo $this->Form->input('removed2', array('type'=>'hidden','class' => 'removed2','value' => '')); ?>
					<!-- for origin images to be shown in preview if the user did not change the images -->
					<?php echo $this->Form->input('image_origin2',array('type'=>'hidden', 'value'=> $OccupationImage2)); ?>

					<br/>
					<!-- Upload 3rd image -->

					<!-- If click "Back" button -->
					<?php if (!empty($OccupationImage3)) : ?>
						<div class = "resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
							<?php echo $this->Html->image($OccupationImage3, array('alt' => 'story image', 'id' => 'previewHolder3', "style" => "position: absolute;", "class" => "preview")); ?>
						</div>
					<?php else: ?>
						<div>
							<img id = "previewHolder3" alt = "Uploaded Image Preview Holder" class="hide preview" style="position: absolute;" />
						</div>
					<?php endif; ?>
					<a href="#" id="img-remove3" class="btn btn-blue col-md-2 delete" style = "display: <?php echo !empty($OccupationImage3) ? 'block':'none' ; ?>">Delete</a>

					<label for="file-3" class="btn btn-default">
					<span></span>
					<strong>
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
							<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
						</svg> Choose a file&hellip;
					</strong>
					</label>
					<span id="img3-name"><?php echo $OccupationImage3; ?></span>
					<?php
						echo $this->Form->input('image3',array(
							'type'=>'file',
							'label' => false,
							'id' => 'file-3',
							'style' => 'display:none'
						));
					?>

					<?php echo $this->Form->input('removed3', array('type'=>'hidden','class' => 'removed3','value' => '')); ?>

					<!-- for origin images to be shown in preview if the user did not change the images -->
					<?php echo $this->Form->input('image_origin3',array('type'=>'hidden', 'value'=> $OccupationImage3)); ?>
					<br/>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('job title', 'Job Title<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('job_title', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength'=>'100'
						));
					?>
				</div>
			</div>

			<div class="form-group" >
				<?php
					echo $this->Form->label('salary', 'Salary', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3" >
					<?php if (!empty($salary_range)) : ?>
						<?php
							echo $this->Form->input('salary_range', array(
								'type' => 'select',
								'label' => false,
								'style'=>'width:200px;',
								'options' => $salary_range,
								'class' => 'form-control',
								'empty'=>'Please select salary' ,
								'div' => array('id' => 'small-dd-blank')
							));
						?>
					<?php endif ; ?>
				</div>
			</div>

			<div class="form-group">
				<?php $location = array('Domestic'=>'Domestic','Oversea'=>'Oversea'); ?>
				<?php
					echo $this->Form->label('location', 'Location', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('location_big_id', array(
							'type'=>'select',
							'empty' => 'please select the location',
							'class' => 'form-control col-md-7 col-xs-12',
							'options'=>$location,
							'label'=>false,
							'id' => 'location-big'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php if (!$datas['Occupation']['location_small_id']) : ?>
						<?php if (!empty($back_data)) : ?>
							<?php if (!$back_data['Occupation']['location_small_id']) : ?>
								<?php
									echo $this->Form->input('location_small_id', array(
										'type' => 'select',
										'empty' => 'please select the sub location',
										'label' => false,
										'class' => 'form-control',
										'div' => array('id' => 'small-location-blank')
									));
								?>
							<?php endif; ?>
						<?php else : ?>
							<?php
								echo $this->Form->input('location_small_id', array(
									'type' => 'select',
									'empty' => 'please select the sub location',
									'label' => false,
									'class' => 'form-control',
									'div' => array('id' => 'small-location-blank')
								));
							?>
						<?php endif; ?>
					<?php endif; ?>
					<?php
						echo $this->Form->input('location_small_id', array(
							'type' => 'select',
							'empty' => 'please select the sub location',
							'label' => false,
							'class' => 'form-control',
							'div' => array('id' => 'hide_div_location')
						));
					?>
					<?php foreach ($small_location as $key => $val): ?>
						<?php
							echo $this->Form->input('location_small_id', array(
								'type' => 'select',
								'empty' => 'please select the sub location',
								'options' => $val,
								'label' => false,
								'class' => 'form-control',
								'div' => array('class' => 'location-small', 'id' => 'location-small-' . $key)
							));
						?>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('job_category', 'Job Category<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('job_category_id', array(
							'type'=>'select',
							'empty' => 'please select the industry',
							'class' => 'form-control col-md-7 col-xs-12',
							'options'=>$big_jobcategory,
							'label'=>false,
							'id' => 'job'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
				<?php if (!$datas['Occupation']['job_category_sub_id']) : ?>
					<?php
						echo $this->Form->input('job_category_sub', array(
							'type' => 'select',
							'empty' => 'please select the sub job category',
							'label' => false,
							'class' => 'form-control',
							'div' => array('id' => 'small-location-blank')
						));
					?>
				<?php endif; ?>
				<?php if(!$error): ?>
					<?php
						echo $this->Form->input('job_category_sub', array(
							'type' => 'select',
							'empty' => 'please select the sub job category',
							'label' => false,
							'class' => 'form-control',
							'div' => array('id' => 'hide_div_job')
						));
					?>
				<?php endif; ?>
				<?php foreach ($small_jobcategory as $key => $val): ?>
					<?php
						echo $this->Form->input('job_category_sub_id', array(
							'type' => 'select',
							'empty' => 'please select the sub job category',
							'options' => $val,
							'label' => false,
							'class' => 'form-control',
							'div' => array('class' => 'sub-job', 'id' => 'sub-job-' . $key)
						));
					?>
				<?php endforeach; ?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('Responsibilty', 'Responsibilty', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('responsibility', array(
							'type' => 'textarea',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength'=>'3000'
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('requirements', 'Requirements', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('requirements', array(
							'type' => 'textarea',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength'=>'3000'
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('Number of keeps', 'Number of keeps', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php if (!empty($fav)) : ?>
						<?php
							echo $this->Html->link(sizeof($fav), array(
								'controller' => 'masteroccupations',
								'action' => 'keeper',
								h($datas['Occupation']['id'])), array(
								'label'=>false ,'class' => 'large'
							));
						?>
					<?php else : ?>
						<?php echo '0'; ?>
					<?php endif; ?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('Number of applicants', 'Number of applicants', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php if(!empty($app)):?>
						<?php
							echo $this->Html->link(sizeof($app), array(
								'controller' => 'masteroccupations',
								'action' => 'applicant',
								h($datas['Occupation']['id'])), array(
								'label'=>false ,'class' => 'large'
							));
						?>
					<?php else: ?>
						<?php echo '0'; ?>
					<?php endif; ?>
				</div>
			</div>

			<?php
				$newdeactivate_Date = '';
				$newDate = date("d M Y H:i", strtotime($datas['Occupation']['created']));
				$newlatestDate = date("d M Y H:i", strtotime($datas['Occupation']['modified']));
			?>
			<?php if (!empty($datas['Occupation']['deactivate_date'])) : ?>
				<?php
					$newdeactivate_Date = date("d M Y h:i:s A", strtotime($datas['Occupation']['deactivate_date']));
				?>
			<?php endif; ?>

			<div class="form-group">
				<?php
					echo $this->Form->label('Posted date', 'Posted date', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $newDate; ?>
				</div>

				<!-- for created date to be shown in preview page -->
				<?php echo $this->Form->input('created', array('type'=>'hidden')); ?>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('Latest update', 'Latest update', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $newlatestDate; ?>
				</div>

				<!-- for modified date to be shown in preview page -->
				<?php echo $this->Form->input('modified', array('type'=>'hidden')); ?>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('Deactivate date', 'Deactivate date', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $newdeactivate_Date ; ?>
				</div>

				<!-- for deactivate_date date to be shown in preview page -->
				<?php echo $this->Form->input('deactivate_date', array('type'=>'hidden')); ?>
			</div>

			<?php if ($user['type'] == 1) : ?>
				<?php echo $this->Form->input('industry_small_id', array('type' => 'hidden' ,'value' =>$user['industry_small'])); ?>
				<?php echo $this->Form->input('industry_big_id', array('type' => 'hidden' ,'value' =>$user['industry_big'])); ?>
			<?php elseif ($user['type'] == 0) : ?>
				<?php echo $this->Form->input('industry_big_id',array('type' => 'hidden', 'label' => false, 'id' => 'industry_big_id')); ?>
				<?php echo $this->Form->input('industry_small_id',array('type' => 'hidden', 'label' => false, 'id' => 'industry_small_id')); ?>
				<?php echo $this->Form->input('sub_headhunter_id',array('type' => 'hidden', 'label' => false, 'id' => 'sub_headhunter_id')); ?>
			<?php endif; ?>

			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<?php
						echo $this->Html->link('Cancel', array(
							'type' => 'reset',
							'controller' => 'masteroccupations',
							'action' => 'index'), array(
							'onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm'
						));
					?>

					<!-- changes preview button as a submit button -->
					<?php
						echo $this->Form->button('Preview', array(
							'type' => 'submit',
							'class' => 'btn btn-white btn-sm',
							'name' => 'preview', 'id' => 'pre'
						));
					?>
					<?php
						echo $this->Form->button('Save', array(
							'type' => 'submit',
							'class' => 'btn btn-orange btn-sm'
						));
					?>
				</div>
			</div>
			<div class="text-align" id="warning-message">
				Invalid file type. Please choose picture only. Can't go to Preview.
			</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<style type="text/css">
	.text-align {
		text-align: center;
		color: red;
	}
	.labelbg {
		background-color: #DDD;
		font-size: 17px;
		color: #fff;
	}
</style>

<script type="text/javascript">
	// show and hide error message and preview button.
	$(document).ready(function() {
		var count = 0;
		$('#warning-message').hide();
		if ($(".error-message")[0]) {
			$('#pre').prop('disabled', true);
			$('#warning-message').show();
		}

		$('.delete').on('click', function() {
			count ++;
			var message = $(this).parents().children('.error-message').length;
			if (count == message) {
				$('#pre').prop('disabled', false);
				$('#warning-message').hide();
			}
		});

		// Company information
		$('#autoselect').select2().on('change', function (e) {
			$("#address").empty();
			$("#logo").empty();
			$("#representative-postion").empty();
			$("#representative-name").empty();
			$("#industry").empty();
			$("#establishment").empty();
			$("#address").empty();
			$("#overview").empty();
			$("#hp-address").empty();
			$("#capital").empty();
			$("#number-of-employee").empty();
			var autoid = this.value;
			var str = $("#autoselect").text();
			$.ajax({
				url: "../ajaxTest",
				type: "POST",
				data:{ id : autoid },
				dataType: "html",
				success : function(response) {
					console.log("ajax seccess");
					var obj = JSON.parse(response);
					$(document).find('.contact-info').show();
					var address = obj.SubHeadhunter.location + '<br/>' + obj.SubHeadhunter.region;
					$("#address").append(address);

					var logo = '/img/'+obj.SubHeadhunter.logo;
					$("#logo").attr("src",logo);

					var representative_postion = obj.SubHeadhunter.representative_postion;
					$("#representative-postion").append(representative_postion);

					var representative_name = obj.SubHeadhunter.representative_name;
					$("#representative-name").append(representative_name);

					var industry = obj.SubHeadhunter.industry;
					$("#industry").append(industry);
					$("#industry_big_id").attr("value",obj.SubHeadhunter.industry_big_id);
					$("#industry_small_id").attr("value",obj.SubHeadhunter.industry_small_id);

					var establishment = obj.SubHeadhunter.establishment;
					$("#establishment").append(establishment);

					var overview = obj.SubHeadhunter.overview;
					$("#overview").append(overview);

					$("#hp-address").attr("href",obj.SubHeadhunter.hp_address);
					$("#hp-address").append(obj.SubHeadhunter.hp_address);
					$("#hp-address").attr("style", " color: blue;");

					if (obj.SubHeadhunter.capital_type == 1) {
						var capital = obj.SubHeadhunter.capital+' MMK';
					} else if(obj.SubHeadhunter.capital_type == 2) {
						var capital = obj.SubHeadhunter.capital+' USD';
					}
					$("#capital").append(capital);

					var number_of_employee = obj.SubHeadhunter.number_of_employee;
					$("#number-of-employee").append(number_of_employee);

					$("#sub_headhunter_id").attr("value",obj.SubHeadhunter.id);

				},
				error: function(){
				}
			});
		});
	});
</script>