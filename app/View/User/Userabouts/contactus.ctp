<div class="container" style="padding-top:40px;padding-right: 24px;">
	<div class="contactus_css">
		<div class="Utitle" style="padding-bottom:15px;"><h2>Contact us</h2></div>
		<?php echo $this->Form->create('User', array('type' => 'file', 'class' => ' form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
			<?php echo $this->Form->label('Email', 'Email', array('class' => 'label_padding control-label col-md-2 col-sm-3 col-xs-12'));?>
			<div class="col-md-9 col-sm-6 col-xs-12">
				<?php echo $this->Form->input('email', array('type' => 'text', 'label' => false, 'class' => 'form-control col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','style'=>'width:105%','type' => 'email')); ?>
			</div>
		</div>
		<div class="form-group">
			<?php echo $this->Form->label('Name', 'Name', array('class' => 'label_padding control-label col-md-2 col-sm-3 col-xs-12'));?>
			<div class="col-md-9 col-sm-6 col-xs-12">
				<?php echo $this->Form->input('name', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','style'=>'width:105%')); ?>
			</div>
		</div>
		<div class="form-group">
			<?php echo $this->Form->label('About yourself', 'About yourself', array('class' => 'label_padding control-label col-md-2 col-sm-3 col-xs-12'));?>
			<div class="col-sm-6 col-md-9">
				<?php $options=array('Jobseeker'=>'Jobseeker','Headhunter'=>'Headhunter','Company'=>'Company'); ?>
				<?php echo $this->Form->input('about_myself', array('type'=>'select', 'options'=>$options,'empty'=>'Please choose about yourself', 'label'=>false, 'class' => 'form-control ','style'=>'width:105%')); ?>
			</div>
		</div>

		<div class="form-group">
			<?php echo $this->Form->label('Subject', 'Subject', array('class' => 'label_padding control-label col-md-2 col-sm-3 col-xs-12'));?>
			<div class="col-md-9 col-sm-6 col-xs-12">
				<?php echo $this->Form->input('subject', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','style'=>'width:105%')); ?>
			</div>
		</div>

		<div class="form-group">
			<?php echo $this->Form->label('Message', 'Message', array('class' => 'label_padding control-label col-md-2 col-sm-3 col-xs-12'));?>
			<div class="col-sm-6 col-md-9">
				<?php echo $this->Form->input('message', array('type' => 'textarea', 'label' => false, 'class' => 'form-control ', 'autocomplete' => 'off' , 'placeholder' => '','style'=>'width:105%')); ?>
			</div>
		</div>
		<div class="form-group">
			<?php echo $this->Form->label('', '', array('class' => 'label_padding control-label col-md-2 col-sm-3 col-xs-12'));?>
			<div class="col-sm-6 col-md-9">
				<?php echo $this->Form->button('Send', array('type' => 'submit', 'label' => false, 'class' => 'cv-save', 'autocomplete' => 'off' , 'placeholder' => '','style'=>'width:105%')); ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>