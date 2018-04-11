<div class="x_panel">
	<div class="x_title">
		<h2> Headhunter Browse </h2>
		<div class="clearfix"> </div>
	</div>
	<div class="x_content">
		<table class="table-st">
			<tr>
				<td class="left">Headhunter ID</td>
				<td class="right">
					<?php echo $cmpdata['CmpHeadhunter']['company_id']; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Headhunter Name</td>
				<td class="right"><?php echo $cmpdata['CmpHeadhunter']['headhunter_name'] ; ?></td>
			</tr>

			<tr>
				<td class="left"> Phone Number </td>
				<td class="right"> Main : <?php echo $cmpdata['CmpHeadhunter']['company_phone'] ; ?><br/>Sub : <?php echo $cmpdata['CmpHeadhunter']['mobile']; ?></td>
			</tr>

			<tr>
				<td class="left">Email address</td>
				<td class="right"><?php echo $cmpdata['CmpHeadhunter']['email']; ?></td>
			</tr>

			<tr>
				<td class="left">Company Name</td>
				<td class="right">
					<?php if($cmpdata['CmpHeadhunter']['independents'] == 1) : ?>
						<?php echo 'Independent' ; ?>
					<?php else : ?>
						<?php echo $cmpdata['CmpHeadhunter']['company_name']; ?>
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
				<td class="left">Education</td>
				<td class="right"><?php echo $edu ; ?></td>
			</tr>

			<tr>
				<td class="left">Industry</td>
				<td class="right">
					<?php if (!empty($big)) : ?>
						<?php foreach ($big as $bigkey => $bigvalue) : ?>
							<?php if (!empty($bigvalue)) : ?>
								<?php echo $array1[$bigvalue]; ?>
							<?php endif; ?>
							<br/>
						<?php endforeach; ?>
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
				<td class="left">Language Skill</td>
				<td class="right">
				<?php if (!empty($bskill)) : echo 'Burmese : ' . $bskill .'<br/>'; endif ; ?>
				<?php if (!empty($eskill)) : echo 'English : ' . $eskill .'<br/>' ; endif ; ?>
				<?php if (!empty($cskill)) : echo 'Chinese : ' . $cskill .'<br/>' ; endif ; ?>
				<?php if (!empty($jskill)) : echo 'Japanese : ' . $jskill .'<br/>' ; endif ; ?>
				<?php foreach ($cmpdata['HeadhunterOtherLanguage'] as $hhkey => $hhvalue) : ?>
					<?php if (!empty($hhvalue['lang_type'])) : ?>
						<?php echo $language[$hhvalue['lang_type']].' : '; ?>
						<?php if ($hhvalue['lang_skill'] != 0 || $hhvalue['lang_skill'] != null ) : ?>
							<?php echo $language_skill[$hhvalue['lang_skill']]; ?>
						<?php endif; ?>
					<?php endif; ?>
					<br/>
				<?php endforeach; ?>
				</td>
			</tr>

			<tr>
				<td class="left">Shout</td>
				<td class="right">
				<p class="test"><?php echo nl2br($cmpdata['CmpHeadhunter']['about']); ?></p></td>
			</tr>

			<tr>
				<td class="left">Profile</td>
				<td class="right">
				<p class="test"><?php echo nl2br($cmpdata['CmpHeadhunter']['profile']); ?></p></td>
			</tr>

			<tr>
				<td class="left">Self PR</td>
				<td class="right">
					<p class="test">
					<?php if (!empty($cmpdata['CmpHeadhunter']['self_pr'])) : ?>
						<?php echo nl2br($cmpdata['CmpHeadhunter']['self_pr']); ?>
					<?php endif; ?>
					</p>
				</td>
			</tr>

			<tr>
				<td class="left">Status</td>
				<td class="right">
				<?php if ($cmpdata['CmpHeadhunter']['deactivate'] == 1) : ?>
					<?php echo "Deactivated"; ?>
				<?php else : ?>
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

		</table>
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
				<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link('Edit', array('controller' => 'adminheadhunters', 'action' => 'edit', h($cmpdata['CmpHeadhunter']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
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
</style>