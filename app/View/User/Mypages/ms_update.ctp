<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('User', array('type' => 'file', 'class' => ' form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
				<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
					<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
						<h3 >Computer Skill</h3>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
					<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
						<h3>Computer Skill</h3>
					</div>
				</div>
		</div>

		<div class="form-group">
			<h4><?php echo $this->Form->label('', 'Microsoft office', array('class' => 'col-md-4 control-label letter_color'));?></h4>
		</div>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Excel<span class = "required"> *</span></p>

			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<span class=" error">
						<?php echo $this->Form->input('UserComputingSkill.0.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
						<?php echo $this->Form->input('UserComputingSkill.0.title', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=>'Excel' )); ?>
						<?php echo $this->Form->input('UserComputingSkill.0.skill', array(
							'type' => 'select',
							'options' => $ms_skill_level ,
							'label' => false,
							'empty'=>'Select language level',
							'style' =>'border-radius:3px;width: 106%;',
							'class' => 'form-control select_height selectpicker sel_width',
							'required' => true
						)); ?>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Word<span class = "required"> *</span></p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<span class=" error">
						<?php echo $this->Form->input('UserComputingSkill.1.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
						<?php echo $this->Form->input('UserComputingSkill.1.title', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control ' ,'value'=>'Word' )); ?>
						<?php echo $this->Form->input('UserComputingSkill.1.skill', array(
							'type' => 'select',
							'options' => $ms_skill_level ,
							'label' => false,
							'empty'=>'Select language level',
							'class' => 'form-control select_height selectpicker sel_width',
							'style' =>'border-radius:3px;width: 106%;',
							'required' => true
							)); ?>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Power Point<span class = "required"> *</span></p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<span class=" error">
						<?php echo $this->Form->input('UserComputingSkill.2.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
						<?php echo $this->Form->input('UserComputingSkill.2.title', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control' ,'value'=>'Power Point' )); ?>
						<?php echo $this->Form->input('UserComputingSkill.2.skill', array(
							'type' => 'select',
							'options' => $ms_skill_level ,
							'label' => false,
							'empty'=>'Select language level',
							'required' => true,
							'style' =>'border-radius:3px;width: 106%;',
							'class' => 'form-control select_height selectpicker sel_width',

							)); ?>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<h4><?php echo $this->Form->label('', 'Others', array('class' => 'col-md-4 control-label letter_color'));?></h4>
		</div>
		<?php if(!empty($ms_info_edit['UserComputingSkill']) && count($ms_info_edit['UserComputingSkill']) > 3) : ?>
			<?php for ($i=3; $i < count($ms_info_edit['UserComputingSkill']); $i++) : ?>
				<div class="other_skills" id=<?php echo "other_skills[".$i."]";?>>
					<?php echo $this->Form->input('UserComputingSkill.'.$i.'.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color">Title</p>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-8 col-sm-6 col-xs-12">
								<span class=" error">
									<?php echo $this->Form->input('UserComputingSkill.'.$i.'.title', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height sel_width', 'autocomplete' => 'off' , 'placeholder' => 'e.g.) Microsoft Illustrator','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;')); ?>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color">Skill</p>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-8 col-sm-6 col-xs-12">
								<span class=" error">
									<?php echo $this->Form->input('UserComputingSkill.'.$i.'.skill', array(
										'type' => 'select',
										'options' => $computer_skill_level ,
										'label' => false,
										'empty'=>'Select skill level',
										'class' => 'form-control select_height selectpicker sel_width',
										'style' =>'border-radius:3px;width: 106%;'
										// 'required' => true
									)); ?>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group btn-delete padding_minus plus_computerskill">
						<span class="btn btn-primary remove_exercise" style="width: 37px;" >
							<i class="fa fa-minus"></i>
						</span>&nbsp;&nbsp;
						<label>Delete skill</label>
					</div>
				</div>
			<?php endfor; ?>
		<?php else : ?>
			<div class="other_skills" id="other_skills[3]">
				<div class="form-group">
					<p class="col-md-4 control-label cv_three_font letter_color">Title</p>
					<div class="col-md-6 selectContainer">
						<div class="input-group col-md-9 col-sm-6 col-xs-12">
							<span class=" error">
								<?php echo $this->Form->input('UserComputingSkill.3.title', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height sel_width', 'autocomplete' => 'off' , 'placeholder' => 'e.g.) Microsoft Illustrator','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;')); ?>
							</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<p class="col-md-4 control-label cv_three_font letter_color">Skill</p>
					<div class="col-md-6 selectContainer">
						<div class="input-group col-md-9 col-sm-6 col-xs-12">
							<span class=" error">
								<?php echo $this->Form->input('UserComputingSkill.3.skill', array(
									'type' => 'select',
									'options' => $computer_skill_level ,
									'label' => false,
									'empty'=>'Select skill level',
									'style' =>'border-radius:3px;width: 106%;',
									'class' => 'form-control select_height selectpicker sel_width'
									// 'required' => true
								)); ?>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group btn-delete padding_minus plus_computerskill" >
					<span class="btn btn-primary remove_exercise" style="width: 37px;">
						<i class="fa fa-minus"></i>
					</span>&nbsp;&nbsp;
					<label>Delete skill</label>
				</div>
			</div>
		<?php endif; ?>
		<div id="language-add-btn" class="plus_computerskill" >
			<span class="btn btn-primary" id="add_skill">
				<i class="fa fa-plus" ></i>
			</span>&nbsp;&nbsp;
			<label>Add skill</label>
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
	$(document).on('click', '#add_skill', function(){
		var cnt = ($('.other_skills').length -1) + 3;
		if ($('.other_skills').length < 10) {
			var add = $(this).parent().prev('#other_skills\\[' + cnt+ '\\]');
			var deleteBtn = '<div class="col-md-2 col-sm-2 col-xs-2" >'+
								'<span class="btn btn-primary remove_exercise">'+
									'<i class="fa fa-minus" ></i>'+
								'</span></div>';
			cnt++;
			add
			.clone()
			.hide()
			.insertAfter(add)
			.attr('id', 'other_skills[' + cnt + ']')
			.find('input, select').each(function(idx, obj) {
				$(obj).attr({
					id: $(obj).attr('id').replace(/\[\d*\]/, '[' + cnt + ']'),
					name: $(obj).attr('name').replace(/\[\d*\]/, '[' + cnt + ']')
				});
				if ($(obj).attr('type') == 'text'){
					$(obj).val('');
				}
				if ($(obj).is("select")){
					$(obj).val('');
				}
				if ($(obj).attr('type') == 'hidden'){
					$(obj).remove();
				}
				$(obj).removeClass('form-error');$(obj).parents('.form-group').removeClass('error has-error');
				$(obj).parent().children('span').remove();
			});
			var clone = $('#other_skills\\[' + cnt + '\\]');
			clone.find('.btn-delete').show();
			clone.slideDown('fast');
		} else {
			window.alert('You can add at most 10 skills.');
		}
	});
	$(document).on('click', '.remove_exercise', function() {
		$(this).parent().parent().remove();
		$(".other_skills").each(function(key, val) {
			$(val).removeAttr('id');
			$(val).attr('id', 'other_skills['+(key+3)+']');
		});
	});
</script>

<style type="text/css">
	.required {
		color: red;
	}
</style>