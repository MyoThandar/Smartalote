<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Your Resume</title>
	<style type="text/css" media="screen">
		@charset "utf-8";
/* CSS Document */

/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/
*{margin:0;padding:0}
/*@page{margin: 30%;}*/

html, body, div, span,
fieldset, form, label, legend,
tr, th, td,
section{
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
body {
	line-height: 1;
}


#container {
	background: #fff;
	margin: 30px auto;
	width: 100%;
	font-family: 'LeagueGothicRegular', serif;
	color: #000;
}

/*----------Header------------*/

/*----------profile picture---*/

.section div.img {
	display: block;
	position: relative;
	overflow: hidden;
	padding: 20.37% 0 0 0;
	float: left;
	width: 26%;
	height: 0%;
	border: medium solid #084B8A;
	overflow: hidden;
	position: relative;
}

.section div.img img {
	display: block;
	max-width:100%;
	width: 212px;
	height : 216px;
	margin:auto;
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
}

.section div.personal-info{
	/*float:right;*/
	width: 68%;
}

/*----------------------------*/

#header {
	background: #0099CC;
	border-bottom: 5px solid #efefef;
	color: #fff;
	height: 30px;
	padding: 14px 18px 0 18px;
	background: -webkit-gradient(linear, left top, left bottom, from(#21b9ec), to(#0099CC));
	background: -moz-linear-gradient(top,  #21b9ec,  #0099CC);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#21b9ec', endColorstr='#0099CC');
}

#header ul li {
	display: inline;
	text-decoration: none;
	margin-right: 10px;
}

#header ul li a {
	color: #fff;
	text-decoration: none;
	font-weight: bold;
	font-size: 14px;
}

#header ul li a:hover {
	color: #FFFF33;
}


.section {
	padding: 0px 0 30px;
	margin: 0 18px;
}

.section.personal {
	margin-top: 28px;
}


.section h2 {
	margin-top: 2px;
	margin-left: 150px;
	font-weight: bold;
	font-size: 14px;
	letter-spacing: 0.2em;
}

.section ul {
	font-size: 15px;
	line-height: 1.8em;
	float: right;
	margin-top: -75px;
	margin-right: 82px;
}

.section ul span {
	font-weight: bold;
	font-size: 15px;
}

.section ul a {
	color: #666;
	text-decoration: none;
}

.section ul a:hover {
	color: #444;
}

.section .left {
	width: 202px;
	float: left;
}

.section .left p {
	font-size: 14px;
	padding-right: 20px;
	margin-top: 10px;
	color: #888;
}

.section .left h3 {
	font-size: 24px;
	color: #000;
}

.section  .right {
	float: right;
	width: 622px;
}

.section p {
	font-size: 14px;
	margin-bottom: 10px;
	line-height: 1.3em;
}

.section h4 {
	font-weight: bold;
	font-size: 14px;
	margin-bottom: 8px;
}

/*----------Section Top------------*/

/*----------Personal------------*/


/*----------Education------------*/

.education {
	height: 200px;
}

.row {
	position: relative;
}

.row h4 {
	font-weight: bold;
	font-size: 16px;
	margin-bottom: 4px;
}

.row h5 {
	color: #999;
	font-weight: bold;
	font-size: 12px;
	margin-bottom: 10px;
}

.row a {
	text-decoration: none;
	color: #fff;
	padding: 7px 8px;
	background: #666;
	font-size: 13px;
	position: absolute;
	top: 0;
	right: 0;
	cursor: default;
}

.row a:hover {
	background: #aaa;
}

/*----------Technical------------*/

.technical {
	height: 220px;
}

.technical h4 {
	color: #000;
	font-size: 12px;
}

.right_right {
	width: 330px;
	float: right;
}

.right_left {
	width: 250px;
	float: left;
}

.right_left span {
	font-weight: bold;
	color: #333;
}


/*----------Contact------------*/

.contact {
	height: 240px;
}

.social_contact {
	float: right;
	text-decoration: none;
	color: #fff;
	padding: 5px 7px;
	font-size: 13px;
	background: #000;
	border-radius: 3px;
	margin-left: 8px;
	margin-top: -19px;
}

.social_contact:hover {
	color: #000;
	background: #fff;
}


.section .cv-title {
	border-bottom: 4px solid #eeeeee;
	padding-bottom: 10px;
}

.section .cv-title h3 {
	font-size: 30px;
	color: #000;
	font-weight: bold;
}

.section .table {
	margin-top: 20px;
}

table {
	width:100%;
	margin-bottom: 20px;
}

table tr td{
	padding:5px 0px;
}

table tr td.thead {
	width:24%;
	font-weight: bold;
}

table tr td.col{
	width: 2%;
}

caption {
	font-size: 20px;
	text-align: left;
	font-weight: bold;
}

.instruction {
	padding-left: 28px;
	padding-top: 10px;
}

.clearfix{
	clear:both;
}

</style>
</head>
<body>
	<div id="container">

		<div style="margin-right: 16px;">
			<div style="text-align: right">
				<?php $logo = "/var/www/html/app/webroot/img/smartalote-pdf.png"; ?>
				<img src="<?php echo $logo; ?>" width=18% height= 0%>
			</div>
		</div>

		<div class="section">
			<?php if (!empty($data['User']['pdf'])) : ?>
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class = "img">
						<?php echo $this->Html->image($data['User']['pdf'], array("style" => "position: absolute;")); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if (!empty($data['User']['pdf'])) : ?>
				<div class="personal-info" style="float:right;">
			<?php else : ?>
				<div class="personal-info" style="margin-left: 0%;">
			<?php endif; ?>

				<h1>
					<?php if (!empty($data['User']['name'])): ?>
					<?php echo $data['User']['name']; ?>
					<?php endif; ?>
				</h1>
				<table style="margin-top: 20px;">
					<tbody>
						<tr>
							<td class="thead">Gender</td>
							<td class="col">:</td>
							<?php $gender=array(1=>'male',2=>'female');?>
							<td>
								<?php if (!empty($data['User']['gender'])): ?>
								<?php echo $gender[$data['User']['gender']]; ?>
								<?php endif; ?>
							</td>
						</tr>

						<tr>
							<td class="thead">Birth date</td>
							<td class="col">:</td>
							<td>
								<?php if (!empty($data['User']['birthday'])): ?>
								<?php echo date('d M Y', strtotime($data['User']['birthday'])); ?>
								<?php endif; ?>
							</td>
						</tr>

						<tr>
							<td class="thead">Nationality</td>
							<td class="col">:</td>
							<td>
								<?php if (!empty($data['User']['nationality'])): ?>
								<?php echo $data['nationality'][$data['User']['nationality']]; ?>
								<?php endif; ?></td>
						</tr>

						<tr>
							<td class="thead">Address</td>
							<td class="col">:</td>
							<td>
								<?php if (!empty($data['User']['address']) || !empty($data['User']['location'])): ?>
								<?php echo $data['User']['address'] . ' ' . $data['location'][$data['User']['location']]; ?>
								<?php endif; ?>
							</td>
						</tr>

						<tr>
							<td class="thead">Phone Number</td>
							<td class="col">: </td>
							<td>
								<?php if (!empty($data['User']['phone_number'])): ?>
								<?php echo $data['User']['phone_number']; ?>
								<?php endif; ?>
							</td>
						</tr>

						<tr>
							<td class="thead">Email</td>
							<td>:</td>
							<td>
								<?php if (!empty($data['User']['email'])): ?>
								<?php echo $data['User']['email']; ?>
								<?php endif; ?>
							</td>
						</tr>

						<tr>
							<td class="thead">Religion</td>
							<td>:</td>
							<td>
								<?php if (!empty($data['User']['religion'])): ?>
								<?php echo $data['religion'][$data['User']['religion']]; ?>
								<?php endif; ?>
							</td>
						</tr>

						<tr>
							<td class="thead">Marital status</td>
							<td>:</td>
							<td>
								<?php if (!empty($data['User']['marital_status'])): ?>
								<?php echo $data['marital_status'][$data['User']['marital_status']]; ?>
								<?php endif; ?>
							</td>
						</tr>

						<tr>
							<td class="thead">Updated Date</td>
							<td>:</td>
							<td>
								<?php if (!empty($data['User']['modified'])): ?>
								<?php echo date('d M Y', strtotime($data['User']['modified'])); ?>
								<?php endif; ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="clear:right;"></div>
		</div>
		<div class="clearfix"></div>

		<?php if (!empty($data['UserCoreSkill'])): ?>
			<div class="section personal">

				<div class="cv-title">
					<h3>Executive summary</h3>
				</div>

				<div class="table">
					<table>
						<tbody>
							<tr>
								<td class="thead">Expected salary</td>
								<td class="col">:</td>
								<td>
									<?php if (!empty($data['UserCoreSkill'][0]['expected_salary'])): ?>
									<?php echo $data['salary'][$data['UserCoreSkill'][0]['expected_salary']]; ?>
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<td class="thead">Current salary</td>
								<td class="col">:</td>
								<td>
									<?php if (!empty($data['UserCoreSkill'][0]['current_salary'])): ?>
									<?php echo $data['salary'][$data['UserCoreSkill'][0]['current_salary']]; ?>
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<td class="thead">Current benefits</td>
								<td class="col">:</td>
								<td>
									<?php if (!empty($data['UserCoreSkill'][0]['current_benefits'])): ?>
									<?php echo $data['UserCoreSkill'][0]['current_benefits']; ?>
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<td class="thead">Availability</td>
								<td class="col">:</td>
								<td>
									<?php if (!empty($data['UserCoreSkill'][0]['availability'])): ?>
									<?php echo $data['availability'][$data['UserCoreSkill'][0]['availability']]; ?>
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<td class="thead">Executive summary</td>
								<td class="col">: </td>
								<td>
									<?php if (!empty($data['UserCoreSkill'][0]['executive_summary'])): ?>
									<?php echo $data['UserCoreSkill'][0]['executive_summary']; ?>
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<td class="thead">Core Skill</td>
								<td></td>
								<td>
									<ol style="list-style-type: circle;">
									<?php if (!empty($data['UserCoreSkill'][0]['UserSubCoreSkill'])): ?>
										<?php foreach ($data['UserCoreSkill'][0]['UserSubCoreSkill'] as $key => $val) : ?>
											<?php if (!empty($val['core_skill'])): ?>
												<li><?php echo $val['core_skill']; ?></li>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
									</ol>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>

		<?php if (!empty($data['UserCareerHistory'])): ?>
			<div class="section gallery">
				<div class="cv-title">
					<h3>Career history</h3>
				</div>

				<div class="table">
					<?php foreach ($data['UserCareerHistory'] as $key => $val): ?>
						<table>
							<caption>
								<?php if (!empty($val['company_name'])): ?>
								<?php echo $val['company_name']; ?>
								<?php endif; ?>
							</caption>
							<tbody>
								<tr style="background: #D3D3D3;">
									<td class="col-md-3 thead" style="color: #fff;text-align: center;">
										<?php echo date('M Y', strtotime($val['joined_y_m'])).'~'.date('M Y', strtotime($val['resignation'])); ?>
									</td>
								</tr>

								<tr>
									<td class="thead">Department</td>
									<td class="col">:</td>
									<td>
										<?php if (!empty($val['department'])): ?>
										<?php echo $val['department']; ?>
										<?php endif; ?>
									</td>
								</tr>

								<tr>
									<td class="thead">Position </td>
									<td class="col">:</td>
									<td>
										<?php if (!empty($val['position'])): ?>
										<?php echo $val['position']; ?>
										<?php endif; ?>
									</td>
								</tr>


								<tr>
									<td class="thead">Industry</td>
									<td class="col">: </td>
									<td>
										<?php if (!empty($val['industry_big_id'])): ?>
										<?php echo $data['industry'][$val['industry_big_id']]; ?>
										<?php endif; ?>
									</td>
								</tr>

								<tr>
									<td class="thead">Job category</td>
									<td class="col">: </td>
									<td>
										<?php if (!empty($val['job_category_id'])): ?>
										<?php echo $data['job'][$val['job_category_id']]; ?>
										<?php endif; ?>
									</td>
								</tr>

								<tr>
									<td class="thead">Job Sub-category</td>
									<td class="col">: </td>
									<td>
										<?php if (!empty($val['job_category_sub_id'])): ?>
										<?php echo $data['jobSub'][$val['job_category_sub_id']]; ?>
										<?php endif; ?>
									</td>
								</tr>

								<tr>
									<td class="thead">
									<br/>
									Projects</td>
									<td class="col"></td>
									<td>
										<?php if (!empty($val['UserProject'])): ?>
											<?php foreach ($val['UserProject'] as $pkey => $pval) : ?>
												<?php
													if (!empty($pval['period_start'])) {
														$start = explode('-', $pval['period_start']);
														$period_start = $data['month'][(int)$start[1]]. ' ' . $start[0];
													} else {
														$period_start = "";
													}

													if (!empty($pval['period_end'])) {
														$end = explode('-', $pval['period_end']);
														$period_end = $data['month'][(int)$end[1]]. ' ' . $end[0];
													} else {
														$period_end = 'Current';
													}
												?>

											<br/>
											<div class="row selection_education">
												<h4><?php echo $pval['title']; ?>&nbsp;&nbsp;
													<div class="col-md-3 thead" style="background:#D3D3D3; color: #fff;text-align: center;height: 22px;float:right;padding-top: 8px;width: 30%;">
														<?php echo $period_start .' &tilde; '. $period_end; ?>
													</div>
												</h4>
												<br/>
												<p>
													<?php if (!empty($pval['detail'])): ?>
													<?php echo $pval['detail']; ?>
													<?php endif; ?>
												</p>
											</div>
											<?php endforeach; ?>
										<?php endif; ?>
									</td>
								</tr>
							</tbody>
						</table>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if (!empty($data['UserEducation'])): ?>
			<div class="section gallery">
				<div class="cv-title">
					<h3>Education</h3>
				</div>

				<div class="table">
				<?php foreach ($data['UserEducation'] as $key => $val): ?>
						<caption>
							<?php if (!empty($val['university_name'])): ?>
							<?php echo $val['university_name']; ?>
							<?php endif; ?>
						</caption>

						<table>
							<?php
								if (!empty($val['enrollment'])) {
									$enrollData = explode('-', $val['enrollment']);
									$enroll = $data['month'][(int)$enrollData[1]]. ' ' . $enrollData[0];
								}
							?>
							<?php
								if (!empty($val['graduation'])) {
									$graduation_data = explode('-', $val['graduation']);
									$graduation = $data['month'][(int)$graduation_data[1]]. ' ' . $graduation_data[0];
								}
							?>

							<tr style="background: #D3D3D3;">
								<td class="col-md-3 thead" style="color: #fff;text-align: center;float: right;">
									<?php echo $enroll.'~'.$graduation; ?>
								</td>
							</tr>

							<tr>
								<td class="thead">Department </td>
								<td class="col">:</td>
								<td>
									<?php if (!empty($val['department'])): ?>
									<?php echo $val['department']; ?>
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<td class="thead">Degree</td>
								<td class="col">:</td>
								<td>
									<?php if (!empty($val['degree'])): ?>
									<?php echo $data['edu'][$val['degree']]; ?>
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<td class="thead">Remarks</td>
								<td class="col">: </td>
								<td>
									<?php if (!empty($val['remarks'])): ?>
									<?php echo $val['remarks']; ?>
									<?php endif; ?>
								</td>
							</tr>
						</tbody>
					</table>
				<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if (!empty($data['UserQualification'])): ?>
			<div class="section gallery">
				<div class="cv-title">
					<h3>Qualification</h3>
				</div>

				<div class="table">
				<?php foreach ($data['UserQualification'] as $key => $val): ?>
					<?php if (!empty($val['qualification_name'])): ?>
					<table>
						<caption>
							<?php echo $val['qualification_name']; ?></caption>
						<tbody>
							<tr>
								<td class="thead">Date</td>
								<td class="col">:</td>
								<td>
									<?php if (!empty($val['qualification_date'])) {
									$qualification = explode('-', $val['qualification_date']);
									$qualification_date = $data['month'][(int)$qualification[1]]. ' ' . $qualification[0];
									echo $qualification_date; } ?>
								</td>
							</tr>
						</tbody>
					</table>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if (!empty($data['UserLanguageSkill'])): ?>
			<div class="section gallery">
				<div class="cv-title">
					<h3> Language skill</h3>
				</div>

				<div class="table">
				<?php foreach ($data['UserLanguageSkill'] as $key => $val): ?>
					<?php if(!empty($val['language'])):?>
					<table>
						<caption><?php echo $val['language']; ?>&nbsp;&nbsp;(<?php echo $data['language_skill'][$val['skill']]; ?>)</caption>
						<tbody>
							<tr>
								<td class="thead">Certification</td>
								<td class="col">:</td>
								<td>
									<?php if (!empty($val['certificate'])): ?>
									<?php echo $val['certificate']; ?>
									<?php endif ; ?>
								</td>
							</tr>
						</tbody>
					</table>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if (!empty($data['UserComputingSkill'])): ?>
			<div class="section gallery">
				<div class="cv-title">
					<h3>Computer skill</h3>
				</div>

				<div class="table">
					<table>
						<caption>Microsoft Office</caption>
						<tbody>
						<?php foreach ($data['UserComputingSkill'] as $key => $val): ?>
							<?php if ($key < 3): ?>
								<tr>
									<td class="thead ">
										<?php if (!empty($val['title'])): ?>
										<?php echo $val['title']; ?>
										<?php endif; ?>
									</td>
									<td class="col">:</td>
									<td>
										<?php if (!empty($val['skill'])): ?>
										<?php echo $data['ms_skill'][$val['skill']]; ?>
										<?php endif ; ?>
									</td>
								</tr>
							<?php endif; ?>
						<?php endforeach; ?>
					</table>


					<table>
						<caption>Others</caption>
						<tbody>
						<?php foreach ($data['UserComputingSkill'] as $key => $val): ?>
							<?php if($key > 2): ?>
								<tr>
									<td class="thead ">
										<?php if (!empty($val['title'])): ?>
										<?php echo $val['title']; ?>
										<?php endif; ?>
									</td>
									<td class="col">:</td>
									<td>
										<?php if (!empty($val['skill'])): ?>
										<?php echo $data['ms_skill'][$val['skill']]; ?>
										<?php endif ; ?>
									</td>
								</tr>
							<?php endif; ?>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>

		<?php if (!empty($data['UserSpecialInstruction'])): ?>
			<div class="section gallery">
				<div class="cv-title">
					<h3>Special instruction</h3>
				</div>

				<div class="table">
				<?php foreach ($data['UserSpecialInstruction'] as $key => $val): ?>
					<?php if($val['title']): ?>
					<table>
						<caption>
							<?php echo $val['title']; ?>
						</caption>
						<tbody>
							<tr>
								<td class="instruction">
									<?php if (!empty($val['title']) && !empty($val['detail'])): ?>
									<?php echo $val['detail']; ?>
									<?php endif; ?>
								</td>
							</tr>
						</tbody>
					</table>
					<?php endif; ?>
					<br>
				<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</body>
</html>
