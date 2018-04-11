<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('User', array('type' => 'file', 'class' => ' form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<h2 class="cv7-name" >
			Registration Procedure(1/3)
		</h2>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3 >Personal Information</h3>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3 >Personal Information</h3>
				</div>
			</div>
		</div>
		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color" style="">Name<span class = "required"> *</span></p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('name', array('type' => 'text', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' =>'border-radius:3px;width: 106%;','maxlength' => 45)); ?>
				</div>
			</div>
		</div>
		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Gender<span class = "required"> *</span></p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('gender', array('type' => 'select', 'options' => array(1=>'Male',2 => 'Female'), 'label' => false,'empty'=>'Gender', 'label'=>false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' =>'border-radius:3px;width: 106%;')); ?>
				</div>
			</div>
		</div>
		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Birthday<span class = "required"> *</span></p>
			<div class="col-md-8" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12" >
					<div class="col-md-2 form-group" >
						<?php echo $this->Form->input('day', array('type'=>'select', 'options'=>$day, 'empty'=>'Day', 'label'=>false, 'class' => 'form-control select_height day_width ','style'=>'border-radius:3px;')); ?>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-2 form-group month_pad ">
						<?php echo $this->Form->input('month', array('type'=>'select', 'options'=>$month, 'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height day_width','style'=>'border-radius:3px')); ?>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-2 form-group year_pad" >
						<?php echo $this->Form->input('year', array('type'=>'select', 'options'=>$birthyear, 'empty'=>'Year', 'class' => 'form-control select_height day_width', 'label'=>false,'style'=>'border-radius:3px')); ?>
					</div>
				</div>
			</div>
			<p class="col-md-4 control-label cv_three_font letter_color">Nationality</p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('nationality', array('type' => 'select', 'options' =>$nationality, 'label' => false,'empty'=>'Nationality', 'label'=>false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' ,'style' =>'border-radius:3px;width: 106%;','maxlength' => 35)); ?>
				</div>
			</div>
		</div>
		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Address<span class = "required"> *</span></p>
			<div class="col-md-6" >
				<div class=" input-group col-md-9 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('location', array(
							'type' => 'select',
							'options' =>$location,
							'required' => true,
							'label' => false,
							'empty'=>'Location',
							'label'=>false,
							'class' => 'form-control cv_one_email select_height',
							'autocomplete' => 'off',
							'style' =>'border-radius:3px;width: 106%;'
						));
					?>
					<?php
						echo $this->Form->input('address', array(
							'type' => 'textarea',
							'label' => false,
							'required' => true,
							'class' => 'form-control cv_one_email select_height',
							'placeholder' => 'Address',
							'autocomplete' => 'off',
							'style' =>'border-radius:3px;margin-top:15px;width: 106%;',
							'maxlength' => 100
						));
					?>
				</div>
			</div>
		</div>
		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Phone<span class = "required"> *</span></p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('phone_number', array(
							'type' => 'text',
							'required' => true,
							'label' => false,
							'class' => 'form-control cv_one_email select_height',
							'autocomplete' => 'off',
							'maxlength' => 20,
							'style' =>'border-radius:3px;width: 106%;'
						));
					?>
				</div>
				<div class="col-md-12" style="margin-top: 10px;">
					<div  id = "check_character" style="display: none;">
						<span >Please choose valid Phone Number!</span>
					</div>
					<div  id = "least_three" style="display: none;">
						<span >Please enter at least 8 Number!</span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Email</p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('email', array('type' => 'email', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'value' => !empty($email) ? $email : '', 'autocomplete' => 'off' ,'readonly' => true,'style' =>'border-radius:3px;width: 106%;')); ?>
				</div>
			</div>
		</div>
		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Religion</p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('religion', array('type' => 'select', 'options' =>$religion, 'label' => false,'empty'=>'Religion', 'label'=>false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' ,'style' =>'border-radius:3px;width: 106%;')); ?>
				</div>
			</div>
		</div>
		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Marital Status</p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('marital_status', array('type' => 'select', 'options' =>$marital_status, 'label' => false,'empty'=>'Marital status', 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' ,'style' =>'border-radius:3px;width: 106%;')); ?>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-sm-6 col-xs-12 btn_save_cancel" >
			<div class="col-md-3  col-md-offset-5 btn_save">
				<?php echo $this->Form->button('Continue', array('type' => 'submit', 'class' => 'cv-save', 'autocomplete' => 'off','style' => 'padding: 8px 70px !important; ')); ?>
			</div>
		</div>
	<?php echo $this->Form->end(); ?>
</div>

<style type="text/css">
	.form-group.internal {
		margin-bottom: 0;
	}
	.indent-small {
		margin-left: 5px;
	}
	.attachment {
		margin-top: 30px;
	}

	.attachment ul {
		width: 100%;
		list-style: none;
		padding-left: 0;
		display: inline-block;
		margin-bottom: 30px;
	}

	.attachment ul li {
		float: left;
		width: 150px;
		margin-right: 10px;
		margin-bottom: 10px;
	}

	.attachment ul li img {
		height: 150px;
		border: 1px solid #ddd;
		padding: 5px;
		margin-bottom: 10px;
	}

	.attachment ul li span {
		float: right;
	}

	.attachment .file-name {
		float: left;
	}

	.attachment .links {
		width: 100%;
		display: inline-block;
	}

	.error-message,.required {
		color : red;
	}

</style>

<script>
	$(document).ready(function() {
		//validation phone number
		$(".cv-save").click(function() {
			if ($("#UserPhoneNumber").val() != "") {
				if(!($.isNumeric($('#UserPhoneNumber').val()))){
					$("#least_three").hide();
					$("#check_character").show();
					$("#check_character").children().css({"color": "red"});
					$("#check_character").children().css({"margin-left": "-11px"});
					return false;
				}

				if (($("#UserPhoneNumber").val().length) < 8) {
					$("#check_character").hide();
					$("#least_three").show();
					$("#least_three").children().css({"color": "red"});
					$("#least_three").children().css({"margin-left": "-11px"});
					return false;
				}
			}


		});
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
