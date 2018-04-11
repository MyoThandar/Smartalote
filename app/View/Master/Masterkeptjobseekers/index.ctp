<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Kept Jobseeker List</h2>
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
								'class' => 'btn btn-default'
							));
							echo $this->Form->end();
						?>
					</div>

					<div class="col-md-10">
						<div class="search-box">
							<?php echo $this->Form->create('User', array('type' => 'get', 'url' => array('controller' => 'masterkeptjobseekers', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
								<div class="input-group" style="margin-right: -11px;">
									<?php if (!empty($this->params->query['keyword'])) : ?>
									<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'search' ,'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
									<?php else : ?>
									<?php echo $this->Form->input('keyword', array('label' => false,'id' => 'search' , 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'required' => false)); ?>
									<?php endif; ?>
									<span class="input-group-btn">
										<?php echo $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i>', array('class' => 'btn btn-default')); ?>
									</span>
								</div>
							<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
				<?php if (!empty($pag)): ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('User.jobseeker_id', 'Jobseeker ID'); ?></th>
								<th><?php echo $this->Paginator->sort('User.name', 'Name'); ?></th>
								<th><?php echo $this->Paginator->sort('User.gender', 'Gender'); ?></th>
								<th><?php echo $this->Paginator->sort('User.birthday', 'Age'); ?></th>
								<th><?php echo $this->Paginator->sort('MasterKeepUser.created', 'Updated Date'); ?></th>
								<th colspan="3">Operations</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($pag as  $cmpkey => $cmpvalue): ?>
								<tr>
									<td>
										<?php if (!empty($cmpvalue['User']['jobseeker_id'])): ?>
										<?php echo h($cmpvalue['User']['jobseeker_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if (!empty($cmpvalue['User']['name'])): ?>
											<?php if (strlen($cmpvalue['User']['name']) > 20): ?>
												<?php echo mb_substr($cmpvalue['User']['name'],0,20,'UTF-8')."..."; ?>
											<?php else : ?>
												<?php echo $cmpvalue['User']['name']; ?>
											<?php endif ; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if ($cmpvalue['User']['gender'] == 1) : ?>
											<?php echo "Male"; ?>
										<?php elseif ($cmpvalue['User']['gender'] == 2): ?>
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
										<?php if (!empty($cmpvalue['MasterKeepUser']['created'])): ?>
										<?php echo date("d M Y", strtotime($cmpvalue['MasterKeepUser']['created'])); ?>
										<?php endif; ?>
									</td>

									<td style="border:1px solid #ddd">
										<?php echo $this->Html->link('Browse', array('controller' => 'masterkeptjobseekers', 'action' => 'browse', h($cmpvalue['User']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>
									</td>
									<td style="display: none"></td>
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
<style type="text/css">
	#btnfailed {
		cursor: auto;
		background: #A9A9A9;
		pointer-events: none;
		margin-top: 1px;
		border: solid #778899 1px;
		color: #fff;
		width: 84%;
	}
	#btnpassed {
		background: #26B99A;
		pointer-events: none;
		margin-top: 1px;
		border: solid #169F85 1px;
		width: 84%;
	}
	#btnselection {
		cursor: auto;
		pointer-events: none;
		margin-top: 1px;
		border: solid #778899 1px;
		width: 84%;
	}
	.del {
		width: auto;
		display: inline-block;
		padding: 6px 12px;
		margin-bottom: 0;
		font-size: 14px;
		font-weight: normal;
		line-height: 1.42857143;
		text-align: center;
		background-image: none;
		border: 1px solid transparent;
		border-radius: 4px;
	}
</style>