<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<?php echo $this->Session->flash(); ?>
<div class="x_panel">

	<?php echo $this->Form->create('Occupation', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'demo-form2', 'autocomplete' => 'off')); ?>

<!-- Job registration -->
	<div class="x_title">
		<h2>Job Register</h2>
		<div class="clearfix"></div>
	</div>

	<!-- Company information -->
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
	<?php endif ; ?>

	<div class="form-group">
		<?php if ($user['type'] == 0) : ?>
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
						'id' => 'autoselect'
					));
				?>
			</div>
		<?php endif ; ?>
		<div>
			<div class="contact-info" style="<?php if(!empty($datas)) echo 'display: block;'; else echo 'display: none;'; ?>">
				<div class="form-group">
					<br/><br/><br/><br/><br/>
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
					<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="address">
						<?php if (!empty($datas)) : ?>
							<?php echo $datas['SubHeadhunter']['location'].'<br/>'; ?>
							<?php if (!empty($datas['SubHeadhunter']['region'])) : ?>
								<?php echo $region[$datas['SubHeadhunter']['region']]; ?>
							<?php endif; ?>
						<?php endif; ?>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Photo </label>
					<?php if (!empty($datas)) : ?>
						<?php $logo = "/img/".$datas['SubHeadhunter']['logo'] ; ?>
						<img src = <?php echo $logo; ?> style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; postion: relative;" id="logo">
					<?php else : ?>
						<img style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; postion: relative;" id="logo">
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Representative postion </label>
					<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="representative-postion">
						<?php if (!empty($datas)) : ?>
							<?php echo $datas['SubHeadhunter']['representative_postion']; ?>
						<?php endif; ?>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Representative name </label>
					<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="representative-name">
						<?php if (!empty($datas)) : ?>
							<?php echo $datas['SubHeadhunter']['representative_name']; ?>
						<?php endif; ?>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Industry </label>
					<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="industry">
						<?php if (!empty($datas)) : ?>
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
						<?php if (!empty($datas)) : ?>
							<?php echo $datas['SubHeadhunter']['establishment']; ?>
						<?php endif; ?>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Business overview </label>
					<label class=col-md-3 col-sm-3 col-xs-3" style="width: 50%;padding-top: 9px;" id="overview">
						<?php if (!empty($datas)) : ?>
							<?php echo $datas['SubHeadhunter']['overview']; ?>
						<?php endif; ?>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">HP address</label>
					<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;">
						<a id="hp-address" href="<?php if(!empty($datas)) echo $datas['SubHeadhunter']['hp_address']; ?>" style="color: blue;">
							<?php if (!empty($datas)) : ?>
								<?php echo $datas['SubHeadhunter']['hp_address']; ?>
							<?php endif; ?>
						</a>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Capital</label>
					<label class="col-md-3 col-sm-3 col-xs-3" style="width: auto;padding-top: 9px;" id="capital">
						<?php if (!empty($datas)) : ?>
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
						<?php if (!empty($datas['SubHeadhunter']['number_of_employee'])) : ?>
							<?php if (!empty($datas)) : ?>
								<?php echo $no_of_employee[$datas['SubHeadhunter']['number_of_employee']]; ?>
							<?php endif; ?>
						<?php endif; ?>
					</label>
				</div>
			</div>
		</div>

	</div>

	<!-- Job registration -->
	<div class="x_content">
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

		<div class="form-group">
			<?php echo $this->Form->label('job_id', 'Job ID', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php
					echo $this->Form->input('job_id', array(
						'type' => 'text',
						'value' => $UserCode ,
						'label' => false,
						'class' => 'form-control col-md-7 col-xs-12',
						'autocomplete' => 'off' ,
						'placeholder' => '',
						'disabled' => true
					));
				?>
			</div>
		</div>

		<div class="form-group">
			<?php
				echo $this->Form->label('company_id', 'Company/Headhunter ID', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
				));
			?>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php
					echo $this->Form->input('company_id', array(
						'type' => 'text',
						'value' => $user['company_id'],
						'label' => false,
						'class' => 'form-control col-md-7 col-xs-12',
						'autocomplete' => 'off' ,
						'placeholder' => '',
						'disabled' => true
					));
				?>
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
					if (!empty($user['headhunter_name'])) {
						$co_name = $user['headhunter_name'] ;
					} elseif (!empty($user['company_name'])) {
						$co_name = $user['company_name'] ;
					}
				?>

				<?php
					echo $this->Form->input('company_id', array(
						'type' => 'text',
						'value' => $co_name,
						'label' => false,
						'class' => 'form-control col-md-7 col-xs-12',
						'autocomplete' => 'off' ,
						'placeholder' => '',
						'disabled' => true
					));
				?>
			</div>
		</div>

		<!--Image upload-->
		<div class="form-group">
			<?php echo $this->Form->label('logo', 'Photo', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
			<div class="col-md-8 col-sm-8 col-xs-12" style="padding-left: 24px;">

				<?php
					if (isset($requestData)) {
						if (!empty($requestData['Occupation']['image1'])) {
							$image1 = $requestData['Occupation']['image1'];
						}
						if (!empty($requestData['Occupation']['image2'])) {
							$image2 = $requestData['Occupation']['image2'];
						}
						if (!empty($requestData['Occupation']['image3'])) {
							$image3 = $requestData['Occupation']['image3'];
						}
					}
				?>

				<!-- Upload 1st image -->
				<?php if(isset($image1)): ?>
					<div class="resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
						<?php
							echo $this->Form->input('logo1',array(
								'type' => 'hidden',
								'label' => false,
								'value' => $image1,
								'id' => 'img-hidden-val'
							));
						?>

						<?php
							echo $this->Html->image($image1, array(
								'alt' => 'Uploaded Image Preview Holder',
								'id' => 'previewHolder1',
								"style" => "position: absolute;",
								"class" => "preview"
							));
						?>
					</div>
					<a href="#" id="img-remove1" class="btn btn-blue col-md-2">Delete</a>
					<label for="file-1" class="btn btn-default">
						<span></span>
						<strong>
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
							</svg> Choose a file&hellip;
						</strong>
					</label>
					<span id="img1-name"><?php echo $image1; ?></span>
				<?php else: ?>
					<div>
						<img id="previewHolder1" alt="Uploaded Image Preview Holder" class="hide" style="position: absolute;" />
					</div>
					<!-- <div class="clearfix"></div> -->
					<div>
						<a href="#" id="img-remove1" class="btn btn-blue col-md-2" style="display:none;">Delete</a>
						<label for="file-1" class="btn btn-default">
							<span></span>
							<strong>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
									<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
								</svg> Choose a file&hellip;
							</strong>
						</label>
						<span id="img1-name"></span>
					</div>
				<?php endif; ?>

				<?php
					echo $this->Form->input('image1',array(
						'type'=>'file',
						'label' => false,
						'id' => 'file-1',
						'style' => 'display:none'
					));
				?>

				<!-- Upload 2nd image -->
				<?php if(isset($image2)): ?>
					<div class="resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
						<?php
							echo $this->Form->input('logo2',array(
								'type' => 'hidden',
								'label' => false,
								'value' => $image2,
								'id' => 'img2-hidden-val'
							));
						?>
						<?php
							echo $this->Html->image($image2, array(
								'alt' => 'Uploaded Image Preview Holder',
								'id' => 'previewHolder2',
								"style" => "position: absolute;",
								"class" => "preview"
							));
						?>
					</div>
					<a href="#" id="img-remove2" class="btn btn-blue col-md-2">Delete</a>
					<label for="file-2" class="btn btn-default">
						<span></span>
						<strong>
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
							</svg> Choose a file&hellip;
						</strong>
					</label>
					<span id="img2-name"><?php echo $image2; ?></span>
				<?php else: ?>
					<div>
						<img id="previewHolder2" alt="Uploaded Image Preview Holder" class="hide" style="position: absolute;" />
					</div>

					<a href="#" id="img-remove2" class="btn btn-blue col-md-2" style="display:none;">Delete</a>
					<label for="file-2" class="btn btn-default">
						<span></span>
						<strong>
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
							</svg> Choose a file&hellip;
						</strong>
					</label>
					<span id="img2-name"></span>
				<?php endif; ?>

				<?php
					echo $this->Form->input('image2',array(
						'type'=>'file',
						'label' => false,
						'id' => 'file-2',
						'style' => 'display:none'
					));
				?>

				<!-- Upload 3rd image -->
				<?php if(isset($image3)): ?>
					<div class="resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
						<?php
							echo $this->Form->input('logo3',array(
								'type' => 'hidden',
								'label' => false,
								'value' => $image3,
								'id' => 'img3-hidden-val'
							));
						?>
						<?php
							echo $this->Html->image($image3, array(
								'alt' => 'Uploaded Image Preview Holder',
								'id' => 'previewHolder3',
								"style" => "position: absolute;",
								"class" => "preview"
							));
						?>
					</div>
					<a href="#" id="img-remove3" class="btn btn-blue col-md-2">Delete</a>
					<label for="file-3" class="btn btn-default">
						<span></span>
						<strong>
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
							</svg> Choose a file&hellip;
						</strong>
					</label>
					<span id="img3-name"><?php echo $image3; ?></span>
				<?php else: ?>
					<div>
						<img id="previewHolder3" alt="Uploaded Image Preview Holder" class="hide" style="position: absolute;" />
					</div>

					<div>
						<a href="#" id="img-remove3" class="btn btn-blue col-md-2" style="display:none;">Delete</a>
						<label for="file-3" class="btn btn-default">
							<span></span>
							<strong>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
									<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
								</svg> Choose a file&hellip;
							</strong>
						</label>
						<span id="img3-name"></span>
					</div>
				<?php endif; ?>

				<?php
					echo $this->Form->input('image3',array(
						'type'=>'file',
						'label' => false,
						'id' => 'file-3',
						'style' => 'display:none'
					));
				?>

				<br/>
			</div>
		</div>

		<div class="form-group">
			<?php
				echo $this->Form->label('job title', 'Job Title <span class="required">*</span>', array(
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
				<?php
					echo $this->Form->input('salary_range', array(
						'type'=>'select',
						'empty' =>'Please select salary range',
						'class' => 'form-control col-md-7 col-xs-12',
						'options'=>$salary_range,
						'label'=>false,
						'id' => 'locatioin-big'
					));
				?>
			</div>
		</div>

		<div class="form-group">
			<?php if(!empty($requestData)):?>
				<div id="error-back" style="display: none;">1</div>
			<?php endif; ?>

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
				<?php
					echo $this->Form->input('location_small_id', array(
						'type' => 'select',
						'empty' => 'please select the sub location',
						'label' => false,
						'class' => 'form-control',
						'div' => array('id' => 'small-location-blank')
					));
				?>

				<?php foreach ($small_location as $lockey => $locval): ?>
					<?php
						echo $this->Form->input('location_small_id', array(
							'type' => 'select',
							'empty' => 'please select the sub location',
							'options' => $locval,
							'label' => false,
							'class' => 'form-control',
							'div' => array('class' => 'location-small', 'id' => 'location-small-' . $lockey)
						));
					?>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="form-group">
			<?php
				echo $this->Form->label('job_category_id', 'Job Category <span class="required">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
				));
			?>
			<div class="col-md-3 col-sm-3 col-xs-3">
				<?php
					echo $this->Form->input('job_category_id', array(
						'type'=>'select',
						'empty' => 'please select the job category',
						'class' => 'form-control col-md-7 col-xs-12',
						'options'=>$big_jobcategory,
						'label'=>false,
						'id' => 'job'
					));
				?>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3">
				<?php if(!$error): ?>
					<?php
						echo $this->Form->input('job_category_sub_id', array(
							'type' => 'select',
							'empty' => 'please select the small job category',
							'label' => false,
							'class' => 'form-control',
							'div' => array('id' => 'sub-job-blank')
						));
					?>
				<?php endif; ?>

				<?php foreach ($small_jobcategory as $jobkey => $jobval) : ?>
					<?php
						echo $this->Form->input('job_category_sub_id', array(
							'type' => 'select',
							'empty' => 'please select the small job category',
							'options' => $jobval,
							'label' => false,
							'class' => 'form-control',
							'div' => array('class' => 'sub-job', 'id' => 'sub-job-' . $jobkey)
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

		<?php if ($user['type'] == 1) : ?>
			<?php echo $this->Form->input('industry_small_id', array('type' => 'hidden' ,'value' =>$user['industry_small'])); ?>
			<?php echo $this->Form->input('industry_big_id', array('type' => 'hidden' ,'value' =>$user['industry_big'])); ?>
		<?php elseif ($user['type'] == 0) : ?>
			<?php echo $this->Form->input('industry_big_id',array('type' => 'hidden', 'label' => false, 'id' => 'industry_big_id')); ?>
			<?php echo $this->Form->input('industry_small_id',array('type' => 'hidden', 'label' => false, 'id' => 'industry_small_id')); ?>
			<?php echo $this->Form->input('sub_headhunter_id',array('type' => 'hidden', 'label' => false, 'id' => 'sub_headhunter_id')); ?>
		<?php endif; ?>

	</div>

<!-- End of Job registration -->

<!-- Operations -->
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			<?php
				echo $this->Html->link('Cancel', array(
					'type' => 'reset',
					'controller' => 'masteroccupations',
					'action' => 'index'), array(
					'onclick' => 'return confirm(" Do you want to cancel?")',
					'class' => 'btn btn-gray btn-sm'
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
	<?php echo $this->Form->end(); ?>
</div>

<style type="text/css">
	.labelbg {
		background-color: #DDD;
		font-size: 17px;
		color: #fff;
	}
	/* Autocomplement components design */

	.ui-widget {
		font-family: Arial,Helvetica,sans-serif;
		font-size: 1em;
	}

	.ui-widget .ui-widget {
		font-size: 1em;
	}

	.ui-widget input,
	.ui-widget select,
	.ui-widget textarea,
	.ui-widget button {
		font-family: Arial,Helvetica,sans-serif;
		font-size: 1em;
	}

	.ui-widget.ui-widget-content {
		border: 1px solid #c5c5c5;
	}

	.ui-widget-content {
		border: 1px solid #dddddd;
		background: #ffffff;
		color: #333333;
		width: 10%;
	}

	.ui-state-active,
	.ui-widget-content .ui-state-active,
	.ui-widget-header .ui-state-active,
	a.ui-button:active,
	.ui-button:active,
	.ui-button.ui-state-active:hover {
		border: 1px solid #003eff;
		background: #007fff;
		font-weight: normal;
		color: #ffffff;
	}

	/* End of Autocomplement */

	/* Auto Div for auto select */
	.auto-div {
		width: 17%;
	}

	.contact-info-text {
		margin-left: 100px;
		margin-top: 40px;
		font-size: 14px;
	}
	.company-info {
		margin-top: 9px;
		margin-left: 12px;
	}
</style>


<script type="text/javascript">
$(document).ready(function(){
	// $(document).find('.contact-info').hide();
	$('#autoselect').select2().on('change', function (e) {

		$("#address").empty();
		$("#logo").empty();
		$("#representative-postion").empty();
		$("#representative-name").empty();
		$("#industry").empty();
		$("#establishment").empty();
		$("#region").empty();
		$("#industry").empty();
		$("#overview").empty();
		$("#hp-address").empty();
		$("#capital").empty();
		$("#number-of-employee").empty();
		var autoid = this.value;
		var str = $("#autoselect").text();
		$.ajax({
			url: "ajaxTest",
			type: "POST",
			data:{ id : autoid },
			dataType: "html",
			success : function(response){
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