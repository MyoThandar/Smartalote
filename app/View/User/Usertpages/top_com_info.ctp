<!-- <div class="container jdetail"> -->
<div class="container jobdetail" style="margin-top: -1%;">
	<div class="clearfix"></div>
	<div class="row">
		<div class="cmp-pdetail">
			<?php if($cmpInfo[0]['CmpHeadhunter']['type'] == false):?>
				<div class="col-md-12 col-sm-12 col-xs-12 detail-type1" style=" width: 100%;">
					<h3>Headhunter Information</h3>
				</div>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['logo'])) : ?>
					<div class="col-md-2 col-sm-6 col-xs-6">
						<div class ="cmp-img">
							<?php echo $this->Html->image($cmpInfo[0]['CmpHeadhunter']['logo'], array('alt' => $cmpInfo[0]['CmpHeadhunter']['logo'])); ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="col-md-9 col-sm-10 col-xs-10">
					<ul>
						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['company_name'])) : ?>
							<li>
								<?php echo $cmpInfo[0]['CmpHeadhunter']['company_name']; ?>
							</li>
						<?php else: ?>
							<li>
								<?php echo 'Independent' ; ?>
							</li>
						<?php endif; ?>

						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['industry_big'])): ?>
							<?php $industries=rtrim($cmpInfo[0]['CmpHeadhunter']['industry_big'], ','); ?>
							<?php $IndustryArray=explode(',', $industries); ?>
							<?php foreach($IndustryArray as $key =>$industry_value) : ?>
								<li>
									<a href="/usertpages/job_search?industry_big_id=<?php echo $industry_value; ?>" style='color:blue;'>
										<?php echo $IndustryBig[intval($industry_value)];?>
									</a>
								</li>
							<?php endforeach;?>
						<?php endif; ?>

						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['education'])): ?>
							<li>
								<?php echo $education[$cmpInfo[0]['CmpHeadhunter']['education']]; ?>
							</li>
						<?php endif; ?>


						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['region']) ): ?>
							<li class="location">
								<i class="fa fa-map-marker" aria-hidden="true" style="color: red;"></i> <?php echo $regions[$cmpInfo[0]['CmpHeadhunter']['region']]; ?></li>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['establishment'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3>Establishment</h3>
							<p><?php echo date('d M Y', strtotime($cmpInfo[0]['CmpHeadhunter']['establishment'])); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<div class="col-md-12 col-sm-12 col-xs-12" style="line-height: 1.7em;">
					<div class="detail-type1">
						<h3> Language Skill</h3>
					</div>
					<div style="margin-left: -3%;">
						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['burmese_level'])) :?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-2 col-sm-6 col-xs-6">Burmese Level </div>
								<div class="col-md-6 col-sm-6 col-xs-6"><?php echo $language_skill[$cmpInfo[0]['CmpHeadhunter']['burmese_level']]; ?></div>
							</div>
						<?php endif; ?>
						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['english_level'])) :?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-2 col-sm-6 col-xs-6">English Level</div>
								<div class="col-md-6 col-sm-6 col-xs-6"><?php echo $language_skill[$cmpInfo[0]['CmpHeadhunter']['english_level']]; ?></div>
							</div>
						<?php endif; ?>
						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['chinese_level'])) :?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-2 col-sm-6 col-xs-6">Chinese Level</div>
								<div class="col-md-6 col-sm-6 col-xs-6"><?php echo $language_skill[$cmpInfo[0]['CmpHeadhunter']['chinese_level']]; ?></div>
							</div>
						<?php endif; ?>
						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['japanese_level'])) :?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-2 col-sm-6 col-xs-6">Japan  Level</div>
								<div class="col-md-6 col-sm-6 col-xs-6"><?php echo $language_skill[$cmpInfo[0]['CmpHeadhunter']['japanese_level']]; ?></div>
							</div>
						<?php endif; ?>

						<?php if(!empty($cmpInfo[0]['HeadhunterOtherLanguage'])) : ?>

							<?php foreach ($cmpInfo[0]['HeadhunterOtherLanguage'] as $key => $value) : ?>

								<?php if(!empty($value['lang_type']) && !empty($value['lang_skill'])) : ?>

									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-2 col-sm-6 col-xs-6">
											<?php echo $language[$value['lang_type']].'&nbsp;Level'?>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-6">
											<?php echo $language_skill[$value['lang_skill']]; ?>
										</div>
									</div>
								<?php endif; ?>

							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['profile'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3> Profile</h3>
							<p><?php echo nl2br($cmpInfo[0]['CmpHeadhunter']['profile']); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['self_pr'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3> Self Pr</h3>
							<p><?php echo nl2br($cmpInfo[0]['CmpHeadhunter']['self_pr']); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['about'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3> Shout</h3>
							<p><?php echo nl2br($cmpInfo[0]['CmpHeadhunter']['about']); ?></p>
						</div>
					</div>
				<?php endif; ?>

			<?php else:?>
				<div class="col-md-12 col-sm-12 col-xs-12 detail-type1" style=" width: 100%;">
					<h3>Company Information</h3>
				</div>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['logo'])) : ?>
					<div class="col-md-2 col-sm-6 col-xs-6">
						<div class ="cmp-img">
							<?php echo $this->Html->image($cmpInfo[0]['CmpHeadhunter']['logo'], array('alt' => $cmpInfo[0]['CmpHeadhunter']['logo'])); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="col-md-9 col-sm-10 col-xs-10 cmp-info">
					<ul>
						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['company_name'])) : ?>
							<li>
								<?php echo $cmpInfo[0]['CmpHeadhunter']['company_name']; ?>
							</li>
						<?php endif; ?>
						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['industry_big'])): ?>
							<li>
								<a href="/usertpages/job_search?industry_big_id=<?php echo $cmpInfo[0]['CmpHeadhunter']['industry_big']; ?>" style='color:blue;'>
									<?php echo $IndustryBig[$cmpInfo[0]['CmpHeadhunter']['industry_big']];?>
								</a>

								<?php echo '/';?>

								<a href="/usertpages/job_search?industry_small_id=<?php echo $cmpInfo[0]['CmpHeadhunter']['industry_small']; ?>" style='color:blue;'>
									<?php echo $IndustrySmall[$cmpInfo[0]['CmpHeadhunter']['industry_small']];?>
								</a>
							</li>
						<?php endif; ?>
						<?php if (!empty($cmp['number_of_employee'])): ?>
							<?php if (empty($cmp['number_of_employee_flag'])) : ?>
								<li>
									<?php echo $employee[$cmp['number_of_employee']]; ?> persons
								</li>
							<?php endif; ?>
						<?php endif; ?>


						<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['region']) ): ?>
							<li class="location">
								<i class="fa fa-map-marker" aria-hidden="true" style="color: red;"></i> <?php echo $regions[$cmpInfo[0]['CmpHeadhunter']['region']]; ?></li>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['company_id'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3> Company ID</h3>
							<p><?php echo $cmpInfo[0]['CmpHeadhunter']['company_id']; ?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['representative_name'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3> Representative</h3>
							<p><?php echo $cmpInfo[0]['CmpHeadhunter']['representative_name']." (".$cmpInfo[0]['CmpHeadhunter']['representative_postion'].")"; ?></p>
						</div>
					</div>
				<?php endif; ?>


				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['establishment'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3>Establishment</h3>
							<p><?php echo date('d M Y', strtotime($cmpInfo[0]['CmpHeadhunter']['establishment'])); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['number_of_employee'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3>Employees</h3>
							<p><?php echo str_replace("to","~",$employee[$cmpInfo[0]['CmpHeadhunter']['number_of_employee']]); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['overview'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3>About us</h3>
							<p><?php echo nl2br($cmpInfo[0]['CmpHeadhunter']['overview']); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($cmpInfo[0]['CmpHeadhunter']['hp_address'])) : ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="detail-type1">
							<h3>HP address</h3>
							<p><?php $newhp_address = wordwrap($cmpInfo[0]['CmpHeadhunter']['hp_address'], 18, "\n", true); ?>
								<?php echo $this->Html->link(
								$newhp_address,$newhp_address,['class' => '', 'target' => '_blank']); ?></p>
							</div>
						</div>
					<?php endif; ?>

				<?php endif; ?>

		</div>
	</div>

	<div class="clearfix"></div>

	<?php if (!empty($joblist)) : ?>
	<div class="row other-job">
		<div>
			<div class="col-md-12 col-sm-12 col-xs-12 detail-type1">
				<h3>Jobs </h3>
			</div>
			<?php foreach ($joblist as $jkey => $jval): ?>
				<div class="col-md-12 col-sm-12 col-xs-12 col-fixed">
					<div class="item">
						<div class="lts">
							<?php echo $this->Html->image($jval['CmpHeadhunter']['logo'], array('alt' => $jval['CmpHeadhunter']['logo'])); ?>
						</div>
					<div class="rts">
						<span class="jId" style="display: none"><?php echo $jval['Occupation']['id']; ?></span>
						<ul class="jinfo">

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
							<li class="bolder hidden-md hidden-lg">
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

							<!-- <li class="bolder">
								<?php
									if (!empty($jval['CmpHeadhunter']['company_name']) && empty($jval['CmpHeadhunter']['headhunter_name'])) {
										if (count($jval['CmpHeadhunter']['company_name']) > 30)
											echo mb_substr( $jval['CmpHeadhunter']['company_name'], 0, 30,'UTF-8')."...";
										else
											echo $jval['CmpHeadhunter']['company_name'];
									}
									elseif (empty($jval['CmpHeadhunter']['company_name']) && !empty($jval['CmpHeadhunter']['headhunter_name']))
										if (count($jval['CmpHeadhunter']['headhunter_name']) > 30)
											echo mb_substr( $jval['CmpHeadhunter']['headhunter_name'], 0, 30,'UTF-8')."...";
										else
											echo $jval['CmpHeadhunter']['headhunter_name'];

									elseif (!empty($jval['CmpHeadhunter']['company_name']) && !empty($jval['CmpHeadhunter']['headhunter_name']))
										if (count($jval['CmpHeadhunter']['headhunter_name']) > 30)
											echo mb_substr( $jval['CmpHeadhunter']['headhunter_name'], 0, 30,'UTF-8')."...";
										else
											echo $jval['CmpHeadhunter']['headhunter_name'];
								?>
							</li>
 -->
							<li>
								<?php if (!empty($jval['IndustrySmall']['label'])): ?>
									<?php echo $jval['IndustryBig']['label']; ?> /
								<?php endif; ?>

								<?php if (!empty($jval['IndustrySmall']['label'])): ?>
									<?php echo $jval['IndustrySmall']['label']; ?>
								<?php endif; ?>
							</li>

							<li class="bolder"><?php echo $jval['Occupation']['job_title']; ?></li>

							<?php if (!empty($jval['Occupation']['salary_range'])): ?>
							<li>
								<i class="fa fa-usd" aria-hidden="true"></i> <?php echo $salary_range[$jval['Occupation']['salary_range']]; ?>
							</li>
							<?php endif; ?>

							<?php if (!empty($jval['Region']['name'])): ?>
							<li class="location">
								<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $jval['Region']['name']; ?>
							</li>
							<?php endif; ?>

						</ul>
					</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>

</div>

<script type="text/javascript">

	$(function() {
		$('.item').on('click', function() {
			var jobId = $(this).find('.jId').text();
			var url = "<?php echo Router::url(array('controller' => 'useroccupations', 'action' => 'detail')); ?>";
			window.location = url+'/'+jobId;
		});
	});

</script>
<style type="text/css">
	.other-job {
		border-radius: 7px;
		margin-bottom: -3%;
		margin-top: 3%;
		background: #fff;
		padding-bottom: 3%;
	}
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

	.row .cmp-pdetail ul {
		line-height: 2;
		list-style-type: none;
		margin-left: -39px;
	}

	ul.jinfo {
		list-style-type: none;
		line-height: 1.8;
		font-size: 13px;
		margin-left: -12%;
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
		.row .cmp-pdetail {
			border: 1px solid #E0E0E0;
			margin-top: 30px;
			display: inline-block;
			background-color: #fff;
		}
		.row .cmp-pdetail ul {
			line-height: 2;
			list-style-type: none;
			margin-left: -57px;
		}
		ul.jinfo {
			list-style-type: none;
			line-height: 1.8;
			font-size: 13px;
			margin-left: -13%;
			margin-bottom: 0%;
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
</style>