<!-- use content_style.ss -->
<!-- menu for login user -->
<?php echo $this->Html->script('tpl/activity.js'); ?>
<div class="container"><br>
	<legend style="text-align:center;margin-top:10px;">Activity Management</legend>
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#menu0">Applied jobs</a></li>
		<li><a data-toggle="tab" href="#menu1">Saved jobs</a></li>
	</ul>

	<div class="tab-content">
		<div id="menu0" class="tab-pane fade in active">
			<br>
				<div>
					<!--    START don't get cancel status= 2 in occupation table -->
					<?php $cancel_status = array();?>
					<?php foreach($occupations as $occKey =>$occValue):?>
						<?php if($occValue['OccupationApply'][0]['cancel_status'] != 2):?>
							<?php $cancel_status[] = $occValue['OccupationApply'][0]['cancel_status'].','; ?>
						<?php endif;?>
					<?php endforeach;?>
					<!--    END don't get cancel status= 2 in occupation table -->

					<div>
						<?php if(empty($cancel_status)) {
							echo "<div style='margin-top:20px'>";
							echo "<h4>My Applications</h4>";
							echo "<div>No application yet.";
							echo $this->Html->link('Find your dream job', array('controller' => 'usertpages', 'action' => 'job_search'));
							echo " and apply now!</div>";
							echo "</div>";
						}
						?>
						<?php if (!empty($cancel_status)) : ?>
							<div class="x_content">
								<div class="table-responsive">
									<table class="table table-hover jambo_table bulk_action"  id="table01" style="border: 1px solid #DCDCDC;">
										<thead>
											<tr class="headings info" >
												<th class="column-title">Job ID</th>
												<th class="column-title">Company Name</th>
												<th class="column-title">Position </th>
												<th class="column-title">Salary</th>
												<th class="column-title">Applied </th>
												<th class="column-title">Status </th>
												<th class="column-title">Latest update </th>
												<th class="column-title no-link last"><span class="nobr">Cancel</span>
												<th class="column-title no-link last hidden-md hidden-lg"><span class="nobr">Blank</span>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($occupations as $occkey => $occ): ?>
												<?php if($occ['OccupationApply'][0]['cancel_status'] != 2) :?>
													<?php if($occ['Occupation']['deleted'] == 0):?>

														<tr>
															<td><?php echo $occ['Occupation']['job_id'];?> </td>
															<td class="jobDetail" id=<?php echo $occ['Occupation']['id'];?> style="cursor:pointer;">
																<?php if(!empty($app_companies[$occ['Occupation']['id']])) :?>
																	<?php if(strlen($app_companies[$occ['Occupation']['id']]) >30): ?>
																		<?php echo mb_substr($app_companies[$occ['Occupation']['id']],0,30,'UTF-8')."..."; ?>
																	<?php else:?>
																		<?php echo $app_companies[$occ['Occupation']['id']]; ?>
																	<?php endif;?>
																<?php endif;?>
															</td>

															<td class="jobDetail" id=<?php echo $occ['Occupation']['id'];?> style="cursor:pointer;">
																<?php if(!empty($occ['Occupation']['job_title'])): ?>
																	<?php if(strlen($occ['Occupation']['job_title']) > 30): ?>
																		<?php echo mb_substr($occ['Occupation']['job_title'],0,30,'UTF-8')."..."; ?>
																	<?php else: ?>
																		<?php echo h($occ['Occupation']['job_title']); ?>
																	<?php endif; ?>
																<?php endif; ?>
															</td>

															<td class="jobDetail" id=<?php echo $occ['Occupation']['id'];?> style="cursor:pointer;">
																<?php if(!empty($occ['Occupation']['salary_range'])): ?>
																	<?php echo $salary[$occ['Occupation']['salary_range']]; ?>
																<?php endif; ?>
															</td>

															<td class="jobDetail" id=<?php echo $occ['Occupation']['id'];?> style="cursor:pointer;">
																<?php if(!empty($occ['OccupationApply'][0]['created'])): ?>
																	<?php echo date('d M Y',strtotime(h($occ['OccupationApply'][0]['created']))) ; ?>
																<?php endif; ?>
															</td>

															<?php if($occ['OccupationApply'][0]['status'] == 1 || $occ['OccupationApply'][0]['status'] == 5):?>

																<td class="a-right a-right hidden-xs hidden-sm">
																	<?php echo ''; ?>
																</td>

															<?php elseif($occ['OccupationApply'][0]['status'] == 2) :?>

																<td class="a-right a-right">
																	<button type="button" class="btn btn-warning show_selection">Selection</button>
																</td>

															<?php elseif($occ['OccupationApply'][0]['status'] == 3) :?>

																<td class="a-right a-right">
																	<button type="button" class="btn btn-success show_passed ">Passed</button>
																</td>

															<?php else:?>

																<td class="a-right a-right" >
																	<button type="button" class="btn btn-default show_failed">Failed</button>
																</td>

															<?php endif; ?>

															<td class="a-right a-right jobDetail" id=<?php echo $occ['Occupation']['id'];?> style="cursor:pointer;">
																<?php if(!empty($occ['OccupationApply'][0]['modified'])): ?>
																	<?php echo date('d M Y',strtotime(h($occ['OccupationApply'][0]['modified']))) ; ?>
																<?php endif; ?>
															</td>

															<td class="a-right a-right">
																<?php echo $this->Html->link('Cancel', array('controller' => 'useroccupations', 'action' => 'appliedJobDelete', h($occ['Occupation']['id'])), array('confirm' => "Would you like to cancel this job?", 'class' =>'del btn-info')); ?>
															</td>
														</tr>
													<?php endif; ?>
												<?php endif; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
		</div>
		<div id = "menu1" class="tab-pane fade"><br>
			<div>
				<?php if(empty($saveOccupaitons)) {
						echo "<div style='margin-top:20px'>";
						echo "<h4>Saved Jobs</h4>";
						echo "<div>Not listed yet.";
						echo $this->Html->link('Find your dream job', array('controller' => 'usertpages', 'action' => 'job_search'));
						echo " and list up now!</div>";
						echo "</div>";
					}
				?>
				<?php if (!empty($saveOccupaitons)) : ?>
					<div class="x_content">
						<div class="table-responsive">
							<table class="table table-hover jambo_table bulk_action"   id="table02" style="border: 1px solid #DCDCDC;">
								<thead>
									<tr class="headings info">
										<th class="column-title">Job ID</th>
										<th class="column-title">Company Name</th>
										<th class="column-title">Position </th>
										<th class="column-title">Salary</th>
										<th class="column-title">Situation </th>
										<th class="column-title no-link last"><span class="nobr">Delete</span>
										</th>
									</tr>
								</thead>

								<tbody>

								<?php foreach ($saveOccupaitons as $cmpkey => $cmpvalue): ?>
									<?php if( $cmpvalue['Occupation']['deleted'] == 0):?>

										<tr>
											<td><?php echo $cmpvalue['Occupation']['job_id'];?></td>
											<td class="jobDetail" id=<?php echo $cmpvalue['Occupation']['id'];?> style="cursor:pointer;">
												<?php if(!empty($companies[$cmpvalue['Occupation']['id']])): ?>
													<?php if(strlen($companies[$cmpvalue['Occupation']['id']]) > 37): ?>
														<?php echo mb_substr($companies[$cmpvalue['Occupation']['id']],0,37,'UTF-8')."..."; ?>
													<?php else: ?>
														<?php echo h($companies[$cmpvalue['Occupation']['id']]); ?>
													<?php endif; ?>
												<?php endif; ?>
											</td>

											<td class="jobDetail" id=<?php echo $cmpvalue['Occupation']['id'];?> style="cursor:pointer;">
												<?php if(!empty($cmpvalue['Occupation']['job_title'])): ?>
													<?php if(strlen($cmpvalue['Occupation']['job_title']) > 33): ?>
														<?php echo mb_substr($cmpvalue['Occupation']['job_title'],0,33,'UTF-8')."..."; ?>
													<?php else: ?>
														<?php echo h($cmpvalue['Occupation']['job_title']); ?>
													<?php endif; ?>
												<?php endif; ?>
											</td>

											<td class="jobDetail" id=<?php echo $cmpvalue['Occupation']['id'];?> style="cursor:pointer;">
												<?php if(!empty($cmpvalue['Occupation']['salary_range'])): ?>
													<?php echo $salary[$cmpvalue['Occupation']['salary_range']]; ?>
												<?php endif; ?>
											</td>

											<td class="a-right a-right">
												<?php if($cmpvalue['Occupation']['deactivate'] == 1 || $cmpvalue['Occupation']['deleted'] == 1) :?>
													<button type="button" class="btn btn-default show_closed open_close">Closed</button>
												<?php else :?>
													<button type="button" class="btn btn-warning show_selection open_close">Open</button>
												<?php endif;?>
											</td>

											<td class="a-right a-right">
												<?php echo $this->Html->link('Delete', array('controller' => 'useroccupations', 'action' => 'savedJobDelete', h($cmpvalue['Occupation']['id'])), array('confirm' => "Would you like to delete this job?", 'class' =>'cancel_button btn-info')); ?>
											</td>

										</tr>
									<?php endif; ?>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	//detail from occupations index in ActivityManagement
	$(document).ready(function() {
		$(".jobDetail").click(function() {
			var jobId = $(this).attr("id");
			var url = "<?php echo Router::url(array('controller' => 'useroccupations', 'action' => 'detail')); ?>";
			window.location = url+'/'+jobId;
		});
	});
</script>