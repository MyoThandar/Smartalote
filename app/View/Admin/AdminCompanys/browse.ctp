<div class="x_panel">
	<div class="x_title">
		<h2>Company Browse</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table class="table-st">
			<tbody>
				<tr>
					<td class="left">Company ID</td>
					<td class="right">
						<?php echo $cmpdata['CmpHeadhunter']['company_id']; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Company Name</td>
					<td class="right"><?php echo $cmpdata['CmpHeadhunter']['company_name'] ; ?></td>
				</tr>

				<tr>
					<td class="left"> Phone Number </td>
					<td class="right">
						<?php if (!empty($cmpdata['CmpHeadhunter']['company_phone'])) : ?>
							Main : <?php echo $cmpdata['CmpHeadhunter']['company_phone'] ; ?>
							<br/>
						<?php endif; ?>

						<?php if (!empty($cmpdata['CmpHeadhunter']['mobile'])) : ?>
							Sub : <?php echo $cmpdata['CmpHeadhunter']['mobile']; ?>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Address</td>
					<td class="right"> <?php echo $cmpdata['CmpHeadhunter']['location']; ?><br/><?php echo $regionname; ?></td>
				</tr>

				<tr>
					<td class="left">Photo</td>
					<td class="right">
						<?php if (!empty($cmpdata['CmpHeadhunter']['logo'])) : ?>
							<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
								<?php echo $this->Html->image($cmpdata['CmpHeadhunter']['logo'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
							</div>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td class="left">Representative</td>
					<td class="right"> Position : <?php echo $cmpdata['CmpHeadhunter']['representative_postion'] ; ?><br/>Name : <?php echo $cmpdata['CmpHeadhunter']['representative_name']; ?></td>
				</tr>
				<tr>
					<td class="left">Contact</td>
					<td class="right"> Position : <?php echo $cmpdata['CmpHeadhunter']['contact_position'] ; ?><br/>Name : <?php echo $cmpdata['CmpHeadhunter']['contact_name']; ?>
					<br/> Email :
					<?php echo $cmpdata['CmpHeadhunter']['email'] ; ?></td>
				</tr>
				<tr>
					<td class="left">HP Address</td>
					<td class="right">
						<a href="<?php echo $cmpdata['CmpHeadhunter']['hp_address']; ?>" target="_blank" style="color: blue;">
							<?php $newtext = wordwrap($cmpdata['CmpHeadhunter']['hp_address'], 120, "<br/>", true); ?>
							<?php echo "$newtext<br/>"; ?>
						</a>
					</td>
				</tr>

				<tr>
					<td class="left">Capital</td>
					<td class="right">
					<?php if (!empty($cmpdata['CmpHeadhunter']['capital'])) : ?>
						<?php if ($cmpdata['CmpHeadhunter']['capital_type'] == 1) : ?>
							<?php echo "MMK "; ?>
						<?php elseif ($cmpdata['CmpHeadhunter']['capital_type'] == 2) : ?>
							<?php echo "USD "; ?>
						<?php endif ; ?>
							<?php echo $cmpdata['CmpHeadhunter']['capital']; ?>
					<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Number of Employee</td>
					<td class="right">
						<?php if (!empty($emp_number)) : ?>
							<?php echo $emp_number ; ?>
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
					<?php if (!empty($cmpdata['CmpHeadhunter']['establishment'])) : ?>
						<?php echo date('d M Y',strtotime($cmpdata['CmpHeadhunter']['establishment']) ) ; ?>
					<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Business Overview</td>
					<td class="right">
					<p class="test"><?php echo nl2br($cmpdata['CmpHeadhunter']['overview']) ; ?></p>
					</td>
				</tr>

				<tr>
					<td class="left">Status</td>
					<td class="right">
					<?php if ($cmpdata['CmpHeadhunter']['deactivate'] == 1) : ?>
						<?php echo "Deactivated"; ?>
					<?php else :?>
						<?php echo "Active"; ?>
					<?php endif ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">The limitation of the number of mail transmissions </td>
					<td class="right">
						<?php if (!empty($cmpdata['CmpHeadhunter']['mail_limit'])) : ?>
							<?php echo $cmpdata['CmpHeadhunter']['total_mail'] ; ?>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td class="left">The number of sent email </td>
					<td class="right">
						<?php echo $cmpdata['CmpHeadhunter']['sent_mail'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">The number of available email </td>
					<td class="right">
					<?php if (!empty($cmpdata['CmpHeadhunter']['mail_limit'])) : ?>
						<?php echo $cmpdata['CmpHeadhunter']['avaliable_mail'] ; ?>
					<?php endif; ?>
					</td>
				</tr>

			</tbody>
		</table>
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
				<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link('Edit', array('controller' => 'admincompanys', 'action' => 'edit', h($cmpdata['CmpHeadhunter']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
			</div>
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

	/* Top employer logo design */
	/*.top-employee {
		width: 150px;
		height: 150px;
		border:1px solid lightgray;
		position: relative;
	}*/
	/*.top-employee img {
		max-width: 100%;
		max-height:100%;
		margin: auto;
		position: absolute;
		top: 0; left: 0; bottom: 0; right: 0;
	}*/
</style>