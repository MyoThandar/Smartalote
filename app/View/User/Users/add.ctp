<div class="container">
	<div id="signupbox" class="login_box mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
		<div class="sub_box" >

			<div class="Utitle" >
				<h2>Sign Up</h2>
			</div>

			<!--  START disable true of false register button after error message -->
			<?php if(!empty($checkbtn)) :?>
				<?php $checkbtn = $checkbtn ;?>
			<?php else:?>
				<?php $checkbtn = '' ;?>
			<?php endif;?>
			<?php echo $this->Form->hidden('type', array('class'  => 'hiddenFieldchkbtn','value' => $checkbtn)); ?>
			<!--  END disable true of false register button after error message -->

			<div class="panel-body" >
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'), 'label' => false,'class'=>'form-horizontal')); ?>

				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'email ', 'autofocus' => true, 'autocomplete' => 'off','label' => false, 'maxlength' => 60)); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<?php echo $this->Form->input('password', array( 'class' => 'form-control', 'placeholder' => 'password', 'autocomplete' => 'off', 'label' =>false, 'maxlength' => 20)); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<?php echo $this->Form->input('confirm_password', array('type' => 'password','class' => 'form-control', 'placeholder' => 'confirm password', 'autocomplete' => 'off','label' =>false, 'maxlength' => 20)); ?>
					</div>
				</div>


				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<label class="control control--checkbox">I have read and agree to SmartAlote's
						<?php
							echo $this->Html->link("Privacy Policy", array(
								'controller' => 'userabouts',
								'action' => 'privacy_policy'), array(
								'label' => false,'class'=>'blue_link'
							));
						?> and
						<?php
							echo $this->Html->link(" Terms & Conditions", array(
								'controller' => 'userabouts',
								'action' => 'term_condition'), array(
								'label' => false,'class'=>'blue_link'
							));
						?> of use
							<?php echo $this->Form->checkbox('remember_me'); ?>
							<div class="control__indicator"></div>
						</label>
					</div>
				</div>


				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 hidden-xs hidden-sm">
						<?php echo $this->Form->button('Register', array('class' =>'btn btn-warning btn-md btn-block disabledBtn')); ?>
					</div>
				</div>

				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 hidden-md hidden-lg">
						<?php echo $this->Form->button('Register', array('class' =>'btn btn-warning btn-md btn-block disabledBtn','style'=>'width:100%;')); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-1 col-sm-8  col-xs-10 ">
						With your social media account
					</div>
				</div>

				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 hidden-xs hidden-sm">
						<?php
						echo $this->Html->link($this->Html->image('facebook-login.jpg', array('style' => 'border-radius: 3px;width:100%')), array('controller' => 'users', 'action'=>'facebookLogin'),
							array( 'escape' => false)); ?>
					</div>
					<div class="hidden-lg">
						<?php
						echo $this->Html->link($this->Html->image('facebook-login.jpg', array('style' => 'border-radius: 3px;width:86%;margin-left:7%;')), array('controller' => 'users', 'action'=>'facebookLogin'),
							array( 'escape' => false)); ?>
					</div>
				</div>


				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						Already have a SmartAlote account ?&nbsp&nbsp<?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'logout'),array( 'label' => false)); ?>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
<style type="text/css" media="screen">
	button.btn {
		margin:0px;
		transition: all 0.5s;
	}

	.control {
		font-size: 14px;
		position: relative;
		display: block;
		margin-bottom: 15px;
		padding-left: 30px;
		cursor: pointer;
	}

	label {
		font-weight: normal;
	}

	.control input[type=checkbox] {
		position: absolute;
		z-index: -1;
		opacity: 0;
	}

	.control__indicator {
		position: absolute;
		top: 2px;
		left: 0;
		width: 20px;
		height: 20px;
		background: #fff;
		border: 1px solid #cccccc;
		border-radius: 4px;
	}

	.control--radio .control__indicator {
		border-radius: 50%;
	}

	/* Hover and focus states */
	.control:hover input[type=checkbox] ~ .control__indicator,
	.control input[type=checkbox]:focus ~ .control__indicator {
		background: #fff;
	}

	/* Checked state */
	.control input[type=checkbox]:checked ~ .control__indicator {
		background: #084B8A;
	}

	/* Hover state whilst checked */
	.control:hover input[type=checkbox]:not([disabled]):checked ~ .control__indicator,
	.control input[type=checkbox]:checked:focus ~ .control__indicator {
		background: #084B8A;
	}


	/* Check mark */
	.control__indicator:after {
		position: absolute;
		display: none;
		content: '';
	}

	/* Show check mark */
	.control input[type=checkbox]:checked ~ .control__indicator:after {
		display: block;
	}

	/* Checkbox tick */
	.control--checkbox .control__indicator:after {
		top: 3px;
		left: 7px;
		width: 4px;
		height: 9px;
		transform: rotate(45deg);
		border: solid #fff;
		border-width: 0 2px 2px 0px;
	}

	/* Disabled tick colour */
	.control--checkbox input[type=checkbox]:disabled ~ .control__indicator:after {
		border-color: #7b7b7b;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){

		// START disable true of false register button after error message
		var checkbtn = $(".hiddenFieldchkbtn").val();
		if(checkbtn == ''){
			$('.disabledBtn').attr("disabled", true);
		} else {
			$('.disabledBtn').attr("disabled", false);
		}
		// END disable true of false register button after error message

		// For validation error.
		var validateCheck = $('input[type="checkbox"]').prop("checked");
		if (validateCheck == true) {
			$('.disabledBtn').attr("disabled", false);
		} else {
			$('.disabledBtn').attr("disabled", true);
		}

		$('input[type="checkbox"]').click(function(){
			if($(this).prop("checked") == true){
				$('.disabledBtn').attr("disabled", false);
			}else if($(this).prop("checked") == false){
				$('.disabledBtn').attr("disabled", true);
			}
		});
	});
</script>
