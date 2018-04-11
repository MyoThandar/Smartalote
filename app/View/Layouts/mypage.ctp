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
	<?php echo $this->Html->css('tpl/bootstrap'); ?>
	<?php echo $this->Html->css('tpl/style'); ?>
	<?php echo $this->Html->css('tpl/responsive'); ?>
	<?php echo $this->Html->css('token-input'); ?>
	<?php echo $this->Html->css('font-awesome.min'); ?>
	<?php echo $this->Html->css('token-input-facebook'); ?>
	<?php echo $this->Html->css('custombtntb'); ?>
	<?php echo $this->Html->css('tpl/content_style'); ?>
	<?php echo $this->Html->css('mobile'); ?>

	<!-- ========== JavaScript ========== -->
	<?php echo $this->Html->script('jquery-1.10.2'); ?>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->Html->script('custom'); ?>
</head>
<body>
	<?php $user_id =AuthComponent::user('id');?>
	<?php $CV = $this->Session->read('CV') ;?>
	<div id="tf-home" >
		<div class="overlay" >
			<div id="sticky-anchor"></div>

			<!-- for pc view -->
			<div class="hidden-xs hidden-sm col-md-12" id="arrow" style="background-color: #fff !important;">
				<div  class="col-md-3">
					<?php echo $this->Html->link($this->Html->image("large_jobvilla.png"), array('controller' => 'usertpages', 'action' => 'index'), array('escape' => false)); ?>&nbsp&nbsp
					<?php echo $this->Html->link($this->Html->image("myanmar_flag.jpg"), array('controller' => 'usertpages', 'action' => 'index'), array('escape' => false,)); ?>
				</div>

				<div class="col-md-6" style="margin-top: 30px;">
					<span>SmartAlote.biz is the brand new and comprehensive job search site for Myanmar people.<br>Register now and receive schouting message!</span>
				</div>

				<div class="col-md-3" style="margin-top: 20px;">
					<label><!-- margin-left:800px; -->
						<?php if($user_id !=null):?>
							<?php 	echo $this->Html->link("Logout", array('controller' => 'users', 'action' => 'logout'), array('class' =>'btn btn-info tp_logbtn')) ;?>
						<?php endif;?>
					</label>
				</div>

			</div>

			<!-- for mobile view -->
			<div class="hidden-sm hidden-md hidden-lg " >
				<?php echo $this->Html->link($this->Html->image("JobVilla-logo-top.png"), array('controller' => 'usertpages', 'action' => 'index'), array('style' => 'width:110px;height:90px;', 'escape' => false)); ?>
				<?php echo $this->Html->link($this->Html->image("myanmar_flag.jpg"), array('controller' => 'usertpages', 'action' => 'index'), array('escape' => false,)); ?>
			</div>

			<div style="height: 89px;" class="hidden-xs hidden-sm"></div>

			<nav class="navbar-default menu_design" style="height: 50px;">
				<!-- for mobile view -->
				<div class="hidden-md hidden-lg">
					<label class="auth-btn">
						<?php if($user_id !=null):?>
							<?php echo $this->Html->link("Logout", array('controller' => 'users', 'action' => 'logout'), array('class' => ' btn btn-info','style'=> 'margin-top:15px;')) ?>
						<?php endif;?>
					</label>

					<!-- Brand and toggle get grouped for better mobile display -->
					<button id="main_menu" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

				</div>

				<!-- for pc view -->
				<div class="collapse navbar-collapse submenu" id="bs-example-navbar-collapse-1" >
					<!-- menu for login user -->
					<table>
						<tr class=" hidden-xs tpmbar_width ">
							<td></td>
						</tr>
					</table>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>
	</div>

	<!-- ================Content Part==============================-->
	<?php echo $this->fetch('content'); ?>
	<!-- ================Footer==============================-->


	<!-- for PC view footer -->
	<div class="col-md-12 hidden-sm hidden-xs" style="background-color:lightgray;padding-bottom:20px;margin-top:90px;">
		<div class="col-md-2 " style="margin-left:21px;"><?php echo $this->Html->link($this->Html->image("JobVilla-Footer.png"), array('controller' => 'usertpages', 'action' => 'index'), array('rel' => 'nofollow', 'escape' => false)); ?></div>
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
					<?php echo $this->Html->link("Company Register", array('controller' => 'users', 'action' => 'company_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br>
				</p>
				<p>
					<?php echo $this->Html->link("Headhunter Register", array('controller' => 'users', 'action' => 'headhunter_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br>
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
							<?php echo $this->Html->link($this->Html->image("JobVilla-Footer.png"), array('controller' => 'usertpages', 'action' => 'index'), array('rel' => 'nofollow', 'escape' => false)); ?>
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
											<p><?php echo $this->Html->link("Company's  Register", array('controller' => 'users', 'action' => 'company_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br></p>
											<p><?php echo $this->Html->link("Headhunter's  Register", array('controller' => 'users', 'action' => 'headhunter_add'), array('class' => '','style' =>'text-decoration:none;color:#000')) ?><br></p>
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
	<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title">
		<div class="top-title col-md-offset-3" style="margin-left: 24%;">
			<h3>Copyright 2017 SmartAlote. All Rights Reserved</h3>
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