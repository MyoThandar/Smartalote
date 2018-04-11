<div class="container">
	<div id="signupbox"  class="login_box mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
		<div class="sub_box"  >
			<div class="Utitle" >
				<h2>Password Reset</h2>
			</div>
			<div class="panel-body" >
				<?php echo $this->Form->create('User', array('label' => false,'class'=>'form-horizontal')); ?>
				<font color='red'><b><?php echo $this->Session->flash(); ?></b></font>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<?php echo $this->Form->input('password', array('class' => 'form-control','label' => false, 'autocomplete' => 'off' , 'placeholder' => 'Please enter with 4 to 20 letters','maxlength' => 20)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<?php echo $this->Form->input('confirm_password', array('class' => 'form-control','type' => 'password','label' => false, 'autocomplete' => 'off' , 'placeholder' => 'Please enter with 4 to 20 letters' ,'maxlength' => 20)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<?php echo $this->Form->submit('Send', array('class' => 'btn btn-success','style'=>'width:100%;')); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-10 col-md-offset-4 col-xs-10 col-xs-offset-3">
						<?php echo $this->Html->link("Click here for login", "/user/login"); ?>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>