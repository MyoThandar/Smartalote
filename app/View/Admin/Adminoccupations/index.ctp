<?php echo $this->Session->flash(); ?>
<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Job List</h2>
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
								'label' =>  'Show&nbsp;',
								'default' => intval($limit),
								'options' => array_combine(array('50', '100','150'), array('50', '100','150')),
								'class' => 'btn btn-default',
							));
						?>
					</div>

					<div class="col-md-10">
						<div class="col-md-3">
							<?php
								echo $this->Form->input('company', array(
									'label' => false,
									'type' => 'select' ,
									'default' => !empty($this->params->query['company']) ? trim($this->params->query['company']) : '',
									'options' => $cotmp = (!empty($coname) ? $coname : array())  ,
									'onChange' => 'this.form.submit();',
									'empty' => 'please select the company ',
									'class' => 'form-control col-md-7 col-xs-12'
									));
							?>
						</div>

						<div class="col-md-3">
								<?php
									echo $this->Form->input('headhunter', array(
										'label' => false,
										'type' => 'select' ,
										'default' => !empty($this->params->query['headhunter']) ? trim($this->params->query['headhunter']) : '',
										'options' => $hhtmp = (!empty($huntername) ? $huntername : array()) ,
										'onChange' => 'this.form.submit();',
										'empty' => 'please select the headhunter',
										'class' => 'form-control col-md-7 col-xs-12'
										));
									echo $this->Form->end();
								?>
						</div>

						<div class="search-box">
							<?php echo $this->Form->create('Industry', array('type' => 'get', 'url' => array('controller' => 'adminoccupations', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
								<div class="input-group" style="margin-right: -11px;">
									<?php if (!empty($this->params->query['keyword'])) : ?>
									<?php echo $this->Form->input('keyword', array('label' => false,'id' => 'search' , 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
									<?php else : ?>
									<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'search' ,'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'required' => false)); ?>
									<?php endif; ?>
									<span class="input-group-btn">
										<?php echo $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i>', array('class' => 'btn btn-default')) ?>
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
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.company_name', 'Company/Headhunter name'); ?></th>
								<th><?php echo $this->Paginator->sort('Occupation.number_of_keep', 'Number of keeps'); ?></th>
								<th><?php echo $this->Paginator->sort('Occupation.number_of_applicant', 'Number of applicants'); ?></th>
								<th><?php echo $this->Paginator->sort('Occupation.modified', 'Updated date'); ?></th>
								<th colspan="3">Operations</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pag as  $jobkey => $jobvalue): ?>
								<tr class="<?php if($jobvalue['Occupation']['deactivate'] == true) echo 'even'; ?>">
									<td>
										<?php if(!empty($jobvalue['Occupation']['job_id'])): ?>
											<?php echo h($jobvalue['Occupation']['cmp_headhunter_id']).'-'.h($jobvalue['Occupation']['job_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(strlen($jobvalue['Occupation']['job_title']) > 18) :?>
											<?php echo mb_substr($jobvalue['Occupation']['job_title'],0,18,'UTF-8')."..."; ?>
										<?php else: ?>
											<?php echo $jobvalue['Occupation']['job_title']; ?>
										<?php endif ; ?>
									</td>

									<td>
										<?php if(!empty($cmp_name_id[$jobvalue['Occupation']['cmp_headhunter_id']])): ?>
											<?php if(strlen($cmp_name_id[$jobvalue['Occupation']['cmp_headhunter_id']]) > 18): ?>
												<?php echo mb_substr($cmp_name_id[$jobvalue['Occupation']['cmp_headhunter_id']],0,18,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo $cmp_name_id[$jobvalue['Occupation']['cmp_headhunter_id']]; ?>
											<?php endif ; ?>
										<?php endif ; ?>
									</td>

									<td>
										<?php if (!empty($jobvalue['Occupation']['number_of_keep'])) : ?>
											<?php echo h($jobvalue['Occupation']['number_of_keep']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if (!empty($jobvalue['Occupation']['number_of_applicant'])) : ?>
											<?php echo h($jobvalue['Occupation']['number_of_applicant']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if (!empty($jobvalue['Occupation']['modified'])) : ?>
										<?php echo date("d M Y", strtotime($jobvalue['Occupation']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php echo $this->Html->link('Browse', array('controller' => 'adminoccupations', 'action' => 'browse',h($jobvalue['Occupation']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php if ($jobvalue['Occupation']['deactivate'] == false): ?>
											<?php echo $this->Html->link('Deactivate', array('controller' => 'adminoccupations', 'action' => 'approved', h($jobvalue['Occupation']['id'])), array('onclick' => 'return confirm("Would you like to stop?")', 'class' => 'btn btn-gray btn-sm','style' => 'width:75px;')); ?>
										<?php elseif ($jobvalue['Occupation']['deactivate'] == true): ?>
											<?php echo $this->Html->link('Activate', array('controller' => 'adminoccupations', 'action' => 'approved', h($jobvalue['Occupation']['id'])), array('onclick' => 'return confirm("Would you like to start?")', 'class' => 'btn btn-white btn-sm','style' => 'width:75px;')); ?>
										<?php endif; ?>

										<?php echo $this->Html->link('Delete', array('controller' => 'adminoccupations', 'action' => 'delete', h($jobvalue['Occupation']['id'])), array('confirm' => "Would you like to delete this job ?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
									</td>
								</tr>
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
					<?php else:?>
						<?php echo "EMPTY"; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>