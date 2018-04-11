<div class="x_panel">
	<div class="x_title">
		<h2>Job Browse</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table class="table-st">
			<tr>
				<td class="left">Job ID</td>
				<td class="right"><?php echo $occdata['Occupation']['job_id'] ; ?></td>
			</tr>

			<tr>
				<td class="left">Company /Headhunter Name</td>
				<td class="right"><?php echo $cmp_name ; ?></td>
			</tr>

			<tr>
				<td class="left">Image</td>
				<td class="right" >
					<div class="col-md-12">
						<?php if (!empty($occdata['Occupation']['image1'])) : ?>
							<div class = "col-md-3 resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
								<?php echo $this->Html->image($occdata['Occupation']['image1'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
							</div>
							<div class="col-md-1" style="width: 10px;"></div>
						<?php endif ; ?>

						<?php if (!empty($occdata['Occupation']['image2'])) : ?>
							<div class = "col-md-3 resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
								<?php echo $this->Html->image($occdata['Occupation']['image2'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
							</div>
							<div class="col-md-1" style="width: 10px;"></div>
						<?php endif ; ?>

						<?php if (!empty($occdata['Occupation']['image3'])) : ?>
							<div class = "col-md-3 resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
								<?php echo $this->Html->image($occdata['Occupation']['image3'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
							</div>
							<div class="col-md-1" style="width: 10px;"></div>
						<?php endif ; ?>
					</div>
				</td>
			</tr>

			<tr>
				<td class="left">Job Title</td>
				<td  class="right"><?php echo $occdata['Occupation']['job_title']; ?></td>
			</tr>

			<tr>
				<td class="left">Salary</td>
				<td class="right">
					<?php echo $salary_range; ?>
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
					<?php  echo $job['JobCategorie']['label'] .' / '; ?><?php echo $job['JobCategorieSub']['label'] ; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Responsibility</td>
				<td class="right">
					<p class='test' ><?php echo nl2br($occdata['Occupation']['responsibility']); ?></p>
				</td>
			</tr>

			<tr>
				<td class="left">Requirements</td>
				<td class="right">
					<p class='test' ><?php echo nl2br($occdata['Occupation']['requirements']); ?></p>
				</td>
			</tr>

			<tr>
				<td class="left">Number of Keeps</td>
				<td class="right">
					<?php echo $like_count; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Number of Applicants</td>
				<td class="right"><?php echo $applied_count; ?></td>
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
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
				<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
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
</style>