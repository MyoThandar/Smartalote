<div class="x_panel">
	<div class="x_title">
		<h2>Company Register</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
		<?php
			echo $this->Form->create('CmpHeadhunter', array(
				'type' => 'file',
				'class' => 'form-horizontal form-label-left',
				'inputDefaults' => array(
					'label' => false,
					'div' => false
				),
				'id' => 'demo-form2',
				'autocomplete' => 'off'
			));
		?>

			<div class="form-group">
				<?php
					echo $this->Form->label('id', 'Company ID', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('id', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'value' => $UserCode,
							'disabled' => true
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('company_name', 'Company Name<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('company_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100',
							'id' => 'companyName',
							'required' => false
						));
					?>
				</div>
				<div id='companyValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Company Name</div>
			</div>

			<div class="form-group" style="border-bottom: none; ">
				<?php
					echo $this->Form->label('phone_no', 'Phone Number', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('company_phone', 'Main<span class="required">*</span>', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-5'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<span class=" error">
						<?php
							echo $this->Form->input('company_phone', array(
								'type' => 'text',
								'label' => false,
								'class' => 'form-control col-md-7 col-xs-5',
								'autocomplete' => 'off' ,
								'placeholder' => '',
								'maxlength' => '20',
								'id' => 'phoneMain',
								'required' => false
							));
						?>
					</span>
				</div>
				<div id='phoneMainValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Phone Number.</div>
			</div>

			<div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('mobile', 'Sub', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
				<span class=" error">
					<?php
						echo $this->Form->input('mobile', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'placeholder' => '',
							'maxlength' => '20'
						));
					?>
				</span>
				</div>
			</div>

			<div class="form-group" style="border-bottom: none; ">
				<?php
					echo $this->Form->label('location', 'Address <span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<?php
						echo $this->Form->input('location', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100',
							'id' => 'address',
							'required' => false
						));
					?>
				</div>
				<div id='addressValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Address</div>
			</div>

			<div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-3 col-sm-3 col-xs-3">
				<span class="error">
					<?php
						echo $this->Form->input('region', array(
							'type' => 'select',
							'options'=> !empty($location) ? $location : array(),
							'label'=>false,
							'class' => 'form-control'
						));
					?>
				</span>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('logo', 'Company logo <span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">

					<?php if (!empty($image)) : ?>
						<div class="resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
							<?php
								echo $this->Form->input('image',array(
									'type' => 'hidden',
									'label' => false,
									'value' => $image,
									'id' => 'img-hidden-val'
								));
							?>
							<?php
								echo $this->Html->image($image, array(
									'id' => 'previewHolder',
									"style" => "position: absolute;",
									"class" => "preview"
								));
							?>
						</div>
						<br/>
						<label for="file-7" class="btn btn-default">
							<span></span>
							<strong>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
									<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
								</svg> Choose a file&hellip;
							</strong>
						</label>
						<span id="img-name"><?php echo $image; ?></span>

					<?php else : ?>
						<div>
							<img id="previewHolder" alt="Uploaded Image Preview Holder" class="hide" style="position: absolute;" />
						</div>
						<div class="clearfix"></div>
						<label for="file-7" class="btn btn-default">
							<span></span>
							<strong>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
									<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
								</svg> Choose a file&hellip;
							</strong>
						</label>
						<span id="img-name"></span>

					<?php endif; ?>

					<?php
						echo $this->Form->input('logo',array(
							'type' => 'file',
							'label' => false,
							'id' => 'file-7',
							'style' => 'display:none',
							'required' => false
						));
					?>
					<span id = 'image-message' ></span>
				</div>
				<div id='imageValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose The Image</div>
			</div>

			<div class="form-group" style="border-bottom: none; ">
				<?php
					echo $this->Form->label('representative', 'Representative', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('representative_postion', 'Position<span class="required">*</span>', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-5'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<?php
						echo $this->Form->input('representative_postion', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '50',
							'id' => 'rPosition',
							'required' => false,
						));
					?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->label('noti', '<span class="required">※</span> e.g., CEO, Managing Director, etc.', array(
							'class' => 'control-label'
						));
					?>
				</div>
				<div id='positionValidate1' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Position.</div>
			</div>

			<div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('representative_name', 'Name<span class="required">*</span>', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<?php
						echo $this->Form->input('representative_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'id' => 'rName',
							'required' => false,
							'maxlength' => '50'
						));
					?>
				</div>
				<div id='nameValidate1' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Name.</div>
			</div>

			<div class="form-group" style="border-bottom: none; ">
				<?php
					echo $this->Form->label('contact', 'Contact', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('contact_position', 'Position<span class="required">*</span>', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-5'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<?php
						echo $this->Form->input('contact_position', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'id' => 'cPosition',
							'required' => false,
							'maxlength' => '50'
						));
					?>
				</div>
				<div id='positionValidate2' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Position.</div>
			</div>

			<div class="form-group" style="border-bottom: none; ">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('contact_name', 'Name<span class="required">*</span>', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<?php
						echo $this->Form->input('contact_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'id' => 'cName',
							'required' => false,
							'placeholder' => '',
							'maxlength' => '50'
						));
					?>
				</div>
				<div id='nameValidate2' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Name.</div>
			</div>

			<div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('email', 'Email Address<span class="required">*</span>', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<?php
						echo $this->Form->input('email', array(
							'type' => 'email',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'id' => 'email',
							'required' => false,
							'maxlength' => '60'
						));
					?>
				</div>
				<div id='emailValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Email Address.</div>
			</div>
			<div class="form-group">
				<?php
					echo $this->Form->label('industry', 'Industry <span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('industry_big', array(
							'type' => 'select',
							'empty' => 'please select the industry',
							'class' => 'form-control col-md-7 col-xs-12',
							'options'=>$big_industry,
							'label'=>false,
							'id' => 'industry-big',
							'required' => false
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php if (!$error): ?>
						<?php
							echo $this->Form->input('industry-small', array(
								'type' => 'select',
								'empty' => 'please select the sub industry',
								'label' => false,
								'class' => 'form-control',
								'div' => array('id' => 'small-industry-blank')
							));
						?>
					<?php endif; ?>

					<?php foreach ($small_industry as $key => $val): ?>
						<?php
							echo $this->Form->input('industry_small', array(
								'type' => 'select',
								'empty' => 'please select the sub industry',
								'options' => $val,
								'label' => false,
								'class' => 'form-control',
								'div' => array('class' => 'industry-small', 'id' => 'industry-small-' . $key)
							));
						?>
					<?php endforeach; ?>
				</div>
				<div id='industryValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Industry</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('Establishment', 'Establishment', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-1">
						<?php echo $this->Form->label('day', 'Day'); ?>
					</div>
					<div class="col-md-3 headhunday" >
						<?php echo $this->Form->input('day', array('type' => 'select', 'options'=>$day,'empty' => 'Day', 'label'=>false, 'class' => 'form-control' ,'style' => 'width:80px;')); ?>
					</div>
					<div class="col-md-2">
						<?php echo $this->Form->label('month', 'Month '); ?>
					</div>
					<div class="col-md-3 headhun_month" >
						<?php echo $this->Form->input('month', array('type' => 'select', 'options'=>$month,'empty' => 'Month', 'label'=>false, 'class' => 'form-control')); ?>
					</div>
					<div class="col-md-1">
						<?php echo $this->Form->label('year', 'Year'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->input('year', array('type' => 'select', 'options'=>$year,'empty' => 'Year', 'class' => 'form-control', 'label'=>false)); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label('business_overview', 'Business Overview', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php if ($error): ?>
						<?php echo $this->Form->input('overview', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'value' => $text,'maxlength' => '3000')); ?>
					<?php else : ?>
						<?php echo $this->Form->input('overview', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label('mail_limit', 'The limitation of number of mail transmissions', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-7 col-sm-7 col-xs-7">
					<?php echo $this->Form->input('mail_limit', array(
						'options' => $mail_transmission,
						'empty' => 'Please choose mail transmissions ',
						'class' => 'form-control col-md-6 col-sm-6 col-xs-6',
						'style' => 'padding-top: 8px;width: 45%;padding-bottom: 8px;'
						)); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label('hp_address', 'HP Address', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('hp_address', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '200')); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label('capital', 'Capital', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php echo $this->Form->input('capital_type', array(
						'options' => array(1=>'MMK',2 => 'USD'),
						'class' => 'control-label col-md-6 col-sm-6 col-xs-6' ,
						'style' => 'width: 79px; height: 33px;'
						)); ?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<?php if (!empty($unformat_num)) : ?>
						<span class="error">
						<?php echo $this->Form->input('capital', array('type' => 'text','value' => $unformat_num , 'label' => false, 'class' => 'form-control col-md-7 col-xs-5', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '15')); ?>
						</span>
					<?php else: ?>
						<span class="error">
							<?php echo $this->Form->input('capital', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-5', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '15')); ?>
						</span>
					<?php endif ; ?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('employee', 'Number of Employee <span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<span class="error">
						<?php
							echo $this->Form->input('number_of_employee', array(
								'type' => 'select',
								'options' => $employee ,
								'empty' => 'Choose number of employee' ,
								'label' => false,
								'required' => false,
								'id' => 'numberOfEmp',
								'class' => 'form-control col-md-7 col-xs-5'
							));
						?>
					</span>
				</div>
				<div id='empValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Number of Employee.</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('password', 'Password<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('password', array(
							'type' => 'password',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'id' => 'password',
							'required' => false,
							'maxlength' => '20',
							'minlength' => '8'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php echo $this->Form->label('noti', '<span class="required">※ </span>Password must be 8 to 20 digits. ', array('class' => 'control-label','style' => 'text-align: left;')); ?>
				</div>
				<div id='passwordValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Password.</div>
			</div>

			<div class="form-group no-line">
				<?php
					echo $this->Form->label('confirm_password', 'Confirm Password<span class="error">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<span class="error">
						<?php
							echo $this->Form->input('confirm_password', array(
								'type' => 'password',
								'label' => false,
								'class' => 'form-control col-md-7 col-xs-5',
								'autocomplete' => 'off' ,
								'placeholder' => '',
								'id' => 'passwordConfirm',
								'required' => false,
								'maxlength' => '20',
								'minlength' => '8'
							));
						?>
					</span>
				</div>
				<div id='passwordConfirmValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Confirm Password.</div>
			</div>

			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'admincompanys', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
					<?php if (!empty($image)) : ?>
						<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm')); ?>
					<?php else : ?>
						<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm','id' => 'imageSubmit')); ?>
					<?php endif; ?>
				</div>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<style type="text/css">
	.error, .required{
		color: red;
	}
	.form-group {
		padding-bottom: 10px;
		border-bottom: 1px solid #D9DEE4;
	}
	.form-group.no-line {
		border-bottom: none;
	}
	.logo-space{
		margin-left: -65px;
		border:none;
		color:red;
	}
	.logo-space-before{
		margin-left: -14px;
		border:none;
		color:red;
	}
	.space{
		padding-left: 65px;
	}
	.Message {
		margin-left: 248px;
		color: red;
	}
</style>

<script>
	$(document).ready(function (){
		// redesign the validation error message.
		if ($('.headhunday .error-message').length) {

			// get the parent div.
			var parent = $('.headhunday .error-message').parent().parent().parent();

			// detach the div.
			var validateMessage = $('.headhunday .error-message').detach();
			validateMessage.addClass('col-md-12');
			validateMessage.css('padding-left', '27%');

			// add detached div to its corresponding parent div.
			$.each(parent, function(index, value) {
				parent[index].append(validateMessage[index]);
			});
		}
	});
</script>