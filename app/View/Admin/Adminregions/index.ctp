<div class="col-md-12 col-sm-12 col-xs-12">
	<?php echo $this->Session->flash(); ?>
	<div class="col-md-8 col-sm-8 col-xs-12"> <h2>Region Register</h2> </div>
	<div class="x_panel">
		<div class="x_content">
			<div class = "adjust">
				<div class="col-md-10">
					<?php echo $this->Form->create(array('type'=>'get')); ?>
						<div class="col-md-12">
							<div class="col-md-3" style="margin-left: -3%;">
								<?php
									$home_abroad = array('Domestic'=>'Domestic','Oversea'=>'Oversea');
									echo $this->Form->input('home_abroad', array(
										'label' => false,
										'default' =>$hm_ab,
										'options' => $home_abroad,
										'onChange' => 'this.form.submit();',
										'empty' => 'Geography',
										'class' => 'btn btn-default btn-block'
										)
									);
								?>
							</div>
							<?php echo $this->Form->end(); ?>

							<div class="region-serch">
								<?php echo $this->Form->create('region', array('type' => 'get', 'url' => array('controller' => 'adminregions', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
									<div class="input-group">
										<?php if (!empty($this->params->query['keyword'])) : ?>
										<?php echo $this->Form->input('keyword', array('label' => false,'id' => 'search' , 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
										<?php else : ?>
										<?php echo $this->Form->input('keyword', array('label' => false,'id' => 'search' , 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'required' => false)); ?>
										<?php endif; ?>
										<span class="input-group-btn">
											<?php echo $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i>', array('class' => 'btn btn-default')) ?>
										</span>
									</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>

						<div class="col-md-3 small">
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-sm-12 col-xs-12">
			<table class="table table-bordered" id="datatable">
				<thead>
					<tr>
						<th>Geography</th>
						<th>Region</th>
						<th class="operation">Operations</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($region_name)): ?>
						<?php foreach ($region_name as $key => $val) : ?>
							<tr>
								<td class="col-md-6 tablebg">
									<?php echo $val['Region']['home_abroad']; ?>
								</td>
								<td class="col-md-6">
									<?php $id = $val['Region']['id'].':'.$val['Region']['name'].':'.$val['Region']['home_abroad'] ?>
									<?php $text = wordwrap($val['Region']['name'], 20, "\r\n", true); ?>
									<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' => 'region-edit' ,'id' => $id)); ?>
								</td>
								<td>
									<?php echo $this->Form->postLink('Delete', array(
											'action' => 'delete',
											$val['Region']['id']
										),
										array(
											'confirm' => "Would you like to delete this region ?",
											'class' => 'btn btn-royal-blue btn-sm'
										)); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

		<!-- Region add and edit form -->
		<?php echo $this->Form->create('Region', array('type' => 'post', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off')); ?>
			<div class="col-md-4 col-sm-12 col-xs-12 well">
				<div class="form-inline form-group">
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<?php echo $this->Form->label('home_abroad','Geography',array('class' => 'control-label')); ?>
					</div>
					<div class="form-group">
						<div class="col-md-8 col-sm-3 col-xs-3">
						<span class=" error">
							<?php echo $this->Form->input('home_abroad', array(
							'type' => 'select',
							'options' => array('Domestic' => 'Domestic', 'Oversea' => 'Oversea'),
							'label' => false,
							'default' => 'Domestic',
							'class' => 'form-control',
							'id' => 'home_abroad'
							)); ?>
						</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<?php echo $this->Form->label('name','Region',array('class' => 'control-label')); ?>
					</div>
					<div class="col-md-8 col-sm-12 col-xs-12">
						<?php echo $this->Form->input('name', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','id' => 'name' ,'maxlength' => 35)); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 hidden-sm hidden-xs"></div>
					<?php echo $this->Form->input('id', array('type' => 'hidden','id' => 'id' )); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm')); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>

	</div>
</div>
<style type="text/css">
	.region-edit{
		color: blue !important;
		text-decoration: underline !important;
	}
</style>