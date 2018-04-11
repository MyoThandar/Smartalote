<div>
	<a class="hiddenanchor" id="signup"></a>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<?php echo $this->Form->create('CmpHeadhunter', array('class' => 'login-form', 'label' => false, 'type' => 'post', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
					<h1 style="color:#fff">Password Reset</h1>
					<font color='red'><b><?php echo $this->Session->flash(); ?></b></font>
					<div>
						<?php echo $this->Form->input('email', array( 'class' => 'form-control', 'placeholder' => 'email', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
					<div class="action mailremind">
						<?php echo $this->Form->submit('Send', array('class' => 'btn btn-md btn-success btn-block')); ?>
						<div class="clear"> </div>
					</div>
					<p class="current_limit" ><?php echo $this->Html->link("Click here for login", "/master/login",array('style'=>'color:#fff')); ?></p>
					<div class="clearfix"></div>
					<div class="separator">
						<div class="clearfix"></div>
						<br />
						<div>
							<h1><i><img src="../img/JobVilla-6.png" style="margin-top: -53px; margin-bottom: -74px;"></i></h1><br>
							<p style="color:#fff">Copyright © SmartAlote All rights reserved. </p>
						</div>
					</div>
					<div class="clearfix"></div>
				<?php echo $this->Form->end(); ?>
			</section>
		</div>
	</div>
</div>