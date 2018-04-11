<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('User', array('type' => 'file', 'class' => ' form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3 >Education</h3>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3 >Education</h3>
				</div>
			</div>

		</div>

		<?php if (!empty($educations) || !empty($requestData)) {
			$educations = !empty($requestData) ? $requestData : $educations;
		} ?>

		<div class="applyForm">
			<?php if(!empty($educations)) : ?>
				<?php foreach ($educations['UserEducation'] as $key => $value) : ?>
					<div id=<?php echo "apply_form[".$key."]";?> class='edu'>
						<div class="form-group">
							<p class="col-md-4 control-label cv_three_font letter_color" id="uni_title">University name<span class = "required"> *</span></p>
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<?php echo $this->Form->input('UserEducation.'.$key.'.university_name', array('type' => 'text','id'=>'uni_id', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'e.g.) Yangon University of Foreign Language','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;','required' => true)); ?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<p class="col-md-4 control-label cv_three_font letter_color" id="major_title">Department<span class = "required"> *</span></p>
							<div class="col-md-6 selectContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<?php echo $this->Form->input('UserEducation.'.$key.'.department', array('type' => 'text','id'=>'major_id', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'e.g.) Computer science department','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;','required' => true)); ?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<p class="col-md-4 control-label cv_three_font letter_color" id="de_title">Degree<span class = "required"> *</span></p>
							<div class="col-md-6 selectContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<i class=""></i>
									<?php echo $this->Form->input('UserEducation.'.$key.'.degree', array('type'=>'select','id'=>'de_id', 'options'=> $education,'empty'=>'Choose Level', 'label'=>false, 'class' => 'form-control selectpicker select_height','style'=>'border-radius:3px;width: 106%;' ,'required' => true)); ?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<p class="col-md-4 control-label cv_three_font letter_color" id="school_title">Enrollment<span class = "required"> *</span></p>
							<div class="col-md-6 selectContainer">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<div class="col-md-4 form-group">
										<?php echo $this->Form->input('UserEducation.'.$key.'.enroll_month', array('type'=>'select','id'=>'smonth', 'options'=>$month,'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height','style'=>'border-radius:3px;width: 106%;','required' => true)); ?>
									</div>
									<div class="col-md-1">
									</div>
									<div class=" col-md-4 form-group">
										<?php echo $this->Form->input('UserEducation.'.$key.'.enroll_year', array('type'=>'select','id'=>'syear', 'options'=>$year,'empty'=>'Year', 'class' => 'form-control select_height', 'label'=>false,'style'=>'border-radius:3px;width: 106%;','required' => true));?>
									</div>
								</div>
							</div>
						</div>


						<div class="form-group graduation_main">
							<p class="col-md-4 control-label cv_three_font letter_color" id="school_title" >Graduation<span class = "required"> *</span></p>
							<div class="col-md-6 selectContainer" >
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
									<!-- <div class="col-md-6 form-group"> -->
										<div class="col-md-4 form-group">
											<?php echo $this->Form->input('UserEducation.'.$key.'.gd_month', array('type'=>'select','id'=>'smonth', 'options' => $month,'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height','style'=>'border-radius:3px;width: 106%;', 'disabled' => isset($value['toggle']) ? $value['toggle'] : false)); ?>
										</div>
										<div class="col-md-1">
										</div>
										<div class="col-md-4 form-group">
										<?php echo $this->Form->input('UserEducation.'.$key.'.gd_year', array('type'=>'select','id'=>'syear', 'options'=>$year,'empty'=>'Year', 'class' => 'form-control select_height', 'label'=>false,'style'=>'border-radius:3px;width: 106%;', 'disabled' => isset($value['toggle']) ? $value['toggle'] : false));?>
										</div>
									<!-- </div> -->
									<div class="col-md-5 form-group still_university" style="margin-top: 9px;">
										<?php echo $this->Form->input('Still in university', array(
											'type' => 'checkbox',
											'class'=>' col-md-2  col-xs-1 col-sm-1  toggleElement',
											'name' => 'UserEducation.'.$key.'.toggle',
											'label' => false,
											'checked' => isset($value['toggle']) ? $value['toggle'] : false,
											'format' => array('independent'),
											)); ?>Still in University
									</div>
								</div>
							</div>

							<p class="col-md-4 control-label cv_three_font letter_color" id="de_title">Remarks</p>
							<div class="col-md-6">
								<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<?php echo $this->Form->input('UserEducation.'.$key.'.remarks', array('type' => 'textarea', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;')); ?>
								</div>
							</div>
						</div>
						<div class="form-group btn-delete minus_edu" >
							<span class="btn btn-primary remove_exercise">
								<i class="fa fa-minus"></i>
							</span>&nbsp;&nbsp;
							<label>Delete University</label>
						</div>
					</div>

				<?php endforeach; ?>

			<?php else : ?>
				<div id = "apply_form[0]" class="edu">
					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color" id="uni_title">University name<span class = "required"> *</span></p>
						<div class="col-md-6 inputGroupContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<?php echo $this->Form->input('UserEducation.0.university_name', array('type' => 'text','id'=>'uni_id', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'e.g.) Yangon University of Foreign Language','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;','required' => true)); ?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color" id="major_title">Department<span class = "required"> *</span></p>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<?php echo $this->Form->input('UserEducation.0.department', array('type' => 'text','id'=>'major_id', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'e.g.) Computer science department','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;','required' => true)); ?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color" id="de_title">Degree<span class = "required"> *</span></p>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<i class=""></i>
								<?php echo $this->Form->input('UserEducation.0.degree', array('type'=>'select','id'=>'de_id', 'options'=>$education,'empty'=>'Choose Level', 'label'=>false, 'class' => 'form-control selectpicker select_height','style'=>'border-radius:3px;width: 106%;','required' => true)); ?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color" id="school_title">Enrollment<span class = "required"> *</span></p>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-12 col-sm-6 col-xs-12">
								<div class="col-md-3 form-group">
									<?php echo $this->Form->input('UserEducation.0.enroll_month', array('type'=>'select','id'=>'smonth', 'options'=>$month,'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height','style'=>'border-radius:3px;width: 106%;','required' => true)); ?>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-3 form-group">
									<?php echo $this->Form->input('UserEducation.0.enroll_year', array('type'=>'select','id'=>'syear', 'options'=>$year,'empty'=>'Year', 'class' => 'form-control select_height', 'label'=>false,'style'=>'border-radius:3px;width: 106%;','required' => true));?>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group graduation_main">
						<p class="col-md-4 control-label cv_three_font letter_color" id="school_title" >Graduation<span class = "required"> *</span></p>
						<div class="col-md-6 selectContainer" >
							<div class="input-group col-md-12 col-sm-6 col-xs-12" >
								<div class="col-md-3 form-group">
									<?php echo $this->Form->input('UserEducation.0.gd_month', array('type'=>'select','id'=>'smonth', 'options' => $month,'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height','style'=>'border-radius:3px;width: 106%;')); ?>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-3 form-group">
									<?php echo $this->Form->input('UserEducation.0.gd_year', array('type'=>'select','id'=>'syear', 'options'=>$year,'empty'=>'Year', 'class' => 'form-control select_height', 'label'=>false,'style'=>'border-radius:3px;width: 106%;'));?>
								</div>
								<div class="col-md-5" style="margin-top: 9px;">
									<?php echo $this->Form->input('Still in university', array(
										'type' => 'checkbox',
										'class'=>' col-md-3 col-xs-1 col-sm-1 toggleElement',
										'name' => "UserEducation.0.toggle",
										'label' => false,
										'format' => array('independent'),
									)); ?>Still in University
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color" id="de_title">Remarks</p>
						<div class="col-md-6">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
							<?php echo $this->Form->input('UserEducation.0.remarks', array('type' => 'textarea', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;')); ?>
							</div>
						</div>
					</div>

					<div class="form-group btn-delete minus_edu">
						<span class="btn btn-primary remove_exercise">
							<i class="fa fa-minus"></i>
						</span>&nbsp;&nbsp;
						<label>Delete University</label>
					</div>
				</div>

			<?php endif; ?>
			<div class="col-md-4 col-sm-12 col-xs-12 plus_edu" id="language-add-btn">
				<span class="btn btn-primary" id="add_exercise">
					<i href="" class="fa fa-plus"></i>
				</span>&nbsp;&nbsp;
				<label> Add University </label>
			</div>
		</div>


		<div class="col-md-12 col-sm-6 col-xs-12 btn_save_cancel" >
			<div class="hidden-md hidden-lg height_btn" ></div>
			<div class="col-md-3"></div>
			<div class="col-md-3 btn_cancel">
				<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'mypages', 'action' => 'mypage'), array('onclick' => 'return confirm("Do you want to cancel without updating?")', 'class' => 'cv-cancel')); ?>
			</div>
			<div class="hidden-md hidden-lg height_btn" ></div>
			<div class="col-md-3 btn_save">
				<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'cv-save', 'autocomplete' => 'off')); ?>
			</div>
		</div>

	<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-delete').first().hide();

		// redesign the validation error message.
		if ($('.error-message').length) {
			// get the parent div.
			var parent = $('.error-message').parent().parent();

			// detach the div.
			var validateMessage = $('.error-message').detach();
			validateMessage.addClass('col-md-12 form-group');
			validateMessage.css('margin-top', '-1%');
			// validateMessage.css('margin-left', '-3%');

			// add detached div to its corresponding parent div.
			$.each(parent, function(index, value) {
				parent[index].append(validateMessage[index]);
			});
		}
	});

	$(document).on('click', '#add_exercise', function(){
		var cnt = ($('.edu').length -1);

		if ($('.edu').length < 5) {

			var add = $(this).parent().prev('#apply_form\\[' + cnt+ '\\]');

			var deleteBtn = '<div class="col-md-2 col-sm-2 col-xs-2" >'+
								'<span class="btn btn-primary remove_exercise">'+
									'<i class="fa fa-minus" ></i>'+
								'</span></div>';
			cnt++;
			add
			.clone()
			.hide()
			.insertAfter(add)
			.attr('id', 'apply_form[' + cnt + ']')
			.find('input, textarea, select, checkbox').each(function(idx, obj) {
					$(obj).attr({
						id: $(obj).attr('id').replace(/\[\d*\]/, '[' + cnt + ']'),
						name: $(obj).attr('name').replace(/\[\d*\]/, '[' + cnt + ']')
					});
					if ($(obj).attr('type') == 'text'){
						$(obj).val('');
					}
					if ($(obj).attr('type') == 'hidden'){
						$(obj).remove();
					}
					if ($(obj).is("select")){
						$(obj).val('');
						$(obj).removeAttr('disabled');
					}
					if ($(obj).attr('type') == 'checkbox'){
						$(obj).attr('checked', false);
					}
					if ($(obj).is('textarea') ){
						$(obj).val('');
					}
					$(obj).removeClass('form-error');
					$(obj).parents('.form-group').removeClass('error has-error');
					$(obj).parents().children().remove('.error-message');
					$(obj).parent().children('span').remove();
			});

			var clone = $('#apply_form\\[' + cnt + '\\]');
			clone.find('.btn-delete').show();
			clone.slideDown('fast');
		} else {
			window.alert('You can add at most 5 university.');
		}
	});

	$(document).on('click', '.remove_exercise', function() {
		$(this).parent().parent().remove();
		$(".edu").each(function(key, val) {
			$(val).removeAttr('id');
			$(val).attr('id', 'apply_form['+key+']');
		});
	});

	$(document).ready(function(e) {
		$(".toggleElement").checked = false;
	});

	$(document).on('change', '.toggleElement', function () {
		if ($(this).prop('checked') == true) {
			$(this).parents().siblings().siblings('.graduation_main').find('select').attr('disabled', true);
			$(this).parents().siblings().siblings('.graduation_main').find('select').attr('disabled', true);

			$(this).parent().parent().find('select').children('option').removeAttr('selected');
			$(this).parent().parent().find('select option[value=""]').attr('selected', true);
		} else {
			$(this).parents().siblings().siblings('.graduation_main').find('select').removeAttr('disabled');
			$(this).parents().siblings().siblings('.graduation_main').find('select').removeAttr('disabled');
		}
	});
</script>

<style type="text/css" media="screen">
	.error-message , .required{
		color: red;
	}
</style>