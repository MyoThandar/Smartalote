<div class="col-md-12">
	<?php echo $this->Session->flash(); ?>
	<div class="col-md-8 col-sm-8 col-xs-12"> <h2>Job Category Register</h2> </div>
	<div class="x_panel">
		<div class="x_content">
			<div class = "adjust">
				<div class="col-md-10">
					<div class="col-md-3 big">
						<?php echo $this->Form->create(array('type'=>'get')); ?>
							<?php if (!empty($this->params->query['job_category'])) : ?>
								<?php $jobcategoryVal = trim($this->params->query['job_category']); ?>
							<?php else : ?>
								<?php $jobcategoryVal = ''; ?>
							<?php endif; ?>
							<?php echo $this->Form->input('job_category', array(
										'label' => false,
										'default' => $jobcategoryVal,
										'options' => $categoryBig,
										'onChange' => 'this.form.submit();',
										'empty' => 'please select the job category',
										'class' => 'btn btn-default btn-block'
									)
								);
							?>
					</div>

					<div class="col-md-3 small">
					</div>
					<?php echo $this->Form->end(); ?>

					<div class="region-serch">
						<?php echo $this->Form->create('JobCategorie', array('type' => 'get', 'url' => array('controller' => 'adminvjobs', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
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
		<div class="col-md-8">
			<table class="table table-bordered" id="datatable">
				<thead>
					<tr>
						<th>Job Category</th>
						<th>Sub Job Category</th>
						<th class="operation">Operations</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($job)): ?>
						<?php foreach ($job as $key1 => $val) : ?>
							<?php foreach ($val['JobCategorieSub'] as $key2 => $value) : ?>
								<tr>
									<td class="col-md-4 tablebg">
										<?php $text = wordwrap($val['JobCategorie']['label'], 20, "\r\n", true); ?>
										<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' => 'large' ,'id' => h($val['JobCategorie']['id']))); ?>
									</td>
									<td class="col-md-4">
									<?php $editData = $val['JobCategorie']['id'].':'.$value['id'].':'.$val['JobCategorie']['label'].':'.$value['label']; ?>
										<?php $text = wordwrap($value['label'], 20, "\r\n", true); ?>
										<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' =>'editform','id' => $editData)); ?>
									</td>
									<td>
										<?php echo $this->Form->postLink('Delete', array(
												'action' => 'delete',
												$val['JobCategorie']['id'],
												$value['id']
											),
											array(
												'confirm' => "Would you like to delete this job category ?",
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
									<?php $text = wordwrap($val['JobCategorie']['label'], 20, "\r\n", true); ?>
									<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' => 'large' ,'id' => h($val['JobCategorie']['id']))); ?>
								</td>
								<td class="col-md-4">
								<?php $editData = $val['JobCategorie']['id'].':'.$val['JobCategorieSub']['id'].':'.$val['JobCategorie']['label'].':'.$val['JobCategorieSub']['label']; ?>
									<?php $text = wordwrap($val['JobCategorieSub']['label'], 20, "\r\n", true); ?>
									<?php echo $this->Html->link("$text\r\n",'#',array('label'=>false ,'class' =>'editform','id' => $editData)); ?>
								</td>
								<td>
									<?php echo $this->Form->postLink('Delete', array(
											'action' => 'delete',
											$val['JobCategorie']['id'],
											$val['JobCategorieSub']['id']
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

		<!-- Add Job Category -->
		<?php echo $this->Form->create('JobCategorie', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'main-form', 'autocomplete' => 'off')); ?>
			<div class="col-md-4 well">
				<div class="form-group">
					<div class="col-md-5">
						<?php echo $this->Form->label('label','Job Category',array('class' => 'control-label','style' => 'padding-top: 0%;')); ?>
					</div>
					<div class="col-md-7">
						<?php echo $this->Form->input('label', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'width: 120%;margin-left: -18%;' ,'maxlength' => 35)); ?>
					</div>
				</div>

				<?php echo $this->Form->input('blabel', array('type'=>'hidden', 'name' => 'data[JobCategorieSub]', 'id' => 'blabel', 'value' => '')); ?>

				<div class="form-group ">
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm', 'style' => "margin-left:37%")); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>

		<!-- Add JobCategorieSub -->
		<?php echo $this->Form->create('JobCategorieSub', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'sub-form', 'autocomplete' => 'off')); ?>
			<div class="col-md-4 well">
				<div class="form-inline form-group">
					<label class="col-md-3">Job Category</label>
					<div class="col-md-9" style="padding-left: 11%;">
						<span id="big_item_txt"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4">
						<?php echo $this->Form->label('label','Sub Job Category',array('class' => 'control-label','style' => 'padding-top: 0%;margin-left: -33%;')); ?>
					</div>
					<div class="col-md-8">
						<?php echo $this->Form->input('JobCategorieSub.0.label', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => 35)); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('blabel', array('type'=>'hidden', 'name' => 'data[JobCategorie][label]', 'id' => 'tmplabel')); ?>
					<?php echo $this->Form->input('JobCategorieSub.0.industry_big_id', array('type'=>'hidden', 'name' => 'data[JobCategorieSub][0][industry_big_id]', 'id' => 'industryId')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm','style' => "margin-left:37%")); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>

		<!-- Edit form -->
		<?php echo $this->Form->create('JobCategorieSub', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'editform', 'autocomplete' => 'off')); ?>
			<div class="col-md-4 well">
				<div class="form-inline form-group">
					<label class="col-md-6">Job Category</label>
				</div>
				<div class="form-group">
					<div class="col-md-5">
						<?php echo $this->Form->label('biglabel','Job Category',array('class' => 'control-label','style' => 'padding-top: 0%;')); ?>
					</div>
					<div class="col-md-7">
						<?php echo $this->Form->input('biglabel', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','id' => 'biglabel' ,'required' => 'true','style' => 'width: 120%;margin-left: -18%;','maxlength' => 35)); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4">
						<?php echo $this->Form->label('smalllabel','Sub Job Category',array('class' => 'control-label','style' => 'padding-top: 0%;margin-left: -33%;')); ?>
					</div>
					<div class="col-md-8">
						<?php echo $this->Form->input('smalllabel', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','id' => 'smalllabel' ,'required' => 'true','style' => 'width: 103%;margin-left: -1%;','maxlength' => 35)); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('industry_big_id', array('type'=>'hidden', 'name' => 'data[JobCategorieSub][industry_big_id]', 'id' => 'industry_big_id')); ?>
					<?php echo $this->Form->input('smallId', array('type'=>'hidden', 'name' => 'data[JobCategorieSub][id]', 'id' => 'smallId')); ?>
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