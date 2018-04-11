<?php echo $this->Session->flash();?>
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
								'label' => array('text'=> 'Show&nbsp;','class' =>'myclass'),
								'default' => intval($limit),
								'options' => array_combine(array('50', '100','150'), array('50', '100','150')),
								'class' => 'btn btn-default',
							));
						?>
					</div>

					<div class="col-md-10">
						<div style="width: 31%; margin-right: -23px; float: right;">
							<?php echo $this->Form->create('Occupation', array('type' => 'get', 'url' => array('controller' => 'masteroccupations', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
								<div class="input-group">
									<?php if (!empty($this->params->query['keyword'])) : ?>
										<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'search' ,'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
									<?php else : ?>
										<?php echo $this->Form->input('keyword', array('label' => false,'id' => 'search' , 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'required' => false)); ?>
									<?php endif; ?>

									<span class="input-group-btn">
										<?php echo $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i>', array('class' => 'btn btn-default')); ?>
									</span>
								</div>
							<?php echo $this->Form->end();?>
						</div>
						<?php echo $this->Html->link('Register', array('controller' => 'masteroccupations', 'action' => 'add'),array('class' =>'btn btn-orange pull-right' ));
						?>
					</div>
				</div>

				<?php if (!empty($pag)) : ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('Occupation.job_id', 'Job ID'); ?></th>
								<th style="width: 250px;"><?php echo $this->Paginator->sort('Occupation.job_title', 'Job Title'); ?></th>
								<th><?php echo $this->Paginator->sort('Occupation.number_of_keep', 'Number of Keep'); ?></th>
								<th><?php echo $this->Paginator->sort('Occupation.number_of_applicant', 'Number of Applicant'); ?></th>
								<th><?php echo $this->Paginator->sort('Occupation.modified', 'Updated date'); ?></th>
								<th>Operations</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pag as $ocukey => $ocuvalue): ?>
								<tr class="<?php if($ocuvalue['Occupation']['deactivate'] == true) echo 'even';?>">
									<td>
										<?php if(!empty($ocuvalue['Occupation']['job_id'])): ?>
											<?php echo h($ocuvalue['Occupation']['cmp_headhunter_id']).'-'.h($ocuvalue['Occupation']['job_id']);?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($ocuvalue['Occupation']['job_title'])): ?>
											<?php if(strlen($ocuvalue['Occupation']['job_title']) > 25): ?>
												<?php echo mb_substr($ocuvalue['Occupation']['job_title'],0,25,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($ocuvalue['Occupation']['job_title']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if (!empty($ocuvalue['Occupation']['number_of_keep'])) : ?>
											<?php echo h($ocuvalue['Occupation']['number_of_keep']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if (!empty($ocuvalue['Occupation']['number_of_applicant'])) : ?>
											<?php echo h($ocuvalue['Occupation']['number_of_applicant']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($ocuvalue['Occupation']['modified'])): ?>
											<?php echo date("d M Y", strtotime($ocuvalue['Occupation']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php echo $this->Html->link('View', array('controller' => 'masteroccupations', 'action' => 'browse',h($ocuvalue['Occupation']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php if ($ocuvalue['Occupation']['deactivate'] == false): ?>
											<?php echo $this->Html->link('Deactivate', array('controller' => 'masteroccupations', 'action' => 'approved', h($ocuvalue['Occupation']['id'])), array('onclick' => 'return confirm("Would you like to deactivate the job information?")', 'class'=>'btn btn-gray btn-sm','style' => 'width:75px;')); ?>
										<?php elseif ($ocuvalue['Occupation']['deactivate'] == true): ?>
											<?php echo $this->Html->link('Activate', array('controller' => 'masteroccupations', 'action' => 'approved', h($ocuvalue['Occupation']['id'])), array('onclick' => 'return confirm("Would you like to activate the job information? If you activate it, the job information will be listed on the jobseekers site.")', 'class' => 'btn btn-white btn-sm','style' => 'width:75px;')); ?>
										<?php endif; ?>
										<?php echo $this->Html->link('Delete', array('controller' => 'masteroccupations', 'action' => 'delete', h($ocuvalue['Occupation']['id'])), array('confirm' => "Would you like to delete this job?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
									</td>
								</tr>
							<?php endforeach;?>
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