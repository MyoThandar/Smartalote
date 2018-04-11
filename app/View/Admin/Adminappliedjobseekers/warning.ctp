<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Warning Jobseeker List</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class = "adjust">
					<div class="col-md-2">
						<?php
							echo $this->Form->create(array('type'=>'get'));
							echo $this->Form->input('name', array(
								'empty' => FALSE,
								'onChange' => 'this.form.submit();',
								'name' => 'limit',
								'label' => 'Show&nbsp;',
								'default' => intval($limit),
								'options' => array_combine(array('50', '100','150'), array('50', '100','150')),
								'class' => 'btn btn-default'
							));
						?>
					</div>
					<div class="col-md-10">
						<div class="search-box sbox">
							<?php echo $this->Form->create('CmpHeadhunter', array('type' => 'get', 'url' => array('controller' => 'adminappliedjobseekers', 'action' => 'warning'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
								<div class="input-group">
									<?php if (!empty($this->params->query['keyword'])) : ?>
										<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'warning_search','class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
									<?php else : ?>
										<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'warning_search', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'required' => false)); ?>
									<?php endif; ?>

									<span class="input-group-btn">
										<?php echo $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i>', array('class' => 'btn btn-default')); ?>
									</span>
								</div>
							<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
				<?php if (!empty($pag)) : ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('Occupation.job_id', 'Job ID'); ?></th>
								<th><?php echo $this->Paginator->sort('Occupation.job_title', 'Job Title'); ?></th>
								<th><?php echo $this->Paginator->sort('User.name', 'Jobseeker Name'); ?></th>
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.company_name', 'Company/Headhunter Name'); ?></th>
								<th>Operations</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pag as $cmpkey => $cmpvalue) : ?>
								<?php
									if ($cmpvalue['OccupationApply']['status'] == 3) { // Passed
										$confirm_date = date_create($cmpvalue['OccupationApply']['adopted_date']);
									} elseif ($cmpvalue['OccupationApply']['status'] == 2) { // Selection
										$confirm_date = date_create($cmpvalue['OccupationApply']['contact_date']);
									}
									$today = date_create(date('Y-m-d'));
									$diff = date_diff($confirm_date,$today);
									$different_date = $diff->format("%R%a");
								?>
								<?php if ($different_date >= 14) : ?>
									<tr>
										<td>
											<?php if(!empty($cmpvalue['Occupation']['job_id'])): ?>
												<?php echo h($cmpvalue['Occupation']['job_id']); ?>
											<?php endif; ?>
										</td>

										<td>
											<?php if(!empty($cmpvalue['Occupation']['job_title'])): ?>
												<?php if(strlen($cmpvalue['Occupation']['job_title']) > 24): ?>
													<?php echo mb_substr($cmpvalue['Occupation']['job_title'],0,24,'UTF-8')."..."; ?>
												<?php else: ?>
													<?php echo h($cmpvalue['Occupation']['job_title']); ?>
												<?php endif; ?>
											<?php endif; ?>
										</td>

										<td>
											<?php if(!empty($cmpvalue['User']['name'])): ?>
												<?php if(strlen($cmpvalue['User']['name']) > 20): ?>
													<?php echo mb_substr($cmpvalue['User']['name'],0,20,'UTF-8')."..."; ?>
												<?php else: ?>
													<?php echo h($cmpvalue['User']['name']); ?>
												<?php endif; ?>
											<?php endif; ?>
										</td>

										<td>
											<?php if(!empty($company[$cmpvalue['OccupationApply']['cmp_headhunter_id']])): ?>
												<?php if(strlen($company[$cmpvalue['OccupationApply']['cmp_headhunter_id']]) > 24): ?>
													<?php echo mb_substr($company[$cmpvalue['OccupationApply']['cmp_headhunter_id']],0,24,'UTF-8')."..."; ?>
												<?php else: ?>
													<?php echo h($company[$cmpvalue['OccupationApply']['cmp_headhunter_id']]); ?>
												<?php endif; ?>
											<?php endif; ?>
										</td>

										<td>
											<?php echo $this->Html->link('Contact', array('controller' => 'adminappliedjobseekers', 'action' => 'contact', h($cmpvalue['Occupation']['id'])), array('confirm' => "Are you sure to contact this jobseeker ?", 'class' =>'btn btn-orange btn-sm')); ?>
										</td>
									</tr>
								<?php endif; ?>
							<?php endforeach; ?>
						</tbody>
					</table>

					<p class="pull-left"><?php echo $this->Paginator->counter(array('format' => __('Display {:start}~{:end} of {:count} Items'))); ?></p>

					<div class="pull-right">
						<?php
							echo $this->Paginator->first(__('first'), array('class' => 'pagi gradient disabled'));
							if ($limit > 50) {
								echo $this->Paginator->prev(__('prev'), array(), null, array('class' => 'prev disabled', 'id' => 'example_first', 'tag' => false));
							}
							echo $this->Paginator->numbers(array(
								'separator' => false,
								'currentTag' => 'a',
								'class' => 'pagi gradient',
								'currentClass' => 'pagi active',
								'modulus' => 4,
								'ellipsis' => '. . .',
								'last' => 1,
								'first' => 1,
							));
							if ($limit > 50) {
								echo $this->Paginator->next(__('next'), array(), null, array('class' => 'next disabled', 'id' => 'example_next'));
							}
							echo $this->Paginator->last(__('last'), array('class' => 'pagi gradient disabled'));
						?>
					</div>
				<?php else: ?>
					<?php echo "EMPTY"; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#warning_search").keyup(function(){
		var str = $('#warning_search').val() ;
		if (str.length == '') {
			location.replace('warning');
		};
	});
</script>