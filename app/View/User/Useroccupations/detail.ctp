<nav class="navbar" data-spy="affix" data-offset-top="197">
	<!-- <div class="col-md-6 col-md-offset-9 col-xs-9 col-xs-offset-7" style="padding-top: 6px;"> -->
	<div class="col-md-12" style="padding-top: 6px;">
		<div class="col-md-1"></div>
		<div class="col-md-12 ">

			<div class="col-md-3  col-md-offset-3 col-xs-12 col-sm-12">
				<?php if (!empty($appliedOccupation['OccupationApply']['status'])) : ?>
					<span class= 'btn btn-success' id="applied" style="pointer-events:none;opacity:0.5;width: 100%;"><?php echo 'Applied'; ?>
					</span>
				<?php else : ?>
					<span class= 'btn btn-success ' id="apply" style="width: 100%;"><?php echo 'Apply' ?></span>
				<?php endif ; ?>
			</div>

			<div class="col-xs-12 hidden-lg hidden-md hidden-sm " style="margin-top:10px;"><!-- start for mobile button break line -->
			</div><!-- end for mobile button break line -->

			<div class="col-md-3 col-xs-12 col-sm-12">
				<?php if (!empty($savedOccupation['OccupationFavorite'])) : ?>
					<span class= 'btn btn-warning' id="keep" style="opacity:0.5;width: 100%;">
						<?php echo 'Saved'; ?>
					</span>
				<?php else: ?>
					<span class= 'btn btn-warning ' id="keep" style="width: 100%;"><?php echo 'Save' ?></span>
				<?php endif; ?>
			</div>

			<div class="col-xs-12 hidden-lg hidden-md hidden-sm " style="margin-top:10px;"><!-- start for mobile button break line -->
			</div><!-- end for mobile button break line -->

			<div id="jobID" style='display: none;'><?php echo $jobDetail['Occupation']['id']; ?></div>
		</div>
	</div>
</nav>
<span id="user-login" style="display:none;"><?php echo !empty($user_id)? $user_id : ''; ?></span>
<div class="container jobdetail">
<?php if (!empty($jobDetail)): ?>
	<div class="row">
		<div class="bordered" style="width: 100%;border-radius: 7px;">

			<!-- Job images for PC -->
			<div class="containertest hidden-sm hidden-xs">
				<?php if (!empty($jobDetail['Occupation']['image1'])) : ?>
					<img src= <?php echo '/img/'.$jobDetail['Occupation']['image1']; ?> class="imgsize" height="260" width = "33%;" />
				<?php endif; ?>
				<?php if (!empty($jobDetail['Occupation']['image2'])) : ?>
					<img src= <?php echo '/img/'.$jobDetail['Occupation']['image2']; ?> class="imgsize" height="260" width = "33%;" />
				<?php endif; ?>
				<?php if (!empty($jobDetail['Occupation']['image3'])) : ?>
					<img src= <?php echo '/img/'.$jobDetail['Occupation']['image3']; ?> class="imgsize" height="260" width = "33%;" />
				<?php endif; ?>
			</div>

			<!-- Job images for SM -->
			<div class="containertest-sm hidden-lg hidden-md">
				<?php if (!empty($jobDetail['Occupation']['image1'])) : ?>
					<?php $image = $jobDetail['Occupation']['image1']?>
				<?php elseif (!empty($jobDetail['Occupation']['image2'])) : ?>
					<?php $image = $jobDetail['Occupation']['image2']?>
				<?php elseif (!empty($jobDetail['Occupation']['image3'])) : ?>
					<?php $image = $jobDetail['Occupation']['image3']?>
				<?php endif; ?>
				<?php if (!empty($image)) : ?>
					<img src= <?php echo '/img/'.$image; ?> class="imgsize" height="260" width = "100%;" />
				<?php endif; ?>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12 ">
				<div class="jtitle" style="word-wrap: break-word;">
					<h3 style="line-height: 1.5em">
						<?php if (!empty($jobDetail['Occupation']['job_title'])): ?>
							<?php echo $jobDetail['Occupation']['job_title']; ?>
						<?php endif; ?>
					</h3>
				</div>
				<div class="clearfix"></div>

				<div class="job-salary">
					<h3 style="border-bottom: 1px solid #E0E0E0;">Salary</h3>
					<p style="font-size: 20px;">
						<?php if (!empty($jobDetail['Occupation']['salary_range'])): ?>
							<?php echo $salary_range[$jobDetail['Occupation']['salary_range']]; ?>
						<?php endif; ?>
					</p>
				</div>

			</div>
			<div style="height: 10px;"></div>

			<!-- Company information -->
			<div class="col-md-12 col-sm-12 col-xs-12 col-fixed">
				<div class="company-item">
					<div class="lts">
						<?php echo $this->Html->image($jobDetail['CmpHeadhunter']['logo'], array('alt' => $jobDetail['CmpHeadhunter']['logo'])); ?>
					</div>
					<div class="rts hidden-sm hidden-xs">
						<?php if ($jobDetail['CmpHeadhunter']['type'] == 1): ?>
							<ul class="jinfo" style="margin-left: 12%;">
								<li style="word-break: break-all;">
									<?php echo $jobDetail['CmpHeadhunter']['company_name']; ?>
								</li>
								<?php if (!empty($jobDetail['CmpHeadhunter']['industry_big'])): ?>
									<li>
										<a href="/usertpages/job_search?industry_big_id=<?php echo $jobDetail['Occupation']['industry_big_id']; ?>" style='color:blue;'>
											<?php echo $jobDetail['CmpHeadhunter']['industry_big'];?>
										</a>

										<?php echo '/';?>

										<a href="/usertpages/job_search?industry_small_id=<?php echo $jobDetail['Occupation']['industry_small_id']; ?>" style='color:blue;'>
											<?php echo $jobDetail['CmpHeadhunter']['industry_small'];?>
										</a>
									</li>
								<?php endif; ?>
								<?php if (!empty($jobDetail['CmpHeadhunter']['number_of_employee'])): ?>
									<li>
										<?php echo $employee[$jobDetail['CmpHeadhunter']['number_of_employee']]; ?> persons
									</li>
								<?php endif; ?>

								<?php if (!empty($jobDetail['CmpHeadhunter']['region'])): ?>
									<li>
										<i class="fa fa-map-marker" aria-hidden="true" style="color: red;"></i> <?php echo $region[$jobDetail['CmpHeadhunter']['region']]; ?>
									</li>
								<?php endif; ?>
							</ul>
						<?php else : ?>
							<ul class="jinfo" style="margin-left: 12%;">
								<li>
									<?php if(!empty($jobDetail['CmpHeadhunter']['company_name'])) :?>
										<?php echo $jobDetail['CmpHeadhunter']['company_name']; ?>
									<?php else:?>
										<?php echo 'Independent'; ?>
									<?php endif;?>
								</li>
								<?php if (!empty($jobDetail['CmpHeadhunter']['education'])): ?>
									<li>
										<?php echo $edu[$jobDetail['CmpHeadhunter']['education']]; ?>
									</li>
								<?php endif; ?>
								<?php if (!empty($jobDetail['CmpHeadhunter']['industry_big'])): ?>
									<li>
										<?php $trimindustry_bigarray = rtrim($jobDetail['CmpHeadhunter']['industry_big'],"&"); ?>
										<?php $industry_bigarray = explode('&',$trimindustry_bigarray);?>
										<?php foreach($industry_bigarray as $industry_bigarray_key => $industry_bigarray_value):?>
											<?php $industry_bigarray_value_remove = explode('-',$industry_bigarray_value); ?>
												<a href="/usertpages/job_search?industry_big_id=<?php echo $industry_bigarray_value_remove[1]; ?>" style='color:blue;'><?php echo $industry_bigarray_value_remove[0]; ?>
												</a>
											<br>
										<?php endforeach;?>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>

					<div class="rts hidden-lg hidden-md">
						<?php if ($jobDetail['CmpHeadhunter']['type'] == 1): ?>
							<ul class="jinfo" style="margin-left: -16%;">
								<li style="word-break: break-all;">
									<?php echo $jobDetail['CmpHeadhunter']['company_name']; ?>
								</li>
								<?php if (!empty($jobDetail['CmpHeadhunter']['industry_big'])): ?>
									<li>
										<a href="/usertpages/job_search?industry_big_id=<?php echo $jobDetail['Occupation']['industry_big_id']; ?>" style='color:blue;'>
											<?php echo $jobDetail['CmpHeadhunter']['industry_big'];?>
										</a>

										<?php echo '/';?>

										<a href="/usertpages/job_search?industry_small_id=<?php echo $jobDetail['Occupation']['industry_small_id']; ?>" style='color:blue;'>
											<?php echo $jobDetail['CmpHeadhunter']['industry_small'];?>
										</a>
									</li>
								<?php endif; ?>
								<?php if (!empty($jobDetail['CmpHeadhunter']['number_of_employee'])): ?>
									<li>
										<?php echo $employee[$jobDetail['CmpHeadhunter']['number_of_employee']]; ?> persons
									</li>
								<?php endif; ?>

								<?php if (!empty($jobDetail['CmpHeadhunter']['region'])): ?>
									<li>
										<i class="fa fa-map-marker" aria-hidden="true" style="color: red;"></i> <?php echo $region[$jobDetail['CmpHeadhunter']['region']]; ?>
									</li>
								<?php endif; ?>
							</ul>
						<?php else : ?>
							<ul class="jinfo" style="margin-left: -16%;">
								<li>
									<?php if(!empty($jobDetail['CmpHeadhunter']['company_name'])) :?>
										<?php echo $jobDetail['CmpHeadhunter']['company_name']; ?>
									<?php else:?>
										<?php echo 'Independent'; ?>
									<?php endif;?>
								</li>
								<?php if (!empty($jobDetail['CmpHeadhunter']['education'])): ?>
									<li>
										<?php echo $edu[$jobDetail['CmpHeadhunter']['education']]; ?>
									</li>
								<?php endif; ?>
								<?php if (!empty($jobDetail['CmpHeadhunter']['industry_big'])): ?>
									<li>
										<?php $trimindustry_bigarray = rtrim($jobDetail['CmpHeadhunter']['industry_big'],"&"); ?>
										<?php $industry_bigarray = explode('&',$trimindustry_bigarray);?>
										<?php foreach($industry_bigarray as $industry_bigarray_key => $industry_bigarray_value):?>
											<?php $industry_bigarray_value_remove = explode('-',$industry_bigarray_value); ?>
												<a href="/usertpages/job_search?industry_big_id=<?php echo $industry_bigarray_value_remove[1]; ?>" style='color:blue;'><?php echo $industry_bigarray_value_remove[0]; ?>
												</a>
											<br>
										<?php endforeach;?>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>

				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 2%;">
				<div class="detail-type1">
					<h3> Job Category </h3>
					<p><?php echo $jobDetail['JobCategorie']['label']; ?>/<?php echo $jobDetail['JobCategorieSub']['label']; ?></p>
				</div>

				<div class="detail-type1">
					<h3>Responsibility</h3>
					<p>
						<?php echo $jobDetail['Occupation']['responsibility']; ?>
					</p>
				</div>

				<div class="detail-type1">
					<h3> Requirements </h3>
					<p>
						<?php echo $jobDetail['Occupation']['requirements']; ?>
					</p>
				</div>

				<div class="detail-type1">
					<h3>Posted Date</h3>
					<p>
						<?php echo date('d M Y',strtotime($jobDetail['Occupation']['created'])) ; ?>
					</p>
				</div>

				<div class="detail-type1">
					<h3> Latest Update </h3>
					<p>
						<?php echo date('d M Y',strtotime($jobDetail['Occupation']['modified'])) ; ?>
					</p>
				</div>

				<div class="detail-type1">
					<h3> Job ID </h3>
					<p>
						<?php echo $jobDetail['Occupation']['job_id'] ; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($jobDetail['CmpHeadhunter']['type'] == 1): ?>
		<?php $cmp = $jobDetail['CmpHeadhunter']; ?>
	<?php else: ?>
		<?php $cmp = $jobDetail['SubHeadhunter']; ?>
	<?php endif; ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="cmp-pdetail">
			<div class="col-md-12 col-sm-12 col-xs-12 detail-type1" style=" width: 100%;">
				<h3>Company Information</h3>
			</div>
			<?php if (empty($cmp['logo_flag'])) : ?>
				<div class="col-md-2 col-sm-6 col-xs-6">
					<div class ="cmp-img">
						<?php echo $this->Html->image($cmp['logo'], array('alt' => $cmp['logo'])); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="col-md-9 col-sm-10 col-xs-10 cmp-info">
				<ul>
					<?php if (empty($cmp['company_name_flag'])) : ?>
						<li style="word-break: break-all;">
							<?php echo $cmp['company_name']; ?>
						</li>
					<?php endif; ?>
					<?php if (!empty($cmp['industry_big'])): ?>
						<li>
							<a href="/usertpages/job_search?industry_big_id=<?php echo $cmp['Occupation'][0]['industry_big_id']; ?>" style='color:blue;'><?php echo $cmp['industry_big'];?></a>

							<?php echo '/';?>

							<a href="/usertpages/job_search?industry_small_id=<?php echo $cmp['Occupation'][0]['industry_small_id']; ?>" style='color:blue;'><?php echo $cmp['industry_small'];?></a>
						</li>
					<?php endif; ?>
					<?php if (!empty($cmp['number_of_employee'])): ?>
						<?php if (empty($cmp['number_of_employee_flag'])) : ?>
							<li>
								<?php echo $employee[$cmp['number_of_employee']]; ?> persons
							</li>
						<?php endif; ?>
					<?php endif; ?>

					<?php if (!empty($cmp['region'])): ?>
						<li class="location">
							<i class="fa fa-map-marker" aria-hidden="true" style="color: red;"></i> <?php echo $region[$cmp['region']]; ?></li>
						</li>
					<?php endif; ?>
				</ul>
			</div>
			<?php if (empty($cmp['overview_flag'])) : ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="detail-type1">
						<?php if (!empty($cmp['overview'])) : ?>
							<h3> Business Overview </h3>
							<p><?php echo $cmp['overview']; ?></p>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php if (!empty($job_lists)): ?>
	<div class="row other-job">
		<div>
			<div class="col-md-12 col-sm-12 col-xs-12 detail-type1">
				<h3> Other Jobs </h3>
			</div>
			<?php $i = 1; foreach ($job_lists as $jkey => $jval): ?>
				<div class="col-md-12 col-sm-12 col-xs-12 col-fixed">
					<div class="item">
						<div class="lts">
							<?php echo $this->Html->image($jval['CmpHeadhunter']['logo'], array('alt' => $jval['CmpHeadhunter']['logo'])); ?>
						</div>
						<div class="rts">
							<span class="jId" style="display: none"><?php echo $jval['Occupation']['id']; ?></span>
							<ul class="jinfo ">

								<!-- PC -->
								<li class="bolder hidden-sm hidden-xs">
									<?php
										if (!empty($jval['CmpHeadhunter']['company_name']) && empty($jval['CmpHeadhunter']['headhunter_name'])) {
											echo $jval['CmpHeadhunter']['company_name'];
										} elseif (empty($jval['CmpHeadhunter']['company_name']) && !empty($jval['CmpHeadhunter']['headhunter_name'])) {
											echo $jval['CmpHeadhunter']['headhunter_name'];
										} elseif (!empty($jval['CmpHeadhunter']['company_name']) && !empty($jval['CmpHeadhunter']['headhunter_name'])){
											echo $jval['CmpHeadhunter']['headhunter_name'];
										}
									?>
								</li>

								<!-- SM -->
								<li class="bolder hidden-md hidden-lg" >
									<?php
										if (!empty($jval['CmpHeadhunter']['company_name']) && empty($jval['CmpHeadhunter']['headhunter_name'])) {
											if (strlen($jval['CmpHeadhunter']['company_name']) > 75)
												echo mb_substr( $jval['CmpHeadhunter']['company_name'], 0, 75,'UTF-8')."...";
											else
												echo $jval['CmpHeadhunter']['company_name'];
										} elseif (empty($jval['CmpHeadhunter']['company_name']) && !empty($jval['CmpHeadhunter']['headhunter_name'])) {
											if (strlen($jval['CmpHeadhunter']['headhunter_name']) > 75)
												echo mb_substr( $jval['CmpHeadhunter']['headhunter_name'], 0, 75,'UTF-8')."...";
											else
												echo $jval['CmpHeadhunter']['headhunter_name'];
										} elseif (!empty($jval['CmpHeadhunter']['company_name']) && !empty($jval['CmpHeadhunter']['headhunter_name'])) {
											if (strlen($jval['CmpHeadhunter']['headhunter_name']) > 75)
												echo mb_substr( $jval['CmpHeadhunter']['headhunter_name'], 0, 75,'UTF-8')."...";
											else
												echo $jval['CmpHeadhunter']['headhunter_name'];
										}
									?>
								</li>

								<li>
									<?php if (!empty($jval['IndustrySmall']['label'])): ?>
										<?php echo $jval['IndustryBig']['label']; ?> /
									<?php endif; ?>

									<?php if (!empty($jval['IndustrySmall']['label'])): ?>
										<?php echo $jval['IndustrySmall']['label']; ?>
									<?php endif; ?>
								</li>

								<!-- Job title for PC -->
								<li class="bolder hidden-xs hidden-sm">
									<?php echo $jval['Occupation']['job_title']; ?>
								</li>

								<!-- Job title for SM -->
								<li class="bolder hidden-md hidden-lg" >
									<?php
										if (!empty($jval['Occupation']['job_title']) && empty($jval['CmpHeadhunter']['headhunter_name'])) {
											if (strlen($jval['Occupation']['job_title']) > 75)
												echo mb_substr( $jval['Occupation']['job_title'], 0, 75,'UTF-8')."...";
											else
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
									<i class="fa fa-map-marker" aria-hidden="true" style="color: red;"></i> <?php echo $jval['Region']['name']; ?>
								</li>
								<?php endif; ?>

							</ul>
						</div>
					</div>
				</div>
				<?php if (($i%2) == 0): ?>
					<div class="clearfix"></div>
				<?php endif; ?>
			<?php $i++; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
</div>

<script type="text/javascript">
	$('#keep').on('click', function(event) {
		var user_login = $('#user-login').text();
		var job_id = $("#jobID").text();
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

	$('#apply').on('click', function(event) {
		var user_login = $('#user-login').text();
		var job_id = $("#jobID").text();
		var element = $(this);
		if(user_login ==''){
			var url = "<?php echo Router::url(array('controller' => 'users', 'action' => 'login')); ?>";
			window.location = url;
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

	$(function() {
		$('.item').on('click', function() {
			var jobId = $(this).find('.jId').text();
			var url = "<?php echo Router::url(array('controller' => 'useroccupations', 'action' => 'detail')); ?>";
			window.location = url+'/'+jobId;
		});
	});
</script>

<style type="text/css">
	.free_div{
		clear: both;
		height: 20px;
	}
	.affix {
		top: 0;
		width: 100%;
		z-index: 10000;
		background-color: #DCDCDC !important;
	}
	.affix + .container {
		padding-top: 70px;
	}
	.navbar{
		background-color: #DCDCDC !important;
	}
	body{
		background-color: #e3e3e3;
	}
	div.containertest {
		width: 100%;
		max-width: 970px;
		margin-top: 2%;
		margin-left: 2%;
	}
	div.containertest-sm {
		width: 100%;
		max-width: 970px;
	}
	.row {
		margin-bottom: 0%;
	}

	.lts {
		margin-top: 0.2em;
	}

	.col-fixed {
		margin-top: 14px;
		margin-bottom: 1%;
	}

	/* For small devices (e.g. smartphones) */
	.imgsize {
		max-width: 100%;
		display: inline-block;
	}

	ul.jinfo {
		list-style-type: none;
		line-height: 1.8;
		font-size: 13px;
		margin-left: -16%;
		margin-bottom: 0%;
	}

	/* For medium devices (e.g. tablets) */
	@media (min-width: 420px) {
		.imgsize {
			max-width: 48%;
		}
	}

	/* For large devices (e.g. desktops) */
	@media (min-width: 760px) {
		.imgsize {
			max-width: 34%;
		}
		 .cmp-info {
			margin-left: -1%;
		}
	}

	/* for each job info */
	.item:hover{
		box-shadow:
		1px 1px #c4bcbc,
		2px 2px #c4bcbc,
		2px 2px #c4bcbc;
		-webkit-transform: translateX(-1px);
		transform: translateX(-1px);
	}

	.job-salary h3{
		font-weight: bolder;
		margin-top: 10px;
		padding-top: 0px;
		padding-right: 10px;
		padding-bottom: 10px;
	}

</style>