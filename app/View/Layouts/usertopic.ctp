<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo 'SmartAlote.com'; ?></title>
	<?php echo $this->Html->charset(); ?>
	<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
	<?php echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
	<?php //echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
	<?php echo $this->Html->meta(array('name '=>'description','content'=>'Your Description Here'))?>
	<?php echo $this->Html->meta(array('name '=>'keywords','content'=>'bootstrap themes, portfolio, responsive theme'))?>
	<?php echo $this->Html->meta(array('name '=>'author','content'=>'ThemeForces.Com'))?>
	<?php //echo $this->fetch('meta'); ?>
	<!-- ========== Title ========== -->
	<!-- ========== CSS ========== -->
	<?php echo $this->Html->css('tpl/bootstrap'); ?>
	<?php echo $this->Html->css('tpl/style'); ?>
	<?php echo $this->Html->css('tpl/responsive'); ?>
	<?php echo $this->Html->css('font-awesome.min'); ?>
	<?php echo $this->Html->css('token-input'); ?>
	<?php echo $this->Html->css('token-input-facebook'); ?>
	<?php echo $this->Html->css('custombtntb'); ?>
	<?php echo $this->Html->css('mobile'); ?>

	<!-- ========== JavaScript ========== -->
	<?php echo $this->Html->script('jquery.min'); ?>
	<?php echo $this->Html->script('tpl/modernizr.custom'); ?>
	<?php echo $this->Html->script('tpl/bootstrap'); ?>
	<?php echo $this->Html->script('jquery.tokeninput'); ?>
	<?php echo $this->Html->script('tpl/user'); ?>
	<?php echo $this->Html->script('tpl/activity'); ?>
		<?php echo $this->Html->script('tpl/ApplySave'); ?>
</head>
<body>


<!-- // binner -->
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
		<div class="hidden-md hidden-lg" style="margin-left: 6%;margin-bottom: -7%;margin-top: -8%;">
			<?php echo $this->Html->link($this->Html->image("JobVilla-logo-top.png"), array('controller' => 'usertpages', 'action' => 'index'), array('style' => 'width:110px;height:90px;', 'escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("myanmar_flag.jpg",array('style' => 'margin-left: 11%;')), array('controller' => 'usertpages', 'action' => 'index'), array('escape' => false,)); ?>
		</div>


		<nav class="navbar-default menu_design" >
			<div class="hidden-md hidden-lg ">
				<label class="auth-btn">
					<?php if($user_id !=null):?>
						<?php echo $this->Html->link("Logout", array('controller' => 'users', 'action' => 'logout'), array('class' => ' btn btn-info')) ?>
					<?php else:?>
						<?php echo $this->Html->link("Register", array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-warning')) ?>
						<?php echo $this->Html->link("Login", array('controller' => 'users', 'action' => 'login'), array('class' => ' btn btn-info')) ?>
					<?php endif;?>
				 </label>
			</div>
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
			<div class="collapse navbar-collapse submenu" id="bs-example-navbar-collapse-1" >
			<?php if (!empty($user_id)): ?>
				<table>
						<tr class=" hidden-xs hidden-sm tpmbar_width ">
							<td style="width:195px;"></td>
							<td class="td_design right_border"><?php echo $this->Html->link("Home", array('controller' => 'usertpages', 'action' => 'index'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?></td>
							<td class="td_design right_border"><?php echo $this->Html->link("Find Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?></td>
							<td class="td_design" ><?php echo $this->Html->link("Message", array('controller' => 'usermessages', 'action' => 'index'),array('style'=>'color:#fff')) ?></td>

							<td class="td_design">
								<?php if(!empty($cv)):?>
									<?php echo $this->Html->link("Mypage", array('controller' => 'mypages', 'action' => 'mypage',AuthComponent::user('id')),array('style'=>'color:#fff')) ?>
								<?php else:?>
									<?php echo $this->Html->link("Mypage", array('controller' => 'mypages', 'action' => 'mypage'),array('style'=>'color:#fff')) ?>
								<?php endif;?>
							</td>
							<td class="td_design" ><?php echo $this->Html->link("Activity management", array('controller' => 'useroccupations', 'action' => 'index'),array('style'=>'color:#fff')) ?></td>
							<td class="td_design" ><?php echo $this->Html->link("Settings", array('controller' => 'usersettings', 'action' => 'userSetting'),array('style'=>'color:#fff')) ?></td>
							<td style="width:195px;"></td>
						</tr>
					</table>
			<?php else: ?>
				<table>
					<tr class=" hidden-xs hidden-sm tpmbar_width ">
						<td class="td_design right_border" >
							<?php echo $this->Html->link("Home", array('controller' => 'usertpages', 'action' => 'index'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
						</td>
						<td class="td_design " >
							<a href="#FJseeker">About Us</a>
						</td>
						<td class="td_design">
							<?php echo $this->Html->link(" Find Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
						</td>
							<td class="td_design" >
								<a href="#FCrecuriter">Company Recuriters</a>
							</td>
							<td class="td_design" >
								<a href="#FHunter">Headhunter</a>
							</td>
					</tr>
				</table>
			<?php endif; ?>

			<?php if($user_id !=null):?>
				<!-- menu for login user -->
				<ul class="nav navbar-nav navbar-right sub_ul hidden-lg hidden-md">
					<li>
						<?php echo $this->Html->link("Home", array('controller' => 'usertpages', 'action' => 'index'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
					</li>
					<li>
						<?php echo $this->Html->link("Find Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
					</li>
					<li>
						<?php echo $this->Html->link("Message", array('controller' => 'usermessages', 'action' => 'index'),array('style'=>'color:#fff')) ?>
					</li>
					<li>
						<?php echo $this->Html->link("Mypage", array('controller' => 'mypages', 'action' => 'mypage'),array('style'=>'color:#fff')) ?>
					</li>
					<li>
						<?php echo $this->Html->link("Activity management", array('controller' => 'useroccupations', 'action' => 'index'),array('style'=>'color:#fff')) ?>
					</li>
					<li>
						<?php echo $this->Html->link("Settings", array('controller' => 'usersettings', 'action' => 'userSetting'),array('style'=>'color:#fff')) ?>
					</li>
				</ul>
			<?php else:?>
				<!-- for mobile view -->
				<ul class="nav navbar-nav navbar-right sub_ul hidden-lg hidden-md">
					<li>
						<?php echo $this->Html->link("Home", array('controller' => 'usertpages', 'action' => 'index'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
					</li>

					<li>
					<a href="#sm-FJseeker" style ='text-decoration:none;color:#fff'>About Us</a>
					</li>

					<li>
					<?php echo $this->Html->link(" Find Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?>
					</li>

					<li>
					<!-- <?php echo $this->Html->link("Company Recuriters", array('controller' => 'users', 'action' => 'employer_add','company'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?> -->
					<a href="#sm-FCrecuriter" style ='text-decoration:none;color:#fff'>Company Recuriters</a>
					</li>

					<li>
					<!-- <?php echo $this->Html->link("Headhunter", array('controller' => 'users', 'action' => 'employer_add','headhunter'), array('class' => '','style' =>'text-decoration:none;color:#fff')) ?> -->
					<a href="#sm-FHunter" style ='text-decoration:none;color:#fff'>Headhunter</a>
					</li>
				</ul>
			<?php endif; ?>
			</div><!-- /.navbar-collapse -->
		</nav>
	</div>
</div>




<!-- ================Content Part==============================-->
	<?php echo $this->fetch('content'); ?>
<!-- ================Footer==============================-->
<?php $user_id = AuthComponent::user('id'); ?>
<!-- for PC view footer -->
<div class="col-md-12 hidden-sm hidden-xs" style="background-color:lightgray;padding-bottom:20px;">
		<div class="col-md-2 " style="margin-left:21px;">
			<?php echo $this->Html->link($this->Html->image("JobVilla-Footer.png",array('style' => 'margin-top: -27px;margin-left: -9px;')), array('controller' => 'usertpages', 'action' => 'index',''), array('rel' => 'nofollow', 'escape' => false)); ?>
		</div>
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
					<?php echo $this->Html->link("Company Register", array('controller' => 'usertpages', 'action' => 'company_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br>
				</p>
				<p>
					<?php echo $this->Html->link("Headhunter Register", array('controller' => 'usertpages', 'action' => 'headhunter_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br>
				</p>
			<?php endif; ?>
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
<nav id="tf-footer" class="hidden-lg hidden-md" style="background-color:lightgray;padding-top:10px;">
	<div class="container" >
		<div class="row padding-top padding-bottom">
			<div class="col-md-12">
				<div class="col-md-6">
					<span class="logo"><!-- hidden-xs-->
						<?php echo $this->Html->link($this->Html->image("JobVilla-Footer.png",array('style' => 'margin-top: -14%;margin-bottom: -12%;')), array('controller' => 'usertpages', 'action' => 'index'), array('rel' => 'nofollow', 'escape' => false)); ?>
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
							<td>
								<?php  if(empty($user_id)):?>
									<p > <?php echo $this->Html->link(" Job seekers Register",
									 array('controller' => 'users', 'action' => 'add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?></p>
								<?php endif;?>
							 </td>
							<td style="padding-left:50px;"><p>
								<?php echo $this->Html->link("Terms & Conditions", array('controller' => 'userabouts', 'action' => 'term_condition'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?>
							</p></td>
						</tr>
						 <tr>
							<td>
							<?php  if(empty($user_id)):?>
								<p ><?php echo $this->Html->link("Company Register", array('controller' => 'usertpages', 'action' => 'company_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br></p>
								<p ><?php echo $this->Html->link("Headhunter Register", array('controller' => 'usertpages', 'action' => 'headhunter_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br></p>
							<?php endif ?>
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
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-sm hidden-xs">
	<div class="top-title col-md-offset-3" style="margin-left: 24%;">
		<h3>Copyright 2017 SmartAlote. All Rights Reserved</h3>
	</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-md hidden-lg">
	<div class="top-title col-md-offset-4 footer_center">
		<h4>Copyright 2017 SmartAlote. All Rights Reserved</h4>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$('body').append('<div id="backToTop"><img src="/img/up-arrow.png"</div>');
	$(window).scroll(function () {
		if ($(this).scrollTop() <= 200) {
			$('#backToTop').fadeOut();
		} else {
			$('#backToTop').fadeIn();
		}
	});
	$('#backToTop').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});
</script>
<style type="text/css">
	#backToTop{
		position: fixed;
		bottom: 0;
		right: 10px;
		cursor: pointer;
		display: none;
		color: #fff;
	}
</style>