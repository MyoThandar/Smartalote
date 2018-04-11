<div class="x_panel">
	<div class="x_title">
		<h2>Job Browse</h2>
		<div class="clearfix"></div>
	</div>

	<!-- Logined user is Headhunter -->
	<?php if ($user['type'] == 0) : ?>
		<div class="x_content">
			<table class="table-st">
				<tr>
					<td colspan="3" class="labelbg">
						<div class="col-md-10 col-sm-10 col-xs-12">
							<?php echo "<label class='main-label'>Company Information</label>"; ?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<table class="table-st">
			<tr>
				<td class="left">Company Name</td>
				<td class="right"><?php echo $occdata['SubHeadhunter']['company_name']; ?></td>
			</tr>
			<tr>
				<td class="left">Address</td>
				<td class="right">
					<?php echo $occdata['SubHeadhunter']['location']; ?><br/><?php echo $regionname; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Company Logo</td>
				<td class="right">
					<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
						<?php if (!empty($occdata['SubHeadhunter']['logo'])) : ?>
							<?php echo $this->Html->image($occdata['SubHeadhunter']['logo'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
							<?php endif; ?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="left">Representative position </td>
				<td class="right">
					<?php if (!empty($occdata['SubHeadhunter']['representative_postion'])) : ?>
						<?php echo $occdata['SubHeadhunter']['representative_postion']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Representative name</td>
				<td class="right">
					<?php if (!empty($occdata['SubHeadhunter']['representative_name'])) : ?>
						<?php echo $occdata['SubHeadhunter']['representative_name']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Industry</td>
				<td class="right">
					<?php if (!empty($industry_data)) : ?>
						<?php echo $industry_data['IndustryBig']['label'].' / '.$industry_data['IndustrySmall']['label']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Establishment</td>
				<td class="right">
					<?php if (!empty($occdata['SubHeadhunter']['establishment'])) : ?>
						<?php echo date('d M Y',strtotime($occdata['SubHeadhunter']['establishment']) ) ; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Business overview</td>
				<td class="right">
					<?php if (!empty($occdata['SubHeadhunter']['overview'])) : ?>
						<?php echo $occdata['SubHeadhunter']['overview']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">HP address</td>
				<td class="right">
					<a href="<?php echo $occdata['SubHeadhunter']['hp_address']; ?>" target="_blank" style="color: blue;">
						<?php $newtext = wordwrap($occdata['SubHeadhunter']['hp_address'], 120, "<br/>", true); ?>
						<?php echo "$newtext<br/>"; ?>
					</a>
				</td>
			</tr>
			<tr>
				<td class="left">Capital</td>
				<td class="right">
					<?php if (!empty($occdata['SubHeadhunter']['capital'])) : ?>
						<?php if ($occdata['SubHeadhunter']['capital_type'] == 1) : ?>
							<?php echo "MMK "; ?>
						<?php elseif ($occdata['SubHeadhunter']['capital_type'] == 2) : ?>
							<?php echo "USD "; ?>
						<?php endif ; ?>
							<?php echo $occdata['SubHeadhunter']['capital']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Number of employee</td>
				<td class="right">
					<?php if (!empty($occdata['SubHeadhunter']['number_of_employee'])) : ?>
						<?php echo $no_of_employee[$occdata['SubHeadhunter']['number_of_employee']]; ?>
					<?php endif; ?>
				</td>
			</tr>
		</table>
	<?php endif; ?>

	<div class="x_content">
		<div class="x_content">
			<table class="table-st">
				<tr>
					<td colspan="3" class="labelbg">
						<div class="col-md-10 col-sm-10 col-xs-12">
							<?php echo "<label class='main-label'>Job Information</label>"; ?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<br/>

		<table class="table-st">
			<tr>
				<td class="left">Job ID</td>
				<td class="right"><?php echo $occdata['Occupation']['job_id'] ; ?></td>
			</tr>

			<tr>
				<td class="left">Company/Headhunter ID</td>
				<td class="right">
					<?php echo $user['company_id'] ; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Company/Headhunter Name</td>
				<td class="right">
					<?php if (!empty($user['company_name'])) : ?>
						<?php $co_name = $user['company_name']; ?>
					<?php elseif (!empty($user['headhunter_name'])) : ?>
						<?php $co_name = $user['headhunter_name']; ?>
					<?php endif; ?>
					<?php echo $co_name ; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Image</td>
				<td class="right">
					<div class="col-md-16" style="margin-left: -1%;">
						<?php if (!empty($occdata['Occupation']['image1'])) : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($occdata['Occupation']['image1'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
						<?php endif ; ?>

						<?php if (!empty($occdata['Occupation']['image2'])) : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($occdata['Occupation']['image2'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
						<?php endif ; ?>

						<?php if (!empty($occdata['Occupation']['image3'])) : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($occdata['Occupation']['image3'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
						<?php endif ; ?>
					</div>
				</td>
			</tr>

			<tr>
				<td class="left">Job Title</td>
				<td class="right"><?php echo $occdata['Occupation']['job_title']; ?></td>
			</tr>

			<tr>
				<td class="left">Salary</td>
				<td class="right">
					<?php if ($salary_range) : ?>
						<?php echo $salary_range; ?>
					<?php endif; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Location</td>
				<td class="right">
				<?php if ($occdata['Occupation']['location_big_id']) : ?>
					<?php echo $region_name; ?>
					<?php echo '( '.$occdata['Occupation']['location_big_id'].' )'; ?>
				<?php endif; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Job Category</td>
				<td class="right">
					<?php if (!empty($job)) : ?>
						<?php echo $job['JobCategorie']['label'] .' / '.$job['JobCategorieSub']['label']; ?>
					<?php endif; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Responsibility</td>
				<td class="right">
					<?php if (!empty($occdata)) : ?>
						<p class='test' >
							<?php echo nl2br($occdata['Occupation']['responsibility']); ?>
						</p>
					<?php endif; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Requirements</td>
				<td class="right">
					<?php if (!empty($occdata)) : ?>
						<p class='test' >
							<?php echo nl2br($occdata['Occupation']['requirements']); ?>
						</p>
					<?php endif; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Number of Keeps</td>
				<td class="right">
					<?php if (!empty($like_count)) : ?>
						<?php echo $this->Html->link($like_count, array('controller' => 'mastersavedjobseekers', 'action' => 'index', h($occdata['Occupation']['id'])),array('label'=>false ,'class' => 'large')); ?>
					<?php else : ?>
						<?php echo '0'; ?>
					<?php endif; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Number of Applicants</td>
				<td class="right">
					<?php if (!empty($applied_count)) : ?>
						<?php echo $this->Html->link($applied_count, array('controller' => 'masterappliedjobseekers', 'action' => 'index', h($occdata['Occupation']['id'])),array('label'=>false ,'class' => 'large')); ?>
					<?php else : ?>
						<?php echo '0'; ?>
					<?php endif; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Posted date</td>
				<td class="right">
					<?php echo date("d M Y H:i", strtotime($occdata['Occupation']['created'])); ?>
				</td>
			</tr>

			<tr>
				<td class="left">Latest update</td>
				<td class="right">
					<?php echo date("d M Y H:i", strtotime($occdata['Occupation']['modified'])); ?>
				</td>
			</tr>

		</table>
		<div class="ln_solid"></div>
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
			<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
			<?php echo $this->Html->link('Edit', array('controller' => 'masteroccupations', 'action' => 'edit', h($occdata['Occupation']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
		</div>
	</div>
</div>
<style type="text/css" media="screen">
	table.table-st {
		width:100%;
	}
	table.table-st tr {
		border-bottom: 1px solid #D9DEE4;
	}
	table.table-st tbody tr td.left{
		width:93%;
		padding:10px;
	}
	table.table-st tbody tr td.right{
		width:71%;
		text-align: left;
		padding:10px;
	}
	/* Three logos design */
	.browse-logo {
		margin-left: 3px;
		margin-bottom: 1px;
		width: 150px;
		min-height: 148px;
		border: 3px solid #ccc;
		background-color: #fff;
		position: relative;
		left: 0px;
		background-position: 50% 50%;
	}
	.browse-logo img {
		width: 90%;
		margin: auto;
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
	}
	.labelbg {
		background-color: #DDD;
		font-size: 17px;
		color: #fff;
	}
</style>