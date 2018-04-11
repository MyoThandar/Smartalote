<div>
	<a class ="hiddenanchor" id="signup"></a>
	<div class ="login_wrapper">
		<div class ="animate form login_form">
			<section class ="login_content">
				<?php echo $this->Form->create('CmpHeadhunter', array('url' => array('controller' => 'masterusers', 'action' => 'login'), 'label' => false)); ?>
					<h4 style="color:#fff;font-size: 17px;">SmartAlote Recruiter portal</h4>
					<font color="red"><?php echo $this->Session->flash(); ?></font>
					<div>
						<?php if ($email) : ?>
							<?php echo $this->Form->input('email', array( 'value'=> $email, 'class' => 'form-control', 'placeholder' => 'email', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
						<?php else : ?>
							<?php echo $this->Form->input('email', array( 'class' => 'form-control', 'placeholder' => 'email', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
						<?php endif; ?>
					</div>
					<div>
						<?php if ($password) : ?>
							<?php echo $this->Form->input('password', array( 'value' => $password,'class' => 'form-control', 'placeholder' => 'password', 'autocomplete' => 'off','label' => false)); ?>
						<?php else : ?>
							<?php echo $this->Form->input('password', array( 'class' => 'form-control', 'placeholder' => 'password', 'autocomplete' => 'off','label' => false)); ?>
						<?php endif; ?>
					</div>
					<p class ="remember_check" style="color:#fff">
						<?php echo $this->Form->checkbox('remember_me',array('checked'=> !empty($password)? true : false)); ?>
						<?php echo $this->Form->label('remember_me', 'Do you remember'); ?>
					</p>
					<div>
						<?php echo $this->Form->button('Login', array('class' => 'btn btn-default submit')); ?>
					</div>
					<p class ="current_limit">
						<?php echo $this->Html->link("Click here if you forgot your password", array('controller' => 'masterusers', 'action' => 'remind'),array( 'label' => false,'style'=>'color:#fff')); ?>
					</p>
					<div class ="clearfix"></div>
					<div class ="separator">
						<div class ="clearfix"></div>
						<br />
						<div>
							<h1><i><img src="../img/JobVilla-6.png" style="margin-top: -53px; margin-bottom: -74px;"></i></h1>
							<p style="color:#fff">Copyright © SmartAlote All rights reserved. </p>
						</div>
					</div>
				<?php echo $this->Form->end(); ?>
			</section>
		</div>
	</div>
</div>
