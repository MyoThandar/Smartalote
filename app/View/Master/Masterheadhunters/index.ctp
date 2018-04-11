<?php echo $this->Session->flash(); ?>
<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Company List</h2>
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
								'class' => 'btn btn-default',
							));
						?>
					</div>
					<div class="col-md-10">
						<div class="col-md-4">
							<?php if (!empty($this->params->query['status'])): ?>
								<?php $deact_act = trim($this->params->query['status']); ?>
							<?php else: ?>
								<?php $deact_act = ''; ?>
							<?php endif; ?>

							<?php  echo $this->Form->input('status', array(
										'label' => false,
										'default'=> $deact_act ,
										'options' =>array('1'=>'active','2'=>'deactivated'),
										'onChange' => 'this.form.submit();',
										'empty' => 'Please select the status',
										'class' => 'form-control col-md-7 col-xs-12',
									)
								);
							echo $this->Form->end();
							?>
						</div>

						<div class="search-box sbox">
							<?php echo $this->Form->create('CmpHeadhunter', array('type' => 'get', 'url' => array('controller' => 'masterheadhunters', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
								<div class="input-group">
									<?php if (!empty($this->params->query['keyword'])) : ?>
										<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'search','class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
									<?php else : ?>
										<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'search', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'required' => false)); ?>
									<?php endif; ?>

									<span class="input-group-btn">
										<?php echo $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i>', array('class' => 'btn btn-default')); ?>
									</span>
								</div>
							<?php echo $this->Form->end(); ?>
						</div>

						<?php echo $this->Html->link('Register', array('controller' => 'masterheadhunters', 'action' => 'add'), array('class' =>'btn btn-orange pull-right' ));
						?>
					</div>
				</div>
				<?php if (!empty($pag)) : ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('SubHeadhunter.company_name', 'Company Name'); ?></th>
								<th><?php echo $this->Paginator->sort('SubHeadhunter.location', 'Address'); ?></th>
								<th><?php echo $this->Paginator->sort('SubHeadhunter.deactivate', 'Status'); ?></th>
								<th><?php echo $this->Paginator->sort('SubHeadhunter.modified', 'Updated date'); ?></th>
								<th>Operations</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pag as  $hhkey => $hhvalue) : ?>
								<?php  if( $hhvalue['SubHeadhunter']['deleted'] == false):?>
									<tr class="<?php if($hhvalue['SubHeadhunter']['deactivate'] == true) echo 'even'; ?>">

										<td>
											<?php if(!empty($hhvalue['SubHeadhunter']['company_name'])): ?>
												<?php if(strlen($hhvalue['SubHeadhunter']['company_name']) > 26): ?>
													<?php echo mb_substr($hhvalue['SubHeadhunter']['company_name'],0,26,'UTF-8')."..."; ?>
												<?php else: ?>
													<?php echo h($hhvalue['SubHeadhunter']['company_name']); ?>
												<?php endif; ?>
											<?php endif; ?>
										</td>

										<td>
											<?php if(!empty($hhvalue['SubHeadhunter']['location'])): ?>
												<?php if(strlen($hhvalue['SubHeadhunter']['location']) > 20): ?>
													<?php echo mb_substr($hhvalue['SubHeadhunter']['location'],0,20,'UTF-8')."..."; ?>
												<?php else: ?>
													<?php echo h($hhvalue['SubHeadhunter']['location']); ?>
												<?php endif; ?>
											<?php endif; ?>
										</td>

										<td>
											<?php if ($hhvalue['SubHeadhunter']['deactivate'] == 1) : ?>
												<?php echo "Deactivated"; ?>
											<?php else: ?>
												<?php echo "Active"; ?>
											<?php endif; ?>
										</td>

										<td>
											<?php if(!empty($hhvalue['SubHeadhunter']['modified'])): ?>
												<?php echo date("d M Y", strtotime($hhvalue['SubHeadhunter']['modified'])); ?>
											<?php endif; ?>
										</td>

										<td>
											<?php echo $this->Html->link('Edit', array('controller' => 'masterheadhunters', 'action' => 'edit',h($hhvalue['SubHeadhunter']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

											<?php if ($hhvalue['SubHeadhunter']['deactivate'] == false) : ?>
												<?php echo $this->Html->link('Deactivate', array('controller' => 'masterheadhunters', 'action' => 'approved', h($hhvalue['SubHeadhunter']['id'])), array('onclick' => 'return confirm("Would you like to stop?")', 'class'=>'btn btn-gray btn-sm')); ?>
											<?php elseif ($hhvalue['SubHeadhunter']['deactivate'] == true) : ?>
												<?php echo $this->Html->link('Activate', array('controller' => 'masterheadhunters', 'action' => 'approved', h($hhvalue['SubHeadhunter']['id'])), array('onclick' => 'return confirm("Would you like to start?")', 'class' => 'btn btn-white btn-sm')); ?>
											<?php endif ; ?>
											<?php echo $this->Html->link('Delete', array('controller' => 'masterheadhunters', 'action' => 'delete', h($hhvalue['SubHeadhunter']['id'])), array('confirm' => "Would you like to delete this company?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
										</td>
									</tr>
								<?php endif ; ?>
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
				<?php else :?>
					<?php echo "EMPTY"; ?>
				<?php endif ; ?>
			</div>
		</div>
	</div>
</div>