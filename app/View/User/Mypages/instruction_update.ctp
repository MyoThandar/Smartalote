<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3>Special instruction</h3>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3>Special instruction</h3>
				</div>
			</div>
		</div>

		<?php if (!empty($instr_info_edit['UserSpecialInstruction'])): ?>
			<?php foreach ($instr_info_edit['UserSpecialInstruction'] as $key => $value) : ?>
				<div class="apply_instruction" id=<?php echo "apply_instruction[" . $key . "]"; ?>>
					<?php
						echo $this->Form->input('UserSpecialInstruction.' . $key . '.id', array(
							'type'=>'hidden',
							'label'=>false,
							'class' =>'form-control'
						));
					?>
					<div class="form-group" style="margin-bottom: 5px;">
						<div class="col-md-4 control-label cv_three_font letter_color">Title</div>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<span class=" error">
									<?php
										echo $this->Form->input('UserSpecialInstruction.' . $key . '.title', array(
											'type' => 'text',
											'label' => false,
											'class' => 'form-control select_height',
											'autocomplete' => 'off' ,
											'style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;'
										));
									?>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4 control-label cv_three_font letter_color">Detail</div>
						<div class="col-md-6 selectContainer">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<span class=" error">
									<?php
										echo $this->Form->input('UserSpecialInstruction.' . $key . '.detail', array(
											'type' => 'textarea',
											'label' => false,
											'class' => 'form-control select_height',
											'autocomplete' => 'off' ,
											'style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;'
										));
									?>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group btn-delete minus_instruction" >
						<span class="btn btn-primary remove_exercise" style="width: 37px;margin-left: 2px !important;">
							<i class="fa fa-minus"></i>
						</span>&nbsp;&nbsp;
						<label>Delete instruction</label>
					</div>
				</div>
			<?php endforeach; ?>

		<?php else: ?>
			<div class="apply_instruction" id=<?php echo "apply_instruction[0]"; ?>>
				<div class="form-group">
					<p class="col-md-4 control-label cv_three_font letter_color">Title</p>
					<div class="col-md-6 selectContainer">
						<div class="input-group col-md-9 col-sm-6 col-xs-12">
							<span class=" error">
								<?php
									echo $this->Form->input('UserSpecialInstruction.0.title', array(
										'type' => 'text',
										'label' => false,
										'class' => 'form-control select_height',
										'autocomplete' => 'off' ,
										'placeholder' => '',
										'style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;'
									));
								?>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<p class="col-md-4 control-label cv_three_font letter_color">Detail</p>
					<div class="col-md-6 selectContainer">
						<div class="input-group col-md-9 col-sm-6 col-xs-12">
							<span class=" error">
								<?php
									echo $this->Form->input('UserSpecialInstruction.0.detail', array(
										'type' => 'textarea',
										'label' => false,
										'class' => 'form-control select_height',
										'autocomplete' => 'off' ,
										'placeholder' => '',
										'style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;'
									));
								?>
							</span>
						</div>
					</div>
				</div>

				<div class="form-group btn-delete minus_instruction">
					<span class="btn btn-primary remove_exercise " style="width: 37px;margin-left: 2px !important;">
						<i class="fa fa-minus"></i>
					</span>&nbsp;&nbsp;
					<label>Delete instruction</label>
				</div>
			</div>
		<?php endif; ?>

		<div class="form-group language_plus plus_instruction">
			<span class="btn btn-primary cv_five_plus" id="add_qualification" >
				<i class="fa fa-plus"></i>
			</span>&nbsp;&nbsp;
			<label>Add instruction</label>
		</div>

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
	$(document).on('click', '#add_qualification', function(){
		var cnt = $('.apply_instruction').length -1;
		if ($('.apply_instruction').length < 10) {
			var add = $(this).parent().prev('#apply_instruction\\[' + cnt+ '\\]');
			var deleteBtn = '<div class="col-md-2 col-sm-2 col-xs-2" >'+
								'<span class="btn btn-primary remove_exercise">'+
									'<i class="fa fa-minus" ></i>'+
								'</span></div>';
			cnt++;
			add
			.clone()
			.hide()
			.insertAfter(add)
			.attr('id', 'apply_instruction[' + cnt + ']')
			.find('input, textarea').each(function(idx, obj) {
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
				if ($(obj).attr('type') == 'hidden'){
					$(obj).remove();
				}
				$(obj).removeClass('form-error');$(obj).parents('.form-group').removeClass('error has-error');
				$(obj).parent().children('span').remove();
			});
			var clone = $('#apply_instruction\\[' + cnt + '\\]');
			clone.find('.btn-delete').show();
			clone.slideDown('fast');
		} else {
			window.alert('You can add at most 10 instructions.');
		}
	});
	$(document).on('click', '.remove_exercise', function() {
		$(this).parent().parent().remove();
		$(".apply_instruction").each(function(key, val) {
			$(val).removeAttr('id');
			$(val).attr('id', 'apply_instruction['+key+']');
		});
	});
</script>
<style type="text/css">
	@media screen and (min-width: 600px) {

	}
</style>