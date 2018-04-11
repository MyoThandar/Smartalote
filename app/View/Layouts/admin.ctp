<!DOCTYPE html>
<html lang="en">
	<head>
			<?php echo $this->Html->charset(); ?>
			<?php echo $this->Html->meta(null, null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
			<?php echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
			<?php echo $this->fetch('meta'); ?>
			<!-- ========== Title ========== -->
			<title><?php echo 'SmartAlote.com_Administrator Portal'; ?></title>
			<!-- ========== CSS ========== -->
			<?php echo $this->Html->css('//cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.css'); ?>
			<?php echo $this->Html->css('bootstrap.min'); ?>
			<?php echo $this->Html->css('font-awesome.min'); ?>
			<?php echo $this->Html->css('nprogress'); ?>
			<?php echo $this->Html->css('custom.min'); ?>
			<?php echo $this->Html->css('green'); ?>
			<?php echo $this->Html->css('adstyle'); ?>
			<?php echo $this->Html->css('report'); ?>
			<?php echo $this->Html->css('message'); ?>
			<?php echo $this->Html->css('select2.min'); ?>
			<?php echo $this->Html->css('custombtntb'); ?>
			<?php echo $this->Html->script('jquery.min'); ?>
			<?php echo $this->Html->script('bootstrap.min'); ?>
			<?php echo $this->Html->script('select2.min'); ?>
			<?php echo $this->Html->script('datatables.min') ?>
			<?php echo $this->Html->script('datatable'); ?>

	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;margin-left: 70px;margin-left: -11px;">
							<?php echo $this->Html->link('<img src= "/img/JobVilla-6.png" alt="SmartAlote" ><span class="right-side-menu"> &nbsp;SmartAlote</span>', array('controller' => 'admin', 'action' => 'company/index'), array('class' => 'site_title', 'escape' => false,'style' => 'padding-left:-1px; width: 100%; height:112px;margin-top: -57px;')) ?>
						</div>
						<br />
						<?php $string = Router::reverse($this->params); ?>
						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<h3>Welcome Admin</h3>
								<ul class="nav side-menu">
									<li><a><i class="fa fa-building-o"></i> <?php echo "Company / HeadHunter"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li style="display: none">
												<?php
												for ($i=1; $i < 1000 ; $i++) {
													echo $this->Html->link('Browse', array('controller' => 'admincompanys', 'action' => 'browse', $i));
												} ?>
											</li>
											<li>
												<?php echo $this->Html->link('Company List', array('controller' => 'admincompanys', 'action' => 'index')); ?>
											</li>
											<li style="display: none">
												<?php
												for ($j=1; $j < 1000 ; $j++) {
													echo $this->Html->link('Browse', array('controller' => 'adminheadhunters', 'action' => 'browse', $j));
												} ?>
											</li>
											<li>
												<?php echo $this->Html->link('Pick Up', array('controller' => 'adminpickups', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('HeadHunter List', array('controller' => 'adminheadhunters', 'action' => 'index')); ?>
											</li>
										</ul>
									</li>
									<li><a><i class="fa fa-edit"></i> <?php echo "Job" ; ?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li style="display: none">
												<?php
												for ($k=1; $k < 1000 ; $k++) {
													echo $this->Html->link('Browse', array('controller' => 'adminoccupations', 'action' => 'browse', $k));
												} ?>
											</li>
											<li><?php echo $this->Html->link('Job List', array('controller' => 'adminoccupations', 'action' => 'index')); ?></a></li>
										</ul>
									</li>
									<li><a><i class="fa fa-users"></i> <?php echo "Jobseeker " ; ?><span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li style="display: none">
												<?php
												for ($p=1; $p < 1000 ; $p++) {
													echo $this->Html->link('Browse', array('controller' => 'adminjobseekers', 'action' => 'browse', $p));
												} ?>
											</li>
											<li>
												<?php echo $this->Html->link('Jobseeker List', array('controller' => 'adminjobseekers', 'action' => 'index')); ?>
											</li>
										</ul>
									</li>
									<li><a><i class="fa fa-user"></i> <?php echo "Applied Jobseeker" ; ?><span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li style="display: none">
												<?php
												for ($p=1; $p < 1000 ; $p++) {
													echo $this->Html->link('Browse', array('controller' => 'adminappliedjobseekers', 'action' => 'browse', $p));
												} ?>
											</li>
											<li>
												<?php echo $this->Html->link('Applied Jobseeker List', array('controller' => 'adminappliedjobseekers', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Warning List', array('controller' => 'adminappliedjobseekers', 'action' => 'warning')); ?>
											</li>
										</ul>
									</li>
									<li><a><i class="fa fa-envelope-o"></i> <?php echo "Message " ; ?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
											<?php echo $this->Html->link('message', array('controller' => 'adminmessages', 'action' => 'index')); ?>
											</li>
										</ul>
									</li>
									<li><a><i class="fa fa-cogs"></i> <?php echo "Various Settings"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php $pos = strpos($string,'admin/industry/index'); ?>
												<?php if($pos === false) : ?>
													<?php echo $this->Html->link('Industry List', array('controller' => 'adminindustrys', 'action' => 'index')); ?>
												<?php else: ?>
													<?php echo $this->Html->link( 'Industry List', Router::reverse($this->params)); ?>
													<li style="display: none"><?php echo $this->Html->link('Industry List', array('controller' => 'adminindustrys', 'action' => 'index')); ?></li>
												<?php endif; ?>
											</li>
											<li>
												<?php $jobpos = strpos($string,'admin/vjob/index'); ?>
												<?php if($jobpos === false) : ?>
													<?php echo $this->Html->link('Occupation List', array('controller' => 'adminvjobs', 'action' => 'index')); ?>
												<?php else: ?>
													<?php echo $this->Html->link( 'Occupation List', Router::reverse($this->params)); ?>
													<li style="display: none"><?php echo $this->Html->link('Occupation List', array('controller' => 'adminvjobs', 'action' => 'index')); ?></li>
												<?php endif; ?>
											</li>
											<li>
												<?php $regionpos = strpos($string,'admin/region/index'); ?>
												<?php if($regionpos === false) : ?>
													<?php echo $this->Html->link('Region List', array('controller' => 'adminregions', 'action' => 'index')); ?>
												<?php else : ?>
													<?php echo $this->Html->link( 'Region List', Router::reverse($this->params)); ?>
													<li style="display: none"><?php echo $this->Html->link('Region List', array('controller' => 'adminregions', 'action' => 'index')); ?></li>
												<?php endif; ?>
											</li>
										</ul>
									</li>
									<li><a><i class="fa fa-bar-chart"></i> <?php echo "Daily Report " ; ?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
											<?php echo $this->Html->link("Daily Report", array('controller' => 'adminreports', 'action' => 'index')); ?>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										Admin
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li>
											<?php echo $this->Html->link('<i class="fa fa-sign-out pull-right"></i> Log Out', array('controller' => 'adminusers', 'action' => 'logout'), array('escape' => false)); ?>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->

				<!-- page content -->
				<div class="right_col" role="main">
					<div id="mydiv">
						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
	<!-- ================Content Part==============================-->
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
		<!-- jQuery -->
		<?php echo $this->Html->script('fastclick'); ?>
		<?php echo $this->Html->script('nprogress'); ?>
		<?php echo $this->Html->script('custom'); ?>
		<?php echo $this->Html->script('message'); ?>
		<?php echo $this->Html->script('logo'); ?>
		<?php echo $this->Html->script('datatable'); ?>
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
		// logo change
		if(on % 2 == 0) // Even
		{
			$('.site_title').children('img').attr('src', '/img/JobVilla_verticle.png');
			$('.site_title').children('img').attr('style', 'margin-top:50px; margin-left:-9px;');
			$('#sidebar-menu').attr('style', 'margin-top: 75px;');
		}
		else // Odd
		{
			$('.site_title').children('img').attr('src', '/img/JobVilla-6.png');
			$('.site_title').attr('style', 'padding-left:0px; width: 100%; height:112px;margin-top: -41px;');
			$('.site_title').children('img').attr('style', '');
		}
	});
});
</script>