<!-- User top header photo -->
<div class="hidden-xs hidden-sm">
	<div class="col-md-12 top_bunner" >
		<div class="col-md-6">
			<div class="col-md-1">
			</div>
			<div class="col-md-11">
				<p>
					<div>
						<strong class="bun_font">We Offer&nbsp</strong>
						<label style="color:red;font-size:40px">
							<?php if(!empty($job_lists)) : ?>
								<?php echo count($job_lists); ?>
							<?php else : ?>
								<?php echo "EMPTY"; ?>
							<?php endif; ?>
						</label>
						<strong class="bun_font" >&nbspMyanmar Job Vacancies</strong>
					</div><br>
					<div><strong class="bun_font" >Find New Job To Step Up</strong></div>
				</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-4">
			</div>
			<div class="col-md-6 m_search" >
				<div class="show_box">
					<?php echo $this->Form->create('Occupation', array( 'url' => array('controller' => 'usertpages', 'action' => 'job_search'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
					<div class="container-1">
						<?php if (!empty($this->params->query['keyword'])) : ?>
							<?php echo $this->Form->input('keyword', array('label' => false, 'class' => 'search_select letter_align', 'autocomplete' => 'off', 'placeholder' => 'Keyword', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
						<?php else : ?>
							<?php echo $this->Form->input('keyword', array('label' => false,'class' => 'search_select letter_align','style'=>'font-size:12px', 'autocomplete' => 'off', 'placeholder' =>'Keyword', 'required' => false)); ?>
						<?php endif; ?>
					</div>
				</div>
				<div style="padding-top:5px;">
					<?php echo $this->Form->input('location_small_id', array(
						'options' =>$region,
						'empty'=>'---Location---','class' =>"search_select letter_align",'required' => false,'label'=>false
					)); ?>
				</div>
				<div style="padding-top:5px;">
					<?php echo $this->Form->input('job_category_id', array(
						'options' =>$job_category,
						'empty'=>'---Job Category---','class' =>"search_select letter_align",'required' => false,'label'=>false
					)); ?>
				</div>
				<div style="padding-top:5px;">
					<?php echo $this->Form->input('industry_big_id', array(
						'options' => $industry,
						'empty'=>'---Industry---','class' =>"search_select letter_align",'required' => false,'label'=>false
					)); ?>
				</div>
				<div style="padding-top:5px;">
					<?php echo $this->Form->input('salary_range', array(
						'options' => $salary_range,
						'empty'=>'---Salary---','class' =>"search_select letter_align",'required' => false,'label'=>false
					)); ?>
				</div>
				<div style="padding-top:5px;">
					<strong><?php echo $this->Form->submit(
						'Find Job',
						array('class' => 'search_select find_job_btn')
								);?>
					</strong>
				</div>
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
</div>

<div class="hidden-md hidden-lg">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="txt-type1">
					<div class="txt-center">
						<div><strong class="bun_font">We Offer&nbsp</strong> <label style="color:red;font-size:40px"><?php if(!empty($job_lists)){ echo count($job_lists);}else{
						echo "EMPTY";}?></label><strong class="bun_font" >&nbspMyanmar Job Vacancies</strong></div><br>
						<div><strong class="bun_font" >Find New Job To Step Up</strong></div>
					</div>
				</div>
			</div>

			<?php echo $this->Form->create('Occupation', array( 'url' => array('controller' => 'usertpages', 'action' => 'job_search'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<div class="container-1">
							<?php if (!empty($this->params->query['keyword'])) : ?>
								<?php echo $this->Form->input('keyword', array('label' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Keyword', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
							<?php else : ?>
								<?php echo $this->Form->input('keyword', array('label' => false,'class' => 'form-control','style'=>'font-size:12px', 'autocomplete' => 'off', 'placeholder' =>'Keyword', 'required' => false)); ?>
							<?php endif; ?>
						</div>
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
				</div>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<div class="clear"></div>

<!-- Latest jobs for PC -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-xs hidden-sm">
	<div class="top-title">
		<h3>LATEST JOBS</h3>
	</div>
</div>

<!-- Latest jobs for mobile -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-lg hidden-md">
	<div class="top-title text-center">
		<h4>LATEST JOBS</h4>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-centered col-fixed">
			<div class="content">
				<?php echo $this->Html->link("Browse All Jobs", array('controller' => 'usertpages', 'action' => 'job_search'), array('class' =>'btn btn-orange-bright')) ?>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row rowpc">
		<?php if (!empty($job_lists)) : ?>
			<?php $i = 1; foreach ($job_lists as $jkey => $jval) : ?>
			<?php if ($i < 13) : ?>
				<div class="col col-md-6 col-sm-12 col-xs-12 col-fixed">
					<div class="item itempc">
						<div class="lts">
							<?php echo $this->Html->image($jval['CmpHeadhunter']['logo'], array('alt' => $jval['CmpHeadhunter']['logo'])); ?>
						</div>

						<div class="rts sm-latest-job">
							<span class="jId" style="display: none"><?php echo $jval['Occupation']['id']; ?></span>
							<ul class="jinfo pc col-sm-9">

								<li class="text-concat bolder moble_word_break">
									<?php if ($jval['CmpHeadhunter']['type'] == true) : ?>
										<?php
											if (strlen($jval['CmpHeadhunter']['company_name']) > 75) {
												echo mb_substr($jval['CmpHeadhunter']['company_name'],0,75,'UTF-8')."...";
											} else {
												echo $jval['CmpHeadhunter']['company_name'];
											}
										?>
									<?php else : ?>
										<?php if(!empty($jval['CmpHeadhunter']['company_name'])) : ?>
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
									<?php if (!empty($jval['IndustrySmall']['label'])) : ?>
										<?php echo $jval['IndustryBig']['label'] . ' / ' . $jval['IndustrySmall']['label']; ?>
									<?php endif; ?>
								</li>

								<li class="bolder moble_word_break">
									<?php
										if (strlen($jval['Occupation']['job_title']) > 75) {
											echo mb_substr($jval['Occupation']['job_title'],0,75,'UTF-8')."...";
										} else {
											echo $jval['Occupation']['job_title'];
										}
									?>
								</li>

								<?php if (!empty($jval['Occupation']['salary_range'])) : ?>
									<li>
										<i class="fa fa-usd" aria-hidden="true"></i>
										<?php echo $salary_range[$jval['Occupation']['salary_range']]; ?>
									</li>
								<?php endif; ?>

								<?php if (!empty($jval['Region']['name'])) : ?>
									<li class="location">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										<?php echo $jval['Region']['name'];?>
									</li>
								<?php endif; ?>

							</ul>
						</div>
					</div>
				</div>

				<?php if (($i%2) == 0) : ?>
					<div class="clearfix"></div>
				<?php endif; ?>
			<?php endif; ?>
			<?php $i++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>

<div class="clearfix"></div>

<!--  FOR TOP EMPLOYER -->
<?php if (!empty($company_logo)) : ?>

	<!-- PC -->
	<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-xs hidden-sm">
		<div class="top-title">
			<h3>TOP EMPLOYER</h3>
		</div>
	</div>

	<!-- SM -->
	<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-lg hidden-md">
		<div class="top-title text-center">
			<h4>TOP EMPLOYER</h4>
		</div>
	</div>

	<div class="container">
		<div class="row row-fixed">
			<?php foreach ($company_logo as $logokey => $logovalue) : ?>
				<div class="col-md-2 col-sm-4 col-xs-6 col-fixed">
					<div class="list">
						<div class="topemp">
							<?php if (!empty($logovalue)) : ?>
								<?php echo $this->Html->link($this->Html->image($logovalue), array('controller' => 'usertpages', 'action' => 'top_com_info', $logokey), array('escape' => false)); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

<div class="clearfix"></div>

<!-- PC -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-xs hidden-sm">
	<div class="top-title">
		<h3>SEARCH BY</h3>
	</div>
</div>

<!-- SM -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-lg hidden-md">
	<div class="top-title text-center">
		<h4>SEARCH BY</h4	>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12 col-fixed">
			<div class="list">
				<div class="title1">
					<h3>Industry</h3>
				</div>
				<div class="list-type-1 panel industry_height">
					<ul>
						<?php foreach($countIndustry as $ikey => $ival) : ?>
						<li>
							<?php echo $this->Html->link($industry[$ival['Occupation']['industry_big_id']], array(
								'controller' => 'usertpages',
								'action' => 'job_search',
								'?' => array('industry_big_id' => $ival['Occupation']['industry_big_id']))); ?>
							<span style="color: red;">  ( <?php echo $ival[0]['count']; ?> ) </span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 col-xs-12 col-fixed">
			<div class="list">
				<div class="title1">
					<h3>Job Category</h3>
				</div>
				<div class="list-type-1 panel category_height">
					<ul>
						<?php foreach($countJobcategory as $jkey => $jval) : ?>
						<li>
							<?php echo $this->Html->link($job_category[$jval['Occupation']['job_category_id']], array('controller' => 'usertpages','action'=>'job_search',"?job_category_id=".$jval['Occupation']['job_category_id'])); ?>
							 <span style="color: red;"> ( <?php echo $jval[0]['count']; ?> ) </span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 col-xs-12 col-fixed">
			<div class="list">
				<div class="title1">
					<h3>Region</h3>
				</div>
				<div class="list-type-1 panel region_height">
					<ul>
						<?php foreach($countRegion as $rkey => $rval) : ?>
						<li>
						<?php echo $this->Html->link($region[$rval['Occupation']['location_small_id']], array('controller' => 'usertpages','action'=>'job_search',"?location_small_id=".$rval['Occupation']['location_small_id'])); ?>

						<span style="color: red;"> ( <?php echo $rval[0]['count']; ?> ) </span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- for jobseeker -->
<div class="clearfix"></div>

<!-- PC -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-xs hidden-sm" id="FJseeker">
	<div class="top-title">
		<h3>FOR JOB SEEKERS</h3>
	</div>
</div>

<!-- SM -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-lg hidden-md" id="sm-FJseeker">
	<div class="top-title text-center">
		<h4>FOR JOB SEEKERS</h4>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="txt-type1">
				<p>SMARTALOTE is a comprehensive job search site. You can receive the scouting messages directly from Myanmar's fantastic companies and top-level headhunters and apply for listed job opportunities.</p>
				<h3 style="color:#31699f" class='margin-top-sm' >
					1.Registration of CV
				</h3>
				<p>
					You can create your CV online and download it to use offline. Keep the CV information up-to-date. Tracking your carriers is always the shortcut to your career advancement.
				</p>
				<h3 style="color:#31699f" class='margin-top-sm' >
					2.Scouting messages
				</h3>
				<p>
					Company recruiters and headhunters will send scouting messages to you based on the registered CV. It is up to you whether to apply for the scouting message or not. You can also grasp your market value by the scouting messages. We strongly recommend that you fill out the job history carefully as much as possible.
				</p>
				<h3 style="color:#31699f" class='margin-top-sm' >
					3.Application for the job information
				</h3>
				<p>
					You can apply online to the job information posted in SMARTALOTE. Since you can exchange with recruiters/headhunters in message function on SMARTALOTE, you can proceed with career change efficiently.
				</p>
				<h3 style="color:#31699f" class='margin-top-sm' >
					4.Reward for success (Under preparation)
				</h3>
				<p>
					Please contact SMARTALOTE after getting your official job offer of the company applied through SMARTALOTE. After confirming to the company, you will be paid reward fee for success as a "celebration gift".
				</p>
			</div>

			<?php if(empty($user_id)) : ?>
				<div class="content">
					<?php echo $this->Html->link("Job Seeker's Register", array('controller' => 'users', 'action' => 'add'), array('class' =>'btn btn-orange-bright')) ?>
				</div>
			<?php endif?>
		</div>
	</div>
</div>

<!-- for recruite -->
<div class="clearfix"></div>

<!-- PC -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-xs hidden-sm" id="FCrecuriter">
	<div class="top-title" >
		<h3>FOR COMPANY RECRUITERS</h3>
	</div>
</div>

<!-- SM -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-lg hidden-md" id="sm-FCrecuriter">
	<div class="top-title text-center">
		<h4>FOR COMPANY RECRUITERS</h4>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="txt-type1">
				<p>
					You can post job advertisements anytime by registering SMARTALOTE. Jobseekerswill apply for your job information. It is also possible for you to discover talented person who are suited to your company's needs among registered CVs. You can make appointment for the candidates you like and arrange the schedule for the interview. SMARTALOTE will help you make your recruitment activities more efficient.
				</p>
			</div>
			<?php if(empty($user_id)) : ?>
				<div class="content">
				<?php echo $this->Html->link("Company's Register", array('controller' => 'usertpages', 'action' => 'company_add'), array('class' =>'btn btn-orange-bright')) ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- for headhunter -->
<div class="clearfix"></div>

<!-- PC -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-sm hidden-xs" id="FHunter">
	<div class="top-title" >
		<h3 >FOR HEADHUNTER</h3>
	</div>
</div>

<!-- SM -->
<div class="col-md-12 col-sm-12 col-xs-12 fr-top-title hidden-lg hidden-md" id="sm-FHunter">
	<div class="top-title text-center" >
		<h4>FOR HEADHUNTER</h4>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="txt-type1">
				<p>
					Let's find talented persons that meet the needs of your client company from the SMARTALOTE talent bank. It is already past stories that recruiting agency had to build your own human resource database. You are free to screen the personnel resources registered in SMARTALOTE and introduce them to your client company. SMARTALOTE receives a small fee when applicants are hired by your client via you, but profitability and efficiency of your business will be dramatically improved.
				</p>
			</div>
			<?php if(empty($user_id)) : ?>
				<div class="content">
				<?php echo $this->Html->link("Headhunter's Register", array('controller' => 'usertpages', 'action' => 'headhunter_add'), array('class' =>'btn btn-orange-bright')) ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var maxHeight = Math.max.apply(null, $("div.panel").map(function (){
			return $(this).height();
		}).get());
		$('.industry_height').height(maxHeight);
		$('.category_height').height(maxHeight);
		$('.region_height').height(maxHeight);
	});

	$(".sub_ul > li >a").click(function(){
		$('.submenu').hide();
		$('#main_menu').click();
	});

	$('#main_menu').click(function(){
		$('.submenu').show();
	});

	$(function() {
		$('.item').on('click', function() {
			var jobId = $(this).find('.jId').text();
			var url = "<?php echo Router::url(array('controller' => 'useroccupations', 'action' => 'detail')); ?>";
			window.location = url+'/'+jobId;
		});
	});

</script>

<style type="text/css" media="screen">
	table {
		margin: auto;
	}
	.pc {
		margin-top: -1%;
		margin-left: -2%;
		margin-bottom: -1%;
	}
	.rowpc {
		margin-top: -2%;
		margin-bottom: 2%;
	}
	.row {
		display: flex;
		flex-wrap: wrap;
		padding:0px 7px;
	}
	.col {
		display: flex;
	}
	h3 {
		margin-top: 1%;
	}
	.itempc {
		height: auto;
		width: 100%;
		display: inline-block;
	}
	li.bolder.moble_word_break {
		line-height: 1.3;
		padding: 6px 0px;
	}
</style>