<div class="container">
	<div id="signupbox" class="login_box mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
		<div class="sub_box" >

			<div class="Utitle" >
				<h2>Sign In With SmartAlote Account</h2>
			</div>

			<div class="panel-body" >
				<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'), 'label' => false,'class'=>'form-horizontal')); ?>
				<?php echo $this->Session->flash(); ?>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<?php if($email): ?>
							<?php echo $this->Form->input('email', array( 'value'=> $email, 'placeholder' => 'email', 'autofocus' => true, 'autocomplete' => 'off','label' => false,'type'=>'text', 'class' => 'form-control')); ?>
						<?php else: ?>
							<?php echo $this->Form->input('email', array('placeholder' => 'email', 'autofocus' => true, 'autocomplete' => 'off','label' => false,'type'=>'text', 'class' => 'form-control')); ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<?php if ($password): ?>
							<?php echo $this->Form->input('password', array('value' => $password, 'placeholder' => 'password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
						<?php else: ?>
							<?php echo $this->Form->input('password', array('placeholder' => 'password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
					<?php if(!empty($remember_me)):?>
						<?php echo $this->Form->checkbox('remember_me',array('checked'=>true)); ?>
					<?php  else:?>
						<?php echo $this->Form->checkbox('remember_me' ); ?>
					<?php endif;?>
						<?php echo $this->Form->label('remember_me', 'Do you remember');?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<!-- <?php echo $this->Html->link("Click here if you forgot your password", array('controller' => 'users', 'action' => 'remind'),array( 'label' => false,'target' =>'_blank')); ?> -->
						<?php echo $this->Html->link("Click here if you forgot your password", array('controller' => 'users', 'action' => 'remind'),array( 'label' => false,'target' =>'_blank')); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1 hidden-xs hidden-sm">
						<?php echo $this->Form->button('Login', array('class'=>'btn btn-info btn-md btn-block','type'=>'submit')); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1 hidden-lg hidden-md">
						<?php echo $this->Form->button('Login', array('class'=>'btn btn-info btn-sm btn-block','type'=>'submit','style'=>'width:100%;')); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-1 col-sm-8  col-xs-10 ">
						With your social media account
					</div>
				</div>

				<div class="form-group" >
					<div class="col-md-10  col-md-offset-1 hidden-xs hidden-sm">
						<?php
						echo $this->Html->link($this->Html->image('facebook-login.jpg', array('style' => 'border-radius: 5px;width:100%;')), array('controller' => 'users', 'action'=>'facebookLogin'),
							array( 'escape' => false)); ?>
					</div>
					<div class="col-md-10 col-md-offset-1 hidden-lg hidden-md">
						<?php
					echo $this->Html->link($this->Html->image('facebook-login.jpg', array('style' => 'border-radius: 3px;width:100%')), array('controller' => 'users', 'action'=>'facebookLogin'),
							array( 'escape' => false)); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-md-offset-1 col-sm-8  col-xs-10 ">
						Don't have an Account? <?php echo $this->Html->link("Register Now!", array('controller' => 'users', 'action' => 'add'),array( 'label' => false,'target' =>'_blank')); ?>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.btn-facebook{
		color:#fff;
		background-color:#3b5998;
		border-color:rgba(0,0,0,0.2);
	}
	.btn-facebook:hover,.btn-facebook:focus,.btn-facebook:active,.btn-facebook.active,.open .dropdown-toggle.btn-facebook {
		color:#fff;
		background-color:#30487b;
		border-color:rgba(0,0,0,0.2)}
	button.btn {
		margin:0px;
		transition: all 0.5s;
	}
	.message {
		color: red;
		padding-left: 9%;
	}

	/*---------- mobile -----------*/
	@media screen and (max-width: 768px) and (max-width: 992px) {
	.message {
		color: red;
		padding-left: 0%;
	}
</style>