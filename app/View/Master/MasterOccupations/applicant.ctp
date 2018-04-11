<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Applied Jobseeker List</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
<!--=================== for display==================== -->
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
							echo $this->Form->end();
						?>
					</div>
				</div>
				<?php if(!empty($pag)): ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('User.jobseeker_id', 'Jobseeker ID'); ?></th>
								<th><?php echo $this->Paginator->sort('User.name', 'Name'); ?></th>
								<th><?php echo $this->Paginator->sort('User.gender', 'Gender'); ?></th>
								<th><?php echo $this->Paginator->sort('User.birthday', 'Age'); ?></th>
								<th><?php echo $this->Paginator->sort('User.created', 'Updated Date'); ?></th>
								<th>Operations</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($pag as  $cmpkey => $cmpvalue): ?>
								<?php if( $cmpvalue['User']['deleted'] == false):?>
									<tr class="<?php if($cmpvalue['User']['withdraw'] == true) echo 'even'; ?>">
										<td>
											<?php if(!empty($cmpvalue['User']['jobseeker_id'])): ?>
											<?php echo h($cmpvalue['User']['jobseeker_id']); ?>
											<?php endif; ?>
										</td>

										<td>
											<?php if(!empty($cmpvalue['User']['name'])): ?>
												<?php if(strlen($cmpvalue['User']['name']) > 20): ?>
													<?php echo mb_substr($cmpvalue['User']['name'],0,20,'UTF-8')."..."; ?>
												<?php else : ?>
													<?php echo $cmpvalue['User']['name']; ?>
												<?php endif ; ?>
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

										<td style="border:1px solid #ddd">
											<?php echo $this->Html->link('Browse', array('controller' => 'masteroccupations', 'action' => 'applicantBrowse', h($cmpvalue['OccupationApply']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>
										</td>
										<td style="display: none"></td>
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
				<?php else:?>
					<?php echo "EMPTY"; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>