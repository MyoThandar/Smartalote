<?php echo $this->Session->flash(); ?>
<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20">
		<div class="x_panel">
			<div class="x_title">
				<h2>HeadHunter List</h2>
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
							<?php echo $this->Form->create('CmpHeadhunter', array('type' => 'get', 'url' => array('controller' => 'adminheadhunters', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
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

						<?php echo $this->Html->link('Register', array('controller' => 'adminheadhunters', 'action' => 'add'), array('class' =>'btn btn-orange pull-right' ));
						?>
					</div>
				</div>

				<?php if(!empty($pag)): ?>
					<table class="table table-bordered" >
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.company_id', 'Headhunter ID'); ?></th>
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.headhunter_name', 'Headhunter Name'); ?></th>
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.company_name', 'Company Name'); ?></th>
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.company_phone', 'Phone'); ?></th>
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.email', 'E-mail Address'); ?></th>
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.deactivate', 'Status'); ?></th>
								<th><?php echo $this->Paginator->sort('CmpHeadhunter.modified', 'Updated Date'); ?></th>
								<th colspan="3">Operations</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pag as  $cmpkey => $cmpvalue): ?>
								<tr class="<?php if($cmpvalue['CmpHeadhunter']['deactivate'] == true) echo 'even'; ?>">
									<td>
										<?php if(!empty($cmpvalue['CmpHeadhunter']['company_id'])): ?>
											<?php echo h($cmpvalue['CmpHeadhunter']['company_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($cmpvalue['CmpHeadhunter']['headhunter_name'])): ?>
											<?php if(strlen($cmpvalue['CmpHeadhunter']['headhunter_name']) > 13):?>
												<?php echo mb_substr($cmpvalue['CmpHeadhunter']['headhunter_name'],0,13,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($cmpvalue['CmpHeadhunter']['headhunter_name']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($cmpvalue['CmpHeadhunter']['company_name'])): ?>
											<?php if(strlen($cmpvalue['CmpHeadhunter']['company_name']) > 13):?>
												<?php echo mb_substr($cmpvalue['CmpHeadhunter']['company_name'],0,13,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($cmpvalue['CmpHeadhunter']['company_name']); ?>
											<?php endif; ?>
										<?php else: ?>
											<?php echo "Independent"; ?>
										<?php endif; ?>
									</td>


									<td>
										<?php if(!empty($cmpvalue['CmpHeadhunter']['company_phone'])): ?>
											<?php if(strlen($cmpvalue['CmpHeadhunter']['company_phone']) > 10) :?>

												<?php  echo mb_substr($cmpvalue['CmpHeadhunter']['company_phone'],0,15,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo $cmpvalue['CmpHeadhunter']['company_phone']; ?>
											<?php 	endif ; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($cmpvalue['CmpHeadhunter']['email'])): ?>
											<?php if(strlen($cmpvalue['CmpHeadhunter']['email']) > 14): ?>
												<?php echo mb_substr($cmpvalue['CmpHeadhunter']['email'],0,14,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo $cmpvalue['CmpHeadhunter']['email']; ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if ($cmpvalue['CmpHeadhunter']['deactivate'] == 1) : ?>
											<?php echo "Deactivated"; ?>
										<?php else: ?>
											<?php echo "Active"; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($cmpvalue['CmpHeadhunter']['modified'])): ?>
											<?php echo date("d M Y", strtotime($cmpvalue['CmpHeadhunter']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php echo $this->Html->link('Browse', array('controller' => 'adminheadhunters', 'action' => 'browse', h($cmpvalue['CmpHeadhunter']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php if ($cmpvalue['CmpHeadhunter']['deactivate'] == false): ?>
											<?php echo $this->Html->link('Deactivate', array('controller' => 'adminheadhunters', 'action' => 'approved', h($cmpvalue['CmpHeadhunter']['id'])), array('onclick' => 'return confirm("Would you like to stop?")', 'class' => 'btn btn-gray btn-sm','style' => 'width:75px;')); ?>
										<?php elseif ($cmpvalue['CmpHeadhunter']['deactivate'] == true): ?>
											<?php echo $this->Html->link('Activate', array('controller' => 'adminheadhunters', 'action' => 'approved', h($cmpvalue['CmpHeadhunter']['id'])), array('onclick' => 'return confirm("Would you like to start?")', 'class' => 'btn btn-white btn-sm','style' => 'width:75px;')); ?>
										<?php endif; ?>

										<?php echo $this->Html->link('Delete', array('controller' => 'adminheadhunters', 'action' => 'delete', h($cmpvalue['CmpHeadhunter']['id'])), array('confirm' => "Would you like to delete this company?", 'class' =>'btn btn-royal-blue btn-sm',)); ?>
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