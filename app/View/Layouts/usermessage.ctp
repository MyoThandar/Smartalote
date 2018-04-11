<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
	<?php echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
	<?php //echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
	<?php echo $this->Html->meta(array('name '=>'description','content'=>'Your Description Here'))?>
	<?php echo $this->Html->meta(array('name '=>'keywords','content'=>'bootstrap themes, portfolio, responsive theme'))?>
	<?php echo $this->Html->meta(array('name '=>'author','content'=>'ThemeForces.Com'))?>
	<?php //echo $this->fetch('meta'); ?>
	<!-- ========== Title ========== -->
	<title><?php echo 'SmartAlote.com'; ?></title>
	<!-- ========== CSS ========== -->
	<?php echo $this->Html->css('tpl/bootstrap.min'); ?>
	<?php echo $this->Html->css('font-awesome.min'); ?>
	<?php echo $this->Html->css('tpl/style'); ?>
	<?php echo $this->Html->css('tpl/responsive'); ?>
	<?php echo $this->Html->css('tpl/content_style'); ?>
	<?php echo $this->Html->css('message'); ?>
	<?php echo $this->Html->css('custombtntb'); ?>

	<!-- ========== JavaScript ========== -->
	<?php echo $this->Html->script('jquery-1.12.4'); ?>
	<?php echo $this->Html->script('tpl/bootstrap'); ?>
	<?php echo $this->Html->script('jquery.tokeninput'); ?>
	<?php echo $this->Html->script('tpl/user'); ?>

	<style type="text/css" media="screen">
		.mail-box {
			border-collapse: collapse;
			border-spacing: 0;
			display: table;
			table-layout: fixed;
			width: 90%;
			margin: auto;
		}
		.inbox-body {
			padding: 10px;
			margin-bottom: 60px;
		}
		ul.inbox-nav li a {
			color: #6a6a6a;
			display: inline-block;
			line-height: 45px;
			padding: 0 20px;
			width: 100%;
			text-decoration: none;
		}
		button.btn, a.btn {
			margin: 0px 0px;
		}

		.x_title > h2
		{
			margin-left: 69px;
		}

		.inbox-pagination a.np-btn {
			padding: 6px 15px;
		}

		.row {
			margin-right: 0;
			margin-left: 0;
		}

	</style>
</head>
<body>
	<?php $user_id =AuthComponent::user('id');?>
	<?php $CV = $this->Session->read('CV') ;?>
	<div id="tf-home" >
		<div class="overlay" >
			<div id="sticky-anchor"></div>

			<!-- for pc view -->
			<div class="hidden-xs hidden-sm col-md-12" id="arrow" style="background-color: #fff !important;">
				<div  class="col-md-3" style="margin-top: -1%;">
					<?php echo $this->Html->link($this->Html->image("large_jobvilla.png"), array('controller' => 'usertpages', 'action' => 'index'), array('escape' => false)); ?>&nbsp&nbsp
					<?php echo $this->Html->link($this->Html->image("myanmar_flag.jpg"), array('controller' => 'usertpages', 'action' => 'index'), array('escape' => false,)); ?>
				</div>
				<div class="col-md-6" style="margin-top: 30px;">
					<span>SmartAlote.com is the brand new and comprehensive job search site for Myanmar people.<br>Register now and receive schouting message!</span>
				</div>
				<div class="col-md-3" style="margin-top: 20px;">
					<label><!-- margin-left:800px; -->
						<?php if($user_id !=null):?>
							<?php 	echo $this->Html->link("Logout", array('controller' => 'users', 'action' => 'logout'), array('class' =>'btn btn-info tp_logbtn')) ;?>
						<?php else:?>
							<?php echo $this->Html->link("Register", array('controller' => 'users', 'action' => 'add'), array('class' =>'btn btn-warning pc_btn_reg pc_regbtn','style' =>'border-radius:none !important;')) ?>
							<?php 	echo $this->Html->link("Login", array('controller' => 'users', 'action' => 'login'), array('class' =>'btn btn-info tp_logbtn')) ;?>
						<?php endif;?>
					</label>
				</div>
			</div>

			<!-- for mobile view -->
			<div class="hidden-md hidden-lg">
				<?php echo $this->Html->link($this->Html->image("JobVilla-logo-top.png",array('style' => '    margin-top: -7%;margin-bottom: -7%;margin-left: 5%;')), array('controller' => 'usertpages', 'action' => 'index'), array('style' => 'width:110px;height:90px;', 'escape' => false)); ?>
				<?php echo $this->Html->link($this->Html->image("myanmar_flag.jpg",array('style' => 'margin-left: 3%;')), array('controller' => 'usertpages', 'action' => 'index'), array('escape' => false,)); ?>
			</div>

			<nav class="navbar-default menu_design" >
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" >
					<button id="main_menu" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<!-- for pc view -->
				<div class="collapse navbar-collapse submenu"   id="bs-example-navbar-collapse-1" >
					<?php  if($user_id !=null):?>
						<!-- menu for login user -->
						<table>
							<tr class=" hidden-xs tpmbar_width ">
								<td style="width:195px;"></td>
								<td  class="td_design right_border"><?php echo $this->Html->link(" Home", array('controller' => 'usertpages', 'action' => 'index'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?></td>
								<td  class="td_design" >
									<?php echo $this->Html->link("Find Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
								</td>
								<td  class="td_design" ><?php echo $this->Html->link("Message", array('controller' => 'usermessages', 'action' => 'index'),array('style'=>'color:#fff')) ?></td>
								<td  class="td_design" ><?php echo $this->Html->link("My Page", array('controller' => 'mypages', 'action' => 'mypage'),array('style'=>'color:#fff')) ?></td>
								<td  class="td_design" ><?php echo $this->Html->link("Activity management", array('controller' => 'useroccupations', 'action' => 'index'),array('style'=>'color:#fff')) ?></td>
								<td  class="td_design" ><?php echo $this->Html->link("Settings", array('controller' => 'usersettings', 'action' => 'userSetting'),array('style'=>'color:#fff')) ?></td>
								<td  style="width:195px;"></td>
							</tr>
						</table>
					<?php else:?>
						<!-- menu for no login user -->
						<table>
							<tr class=" hidden-xs tpmbar_width ">
								<td style="width:470px;"></td>
								<td  class="td_design right_border"><?php echo $this->Html->link(" Home", array('controller' => 'usertpages', 'action' => 'index'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?></td>
								<td  class="td_design" >
									<?php echo $this->Html->link("Find Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
								</td>

								<td  style="width:470px;"></td>
							</tr>
						</table>
					<?php endif;?>
					<!-- for mobile view -->
					<?php  if($user_id !=null):?>
						<!-- menu for login user -->
						<ul class="nav navbar-nav navbar-right sub_ul  hidden-sm hidden-lg hidden-md">
							<li>
								<?php echo $this->Html->link(" Home", array('controller' => 'usertpages', 'action' => 'index'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
							</li>
							<li>
								<?php echo $this->Html->link("Find Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
							</li>
							<li>
								<?php echo $this->Html->link("Message", array('controller' => 'usermessages', 'action' => 'index'),array('style'=>'color:#fff')) ?>
							</li>
							<li>
									<?php echo $this->Html->link("My Page", array('controller' => 'mypages', 'action' => 'mypage'),array('style'=>'color:#fff')) ?>
							</li>
							<li>
								<?php echo $this->Html->link("Activity management", array('controller' => 'useroccupations', 'action' => 'index'),array('style'=>'color:#fff')) ?>
							</li>
							<li>
								<?php echo $this->Html->link("Settings", array('controller' => 'usersettings', 'action' => 'userSetting'),array('style'=>'color:#fff')) ?>
							</li>
						</ul>
					<?php else:?>
						<!-- menu for login user -->
						<ul class="nav navbar-nav navbar-right sub_ul  hidden-sm hidden-lg hidden-md">
							<li>
								<?php echo $this->Html->link(" Home", array('controller' => 'usertpages', 'action' => 'index'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
							</li>
							<li>
								<?php echo $this->Html->link("Find Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
							</li>
						</ul>
					<?php endif;?>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>
	</div>
	<!-- ================Content Part==============================-->
	<?php echo $this->fetch('content'); ?>
	<!-- ================Footer==============================-->
	<!-- for PC view footer -->
	<div class="col-md-12 hidden-sm hidden-xs" style="background-color:lightgray;padding-bottom:20px;margin-top:90px;">
		<div class="col-md-2 " style="margin-left:21px;margin-top: -2%;"><?php echo $this->Html->link($this->Html->image("JobVilla-Footer.png"), array('controller' => 'usertpages', 'action' => 'index'), array('rel' => 'nofollow', 'escape' => false)); ?></div>
		<div class="col-md-2 pc_footer_JV">
			<p style="color:#000; font-size:22px;">SmartAlote</p>
				<?php  if(empty($user_id)):?>
					<p>
						<?php echo $this->Html->link(" Job seekers Register",
						array('controller' => 'users', 'action' => 'add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?>
					</p>
				<?php endif; ?>
				<p >
					<?php echo $this->Html->link("Search for Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br>
				</p>
				<?php  if(empty($user_id)):?>
					<p >
						<?php echo $this->Html->link("Company Register", array('controller' => 'users', 'action' => 'employer_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br>
					</p>
					<p>
						<?php echo $this->Html->link("Headhunter Register", array('controller' => 'users', 'action' => 'employer_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br>
					</p>
				<?php  endif; ?>
		</div>
		<div class="col-md-2  pc_footer_JV">
			<p style="color:#000; font-size:22px;">Company</p>
			<p>
				<?php echo $this->Html->link("Terms & Conditions", array('controller' => 'userabouts', 'action' => 'term_condition'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?>
			</p>
			<p>
				<?php echo $this->Html->link("Help", array('controller' => 'userabouts', 'action' => 'help'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?>
			</p>
			<p >
				<?php echo $this->Html->link("Contact Us", array('controller' => 'userabouts', 'action' => 'contactus'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?>
			</p>
		</div>

	</div>
	<!-- for mobile view footer -->
	<nav id="tf-footer" class="hidden-lg hidden-md" style="background-color:lightgray;margin-top:10px;padding-top:10px;">
		<div class="container" >
			<div class="row padding-top padding-bottom">
				<div class="col-md-12">
					<div class="col-md-6">
						<span class="logo "><!-- hidden-xs-->
							<?php echo $this->Html->link($this->Html->image("JobVilla-Footer.png",array('style' => 'margin-top: -10%;margin-bottom: -10%;')), array('controller' => 'usertpages', 'action' => 'index'), array('rel' => 'nofollow', 'escape' => false)); ?>
						</span>
						<table>
							<tr>
								<td><p style="color:#000; font-size:22px;">SmartAlote</p></td>
								<td style="padding-left:50px;"><p style="color:#000; font-size:22px;">Company</p></td>
							</tr>
							<tr>
								<td><p ><?php echo $this->Html->link("Search for Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br></p></td>
								<td style="padding-left:50px;"><p> <?php echo $this->Html->link("Help", array('controller' => 'userabouts', 'action' => 'help'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?></p></td>
							</tr>
							<tr>
								<td><?php  if(empty($user_id)):?><p > <?php echo $this->Html->link(" Job seekers Register",
								array('controller' => 'users', 'action' => 'add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?></p><?php endif;?></td>
								<td style="padding-left:50px;"><p>
									<?php echo $this->Html->link("Terms & Conditions", array('controller' => 'userabouts', 'action' => 'term_condition'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?>
								</p></td>
							</tr>
							<tr>

									<td>
										<?php  if(empty($user_id)):?>
											<p><?php echo $this->Html->link("Company's  Register", array('controller' => 'users', 'action' => 'employer_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br></p>
											<p><?php echo $this->Html->link("Headhunter's  Register", array('controller' => 'users', 'action' => 'employer_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br></p>
										<?php  endif;?>
									</td>
									<td style="padding-left:50px;"><p > <?php echo $this->Html->link("Contact Us", array('controller' => 'userabouts', 'action' => 'contactus'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?></p></td>

							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>
	<div class="col-md-12 copyright" >
		Copyright 2017 SmartAlote. All Rights Reserved
	</div>
</body>
</html>