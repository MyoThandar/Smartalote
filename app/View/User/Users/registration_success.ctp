<div class="container">
	<div id="signupbox" class="login_box mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
		<div class="sub_box" >
			<div class="Utitle" >
				<h2>Thank you for your  registration!</h2>
			</div>
			<div class="panel-body" >
				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 " >
						<font size="3"><p>We already sent an email to the e-mail address that you registered  to complete the registration process,  please login from this email.</p>
							<p>If you do not received the email we sent, please check your e-mail address and register it again.</p>
						</font>
					</div>
				</div>
				<?php echo $this->Html->image('welcome.jpg', array('class' => 'img_reg col-md-10 col-sm-12 col-xs-12')); ?>

				<?php if (!empty($user_id)): ?>
					<?php echo $this->Html->link('My Page', array('controller' => 'mypages', 'action' => 'mypage'), array('class'=>"success_btn btn btn-info col-md-10 col-sm-12 col-xs-12")); ?>
				<?php else: ?>
					<div class="col-xs-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
						<?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'), array('class'=>"success_btn btn btn-info col-md-10 col-sm-12 col-xs-12",'style' => 'width:100%;')); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>