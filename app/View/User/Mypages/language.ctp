<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'mypages', 'action' => 'language'), 'class' => ' form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<h2 class="cv7-name" >
			Registration Procedure(3/3)
		</h2>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3>Language Skills</h3>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3>Language Skills</h3>
				</div>
			</div>
		</div>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Burmese Skill</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12 ">
					<span class=" error">
						<?php echo $this->Form->input('UserLanguageSkill.0.skill', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'empty'=>'select language level',
							'class' => 'form-control select_height selectpicker',
							'style' => 'width: 104%;border-radius:3px;'
						)); ?>
					</span>
					<?php echo $this->Form->input('UserLanguageSkill.0.language', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=>'Burmese' )); ?>
					<?php echo $this->Form->input('UserLanguageSkill.0.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-color: #C0C0C0;margin-top: 15px;width: 104%;')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.0.user_id', array('type' => 'hidden', 'value' => $id)); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">English Skill</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<span class=" error">
						<?php echo $this->Form->input('UserLanguageSkill.1.skill', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'empty'=>'select language level',
							'class' => 'form-control select_height selectpicker',
							'style' => 'width: 104%;border-radius:3px;'
							)); ?>
					</span>
					<?php echo  $this->Form->input('UserLanguageSkill.1.language', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=>'English' )); ?>
					<?php echo $this->Form->input('UserLanguageSkill.1.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-color: #C0C0C0;margin-top: 15px;width: 104%;')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.1.user_id', array('type' => 'hidden', 'value' => $id)); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Chinese Skill</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<span class=" error">
						<?php echo $this->Form->input('UserLanguageSkill.2.skill', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'empty'=>'select language level',
							'class' => 'form-control select_height selectpicker',
							'style' => 'width: 104%;border-radius:3px;'
							)); ?>
					</span>
					<?php echo  $this->Form->input('UserLanguageSkill.2.language', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=>'Chinese' )); ?>
					<?php echo $this->Form->input('UserLanguageSkill.2.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-color: #C0C0C0;margin-top: 15px;width: 104%;')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.2.user_id', array('type' => 'hidden', 'value' => $id)); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Japanese Skill</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<span class=" error">
						<?php echo $this->Form->input('UserLanguageSkill.3.skill', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'empty'=>'select language level',
							'class' => 'form-control select_height selectpicker',
							'style' => 'width: 104%;border-radius:3px;'
							)); ?>
					</span>
					<?php echo  $this->Form->input('UserLanguageSkill.3.language', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control select_height' ,'value'=>'Japanese' )); ?>
					<?php echo $this->Form->input('UserLanguageSkill.3.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-color: #C0C0C0;margin-top:15px;width: 104%;')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.3.user_id', array('type' => 'hidden', 'value' => $id)); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="other_languages" id="other_languages[4]">
			<div class="form-group">
				<p class="col-md-4 control-label cv_three_font letter_color">Others</p>
				<div class="col-md-6 selectContainer">
					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<span class=" error">
						<?php
							echo $this->Form->input('UserLanguageSkill.4.language', array(
								'type' => 'select',
								'label' => false,
								'class' => 'form-control select_height',
								'autocomplete' => 'off',
								'placeholder' => 'Language',
								'style' => 'border-color: #C0C0C0;margin-bottom: 5px;width: 104%;border-radius:3px;',
								'options' => $language,
								'empty' => 'Select a language.'
							));
						?>
						</span>
						<?php
							echo $this->Form->input('UserLanguageSkill.4.skill', array(
								'type' => 'select',
								'options' => $language_skill ,
								'label' => false,
								'empty'=>'select language level',
								'class' => 'form-control select_height selectpicker',
								'style' => 'margin-top:15px;width: 104%;border-radius:3px;'
							));
						?>
						<?php
							echo $this->Form->input('UserLanguageSkill.4.certificate', array(
								'type' => 'text',
								'label' => false,
								'class' => 'form-control select_height',
								'autocomplete' => 'off',
								'placeholder' => 'Certificate','style' => 'border-color: #C0C0C0;margin-top: 15px;width: 104%;'
							));
						?>
						<?php echo $this->Form->input('UserLanguageSkill.4.user_id', array('type' => 'hidden', 'value' => $id)); ?>
					</div>
				</div>
			</div>

			<div class="form-group btn-delete padding_minus minus_language" >
				<span class="btn btn-primary remove_exercise col-md-offset-5" >
					<i class="fa fa-minus"></i>
				</span>&nbsp;&nbsp;
				<label>Delete language</label>
			</div>

		</div>

		<div id="language-add-btn" class="add_language">
			<span class="btn btn-primary col-md-offset-2" id="add_language">
				<i class="fa fa-plus" ></i>
			</span>&nbsp;&nbsp;
			<label>Add language</label>
		</div>

		<br>
		<div class="col-md-12 col-sm-6 col-xs-12 btn_save_cancel" >
			<div class="col-md-3  col-md-offset-5  btn_save">
				<?php echo $this->Form->button('Continue', array('type' => 'submit', 'class' => 'cv-save', 'autocomplete' => 'off' ,'style' =>'padding: 8px 70px !important;')); ?>
			</div>
		</div>
	<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-delete').first().hide();
	});

	$(document).on('click', '#add_language', function(){
		var cnt = ($('.other_languages').length -1) + 4;
		var add = $(this).parent().prev('#other_languages\\[' + cnt+ '\\]');
		var deleteBtn = '<div class="col-md-2 col-sm-2 col-xs-2" >'+
							'<span class="btn btn-primary remove_exercise">'+
								'<i class="fa fa-minus" ></i>'+
							'</span></div>';
		cnt++;

		if (cnt < 21) {
			add
			.clone()
			.hide()
			.insertAfter(add)
			.attr('id', 'other_languages[' + cnt + ']')
			.find('input, select').each(function(idx, obj) {
				$(obj).attr({
					id: $(obj).attr('id').replace(/[0-9]+$/, cnt),
					name: $(obj).attr('name').replace(/\[UserLanguageSkill\]\[[0-9]\]/, '[UserLanguageSkill][' + cnt + ']')
				});
				if ($(obj).attr('type') == 'text'){
					$(obj).val('');
				}
				$(obj).removeClass('form-error');$(obj).parents('.form-group').removeClass('error has-error');
				// $(obj).parent().children('span').remove();
			});
			var clone = $('#other_languages\\[' + cnt + '\\]');
			clone.find('.btn-delete').show();
			clone.slideDown('fast');
		} else {
			alert('you can\'t other language more than 15');
		}
	});
	$(document).on('click', '.remove_exercise', function() {
		$(this).parent().parent().remove();
		$(".other_languages").each(function(key, val) {
			$(val).removeAttr('id');
			$(val).attr('id', 'other_languages['+(key+4)+']');
		});
	});
</script>