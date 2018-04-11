<span id="user-login" style="display:none;"><?php echo !empty($user_id)? $user_id : ''; ?></span>
<div class="container" >
	<div class="col-md-3 col-sm-12 col-xs-12">
		<div class="hidden-sm hidden-xs">
			<div class="form-group search-job"><strong><h3>Search Jobs</h3></strong></div>
		</div>

		<div class="hidden-sm hidden-xs">
			<div class="form-group" >
				<?php echo $this->Form->create('Occupation', array( 'url' => array('controller' => 'usertpages', 'action' => 'job_search'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>

					<?php if (!empty($this->params->query['keyword'])) : ?>
						<?php echo $this->Form->input('keyword', array('label' => false, 'class' => 'search_select letter_align', 'autocomplete' => 'off', 'style'=>'font-size:10px', 'placeholder' => 'Keyword', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
					<?php else : ?>
						<?php echo $this->Form->input('keyword', array('label' => false,'class' => 'search_select letter_align','style'=>'font-size:10px', 'autocomplete' => 'off', 'placeholder' =>'Keyword', 'required' => false)); ?>
					<?php endif; ?>
					<?php echo $this->Form->input('location_small_id', array(
						'options' =>$region,
						'empty'=>'---Location---','class' =>"search_select letter_align",'required' => false,'label'=>false
						)); ?>
					<?php echo $this->Form->input('job_category_id', array(
						'options' =>$job_category,
						'empty'=>'---Job Category---','class' =>"search_select letter_align",'required' => false,'label'=>false
						));
					?>
					<?php echo $this->Form->input('industry_big_id', array(
						'options' => $industry,
						'empty'=>'---Industry---','class' =>"search_select letter_align",'required' => false,'label'=>false
						));
					?>
					<?php echo $this->Form->input('salary_range', array(
						'options' => $salary_range,
						'empty'=>'---Salary---','class' =>"search_select letter_align",'required' => false,'label'=>false
						));
					?>
					<strong>
						<?php 	echo $this->Form->submit(
							'Find Search',
							array('class' => 'search_select','style'=>'background-color:#66a3ff ;color:#ffffff;font-size: 15px;border:none'));
						?>
					</strong>
				<?php echo $this->Form->end();?>
			</div>
		</div>

		<div class="hidden-md hidden-lg navpc">
			<div class="text-center">
				<button class="btn btn-default btn-lg btn-block" onclick="openNav()">Search Jobs</button>
			</div>

			<div id="mySidenav" class="sidenav">
				<div class="col-xs-12 col-sm-12" style="color: #000;">
					<a href="javascript:void(0)" class="btn btn-primary" onclick="closeNav()" style="color:#fff">Close panel</a>
				</div>
				<div class="col-xs-12 col-sm-12" style="color: #000;">
					<h2 id="hide">Search Jobs</h2>
				</div>
				<?php echo $this->Form->create('Occupation', array( 'url' => array('controller' => 'usertpages', 'action' => 'job_search'), 'class' => 'search-box-form', 'style' => 'margin: 66px 10px', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
					<div class="form-group">
						<?php if (!empty($this->params->query['keyword'])) : ?>
							<?php echo $this->Form->input('keyword', array('label' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Keyword', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
						<?php else : ?>
							<?php echo $this->Form->input('keyword', array('label' => false,'class' => 'form-control','style'=>'font-size:12px', 'autocomplete' => 'off', 'placeholder' =>'Keyword', 'required' => false)); ?>
						<?php endif; ?>
					</div>
					<div class="form-group">
						<?php echo $this->Form->input('location_small_id', array(
							'options' =>$region,
							'empty'=>'---Location---','class' =>"form-control",'required' => false,'label'=>false
						)); ?>
					</div>
					<div class="form-group">
						<?php echo $this->Form->input('job_category_id', array(
							'options' =>$job_category,
							'empty'=>'---Job Category---','class' =>"form-control",'required' => false,'label'=>false
						)); ?>
					</div>
					<div class="form-group">
						<?php echo $this->Form->input('industry_big_id', array(
							'options' => $industry,
							'empty'=>'---Industry---','class' =>"form-control",'required' => false,'label'=>false
						)); ?>
					</div>
					<div class="form-group">
						<?php echo $this->Form->input('salary_range', array(
							'options' => $salary_range,
							'empty'=>'---Salary---','class' =>"form-control",'required' => false,'label'=>false
						)); ?>
					</div>
					<div class="form-group">
						<strong><?php echo $this->Form->submit(
							'Find Job',
							array('class' => 'form-control find_job_btn')
									);?>
						</strong>
					</div>
				<?php echo $this->Form->end();?>
			</div>
		</div>

		<!-- Top employer for PC-->
		<?php if (!empty($company_logo)) : ?>
			<div class="hidden-xs hidden-sm">
				<strong style="font-size:16px;">Top Employer</strong>
				<div class="clearfix"></div>
				<?php foreach ($company_logo as $logokey => $logovalue) : ?>
				<div class="col-md-6 col-sm-6 col-xs-6 col-fixed">
					<div class="list">
						<div class="topemp">
							<?php if (!empty($logovalue)): ?>
								<?php echo $this->Html->link($this->Html->image($logovalue), array('controller' => 'usertpages', 'action' => 'top_com_info', $logokey), array('escape' => false)); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="col-md-9 col-sm-12 col-xs-12 job">
		<div class="form-group subtitle">
			<div class="title-type2">
				<?php if (!empty($job_lists)): ?>
					<strong>
						<h3>
							Filter&nbsp;<span style="color: blue;">
							<?php echo $this->Paginator->counter(array('format' => '{:count}')); ?>
							</span>&nbsp;
							<?php if($this->Paginator->counter(array('format' => '{:count}')) >1 ): ?>
								<?php echo "Jobs";?>
							<?php else: ?>
								<?php echo "Job";?>
							<?php endif;?>
						</h3>
					</strong>
				<?php endif; ?>
			</div>
			<div class="hidden-md hidden-lg">
				<?php if ($limit > 20) : ?>
					<div class="text-center">
						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<?php
								if ($this->Paginator->counter('{:page}') > 1) {
									echo '<li class="page-item>"'. $this->Paginator->prev(__('<'), array(), null, array('class' => 'prev disabled', 'id' => 'example_first')).'</li>';
								}

									echo $this->Paginator->numbers(array(
										'separator' => false,
										'tag' => 'li',
										'currentTag' => 'a',
										'class' => 'page-item',
										'currentClass' => 'active',
										'modulus' => 3
									));
									if ($this->Paginator->counter('{:page}') < $this->Paginator->counter('{:pages}')) {
										echo '<li class="page-item>"'. $this->Paginator->next(__('>'), array(), null, array('class' => 'next disabled', 'id' => 'example_next', 'tag' => 'li')).'</li>';
									}
									?>
							</ul>
						</nav>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>

		<?php if (!empty($job_lists)): ?>
			<?php $i = 1; foreach ($job_lists as $jkey => $jval): ?>
				<div class="job-ad-item">
					<div class="item-info">
						<div class="item-image-box">
							<div class="lts">
								<?php echo $this->Html->image($jval['CmpHeadhunter']['logo'], array('alt' => $jval['CmpHeadhunter']['logo'])); ?>
							</div>
						</div>
						<div class="hidden-md hidden-lg">
							<div class="clearfix"></div>
						</div>

						<!-- PC -->
						<div class="ad-info ad-info-pc col-md-8 hidden-sm hidden-xs">
							<div class="ad-meta">
								<span class="jId" style="display: none;"><?php echo $jval['Occupation']['id']; ?></span>
								<ul class="jinfo">
								<li class="bolder" style="word-wrap: break-word; line-height: 1.3; padding: 2px 0px;">
									<?php if($jval['CmpHeadhunter']['type'] == true): ?>
										<?php echo $jval['CmpHeadhunter']['company_name'];?>
									<?php else : ?>
										<?php if(!empty($jval['CmpHeadhunter']['company_name'])): ?>
											<?php echo $jval['CmpHeadhunter']['company_name']; ?>
										<?php else : ?>
											<?php echo 'Independent';?>
										<?php endif;?>
									<?php endif;?>
								</li>

								<li>
									<?php echo $jval['IndustryBig']['label'];?>
									<?php if (!empty($jval['IndustryBig']['label']) || !empty($jval['IndustrySmall']['label'])): ?>
										/
									<?php endif; ?>
									<?php echo $jval['IndustrySmall']['label'];?>
								</li>

								<li class="bolder" style="line-height: 1.3; padding: 6px 0px;">
									<?php
										echo $jval['Occupation']['job_title'];
									?>
								</li>

								<?php if (!empty($jval['Occupation']['salary_range'])): ?>
								<li>
									<i class="fa fa-usd" aria-hidden="true"></i> <?php echo $salary_range[$jval['Occupation']['salary_range']]; ?>
								</li>
								<?php endif; ?>

								<?php if (!empty($jval['Region']['name'])): ?>
								<li class="location">
									<i class="fa fa-map-marker" aria-hidden="true"></i>
									<?php
										if (strlen($jval['Region']['name']) > 30)
											echo mb_substr( $jval['Region']['name'], 0, 30,'UTF-8')."...";
										else
										echo $jval['Region']['name'];
									?>
								</li>
								<?php endif; ?>

							</ul>
							</div><!-- ad-meta -->
						</div><!-- ad-info -->

						<!-- SM -->
						<div class="ad-info ad-info-sm col-md-8 hidden-md hidden-lg">
							<div class="ad-meta">
								<span class="jId" style="display: none;"><?php echo $jval['Occupation']['id']; ?></span>
								<ul class="jinfo">
								<li class="bolder" style="word-wrap: break-word; line-height: 1.3; padding: 2px 0px;">
									<?php if($jval['CmpHeadhunter']['type'] == true): ?>
										<?php
											if (strlen($jval['CmpHeadhunter']['company_name']) > 75) {
												echo mb_substr($jval['CmpHeadhunter']['company_name'],0,75,'UTF-8')."...";
											} else {
												echo $jval['CmpHeadhunter']['company_name'];
											}
										?>
									<?php else : ?>
										<?php if(!empty($jval['CmpHeadhunter']['company_name'])): ?>
											<?php
												if (strlen($jval['CmpHeadhunter']['company_name']) > 75) {
													echo mb_substr($jval['CmpHeadhunter']['company_name'],0,75,'UTF-8')."...";
												} else {
													echo $jval['CmpHeadhunter']['company_name'];
												}
											?>
										<?php else : ?>
											<?php echo 'Independent';?>
										<?php endif;?>
									<?php endif;?>
								</li>

								<li>
									<?php echo $jval['IndustryBig']['label'];?>
									<?php if (!empty($jval['IndustryBig']['label']) || !empty($jval['IndustrySmall']['label'])): ?>
										/
									<?php endif; ?>
									<?php echo $jval['IndustrySmall']['label'];?>
								</li>

								<li class="bolder" style="line-height: 1.3; padding: 6px 0px;">
									<?php
										if (strlen($jval['Occupation']['job_title']) > 75) {
											echo mb_substr($jval['Occupation']['job_title'],0,75,'UTF-8')."...";
										} else {
											echo $jval['Occupation']['job_title'];
										}
									?>
								</li>

								<?php if (!empty($jval['Occupation']['salary_range'])): ?>
								<li>
									<i class="fa fa-usd" aria-hidden="true"></i> <?php echo $salary_range[$jval['Occupation']['salary_range']]; ?>
								</li>
								<?php endif; ?>

								<?php if (!empty($jval['Region']['name'])): ?>
								<li class="location">
									<i class="fa fa-map-marker" aria-hidden="true"></i>
									<?php
										if (strlen($jval['Region']['name']) > 30)
											echo mb_substr( $jval['Region']['name'], 0, 30,'UTF-8')."...";
										else
										echo $jval['Region']['name'];
									?>
								</li>
								<?php endif; ?>

							</ul>
							</div><!-- ad-meta -->
						</div><!-- ad-info -->

						<!-- PC -->
						<div class="hidden-sm hidden-xs">
							<div class="button">
								<?php if (in_array($jval['Occupation']['id'], $appliedOccuaptions)) :?>
									<button type="button" class="btn btn-success applied sub">Applied</button>
								<?php else: ?>
									<button type="button" class="btn btn-success  apply-now sub" >Apply</button>
								<?php endif; ?>
								<br/>
								<?php if (in_array($jval['Occupation']['id'], $savedOccuaptions)) :?>
									<button type="button" class="btn btn-warning saved sub">Saved</button>
								<?php else: ?>
									<button type="button" class="btn btn-warning save-now sub">Save</button>
								<?php endif; ?>
							</div>
						</div>

						<!-- SM -->
						<div class="hidden-md hidden-lg">
							<div class="button main">
								<?php if (in_array($jval['Occupation']['id'], $appliedOccuaptions)) :?>
									<button type="button" class="btn btn-success applied sub">Applied</button>
								<?php else: ?>
									<button type="button" class="btn btn-success apply-now sub">Apply</button>
								<?php endif; ?>
								<?php if (in_array($jval['Occupation']['id'], $savedOccuaptions)) :?>
									<button type="button" class="btn btn-warning saved sub">Saved</button>
								<?php else: ?>
									<button type="button" class="btn btn-warning save-now sub">Save</button>
								<?php endif; ?>
							</div>
						</div>
					</div><!-- item-info -->
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="job-ad-item empty">
					<div class="item-info">
						Sorry, we couldn't find anything to match that request, please try another option...
					</div><!-- item-info -->
				</div>
		<?php endif; ?>
		<div class="title-type3">
			<div class="hidden-xs hidden-sm">
				<div class="pull-right">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<?php
							if ($this->Paginator->counter('{:page}') > 1) {
								echo '<li class="page-item>"'. $this->Paginator->prev(__('<'), array(), null, array('class' => 'prev disabled', 'id' => 'example_first')).'</li>';
							}

								echo $this->Paginator->numbers(array(
									'separator' => false,
									'tag' => 'li',
									'currentTag' => 'a',
									'class' => 'page-item',
									'currentClass' => 'active',
									'modulus' => 3
								));
								if ($this->Paginator->counter('{:page}') < $this->Paginator->counter('{:pages}')) {
									echo '<li class="page-item>"'. $this->Paginator->next(__('>'), array(), null, array('class' => 'next disabled', 'id' => 'example_next', 'tag' => 'li')).'</li>';
								}
								?>
						</ul>
					</nav>
				</div>
			</div>

			<div class="hidden-md hidden-lg">
				<div class="text-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<?php
							if ($this->Paginator->counter('{:page}') > 1) {
								echo '<li class="page-item>"'. $this->Paginator->prev(__('<'), array(), null, array('class' => 'prev disabled', 'id' => 'example_first')).'</li>';
							}

								echo $this->Paginator->numbers(array(
									'separator' => false,
									'tag' => 'li',
									'currentTag' => 'a',
									'class' => 'page-item',
									'currentClass' => 'active',
									'modulus' => 3
								));
								if ($this->Paginator->counter('{:page}') < $this->Paginator->counter('{:pages}')) {
									echo '<li class="page-item>"'. $this->Paginator->next(__('>'), array(), null, array('class' => 'next disabled', 'id' => 'example_next', 'tag' => 'li')).'</li>';
								}
								?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>

<style type="text/css" media="screen">
	.container {
		margin-top: 30px;
	}

	.applied, .saved {
		opacity: 0.5;
		pointer-events:none;
	}

	.sidenav {
		height: 100%;
		width: 0;
		position: fixed;
		z-index: 1;
		top: 0;
		left: 0;
		background-color: #efefef;
		overflow-x: hidden;
		transition: 0.5s;
	}

	.sidenav a {
		padding: 8px 8px 8px 32px;
		text-decoration: none;
		font-size: 25px;
		color: #818181;
		display: block;
		transition: 0.3s;
	}

	.sidenav a:hover, .offcanvas a:focus{
		color: #f1f1f1;
	}

	.sidenav .closebtn {
		position: absolute;
		top: 0;
		right: 25px;
		font-size: 36px;
		margin-left: 50px;
	}

	.job-ad-item {
		border-radius: 5px;
		margin-top: 1%;
		margin-bottom: 3%;
		padding: 15px;
		overflow: hidden;
		position: relative;
		/*border: 2px solid #f3f3f3;*/
		border: 2px solid #c4bcbc;
	}

	.navpc {
		margin-left: -3%;
	}

	.empty {
		margin-top: 6%;
	}

	.main {
		margin-left: -1%;
		margin-top: 1%;
		margin-bottom: -5%;
	}

	.sub {
		width: 70px;
	}

	.ad-info-pc {
		margin-left: -2%;
		margin-top: -1%;
	}

	.job-ad-item:hover{
		/* for each job info */
		box-shadow:
		1px 1px #c4bcbc,
		2px 2px #c4bcbc,
		2px 2px #c4bcbc;
		-webkit-transform: translateX(-1px);
		transform: translateX(-1px);
	}

	.job{
		margin-left: 3%;
		width: 72%;
		/*margin-bottom: -9%;*/
	}

	@media screen and (max-height: 450px) {
		.sidenav {padding-top: 15px;}
		.sidenav a {font-size: 18px;}
	}

	/*---------- mobile -----------*/
	@media screen and (max-width: 768px) and (max-width: 992px) {
		ul.jinfo {
			list-style-type: none;
			line-height: 1.8;
			font-size: 13px;
			margin-left: 0px;
		}
		.job-ad-item {
			margin-bottom: 10%;
			margin-top: 3%;
			padding: 15px;
			overflow: hidden;
			position: relative;
			/*border: 2px solid #f3f3f3;*/
			border: 2px solid #c4bcbc;
		}
		h3 {
			font-size: 24px;
		}
		.ad-info.sm {
			margin-left: -1%;
			margin-top: -1%;
		}
		.subtitle{
			text-align: center;
		}
		.job{
			width: 100%;
			margin-left: 0%;
		}
	}

</style>

<script type="text/javascript">
	$(function() {
		$('.item-image-box').on('click', function() {
			var jobId = $(this).parent().find('.jId').text();
			var url = "<?php echo Router::url(array('controller' => 'useroccupations', 'action' => 'detail')); ?>";
			window.location = url+'/'+jobId;
		});

		$('.ad-info').on('click', function() {
			var jobId = $(this).find('.jId').text();
			var url = "<?php echo Router::url(array('controller' => 'useroccupations', 'action' => 'detail')); ?>";
			window.location = url+'/'+jobId;
		});

		$('.save-now').on('click', function(event) {
			var user_login = $('#user-login').text();
			var tmp = $(this).parent().parent().parent().find('.jId')[0] ;
			var job_id = tmp.innerHTML ;
			var element = $(this);
			if(user_login ==''){
				var url = "<?php echo Router::url(array('controller' => 'users', 'action' => 'login')); ?>";
				window.location = url;
			}else{
				$.ajax({
					url: "<?php echo Router::url(array('controller' => 'useroccupations', 'action' => 'saveJob')); ?>",
					type: "POST",
					dataType: 'json',
					data: "job_id="+job_id,
					success : function(data){
						element.text(data);
						element.css({opacity: 0.5});
						element.css("pointer-events", "none");
					},
					error: function(data){
						alert('Error occur! Can\'t Save');
					}

				});
			}
		});

		$('.apply-now').on('click', function(event) {
			var user_login = $('#user-login').text();
			var tmp = $(this).parent().parent().parent().find('.jId')[0] ;
			var job_id = tmp.innerHTML ;
			var element = $(this);
			if(user_login ==''){
				var url = "<?php echo Router::url(array('controller' => 'users', 'action' => 'login')); ?>";
				window.location = url ;
			}else{
				$.ajax({
					url: "<?php echo Router::url(array('controller' => 'useroccupations', 'action' => 'applied')); ?>",
					type: "POST",
					dataType: 'json',
					data: "job_id="+job_id,
					success : function(data){
						element.text(data);
						element.css({opacity: 0.5});
						element.css("pointer-events", "none");
					},
					error: function(data){
						alert('Error occur! Can\'t apply');
					}
				});
			}
		});
	});

	function openNav() {
		document.getElementById("mySidenav").style.width = "100%";
	}

	function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
	}
</script>