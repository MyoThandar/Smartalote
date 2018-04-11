<div class="container cv-container mypageedit_container ">
	<?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3 >Qualification</h3>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
				<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
					<h3 >Qualification</h3>
				</div>
			</div>
		</div>


		<?php if (!empty($ql_info_edit['UserQualification'])) : ?>
			<?php foreach ($ql_info_edit['UserQualification'] as $key => $value) : ?>
				<div class="apply_qualification" id=<?php echo "apply_qualification[".$key."]"; ?>>
					<?php echo $this->Form->input('UserQualification.'.$key.'.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color">Name of qualification</p>
						<div class="col-md-6">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<?php echo $this->Form->input('UserQualification.0.qualification_name', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 104%;')); ?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<p class="col-md-4 control-label cv_three_font letter_color">Year/Month<span style="color: red;"> *</span></p>
						<div class="col-md-6">
							<div class="input-group col-md-9 col-sm-6 col-xs-12">
								<div class="col-md-4 form-group">
									<?php echo $this->Form->input('UserQualification.'.$key.'.start_year', array('type'=>'select','id'=>'syear', 'options'=>$year,'empty'=>'Year', 'class' => 'form-control select_height ', 'label'=>false,'style'=>'border-radius:3px;width: 106%;'));?>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-4 form-group">
									<?php echo $this->Form->input('UserQualification.'.$key.'.start_month', array('type'=>'select','id'=>'smonth', 'options'=>$month,'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height ','style'=>'border-radius:3px;width: 106%;')); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group btn-delete padding_minus minus_quali" >
						<span class="btn btn-primary remove_exercise col-md-offset-2">
							<i class="fa fa-minus"></i>
						</span>&nbsp;&nbsp;
						<label>Delete qualification</label>
					</div>

				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="apply_qualification" id=<?php echo "apply_qualification[0]"; ?>>
				<div class="form-group">
					<div class="col-md-4 control-label cv_three_font letter_color">Name of qualification</div>
					<div class="col-md-6">
						<div class="input-group col-md-9 col-sm-6 col-xs-12">
							<?php echo $this->Form->input('UserQualification.0.qualification_name', array('type' => 'text', 'label' => false, 'class' => 'form-control select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;')); ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<p class="col-md-4 control-label cv_three_font letter_color">Year/Month</p>
					<div class="col-md-6">
						<div class="input-group col-md-9 col-sm-6 col-xs-12">
							<div class="col-md-4 form-group">
								<?php echo $this->Form->input('UserQualification.0.start_year', array('type'=>'select','id'=>'syear', 'options'=>$year,'empty'=>'Year', 'class' => 'form-control select_height ', 'label'=>false,'style'=>'border-radius:3px;width: 106%;'));?>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-4 form-group">
								<?php echo $this->Form->input('UserQualification.0.start_month', array('type'=>'select','id'=>'smonth', 'options'=>$month,'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height ','style'=>'border-radius:3px;width: 106%;')); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group btn-delete padding_minus minus_quali">
					<span class="btn btn-primary remove_exercise col-md-offset-2">
						<i class="fa fa-minus"></i>
					</span>&nbsp;&nbsp;
					<label>Delete qualification</label>
				</div>
			</div>
		<?php endif; ?>

		<div id="language-add-btn"  class="plus_quali" >
			<span class="btn btn-primary col-md-offset-3" id="add_qualification">
				<i class="fa fa-plus" ></i>
			</span>&nbsp;&nbsp;
			<label>Add qualification</label>
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
	$(document).on('click', '#add_qualification', function(){
		var cnt = $('.apply_qualification').length - 1;
		if ($('.apply_qualification').length < 15) {
			var add = $(this).parent().prev('#apply_qualification\\[' + cnt+ '\\]');
			var deleteBtn = '<div class="form-group btn-delete" style="margin-left: 642px;">'+
								'<span class="btn btn-primary remove_exercise">'+
									'<i class="fa fa-minus"></i>'+
								'</span>'+
								'<label>Delete qualification</label>'+
							'</div>';
			cnt++;
			add
			.clone()
			.hide()
			.insertAfter(add)
			.attr('id', 'apply_qualification[' + cnt + ']')
			.find('input, select').each(function(idx, obj) {
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
				}
				$(obj).removeClass('form-error');$(obj).parents('.form-group').removeClass('error has-error');
				$(obj).parent().children('span').remove();
			});
			var clone = $('#apply_qualification\\[' + cnt + '\\]');
			clone.find('.btn-delete').show();
			clone.slideDown('fast');
		} else {
			window.alert('You can add at most 15 qualifications.');
		}
	});

	$(document).on('click', '.remove_exercise', function() {
		$(this).parent().parent().remove();
		$(".apply_qualification").each(function(key, val) {
			$(val).removeAttr('id');
			$(val).attr('id', 'apply_qualification['+key+']');
		});
	});
</script>