<?php echo $this->Session->flash(); ?>
<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Jobseeker List</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('User.jobseeker_id', 'Jobseeker ID'); ?></th>
							<th><?php echo $this->Paginator->sort('User.name', 'Name'); ?></th>
							<th><?php echo $this->Paginator->sort('User.gender', 'Gender'); ?></th>
							<th><?php echo $this->Paginator->sort('User.birthday', 'Age'); ?></th>
							<th><?php echo $this->Paginator->sort('User.modified', 'Updated Date'); ?></th>
							<th colspan="3">Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as  $cmpkey => $cmpvalue): ?>
							<tr>
								<td>
									<?php if(!empty($cmpvalue['User']['jobseeker_id'])): ?>
									<?php echo h($cmpvalue['User']['jobseeker_id']); ?>
									<?php endif; ?>
								</td>

								<td>
									<?php if(!empty($cmpvalue['User']['name'])): ?>
									<?php echo h($cmpvalue['User']['name']); ?>
									<?php endif; ?>
								</td>

								<td>
									<?php if ($cmpvalue['User']['gender'] == 1) : ?>
										<?php echo "Male"; ?>
									<?php elseif($cmpvalue['User']['gender'] == 2): ?>
										<?php echo "Female"; ?>
									<?php endif; ?>
								</td>

								<td>
									<?php if(!empty($cmpvalue['User']['birthday'])): ?>
										<?php
											/****** Calculation age from birthday
											***** object oriented
											*********************************/
											$cal_age = date_diff(date_create($cmpvalue['User']['birthday']), date_create('today'))->y ;
											echo $cal_age;
										?>
									<?php endif; ?>
								</td>

								<td>
									<?php if(!empty($cmpvalue['User']['modified'])): ?>
									<?php echo date("d M Y", strtotime($cmpvalue['User']['modified'])); ?>
									<?php endif; ?>
								</td>

								<td>
									<?php echo $this->Html->link('Browse', array('controller' => 'masterjobseekers', 'action' => 'browse', h($cmpvalue['User']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>
								</td>
							</tr>
						<?php endforeach;?>
						<?php echo $this->Form->end();?>
					</tbody>
				</table>
				<p class="pull-left"><?php echo $this->Paginator->counter(array('format' => __('Display {:start}~{:end} of {:count} Items'))); ?></p>

				<div class="pull-right">
					<?php
						echo $this->Paginator->first(__('first'), array('class' => 'pagi gradient disabled'));
						echo $this->Paginator->prev(__('prev'), array(), null, array('class' => 'prev disabled', 'id' => 'example_first', 'tag' => false));
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
						echo $this->Paginator->next(__('next'), array(), null, array('class' => 'next disabled', 'id' => 'example_next'));
						echo $this->Paginator->last(__('last'), array('class' => 'pagi gradient disabled'));
					?>
				</div>
			</div>
		</div>
	</div>
</div>