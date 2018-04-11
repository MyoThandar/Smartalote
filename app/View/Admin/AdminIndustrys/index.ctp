<div class="col-md-12 col-sm-12 col-xs-12">
	<?php echo $this->Session->flash(); ?>
	<div class="col-md-8 col-sm-8 col-xs-12"> <h2>Industry Register</h2> </div>
	<div class="x_panel">
		<div class="x_content">
			<div class = "adjust">
				<div class="col-md-10">
					<div class="col-md-3 big">
						<?php echo $this->Form->create(array('type'=>'get')); ?>
							<?php if (!empty($this->params->query['industry_big'])) : ?>
								<?php $industryBigVal = trim($this->params->query['industry_big']); ?>
							<?php else : ?>
								<?php $industryBigVal = ''; ?>
							<?php endif; ?>
							<?php echo $this->Form->input('industry_big', array(
										'label' => false,
										'default' => $industryBigVal,
										'options' => $big_industry,
										'onChange' => 'this.form.submit();',
										'empty' => 'please select the industry',
										'class' => 'btn btn-default btn-block'
									)
								);
							?>
					</div>

					<div class="col-md-3 small">
					</div>
					<?php echo $this->Form->end(); ?>

					<div class="region-serch">
						<?php echo $this->Form->create('Industry', array('type' => 'get', 'url' => array('controller' => 'adminindustrys', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
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
			</div>
		</div>
		<div class="col-md-8 col-sm-12 col-xs-12">
			<table class="table table-bordered" id="datatable">
				<thead>
					<tr>
						<th>Industry</th>
						<th>Sub Industry</th>
						<th class="operation">Operations</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($industry)): ?>
						<?php foreach ($industry as $key1 => $val) : ?>
							<?php foreach ($val['IndustrySmall'] as $key2 => $value) : ?>
								<tr>
									<td class="col-md-4 tablebg">
										<?php $text = wordwrap($val['IndustryBig']['label'], 20, "\r\n", true); ?>
										<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' => 'large' ,'id' => h($val['IndustryBig']['id']))); ?>
									</td>
									<td class="col-md-4">
									<?php $editData = $val['IndustryBig']['id'].':'.$value['id'].':'.$val['IndustryBig']['label'].':'.$value['label']; ?>
										<?php $text = wordwrap($value['label'], 20, "\r\n", true); ?>
										<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' =>'editform','id' => $editData)); ?>
									</td>
									<td>
										<?php echo $this->Form->postLink('Delete', array(
												'action' => 'delete',
												$val['IndustryBig']['id'],
												$value['id']
											),
											array(
												'confirm' => "Would you like to delete this industry?",
												'class' => 'btn btn-royal-blue btn-sm'
											)); ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endforeach; ?>
					<?php elseif(!empty($keyword_result)) : ?>
						<?php foreach ($keyword_result as $key => $val) : ?>
							<tr>
								<td class="col-md-4 tablebg">
									<?php $text = wordwrap($val['IndustryBig']['label'], 20, "\r\n", true); ?>
									<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' => 'large' ,'id' => h($val['IndustryBig']['id']))); ?>
								</td>
								<td class="col-md-4">
								<?php $editData = $val['IndustryBig']['id'].':'.$val['IndustrySmall']['id'].':'.$val['IndustryBig']['label'].':'.$val['IndustrySmall']['label']; ?>
									<?php $text = wordwrap($val['IndustrySmall']['label'], 20, "\r\n", true); ?>
									<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' =>'editform','id' => $editData)); ?>
								</td>
								<td>
									<?php echo $this->Form->postLink('Delete', array(
											'action' => 'delete',
											$val['IndustryBig']['id'],
											$val['IndustrySmall']['id']
										),
										array(
											'confirm' => "Would you like to delete this industry?",
											'class' => 'btn btn-royal-blue btn-sm'
										)); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if (!empty($blabel)): ?>
						<tr>
							<td class="col-md-4 tablebg">
								<?php if (!empty($blabel)): ?>
									<?php $text = wordwrap($blabel, 20, "\r\n", true); ?>
									<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false , 'class' => 'large')); ?>
								<?php endif; ?>
							</td>
							<td class="col-md-2 ">
							</td>
							<td class="col-md-4 ">
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

		<!-- Add IndustryBig -->
		<?php echo $this->Form->create('IndustryBig', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'main-form', 'autocomplete' => 'off')); ?>
			<div class="col-md-4 col-sm-12 col-xs-12 well">
				<div class="form-group">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<?php echo $this->Form->label('label','Industry',array('class' => 'control-label')); ?>
					</div>
					<div class="col-md-8 col-sm-12 col-xs-12">
						<?php echo $this->Form->input('label', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '' ,'maxlength' => 35)); ?>
					</div>
				</div>

				<?php echo $this->Form->input('blabel', array('type'=>'hidden', 'name' => 'data[IndustrySmall]', 'id' => 'blabel', 'value' => '')); ?>

				<div class="form-group ">
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm', 'style' => "margin-left:37%")); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>

		<!-- Add IndustrySmall -->
		<?php echo $this->Form->create('IndustrySmall', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'sub-form', 'autocomplete' => 'off')); ?>
			<div class="col-md-4 col-sm-12 col-xs-12 well">
				<div class="form-inline form-group">
					<label class="col-md-3 col-sm-6 col-xs-6">Industry</label>
					<div class="col-md-9" style="padding-left: 11%;">
						<span id="big_item_txt"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<?php echo $this->Form->label('label','Sub Industry',array('class' => 'control-label')); ?>
					</div>
					<div class="col-md-8 col-sm-12 col-xs-12">
						<?php echo $this->Form->input('IndustrySmall.0.label', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '' ,'maxlength' => 35)); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('blabel', array('type'=>'hidden', 'name' => 'data[IndustryBig][label]', 'id' => 'tmplabel')); ?>
					<?php echo $this->Form->input('IndustrySmall.0.industry_big_id', array('type'=>'hidden', 'name' => 'data[IndustrySmall][0][industry_big_id]', 'id' => 'industryId')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm','style' => "margin-left:37%")); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>

		<!-- Edit form -->
		<?php echo $this->Form->create('IndustrySmall', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'editform', 'autocomplete' => 'off')); ?>
			<div class="col-md-4 col-sm-12 col-xs-12 well">
				<div class="form-inline form-group">
					<label class="col-md-3 col-sm-6 col-xs-6">Industry</label>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<?php echo $this->Form->label('biglabel','Industry',array('class' => 'control-label')); ?>
					</div>
					<div class="col-md-8 col-sm-12 col-xs-12">
						<?php echo $this->Form->input('biglabel', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','id' => 'biglabel' ,'required' => 'true','maxlength' => 35)); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<?php echo $this->Form->label('smalllabel','Sub Industry',array('class' => 'control-label')); ?>
					</div>
					<div class="col-md-8 col-sm-12 col-xs-12">
						<?php echo $this->Form->input('smalllabel', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','id' => 'smalllabel' ,'required' => 'true','maxlength' => 35)); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('industry_big_id', array('type'=>'hidden', 'name' => 'data[IndustrySmall][industry_big_id]', 'id' => 'industry_big_id')); ?>
					<?php echo $this->Form->input('smallId', array('type'=>'hidden', 'name' => 'data[IndustrySmall][id]', 'id' => 'smallId')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm','style' => "margin-left:37%",'name' => 'edit')); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>

	</div>
</div>
<style type="text/css">
	.editform{
		color: blue !important;
		text-decoration: underline !important;
	}
</style>