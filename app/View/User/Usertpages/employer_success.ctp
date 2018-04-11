<div class="container">
<!-- 	<div id="signupbox" style="margin-top:20px" class="mainbox col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2 ">
		<div class="panel panel-info w3-hover-shadow" >

			<div class="panel-heading" >
				<h4>Thank you for your  registration!</h4>
			</div> -->
	<div id="signupbox" class="login_box mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
		<div class="sub_box" >
			<div class="Utitle" >
				<h2>Thank you for your  registration!</h2>
			</div>

			<div class="panel-body" >
				<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'logout'), 'label' => false,'class'=>'form-horizontal')); ?>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<p>Thank you so much for your interest in SmartAlote! Your registered information was successfully delivered to SmartAlote team. You can surely find the right person for you with SmartAlote.</p><br>
						<p>We sent an e-mail to confirm that the registered e-mail address is correct. Please check your mailbox. If the mail has not arrived, the entered information may be incorrect. In that case, please register again from the Registration form.</p>
					</div>
				</div>
					<img   style="" src="/img/welcome.jpg" class="img_reg col-md-10 col-sm-12 col-xs-12">
					<!-- <?php echo $this->Form->submit('Home', array('class'=>"success_btn btn btn-info col-md-10 col-sm-12 col-xs-12")); ?> -->
				</div>

				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>