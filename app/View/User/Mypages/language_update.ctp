<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('User', array('type' => 'file', 'class' => ' form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
				<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
					<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
						<h3 >Language Skills</h3>
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
					<?php echo $this->Form->input('UserLanguageSkill.0.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.0.user_id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=> $current_user_id)); ?>
					<span class=" error">
						<?php echo $this->Form->input('UserLanguageSkill.0.skill', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'empty'=>'select language level',
							'class' => 'form-control select_height selectpicker',
							'style' =>'border-radius:3px;width: 106%;',
						)); ?>
					</span>
					<?php echo $this->Form->input('UserLanguageSkill.0.language', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=>'Burmese' )); ?>
					<?php echo $this->Form->input('UserLanguageSkill.0.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height select_css', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-radius:3px;margin-top: 3%;width: 106%')); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">English Skill</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('UserLanguageSkill.1.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.1.user_id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=> $current_user_id)); ?>
					<span class=" error">
						<?php echo $this->Form->input('UserLanguageSkill.1.skill', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'empty'=>'select language level',
							'class' => 'form-control select_height selectpicker',
							'style' =>'border-radius:3px;width: 106%;',
							)); ?>
					</span>
					<?php echo $this->Form->input('UserLanguageSkill.1.language', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=>'English' )); ?>
					<?php echo $this->Form->input('UserLanguageSkill.1.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height select_css', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-radius:3px;margin-top: 3%;width: 106%;')); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Chinese Skill</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('UserLanguageSkill.2.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.2.user_id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=> $current_user_id)); ?>
					<span class=" error">
						<?php echo $this->Form->input('UserLanguageSkill.2.skill', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'style' =>'border-radius:3px',
							'empty'=>'select language level',
							'class' => 'form-control select_height selectpicker',
							'style' => 'width: 106%'
							)); ?>
					</span>
					<?php echo $this->Form->input('UserLanguageSkill.2.language', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=>'Chinese' )); ?>
					<?php echo $this->Form->input('UserLanguageSkill.2.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height select_css', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-radius:3px;margin-top: 3%;width: 106%;')); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Japanese Skill</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('UserLanguageSkill.3.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.3.user_id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=> $current_user_id)); ?>
					<span class=" error">
						<?php echo $this->Form->input('UserLanguageSkill.3.skill', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'empty'=>'select language level',
							'class' => 'form-control select_height selectpicker ',
							'style' =>'border-radius:3px;width: 106%;',
							)); ?>
					</span>
					<?php echo $this->Form->input('UserLanguageSkill.3.language', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control select_height' ,'value'=>'Japanese' )); ?>
					<?php echo $this->Form->input('UserLanguageSkill.3.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height select_css', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-radius:3px;margin-top:3%;width: 106%;')); ?>
				</div>
			</div>
		</div>
		<br>
		<?php if(!empty($languages['UserLanguageSkill']) && count($languages['UserLanguageSkill']) > 4) : ?>
			<?php for ($i=4; $i < count($languages['UserLanguageSkill']); $i++) : ?>
				<div class="other_languages" id=<?php echo "other_languages[".$i."]"; ?>>
					<?php echo $this->Form->input('UserLanguageSkill.'.$i.'.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
					<?php echo $this->Form->input('UserLanguageSkill.'.$i.'.user_id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=> $current_user_id)); ?>
					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color">Others</p>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<?php echo $this->Form->input('UserLanguageSkill.'.$i.'.language', array('type' => 'select', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => 'Language','style' => 'border-color: #C0C0C0;margin-bottom: 15px;width: 106%', 'options' => $language, 'empty' => 'Select a language.')); ?>
								<?php echo $this->Form->input('UserLanguageSkill.'.$i.'.user_id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=> $current_user_id)); ?>
								<?php echo $this->Form->input('UserLanguageSkill.'.$i.'.skill', array(
										'type' => 'select',
										'options' => $language_skill ,
										'label' => false,
										'empty'=>'select language level',
										'style' =>'border-radius:3px;width: 106%;',
										'class' => 'form-control select_height selectpicker',
										)); ?>
								<?php echo $this->Form->input('UserLanguageSkill.'.$i.'.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height select_css', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'border-radius:3px;margin-top:3%;width: 106%;')); ?>
							</div><br>
						</div>
					</div>

					<div class="form-group btn-delete padding_minus minus_language" >
						<span class="btn btn-primary remove_exercise col-md-offset-5" >
							<i class="fa fa-minus"></i>
						</span>&nbsp;&nbsp;
						<label>Delete language</label>
					</div>
				</div>
			<?php endfor; ?>
		<?php else : ?>
			<div class="other_languages" id="other_languages[4]">
				<?php echo $this->Form->input('UserLanguageSkill.0.user_id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=> $current_user_id)); ?>
				<div class="form-group">
					<p class="col-md-4 control-label cv_three_font letter_color">Others</p>
					<div class="col-md-6 selectContainer">
						<div class="input-group col-md-9 col-sm-6 col-xs-12">
							<?php
								echo $this->Form->input('UserLanguageSkill.4.language', array(
									'type' => 'select',
									'label' => false,
									'class' => 'form-control select_height',
									'autocomplete' => 'off',
									'placeholder' => 'Language',
									'style' => 'border-radius:3px;border-color: #C0C0C0;margin-bottom: 5px;width: 104%;',
									'options' => $language,
									'empty' => 'Select a language.'
								));
							?>
							<?php
							echo $this->Form->input('UserLanguageSkill.4.user_id', array(
								'type'=>'hidden',
								'label'=>false,
								'class' =>'form-control',
								'value'=> $current_user_id
								));
								?>

							 <?php echo $this->Form->input('UserLanguageSkill.4.skill', array(
									'type' => 'select',
									'options' => $language_skill ,
									'label' => false,
									'empty'=>'select language level',
									'class' => 'form-control select_height selectpicker bottom_language',
									'style' => 'border-radius:3px;width:104%;'
									)); ?>
							<?php echo $this->Form->input('UserLanguageSkill.4.certificate', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height select_css', 'autocomplete' => 'off' , 'placeholder' => 'Certificate','style' => 'width: 104%')); ?>
						</div>
					</div>
				</div>

				<div class="form-group btn-delete padding_minus minus_language">
					<span class="btn btn-primary remove_exercise col-md-offset-5">
						<i class="fa fa-minus"></i>
					</span>&nbsp;&nbsp;
					<label>Delete language</label>
				</div>
			</div>
		<?php endif; ?>

		<div id="language-add-btn" class="add_language">
			<span class="btn btn-primary col-md-offset-2" id="add_language">
				<i class="fa fa-plus" ></i>
			</span>&nbsp;&nbsp;
			<label>Add language</label>
		</div>
		<div class="hidden-md hidden-lg height_btn" ></div>

		<div class="col-md-12 col-sm-6 col-xs-12 btn_save_cancel" >
			<div class="col-md-3"></div>
			<div class="col-md-3 btn_cancel">
				<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'mypages', 'action' => 'mypage'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'cv-cancel')); ?>
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
	});
	$(document).on('click', '#add_language', function(){
		var cnt = ($('.other_languages').length -1) + 4;
		if ($('.other_languages').length < 15) {
			var add = $(this).parent().prev('#other_languages\\[' + cnt+ '\\]');
			var deleteBtn = '<div class="col-md-2 col-sm-2 col-xs-2" >'+
								'<span class="btn btn-primary remove_exercise">'+
									'<i class="fa fa-minus" ></i>'+
								'</span></div>';
			cnt++;
			add
			.clone()
			.hide()
			.insertAfter(add)
			.attr('id', 'other_languages[' + cnt + ']')
			.find('input, select', 'textarea', 'hidden').each(function(idx, obj) {
				$(obj).attr({
					id: $(obj).attr('id').replace(/\[\d*\]/, '[' + cnt + ']'),
					name: $(obj).attr('name').replace(/\[\d*\]/, '[' + cnt + ']')
				});
				if ($(obj).attr('type') == 'text'){
					$(obj).val('');
				}
				if ($(obj).is("textarea")){
					$(obj).val('');
				}
				if ($(obj).is("Select")){
					$(obj).val('');
				}
				$(obj).removeClass('form-error');$(obj).parents('.form-group').removeClass('error has-error');
			});
			var clone = $('#other_languages\\[' + cnt + '\\]');
			clone.find('.btn-delete').show();
			clone.slideDown('fast');
		} else {
			window.alert('You can add at most 15 other languages.');
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