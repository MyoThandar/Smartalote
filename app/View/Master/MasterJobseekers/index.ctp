<?php echo $this->Form->create('User', array('User', 'url' => array('controller' => 'masterjobseekers', 'action' => 'search_result'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
	<?php echo $this->Form->input('master_id', array('type' => 'hidden', 'value' => $master_id)); ?>
	<div class="col-sm-5 col-md-5">
		<div class="input-group col-xs-10 col-sm-4 col-lg-10">
			<?php if (!empty($this->params->query['keyword'])) : ?>
			<?php echo $this->Form->input('keyword', array('label' => false,'id' => 'search' , 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Jobseeker name', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
			<?php else : ?>
			<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'search' ,'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Jobseeker name', 'required' => false)); ?>
			<?php endif; ?>
		</div>
	</div>
</div><!-- don't delete this div -->
	<div class="col-xs-14 col-sm-7 col-lg-7" style="margin-top:10px;">
		<p><strong>Personal</strong></p>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="background-color: #D8D8D8;padding-left:25px;padding-top:30px;padding-bottom:20px;">
		<div class="col-sm-5 col-md-6" >
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('age_range', array('type'=>'select', 'options' => $ages,'empty'=>'------------age-------------','label'=>false, 'class' => 'form-control ' ,'required' => false)); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('nationality', array('type'=>'select', 'options' => $nationality,'empty'=>'--------Nationality---------','label'=>false, 'class' => 'form-control ' ,'required' => false)); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('religion', array('type'=>'select', 'options' => $religion,'empty'=>'----------Religion----------','label'=>false, 'class' => 'form-control ' ,'required' => false)); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('gender', array('type'=>'select', 'options' => array(1=>'Male',2 => 'Female'),'empty'=>'----------Gender---------','label'=>false, 'class' => 'form-control ' ,'required' => false)); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('marital_status', array('type'=>'select', 'options' => $marital_status,'empty'=>'-------Marital status-------','label'=>false, 'class' => 'form-control ','required' => false )); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('degree', array('type'=>'select', 'options' =>$education,'empty'=>'---Degree(Eduction)---','label'=>false, 'class' => 'form-control ','required' => false )); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('location', array('type'=>'select', 'options'=>$location ,'empty'=>'-----------Region-----------', 'label'=>false, 'class' => 'form-control ','required' => false)); ?>
			</div>
		</div>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="margin-top:10px;">
		<p><strong>Working Conditions</strong></p>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="background-color: #D8D8D8;padding-left:25px;padding-top:30px;padding-bottom:20px;">
		<div class="col-sm-5 col-md-6" >
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('expected_salary', array('type'=>'select', 'options'=>$salary_range ,'empty'=>'---Excepted salary---', 'label'=>false, 'class' => 'form-control ','required' => false)); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('current_salary', array('type'=>'select', 'options' => $salary_range,'empty'=>'----Current salary----','label'=>false, 'class' => 'form-control ','required' => false )); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('availability', array('type'=>'select', 'options' => $availability,'empty'=>'-------Availability------','label'=>false, 'class' => 'form-control ','required' => false )); ?>
			</div>
		</div>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="margin-top:10px;">
		<p><strong>Current Job</strong></p>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="background-color: #D8D8D8;padding-left:25px;padding-top:30px;padding-bottom:20px;">
		<div class="col-sm-5 col-md-6" >
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('industry_big_id', array('type'=>'select', 'empty' => '-----Industry------','class' => 'form-control', 'options'=>$big_industry, 'label'=>false,'id' => 'industry-big','required' => false)); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
			<?php if ($error): ?>
				<?php echo $this->Form->input('industry_small_id', array('type' => 'select', 'empty' => '----Sub Industry----', 'label' => false, 'class' => 'form-control', 'div' => array('id' => 'small-industry-blank','required' => false))); ?>
			<?php endif; ?>
			<?php foreach ($small_industry as $key => $val): ?>
				<?php echo $this->Form->input('industry_small_id', array('type' => 'select', 'empty' => '----Sub Industry----', 'options' => $val, 'label' => false, 'class' => 'form-control', 'div' => array('class' => 'industry-small', 'id' => 'industry-small-'.$key,'required' => false))); ?>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
				<?php echo $this->Form->input('job_category_id', array('type'=>'select', 'empty' => '---Job Category---','class' => 'form-control col-md-7 col-xs-12', 'options'=>$big_job, 'label'=>false,'id' => 'big-job','required' => false)); ?>
			</div>
		</div>
		<div class="col-sm-5 col-md-6">
			<div class="input-group col-sm-12 col-md-11">
			<?php if ($error): ?>
			<?php echo $this->Form->input('job_category_sub_id', array('type' => 'select', 'empty' => '---Sub Job Category---', 'label' => false, 'class' => 'form-control', 'div' => array('id' => 'small-job-blank','required' => false))); ?>
			<?php endif; ?>
				<?php foreach ($small_job as $key => $val): ?>
					<?php echo $this->Form->input('job_category_sub_id', array('type' => 'select', 'empty' => 'SubJobCategory', 'options' => $val, 'label' => false, 'class' => 'form-control', 'div' => array('class' => 'small-job', 'id' => 'small-job-'.$key,'required' => false))); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="margin-top:10px;">
	<p><strong>Language Skill</strong></p>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="background-color: #D8D8D8;padding-left:25px;padding-top:30px;padding-bottom:20px;">
		<div class="col-sm-7 col-md-8">
			<div class="col-sm-1 col-md-3" >
				<p>English</p>
			</div>
			<div class="col-sm-6 col-md-9" >
				<div class="input-group col-sm-12 col-md-11">
					<?php echo $this->Form->input('eng_level', array('type'=>'select', 'empty' => '---Skill Level---','class' => 'form-control col-md-7 col-xs-12', 'options'=>$language_skill, 'label'=>false,'required' => false)); ?>
				</div>
			</div>


			<div class="col-sm-1 col-md-3" >
				<p>Burmese</p>
			</div>
			<div class="col-sm-6 col-md-9" >
				<div class="input-group col-sm-12 col-md-11">
					<?php echo $this->Form->input('bm_level', array('type'=>'select', 'empty' => '---Skill Level---','class' => 'form-control col-md-7 col-xs-12', 'options'=>$language_skill, 'label'=>false,'required' => false)); ?>
				</div>
			</div>
			<div class="col-sm-1 col-md-3" >
				<p>Chinese</p>
			</div>
			<div class="col-sm-6 col-md-9" >
				<div class="input-group col-sm-12 col-md-11">
					<span class=" error">
						<?php echo $this->Form->input('chn_level', array('type'=>'select', 'empty' => '---Skill Level---','class' => 'form-control col-md-7 col-xs-12', 'options'=>$language_skill, 'label'=>false,'id' => 'chinese','required' => false)); ?>
					</span>
				</div>
			</div>
			<div class="col-sm-1 col-md-3" >
				<p>Japanese</p>
			</div>
			<div class="col-sm-6 col-md-9" >
				<div class="input-group col-sm-12 col-md-11">
					<?php echo $this->Form->input('jp_level', array('type'=>'select', 'empty' => '---Skill Level---','class' => 'form-control col-md-7 col-xs-12', 'options'=>$language_skill, 'label'=>false,'required' => false)); ?>
				</div>
			</div>
			<div class="col-sm-1 col-md-3" >
				<p>Other</p>
			</div>
			<div class="col-sm-6 col-md-9" >
				<div class="input-group col-sm-12 col-md-11">
					<div class="input-group col-sm-12 col-md-12">
					<span class=" error">
						<?php echo $this->Form->input('other', array(
							'type' => 'select',
							'options' => $language,
							'label' => false,
							'empty'=>'---Select Language---',
							'class' => 'form-control selectpicker',
							'required' => false
							)); ?>
					</span>
				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="margin-top:10px;">
	<p><strong>Microsoft Office</strong></p>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="background-color: #D8D8D8;padding-left:25px;padding-top:30px;padding-bottom:20px;">
		<div class="col-sm-7 col-md-8">
			<div class="col-sm-1 col-md-3" >
				<p>Exel </p>
			</div>
			<div class="col-sm-6 col-md-9" >
				<div class="input-group col-sm-12 col-md-11">
					<?php echo $this->Form->input('excel_skill', array('type'=>'select', 'options' => $ms_skill_level,'empty'=>'---Skill Level---','label'=>false, 'class' => 'form-control select_height','required' => false )); ?>
				</div>
			</div>
			<div class="col-sm-1 col-md-3" >
				<p>Word</p>
			</div>
			<div class="col-sm-6 col-md-9" >
				<div class="input-group col-sm-12 col-md-11">
					<?php echo $this->Form->input('word_skill', array('type'=>'select', 'options' => $ms_skill_level,'empty'=>'---Skill Level---','label'=>false, 'class' => 'form-control select_height','required' => false )); ?>
				</div>
			</div>
			<div class="col-sm-1 col-md-3" >
				<p>PowerPoint</p>
			</div>
			<div class="col-sm-6 col-md-9" >
				<div class="input-group col-sm-12 col-md-11">
					<?php echo $this->Form->input('powerpoint_skill', array('type'=>'select', 'options' => $ms_skill_level,'empty'=>'---Skill Level---','label'=>false, 'class' => 'form-control select_height','required' => false )); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-14 col-sm-7 col-lg-7" style="margin-top:10px; margin-left: 413px;">
		<div class="col-sm-1 col-md-2" style="color:#fff;padding-left:10px;">
			<?php echo $this->Form->submit('Search', array('class' =>'btn btn_style col-xs-11 col-lg-12','style'=>'background-color:#5882FA')); ?>
		</div>
		<div class="col-sm-1 col-md-2" style="color:#fff;padding-left:9px;">
			<!-- <a href="">Reset</a> -->
			<?php echo $this->Form->button('Reset', array('class' =>'btn btn_style col-xs-11 col-lg-12','style'=>'background-color:#5882FA', 'type' => 'reset')); ?>
		</div>
	</div>
<?php echo $this->Form->end();?>
