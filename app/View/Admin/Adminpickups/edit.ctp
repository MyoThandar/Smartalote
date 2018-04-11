<?php echo $this->Html->script('jquery-1.12.4'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui'); ?>
<div class="x_panel">
	<div class="x_title">
	<h2>Picked Up Company Edit</h2>
	<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br>
		<?php echo $this->Form->create('Pickup', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'id' => 'demo-form2')); ?>

			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('company_name', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'100', 'id' => 'tags', 'disabled' => true)); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Start Date <span class="required">*</span>
				</label>
				<div class='col-md-8'>
					<div class="col-md-2 form-group">
						<div class='form-group'>
							<?php echo $this->Form->input('day', array('type'=>'select', 'options'=>$day,'empty'=>'Day', 'label'=>false, 'class' => 'form-control select_height' )); ?>
						</div>
					</div>
					<div class="col-md-2">
						<div class='form-group'>
							<?php echo $this->Form->input('month', array('type'=>'select', 'options'=>$month,'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height')); ?>
						</div>
					</div>
					<div class="col-md-2">
						<div class='form-group'>
							<?php echo $this->Form->input('year', array('type'=>'select', 'options'=>$year,'empty'=>'Year','class' => 'form-control select_height', 'label'=>false)); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Term <span class="required">*</span></label>
				<div class="col-md-6">
					<div class='form-group'>
						<?php echo $this->Form->input('term', array('type'=>'select', 'options'=>$pick_term,'empty'=>'Term','class' => 'form-control', 'label'=>false)); ?>
					</div>
				</div>
			</div>

			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'adminpickups', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm')); ?>
				</div>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<style type="text/css">

/* Autocomplement components design */

	.ui-widget {
		font-family: Arial,Helvetica,sans-serif;
		font-size: 1em;
	}

	.ui-widget .ui-widget {
		font-size: 1em;
	}

	.ui-widget input,
	.ui-widget select,
	.ui-widget textarea,
	.ui-widget button {
		font-family: Arial,Helvetica,sans-serif;
		font-size: 1em;
	}

	.ui-widget.ui-widget-content {
		border: 1px solid #c5c5c5;
	}

	.ui-widget-content {
		border: 1px solid #dddddd;
		background: #ffffff;
		color: #333333;
		width: 10%;
	}

	.ui-state-active,
	.ui-widget-content .ui-state-active,
	.ui-widget-header .ui-state-active,
	a.ui-button:active,
	.ui-button:active,
	.ui-button.ui-state-active:hover {
		border: 1px solid #003eff;
		background: #007fff;
		font-weight: normal;
		color: #ffffff;
	}

/* End of Autocomplement */

</style>

<script type="text/javascript">
// Auto complement
	var company_list = <?php echo json_encode($company_list, JSON_PRETTY_PRINT); ?>;
	var company = <?php echo json_encode($company, JSON_PRETTY_PRINT); ?>;

	$(function() {
		var availableTags = <?php echo json_encode($com_list); ?>;
		$( "#tags" ).autocomplete({
			source: availableTags
		});
	});

</script>