<div class="container">
	<legend >User Setting</legend>
	<div class="col-md-1" ></div>
	<div class="col-md-10 profile_container" >
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'usersettings', 'action' => 'userSetting'), 'label' => false)); ?>

		<div class="newdiv_design email_div">
			<div class="row">
				<div class="col-xs-8"><img src="/img/email shiny logo.png" class="hidden-xs changeimg_size"><strong class="ch_letter">Change Email Address</strong></div>
			</div>
		</div>

		<?php if(!empty($email_edit)):?>
			<div id="email_id" style="display: block;padding: 10px;background-color:#F2F2F2;">
			<?php else:?>
				<div id="email_id" class="change_content">
				<?php endif; ?>

				<?php echo $this->Form->create('User', array('url' => array('controller' => 'usersettings', 'action' => 'userSetting'))); ?>

				<?php if(!empty($email_edit)):?>
					<font color='red'><b><?php echo $this->Session->flash(); ?></b></font>
				<?php endif; ?>

				<p>Type your new email address. We will send an email to request account verification.</p>
				<?php echo $this->Form->hidden('type', array('value' => 'email_edit')); ?>

				<div>
					<?php echo $this->Form->input('email', array( 'class' => 'form-control', 'placeholder' => 'email', 'autofocus' => true, 'autocomplete' => 'off','label' => false,'value'=>$email,'validate' => false)); ?>
				</div><br>
				<div>
					<?php echo $this->Form->input('password', array( 'class' => 'form-control', 'placeholder' => 'password', 'autocomplete' => 'off','label' => false,'value'=>$password,'maxlength'=>'20')); ?>
				</div><br>

				<div class="btn_class" style="padding-bottom:30px;">
					<?php echo $this->Form->button('Reset', array('class' =>'btn_style col-xs-12 col-lg-4')); ?><!-- btn btn-warning -->
				</div>

				<?php echo $this->Form->end(); ?>
			</div><br>

			<div class="newdiv_design password_div">
				<div class="row">
					<div class="col-xs-8"><img src='/img/pass change.png' class="changeimg_size hidden-xs"><strong class="ch_letter">Change Password</strong></div>
				</div>
			</div>

			<?php if(!empty($chg_pass)):?>
				<div id="password_change" class= 'change_content' style="display: block;">
				<?php else:?>
					<div id="password_change" class="change_content">
					<?php endif; ?>

					<?php echo $this->Form->create('User', array('url' => array('controller' => 'usersettings', 'action' => 'userSetting'))); ?>

					<?php if(!empty($chg_pass)):?>
						<font color='red'><b><?php echo $this->Session->flash(); ?></b></font>
					<?php endif; ?>


					<?php echo $this->Form->hidden('type', array('value' => 'change_pw')); ?>

					<div>
						<label>Current password</label>
						<?php echo $this->Form->input('current_password', array( 'class' => 'form-control', 'placeholder' => '', 'autocomplete' => 'off','label' => false,'type'=>'password','maxlength'=>'20')); ?>
					</div><br>

					<div>
						<?php if(!empty($pass_confirm_same)):?>
							<label>New password</label>
						<?php else: ?>
							<label>New password</label>
						<?php endif; ?>
						<?php echo $this->Form->input('newpassword', array( 'class' => 'form-control', 'placeholder' => ' Password must be 8 to 20 digits.', 'autocomplete' => 'off','label' => false,'type'=>'password','maxlength'=>'20')); ?>
					</div><br>

					<div>
						<?php if(!empty($pass_confirm_same)):?>
							<label>Enter new password again</label>
						<?php else: ?>
							<label>Enter new password again</label>
						<?php endif; ?>
						<?php echo $this->Form->input('confirmpassword', array( 'class' => 'form-control', 'placeholder' => '', 'autocomplete' => 'off','label' => false,'type'=>'password','maxlength'=>'20')); ?>
					</div><br>

					<div class="btn_class" style="padding-bottom:20px;">
						<?php echo $this->Form->input('password', array( 'autocomplete' => 'off','type'=>'hidden','value' => '')); ?>
						<?php echo $this->Form->button('Change Password', array('type'=> 'submit' ,'class' => 'btn_style col-xs-12 col-lg-4')); ?>
					</div>

					<?php echo $this->Form->end(); ?>
				</div><br>

				<div class="newdiv_design disclosure_div">
					<div class="row">
						<div class="col-xs-8"><img src="/img/non_disclosure.png" class="changeimg_size hidden-xs"><strong class="ch_letter">Non_disclosure setting</strong></div>
					</div>
				</div>
				<?php if(!empty($non_disclosure)):?>
					<div id="non_disclosure" class="change_content" style="display: block;padding: 10px;margin-bottom:20px;">
					<?php else:?>
						<div id="non_disclosure" class="change_content" style="margin-bottom:20px;">
						<?php endif; ?>

						<?php echo $this->Form->create('User', array('url' => array('controller' => 'usersettings', 'action' => 'userSetting'))); ?>

						<div>
							<strong>Prevent CV searches from specific companies.</strong>
						</div><br>

						<div>
							If you don’t want to be searched by specific companies, e.g., your current company, you can register these companies. Once registered, recruiting staff of registered companies will not be able to find your CV.

						</div><br>

						<div>
							[Note] You can only register companies that use SmartAlote. Companies using SmartAlote are increasing day by day, so it is recommended you to check your disclosure list frequently.
						</div><br>

						<?php if(!empty($non_disclosure)):?>
							<font color='red'><b><?php echo $this->Session->flash(); ?></b></font>
						<?php endif; ?><br>

						<div >
							<?php echo $this->Form->hidden('type', array('value' => 'none_disc')); ?>
							<?php echo $this->Form->input('block_cmp', array('class' => 'form-control col-md-7 col-sm-12 col-xs-12','id'=>'demo-input-local','label' => false)); ?>
						</div><br>

						<div>
						<?php echo $this->Form->button('Save', array('class' => 'col-xs-12 col-md-4 btn_style ')); ?>
						</div>

						<div class="clear"></div><br>
						<?php if(!empty($blockIds)):?>
							<table class="table-responsive" style="border: 0;">
								<?php foreach($blockIds as $blockIdKkey => $blockIdsVal):?>
									<tr>
										<td width="400px">
											<?php if(strlen($blockIdsVal) > 30) : ?>
												<strong><?php echo substr($blockIdsVal, 0, 29)."...";?></strong>
											<?php else : ?>
												<strong><?php echo $blockIdsVal;?></strong>
											<?php endif; ?>
										</td>
										<td>
											<?php echo $this->Html->link("Delete", array('controller' => 'usersettings', 'action' => 'unBlock',$blockIdKkey),array('class' => 'btn btn-primary blockCmpDelete')); ?>
										</td>
									</tr>
								<?php endforeach;?>
							</table>
						<?php else:?><br>
							<b>Not registered yet</b>
						<?php endif;?>

						<?php echo $this->Form->end(); ?>
					</div><br>

					<div class="newdiv_design Withdrawal_div">
						<div class="row">
							<div class="col-xs-8"><img src="/img/widthdraw.png" class="hidden-xs changeimg_size"><strong class="ch_letter">Withdraw from membership</strong></div>
						</div>
					</div>

					<?php echo $this->Form->create('User', array('url' => array('controller' => 'usersettings', 'action' => 'userSetting'))); ?>
					<?php echo $this->Form->hidden('type', array('value' => 'withdrawal')); ?>

					<?php if(!empty($withdraw)):?>
						<div id="Withdrawal" style="display: block;padding: 10px;background-color:#F2F2F2;">
						<?php else:?>
							<div id="Withdrawal" class="change_content">
							<?php endif; ?>
							<?php if(!empty($withdraw)):?>
								<font color='red'><b><?php echo $this->Session->flash(); ?></b></font>
							<?php endif; ?>
							<p>SmartAlote does not recommend you to withdraw!</p>
							<div>
								Once the withdrawal procedure is completed, you will lose all of your CV, application history and messages from companies. We strongly recommend you not to stop using SmartAlote but leave your account till you re-start job change activities again. We will keep your CV safe.
							</div><br>
							<div class="check btn_class" >
								<?php echo $this->Form->input('', array("type" =>"checkbox", 'id'=>'chkleft','label'=>'I will withdraw from SmartAlote.', 'required' => true));?>
							</div>

							<div>
							<?php echo $this->Form->input('password', array( 'class' => 'form-control', 'placeholder' => 'password', 'autocomplete' => 'off','label' => false,'value'=>$password,'maxlength'=>'20')); ?><br>
							<?php echo $this->Form->button('Send', array('class' => 'btn_style_widthdraw col-xs-12 col-lg-4')); ?>
							<?php echo $this->Form->end(); ?><br><br>

							<p style="color: red;">[Note] Even if you tick above and click “Send” button, your withdrawal has not completed. After your submission of your withdrawal request, SmartAlote will automatically send an email to your registered email address. You can proceed withdrawal procedure according to the instruction of the email.
							<p>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var jArray1= <?php echo json_encode($cmpName); ?> ;

			var newObject1 = [];
			$.each(jArray1, function(index, data){
				newObject1.push({
					'id': index,
					'name': data
				});
			});

			$("#demo-input-local").tokenInput(
				newObject1, {
					preventDuplicates: true
				}
				);

			$( ".email_div" ).click(function() {
				$( "#email_id" ).show();
				$( "#password_change" ).hide();
				$( "#non_disclosure" ).hide();
				$( "#Withdrawal" ).hide();
			});

			$( ".password_div" ).click(function() {
				$( "#password_change" ).show();
				$( "#email_id" ).hide();
				$( "#non_disclosure" ).hide();
				$( "#Withdrawal" ).hide();
			});

			$( ".disclosure_div" ).click(function() {
				$( "#non_disclosure" ).show();
				$( "#password_change" ).hide();
				$( "#email_id" ).hide();
				$( "#Withdrawal" ).hide();
			});

			$( ".Withdrawal_div" ).click(function() {
				$( "#Withdrawal" ).show();
				$( "#non_disclosure" ).hide();
				$( "#password_change" ).hide();
				$( "#email_id" ).hide();
			});

		});

	</script>