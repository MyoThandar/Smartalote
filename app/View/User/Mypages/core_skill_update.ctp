<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
				<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
					<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
						<h3 >Expected salary, Executive summary, Core skill</h3>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
					<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
						<h3 >Expected salary, Executive summary, Core skill</h3>
					</div>
				</div>
		</div>

		<?php echo $this->Form->input('UserCoreSkill.id', array('type'=>'hidden', 'label'=>false, 'class' =>'form-control')); ?>
			<div class="form-group">
				<p class="col-md-4 control-label cv_three_font letter_color" id="de_title">Expected salary</p>
				<div class="col-md-6 selectContainer">
					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<i class=""></i>
						<span class=" error">
							<?php echo $this->Form->input('UserCoreSkill.expected_salary', array(
								'type' => 'select',
								'options' => $salary_range ,
								'label' => false,
								'empty'=> true,
								'class' => 'form-control cv_one_email select_height',
								'style'=>'border-radius:3px;width: 106%;',
								'required' => true
							)); ?>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<p class="col-md-4 control-label cv_three_font letter_color" id="de_title">Current salary</p>
				<div class="col-md-6 selectContainer">
					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<i class=""></i>
						<span class=" error">
						<?php echo $this->Form->input('UserCoreSkill.current_salary', array(
							'type' => 'select',
							'options' => $salary_range ,
							'label' => false,
							'empty'=> true,
							'class' => 'form-control cv_one_email select_height',
							'style'=>'border-radius:3px;width: 106%;',
							)); ?>
					</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<p class="col-md-4 control-label cv_three_font letter_color" id="de_title">Current Benefits</p>
				<div class="col-md-6 selectContainer">
					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<i class=""></i>
						<span class=" error">
						<?php echo $this->Form->input('UserCoreSkill.current_benefits', array('type' => 'textarea', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;')); ?>
					</span>
					</div>
				</div>
			</div>
		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Availability</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<span class=" error">
						<?php echo $this->Form->input('UserCoreSkill.availability', array(
							'type' => 'select',
							'options' => $availability ,
							'label' => false,
							'empty'=> true,
							'class' => 'form-control cv_one_email select_height',
							'style'=>'border-radius:3px;width: 106%;',
							'required' => true
							)); ?>
					</span>
				</div>
			</div>
		</div>

		<div class="form-group">
			<p class="col-md-4 control-label cv_three_font letter_color">Executive summary</p>
			<div class="col-md-6 selectContainer">
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<span class=" error">
						<?php echo $this->Form->input('UserCoreSkill.executive_summary', array('type' => 'textarea', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;')); ?>
					</span>
				</div>
			</div>
		</div>
		<?php if (!empty($core_skill_info['UserCoreSkill']['core_skill'])) : ?>
			<?php foreach ($core_skill_info['UserCoreSkill']['core_skill'] as $key => $value) : ?>
				<div class="form-group core_skill">
					<p class="col-md-4 control-label cv_three_font letter_color">Core skill</p>
					<div class="col-md-6 selectContainer">
						<div class="input-group col-md-8 col-sm-6 col-xs-12">
							<span class=" error">
								<?php echo $this->Form->input('UserCoreSkill.core_skill.'.$key, array('type' => 'textarea', 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;')); ?>
							</span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="form-group core_skill">
				<p class="col-md-4 control-label cv_three_font letter_color">Core skill</p>
				<div class="col-md-6 selectContainer">
					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<?php echo $this->Form->input('UserSubCoreSkill.0.core_skill', array('type' => 'text', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;border-radius:3px;width: 106%;')); ?>
					</div>

					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<?php echo $this->Form->input('UserSubCoreSkill.1.core_skill', array('type' => 'text', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;')); ?>
					</div>

					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<?php echo $this->Form->input('UserSubCoreSkill.2.core_skill', array('type' => 'text', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;')); ?>
					</div>

					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<?php echo $this->Form->input('UserSubCoreSkill.3.core_skill', array('type' => 'text', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;')); ?>
					</div>

					<div class="input-group col-md-9 col-sm-6 col-xs-12">
						<?php echo $this->Form->input('UserSubCoreSkill.4.core_skill', array('type' => 'text', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' => 'border-color: #C0C0C0;margin-top: 5px;border-radius:3px;width: 106%;')); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

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