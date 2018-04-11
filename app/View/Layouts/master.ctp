<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<?php echo $this->Html->meta(null, null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
		<?php echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
		<?php echo $this->fetch('meta'); ?>
		<!-- ========== Title ========== -->
		<title><?php echo 'SmartAlote.com_Recruiter Portal'; ?></title>
		<!-- ========== CSS ========== -->
		<?php echo $this->Html->css('bootstrap.min'); ?>
		<?php echo $this->Html->css('font-awesome.min'); ?>
		<?php echo $this->Html->css('nprogress'); ?>
		<?php echo $this->Html->css('master.custom.min'); ?>
		<?php echo $this->Html->css('green'); ?>
		<?php echo $this->Html->css('adstyle'); ?>
		<?php echo $this->Html->css('masterstyle'); ?>
		<?php echo $this->Html->css('message'); ?>
		<?php echo $this->Html->css('custombtntb'); ?>
		<?php echo $this->Html->css('masterstyle'); ?>
		<?php echo $this->Html->css('token-input'); ?>
		<?php echo $this->Html->css('token-input-facebook'); ?>
		<?php echo $this->Html->css('select2.min'); ?>
		<?php echo $this->Html->script('jquery.min'); ?>
		<?php echo $this->Html->script('bootstrap.min'); ?>
		<?php echo $this->Html->script('select2.min'); ?>
		<?php echo $this->Html->script('plusimage'); ?>
		<?php echo $this->Html->script('jquery.tokeninput'); ?>
		<?php echo $this->Html->script('selectize'); ?>
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;margin-left: 70px;margin-left: -11px;">
							<br/>
							<?php echo $this->Html->link('<img src= "/img/JobVilla-6.png" alt="SmartAlote" ><span class="right-side-menu"> &nbsp;SmartAlote</span>', array('controller' => 'master', 'action' => 'job/index'), array('class' => 'site_title', 'escape' => false,'style' => 'width: 100%; height:112px;margin-top: -71px;')) ?>
						</div>
						<div class="clearfix"></div>
						<!-- menu profile quick info -->
						<div class="profile">
							<div class="profile_pic" >
								<?php if (!empty($LoginedInfo['CmpHeadhunter']['logo'])) : ?>
									<?php echo $this->Html->image($LoginedInfo['CmpHeadhunter']['logo'], array('alt' => '...', 'class' => 'img-circle profile_img')); ?>
								<?php endif; ?>
							</div>
							<div class="profile_info">
								<span>Welcome</span>
								<h2>
									<?php if ($LoginedUser['type'] == 1) : ?>
										<?php if(strlen($LoginedUser['company_name']) > 10): ?>
											<?php echo mb_substr($LoginedUser['company_name'],0,10,'UTF-8')."..."; ?>
										<?php else: ?>
											<?php echo h($LoginedUser['company_name']); ?>
										<?php endif; ?>
									<?php else: ?>
										<?php if(strlen($LoginedUser['headhunter_name']) > 10): ?>
											<?php echo mb_substr($LoginedUser['headhunter_name'],0,10,'UTF-8')."..."; ?>
										<?php else: ?>
											<?php echo h($LoginedUser['headhunter_name']); ?>
										<?php endif; ?>
									<?php endif; ?>
								</h2>
							</div>
						</div>
						<!-- /menu profile quick info -->

						<br />
						<div class="clearfix"></div>
						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<ul class="nav side-menu">
									<?php if ($LoginedUser['type'] == false) : ?>
										<li><a><i class="fa fa-home"></i><?php echo "Company" ; ?><span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu">
												<li>
													<?php echo $this->Html->link('Company List', array('controller' => 'masterheadhunters', 'action' => 'index')); ?>
												</li>
											</ul>
										</li>
									<?php endif; ?>
									<li><a><i class="fa fa-edit"></i> <?php echo "Job" ; ?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li><?php echo $this->Html->link('Job List', array('controller' => 'masteroccupations', 'action' => 'index')); ?></a></li>
										</ul>
									</li>
									<li><a><i class="fa fa-users"></i> <?php echo "Jobseeker " ; ?><span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php echo $this->Html->link('Jobseeker Search', array('controller' => 'masterjobseekers', 'action' => 'index')); ?>
											</li>
											<li style="display: none">
												<?php
												for ($p=1; $p < 1000 ; $p++) {
													echo $this->Html->link('Browse', array('controller' => 'masterappliedjobseekers', 'action' => 'browse', $p));
												} ?>
											</li>
											<li>
												<?php echo $this->Html->link('Kept Jobseeker List', array('controller' => 'masterkeptjobseekers', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Applied Jobseeker List', array('controller' => 'masterappliedjobseekers', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Saved Jobseeker List', array('controller' => 'mastersavedjobseekers', 'action' => 'index')); ?>
											</li>
										</ul>
									</li>
									<li><a><i class="fa fa-envelope-o"></i> <?php echo "Message " ; ?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
											<?php echo $this->Html->link('message', array('controller' => 'mastermessages', 'action' => 'index')); ?>
											</li>
										</ul>
									</li>
									<li><a><i class="fa fa-cogs"></i><?php echo "Account"; ?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php if ($LoginedUser['type'] == false) : ?>
													<?php echo $this->Html->link('Account Setting', array('controller' => 'masterprofiles', 'action' => 'headhunterBrowse' ,h($LoginedUser['id']))); ?>
												<?php else: ?>
													<?php echo $this->Html->link('Account Setting', array('controller' => 'masterprofiles', 'action' => 'companyBrowse',h($LoginedUser['id']) )); ?>
												<?php endif; ?>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
						<!-- /sidebar menu -->
					</div>
				</div>
				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<?php if ($LoginedUser['type'] == 1) : ?>
										<?php if(strlen($LoginedUser['company_name']) > 18): ?>
											<?php echo mb_substr($LoginedUser['company_name'],0,18,'UTF-8')."..."; ?>
										<?php else: ?>
											<?php echo h($LoginedUser['company_name']); ?>
										<?php endif; ?>
									<?php else: ?>
										<?php if(strlen($LoginedUser['headhunter_name']) > 18): ?>
											<?php echo mb_substr($LoginedUser['headhunter_name'],0,18,'UTF-8')."..."; ?>
										<?php else: ?>
											<?php echo h($LoginedUser['headhunter_name']); ?>
										<?php endif; ?>
									<?php endif; ?>
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li>
											<?php echo $this->Html->link('<i class="fa fa-sign-out pull-right"></i> Log Out', array('controller' => 'masterusers', 'action' => 'logout'), array('escape' => false)); ?>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->

				<!-- page content -->
				<div class="right_col" role="main">
					<div id = "mydiv">
						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
									<div class="x_content">
										<?php echo $this->fetch('content'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ========== JS ========== -->

		<?php echo $this->Html->script('fastclick'); ?>
		<?php echo $this->Html->script('nprogress'); ?>
		<?php echo $this->Html->script('custom'); ?>
		<?php echo $this->Html->script('logo'); ?>

	</body>
</html>

<script type="text/javascript">
$(document).ready(function () {
	var on = 1;
	$('#menu_toggle').click(function() {
		$('#mydiv').click(function() {
			$('li').removeClass('active');
			$('ul').css('display','');
		});

		on++ ;
		// If menu_toggle is clicked, logo change
		if(on % 2 == 0) // Horizontal service logo
		{
			$('.site_title').children('img').attr('src', '/img/JobVilla_verticle.png');
			$('.site_title').children('img').attr('style', 'margin-top:50px; margin-left:-9px;');
			$('#sidebar-menu').attr('style', 'margin-top: 11px;');
		}
		else // Vertical service logo
		{
			$('.site_title').children('img').attr('src', '/img/JobVilla-6.png');
			$('.site_title').attr('style', 'padding-left:0px; width: 100%; height:112px;margin-top: -68px;');
			$('.site_title').children('img').attr('style', '');
		}
	});
});
</script>