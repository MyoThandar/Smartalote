<?php echo $this->Html->script('jquery-1.12.4'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui'); ?>
<?php echo $this->Session->flash(); ?>
<div class="x_panel" style="height: 1318px;">
	<div class="x_title">
		<h2>Company Edit</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
		<?php echo $this->Form->create('SubHeadhunter', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'demo-form2', 'autocomplete' => 'off')); ?>

			<div class="form-group">
				<?php
					echo $this->Form->label('company_name', 'Company Name<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('company_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength'=>'100',
							'id' => 'companyName',
							'required' => false
						));
					?>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.company_name_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>

				<div id='companyValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Company Name</div>

			</div>

			<div class="form-group no-line ">
				<?php
					echo $this->Form->label('location', 'Address<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<?php
						echo $this->Form->input('location', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength'=>'100',
							'id' => 'address',
							'required' => false
						));
					?>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.location_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>

				<div id='addressValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Address</div>

			</div>

			<div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<span class=" error">
						<?php
							echo $this->Form->input('region', array(
								'type'=>'select',
								'options'=>$region,
								'label'=>false,
								'class' => 'form-control'
							));
						?>
					</span>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('logo', 'Company logo <span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php if (!empty($image)) : ?>

						<div class = "resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">

							<?php
								echo $this->Form->input('image',array(
									'type' => 'hidden',
									'label' => false,
									'value' => $image,
									'id' => 'img-hidden-val'
								));
							?>

							<?php
								echo $this->Html->image($image, array(
									'alt' => 'story image',
									'id' => 'previewHolder',
									"style" => "position: absolute;",
									'class' => 'preview'
								));
							?>
						</div>
						<br/>

						<label for="file-7" class="btn btn-default">
							<span></span>
							<strong>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
									<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
								</svg> Choose a file&hellip;
							</strong>
						</label>
						<span id="img-name">
							<?php echo $image; ?>
						</span>

					<?php else: ?>

						<div class = "resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">

							<?php if ($subheadhunter['SubHeadhunter']['logo']) : ?>
								<?php
									echo $this->Form->input('cologo',array(
										'type' => 'hidden',
										'label' => false,
										'value' => $subheadhunter['SubHeadhunter']['logo']
									));
								?>

								<?php
									echo $this->Html->image($subheadhunter['SubHeadhunter']['logo'], array(
										'alt' => 'story image',
										'id' => 'previewHolder',
										"style" => "position: absolute;",
										'class' => 'preview'
									));
								?>
							<?php else: ?>
								<img id = "previewHolder" alt = "Uploaded Image Preview Holder" style="position: absolute;"/>
							<?php endif; ?>

						</div>

						<div class="clearfix"></div>

						<label for="file-7" class="btn btn-default">
							<span></span>
							<strong>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
									<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
								</svg> Choose a file&hellip;
							</strong>
						</label>
						<span id="img-name"></span>

					<?php endif; ?>

					<?php
						echo $this->Form->input('logo',array(
							'type'=>'file',
							'label' => false,
							'id' => 'file-7',
							'style' => 'display:none',
							'required' => false
						));
					?>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.logo_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>

				<div id='imageValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose The Image</div>

			</div>

			<div class="form-group no-line " >
				<?php echo $this->Form->label('representative', 'Representative', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php echo $this->Form->label('representative_postion', 'Position', array('class' => 'control-label col-md-3 col-sm-3 col-xs-5')); ?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<?php echo $this->Form->input('representative_postion', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-5', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'50')); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.representative_position_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php echo $this->Form->label('representative_name', 'Name', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<?php echo $this->Form->input('representative_name', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'50')); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.representative_name_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('industry', 'Industry<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('industry_big_id', array(
							'type'=>'select',
							'empty' => 'please select the industry',
							'class' => 'form-control col-md-7 col-xs-12',
							'options'=>$big_industry,
							'label'=>false,
							'id' => 'industry-big'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('industry_small_id', array(
							'type' => 'select',
							'empty' => 'please select the sub industry',
							'label' => false,
							'class' => 'form-control',
							'div' => array('id' => 'hide_div_industry')
						));
					?>

					<?php foreach ($small_industry as $key => $val): ?>
						<?php
							echo $this->Form->input('industry_small_id', array(
								'type' => 'select',
								'selected' =>!empty($subheadhunter['SubHeadhunter']['industry_big_id'])? $subheadhunter['SubHeadhunter']['industry_small_id'] : '',
								'options' => $val,
								'label' => false,
								'empty' => 'please select the sub industry',
								'class' => 'form-control',
								'div' => array('class' => 'industry-small', 'id' => 'industry-small-' . $key)
							));
						?>
					<?php endforeach; ?>
				</div>
				<div id='industryValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Industry</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('Establishment', 'Establishment', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-1">
						<?php echo $this->Form->label('day', 'Day'); ?>
					</div>
					<div class="col-md-3 headhunday" >
						<?php echo $this->Form->input('day', array('type'=>'select', 'options'=>$day,'empty'=>'Day', 'label'=>false, 'class' => 'form-control' ,'style'=>'width:80px;')); ?>
					</div>
					<div class="col-md-2">
						<?php echo $this->Form->label('month', 'Month '); ?>
					</div>
					<div class="col-md-3 headhun_month" >
						<?php echo $this->Form->input('month', array('type'=>'select', 'options'=>$month,'empty'=>'Mon', 'label'=>false, 'class' => 'form-control')); ?>
					</div>
					<div class="col-md-1">
						<?php echo $this->Form->label('year', 'Year'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->input('year', array('type'=>'select', 'options'=>$year,'empty'=>'Year', 'class' => 'form-control', 'label'=>false)); ?>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.establishment_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('business_overview', 'Business Overview', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('overview', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'3000')); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.overview_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('hp_address', 'HP Address', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('hp_address', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'200')); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.hp_address_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('capital', 'Capital', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php echo $this->Form->input('capital_type', array(
						'options' => array(1=>'MMK',2 => 'USD'),
						'class' => 'control-label col-md-6 col-sm-6 col-xs-6 cptal_type'
						)); ?>
				</div>

				<div class="col-md-5 col-sm-5 col-xs-5">
					<span class="error">
						<?php echo $this->Form->input('capital', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-5', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'15')); ?>
					</span>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.company_name_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('employee', 'Number of Employee', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<span class="error">
						<?php echo $this->Form->input('number_of_employee', array(
							'type' => 'select',
							'options' => $employee ,
							'empty' => 'Choose number of employee' ,
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5' )); ?>
					</span>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 1%;">
					<?php echo $this->Form->input('SubHeadhunter.company_name_flag', array(
							'type' => 'checkbox',
							'label' => 'Hidden',
							'style' => 'margin-right: 3%;',
							'class' => 'company_check'
						)); ?>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'masterheadhunters', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm','id' => 'imageSubmit')); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<style type="text/css">

	.Message {
		margin-left: 248px;
		color: red;
	}

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

/* End of Auto complement */
</style>

<script>

	$(document).ready(function (){
		// redesign the validation error message.
		if ($('.headhunday .error-message').length) {

			// get the parent div.
			var parent = $('.headhunday .error-message').parent().parent().parent();

			// detach the div.
			var validateMessage = $('.headhunday .error-message').detach();
			validateMessage.addClass('col-md-12');
			validateMessage.css('padding-left', '27%');

			// add detached div to its corresponding parent div.
			$.each(parent, function(index, value) {
				parent[index].append(validateMessage[index]);
			});
		}
	});

</script>