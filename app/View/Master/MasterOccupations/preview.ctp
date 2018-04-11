<div class="x_panel">
	<div class="x_title">
		<h2>Job Preview</h2>
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
				<td class="right"><?php echo $subheadhunterInfo['SubHeadhunter']['company_name']; ?></td>
			</tr>
			<tr>
				<td class="left">Address</td>
				<td class="right">
					<?php echo $subheadhunterInfo['SubHeadhunter']['location']; ?><br/><?php echo $region[$subheadhunterInfo['SubHeadhunter']['region']]; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Company Logo</td>
				<td class="right">
					<div style="width: 150px;height: 150px;border:1px solid lightgray;position: relative;">
					<?php
						echo $this->Html->image(
							$subheadhunterInfo['SubHeadhunter']['logo'],
							array(
								'style' =>'max-width: 100%;max-height:100%;margin: auto;position: absolute;top: 0; left: 0; bottom: 0; right: 0;'
							)
						);
					?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="left">Representative position </td>
				<td class="right">
					<?php if (!empty($subheadhunterInfo['SubHeadhunter']['representative_postion'])) : ?>
						<?php echo $subheadhunterInfo['SubHeadhunter']['representative_postion']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Representative name</td>
				<td class="right">
					<?php if (!empty($subheadhunterInfo['SubHeadhunter']['representative_name'])) : ?>
						<?php echo $subheadhunterInfo['SubHeadhunter']['representative_name']; ?>
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
					<?php if (!empty($subheadhunterInfo['SubHeadhunter']['establishment'])) : ?>
						<?php echo date('d M Y',strtotime($subheadhunterInfo['SubHeadhunter']['establishment']) ) ; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Business overview</td>
				<td class="right">
					<?php if (!empty($subheadhunterInfo['SubHeadhunter']['overview'])) : ?>
						<?php echo $subheadhunterInfo['SubHeadhunter']['overview']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">HP address</td>
				<td class="right">
					<a href="<?php echo $subheadhunterInfo['SubHeadhunter']['hp_address']; ?>" target="_blank" style="color: blue;">
						<?php $newtext = wordwrap($subheadhunterInfo['SubHeadhunter']['hp_address'], 120, "<br/>", true); ?>
						<?php echo "$newtext<br/>"; ?>
					</a>
				</td>
			</tr>
			<tr>
				<td class="left">Capital</td>
				<td class="right">
					<?php if (!empty($subheadhunterInfo['SubHeadhunter']['capital'])) : ?>
						<?php if ($subheadhunterInfo['SubHeadhunter']['capital_type'] == 1) : ?>
							<?php echo "MMK "; ?>
						<?php elseif ($subheadhunterInfo['SubHeadhunter']['capital_type'] == 2) : ?>
							<?php echo "USD "; ?>
						<?php endif ; ?>
							<?php echo $subheadhunterInfo['SubHeadhunter']['capital']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="left">Number of employee</td>
				<td class="right">
					<?php if (!empty($subheadhunterInfo['SubHeadhunter']['number_of_employee'])) : ?>
						<?php echo $no_of_employee[$subheadhunterInfo['SubHeadhunter']['number_of_employee']]; ?>
					<?php endif; ?>
				</td>
			</tr>
		</table>
	<?php endif; ?>

	<!-- Job informations -->

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

	<table class="table-st">
		<tr>
			<td class="left">Job ID</td>
			<td class="right"><?php echo $datas['Occupation']['job_id'] ; ?></td>
		</tr>
		<tr>
			<td class="left">Company/Headhunter Id & Name</td>
			<td class="right">
				<?php $co_id = $user['company_id']; ?>
				<?php if (!empty($user['company_name'])) : ?>
					<?php $co_name = $co_id.' '.$user['company_name']; ?>
				<?php elseif (!empty($user['headhunter_name'])) : ?>
					<?php $co_name = $co_id.' '.$user['headhunter_name']; ?>
				<?php endif; ?>
				<?php echo $co_name ; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Image</td>
			<td class="right">
				<div class="col-md-16" style="margin-left: -1%;">
					<!-- if user changes new image1 over the old one, the new image1 will be shown instead of old image1.  -->
					<?php if (empty($datas['Occupation']['removed1'])) : ?>
						<?php if ($datas['Occupation']['image1']['name'] != '') : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($datas['Occupation']['image1']['name'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
					<!-- if user doesn't change new image1 over the old one, the old image1 will be shown instead of new image1.  -->
						<?php elseif ($datas['Occupation']['image_origin1'] != '') : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($datas['Occupation']['image_origin1'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
						<?php endif ; ?>

					<?php elseif (!empty($datas['Occupation']['removed1'] && $datas['Occupation']['image1']['name'] != '' )) :?>
						<div class="col-md-3" style="margin-right: 7%;">
							<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($datas['Occupation']['image1']['name'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
							</div>
						</div>
						<div class="col-md-1" style="width: 10px;"></div>
					<?php endif ; ?>

					<!-- if user changes new image2 over the old one, the new image2 will be shown instead of old image2.  -->
					<?php if (empty($datas['Occupation']['removed2'])) : ?>

						<?php if ($datas['Occupation']['image2']['name'] != '') : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
										<?php echo $this->Html->image($datas['Occupation']['image2']['name'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
					<!-- if user doesn't change new image2 over the old one, the old image2 will be shown instead of new image2.  -->
						<?php elseif ($datas['Occupation']['image_origin2'] != '') : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
										<?php echo $this->Html->image($datas['Occupation']['image_origin2'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
						<?php endif ; ?>

					<?php elseif (!empty($datas['Occupation']['removed2'] && $datas['Occupation']['image2']['name'] != '' )) : ?>
						<div class="col-md-3" style="margin-right: 7%;">
							<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($datas['Occupation']['image2']['name'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
							</div>
						</div>
						<div class="col-md-1" style="width: 10px;"></div>
					<?php endif ; ?>

					<!-- if user changes new image3 over the old one, the new image3 will be shown instead of old image3.  -->
					<?php if (empty($datas['Occupation']['removed3'])) : ?>
						<?php if ($datas['Occupation']['image3']['name'] != '') : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
										<?php echo $this->Html->image($datas['Occupation']['image3']['name'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
					<!-- if user doesn't change new image3 over the old one, the old image3 will be shown instead of new image3.  -->
						<?php elseif ($datas['Occupation']['image_origin3'] != '') : ?>
							<div class="col-md-3" style="margin-right: 7%;">
								<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
										<?php echo $this->Html->image($datas['Occupation']['image_origin3'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
								</div>
							</div>
						<?php endif ; ?>
					<?php elseif (!empty($datas['Occupation']['removed3'] && $datas['Occupation']['image3']['name'] != '' )) : ?>
						<div class="col-md-3" style="margin-right: 7%;">
							<div class = "resize-img" style="width: 200px; height: 200px; border: medium solid lightgray; overflow: hidden; position: relative;">
									<?php echo $this->Html->image($datas['Occupation']['image3']['name'], array('alt' => 'story image', 'id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
							</div>
						</div>
						<div class="col-md-1" style="width: 10px;"></div>
					<?php endif ; ?>
				</div>

			</td>
		</tr>

		<tr>
			<td class="left">Job Title</td>
			<td class="right">
				<?php if (!empty($datas['Occupation']['job_title'])) : ?>
					<?php echo $datas['Occupation']['job_title'] ; ?>
				<?php endif ; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Salary</td>
			<td class="right">
				<?php if (!empty($datas['Occupation']['salary_range'])) : ?>
					<?php echo $salary_range[$datas['Occupation']['salary_range']]; ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Location</td>
			<td class="right">
			<?php if ($datas['Occupation']['location_big_id']) : ?>
				<?php echo $region[$datas['Occupation']['location_small_id']]; ?>
				<?php echo '( '.$datas['Occupation']['location_big_id'].' )'; ?>
			<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Job Category</td>
			<td class="right" id="padding_indu_cate">
				<div class="col-md-3 col-sm-3 col-xs-10">
					<?php foreach ($job_category_name as $key => $value) :?>
						<?php echo $value; ?>
					<?php endforeach; ?>
					<?php foreach ($job_category_sub_name as $key => $value) :?>
						<?php echo ' / '.$value; ?>
					<?php endforeach; ?>
				</div>
			</td>
		</tr>

		<tr>
			<td class="left">Responsibilty</td>
			<td class="right">
				<?php if(!empty($datas['Occupation']['responsibility'])):?>
					<?php echo nl2br($datas['Occupation']['responsibility']) ; ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Requirements</td>
			<td class="right">
				<?php if(!empty($datas['Occupation']['requirements'])):?>
					<?php echo nl2br($datas['Occupation']['requirements'])  ; ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Number of keeps</td>
			<td class="right">
				<?php if (!empty($fav)) : ?>
					<?php echo $this->Html->link(sizeof($fav), array('controller' => 'masteroccupations', 'action' => 'keeper', h($datas['Occupation']['id'])),array('label'=>false ,'class' => 'large')); ?>
				<?php else : ?>
					<?php echo '0'; ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Number of applicants</td>
			<td class="right">
				<?php if(!empty($app)):?>
					<?php echo $this->Html->link(sizeof($app), array('controller' => 'masteroccupations', 'action' => 'applicant', h($datas['Occupation']['id'])),array('label'=>false ,'class' => 'large')); ?>
				<?php else: ?>
					<?php echo '0'; ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Posted date</td>
			<td class="right">
				<?php if(!empty($datas['Occupation']['created'])):?>
					<?php echo date("d M Y H:i", strtotime($datas['Occupation']['created'])); ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Latest update</td>
			<td class="right">
				<?php if(!empty($datas['Occupation']['modified'])):?>
					<?php echo date("d M Y H:i", strtotime($datas['Occupation']['modified'])); ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td class="left">Deactivated date</td>
			<td class="right">
				<?php if(!empty($datas['Occupation']['deactivate_date'])):?>
					<?php echo date('d M Y H:i',strtotime($datas['Occupation']['deactivate_date'])); ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td></td>
			<td colspan="2" class="history_back">
				<!-- changes back button from the javascript button to form submit button -->
				<?php echo $this->Form->create(); ?>
					<?php echo $this->Form->button('Back', array('type' => 'submit', 'class' => 'btn btn-default btn-sm', 'name' => 'back_to_edit')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm', 'name' => 'save')); ?>
				<?php echo $this->Form->end(); ?>
			</td>
		</tr>
	</table>
</div>

<style type="text/css">
	.large {
		color: blue !important;
		text-decoration: underline !important;
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