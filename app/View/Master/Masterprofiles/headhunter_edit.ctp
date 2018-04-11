<?php echo $this->Session->flash(); ?>
<div class="x_panel">
	<div class="x_title">
		<h2>Headhunter Profile Edit</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
		<?php echo $this->Form->create('CmpHeadhunter', array('type' => 'file', 'class' => 'form-horizontal form-label-left', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'demo-form2', 'autocomplete' => 'off')); ?>

			<div class="form-group">
				<?php
					echo $this->Form->label('id', 'Headhunter ID', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('company_id', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'disabled' => true,
							'value' => $companyId,
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('headhunter_name', 'Headhunter Name<span class="required" >*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('headhunter_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength'=>'100',
							'id' => 'headhunter',
							'required' => false
						));
					?>
				</div>
				<div id='headhunterValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The HeadHunter Name.</div>
			</div>

			<div class="form-group" style="border-bottom: none; ">
				<?php
					echo $this->Form->label('phone_no', 'Phone Number', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('company_phone', 'Main<span class="required">*</span>', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-5'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<span class=" error">
						<?php
							echo $this->Form->input('company_phone', array(
								'type' => 'text',
								'label' => false,
								'class' => 'form-control col-md-7 col-xs-5',
								'autocomplete' => 'off' ,
								'placeholder' => '',
								'maxlength'=>'20',
								'id' => 'phoneMain',
								'required' => false
							));
						?>
					</span>
				</div>
				<div id='phoneMainValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Phone Number.</div>
			</div>
			<div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php
						echo $this->Form->label('mobile', 'Sub', array(
							'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
						));
					?>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5">
					<span class=" error">
						<?php
							echo $this->Form->input('mobile', array(
								'type' => 'text',
								'label' => false,
								'class' => 'form-control col-md-7 col-xs-12',
								'autocomplete' => 'off' ,
								'placeholder' => '',
								'maxlength'=>'20'
							));
						?>
					</span>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('email', 'Email Address<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<span class=" error">
						<?php
							echo $this->Form->input('email', array(
								'type' => 'text',
								'label' => false,
								'class' => 'form-control col-md-7 col-xs-12',
								'autocomplete' => 'off' ,
								'placeholder' => '',
								'maxlength'=>'60',
								'id' => 'emailAdd',
								'required' => false
							));
						?>
					</span>
				</div>
				<div id='emailAddValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Email Address.</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('Company_name', 'Company Name<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-6">

					<?php if ($company == 'empty') : ?>
						<?php echo $this->Form->input('company_name', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12 test','id'=>'companyName', 'autocomplete' => 'off' , 'placeholder' => '','disabled' => true,'required' => false)); ?>

					<?php else: ?>

						<?php if ($cmp_data['CmpHeadhunter']['independents'] == 1) : ?>
							<?php
								echo $this->Form->input('company_name', array(
									'type' => 'text',
									'label' => false,
									'class' => 'form-control col-md-7 col-xs-12 test',
									'id'=>'companyName',
									'autocomplete' => 'off' ,
									'placeholder' => '',
									'disabled' => true,
									'required' => false,
									'maxlength'=>'100'
								));
							?>

						<?php else: ?>
							<?php
								echo $this->Form->input('company_name', array(
									'type' => 'text',
									'label' => false,
									'class' => 'form-control col-md-7 col-xs-12 test',
									'id'=>'companyName',
									'autocomplete' => 'off' ,
									'placeholder' => '',
									'required' => true,
									'maxlength'=>'100',
									'id'=>'companyName',
									'required' => false
								));
							?>
						<?php endif; ?>

					<?php endif; ?>
				</div>
				<?php
					echo $this->Form->input('independents', array(
						'type' => 'checkbox',
						'id'=>'inde',
						'label' => 'independent' ,
						'format' => array('independent')
					));
				?>
				<div id='companyValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Company Name</div>
			</div>

			<div class="form-group" style="border-bottom: none; ">
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
				<div id='addressValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Address</div>
			</div>

			<div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-3"></div>
				<div class="col-md-3 col-sm-3 col-xs-3">
				<span class=" error">
					<?php
						echo  $this->Form->input('region', array(
							'type'=>'select',
							'options'=>$location,
							'label'=>false,
							'class' => 'form-control'
						));
					?>
				</span>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('logo', 'Photo <span class="required">*</span>', array(
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

							<?php if ($cmp_data['CmpHeadhunter']['logo']) : ?>
								<?php
									echo $this->Form->input('cologo',array(
										'type' => 'hidden',
										'label' => false,
										'value' => $cmp_data['CmpHeadhunter']['logo']
									));
								?>
								<?php
									echo $this->Html->image($cmp_data['CmpHeadhunter']['logo'], array(
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
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('Education', 'Education<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('education', array(
							'type'=>'select',
							'class' => 'form-control col-md-7 col-xs-12',
							'options'=>$education,
							'empty' => 'Final Education',
							'label'=>false,
							'id' => 'education',
							'required' => false
						));
					?>
				</div>
				<div id='educationValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose the Education level.</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('industry', 'Industry<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<div class="checkboxes">
						<?php
							echo $this->Form->input('industry_big', array(
								'type'=>'select',
								'multiple'=>'checkbox',
								'label'=> false,
								'value' => empty($industry1) ? $industry_big : $industry1 ,
								'class'=>'multiple-chb',
								'options'=> $big_industry,
								'id' => 'industry',
								'required' => false
							));
						?>
					</div>
				</div>
				<div id='industryValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose The Industry.</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('Establishment', 'Establishment', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-1">
						<?php echo  $this->Form->label('day', 'Day'); ?>
					</div>
					<div class="col-md-3 headhunday" >
						<?php echo  $this->Form->input('day', array('type'=>'select', 'options'=>$day,'empty'=>'Day', 'label'=>false, 'class' => 'form-control' ,'style'=>'width:80px;')); ?>
					</div>
					<div class="col-md-2">
						<?php echo $this->Form->label('month', 'Month '); ?>
					</div>
					<div class="col-md-3 headhun_month"  >
						<?php echo  $this->Form->input('month', array('type'=>'select', 'options'=>$month,'empty'=>'Mon', 'label'=>false, 'class' => 'form-control')); ?>
					</div>
					<div class="col-md-1">
						<?php echo  $this->Form->label('year', 'Year'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->input('year', array('type'=>'select', 'options'=>$year,'empty'=>'Year', 'class' => 'form-control', 'label'=>false)); ?>
					</div>
				</div>
			</div>

			<div class="form-group" style="border-bottom: none;">
				<?php echo $this->Form->label('Language skill', 'Language Skill', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php echo $this->Form->label('burmese', 'Burmese', array('class' => 'control-label col-md-3 col-sm-3 col-xs-5')); ?>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
					<span class=" error">
						<?php echo $this->Form->input('burmese_level', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							)); ?>
					</span>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php echo $this->Form->label('english', 'English', array('class' => 'control-label col-md-3 col-sm-3 col-xs-5')); ?>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
					<span class=" error">
						<?php echo $this->Form->input('english_level', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							)); ?>
					</span>
				</div>
			</div>

			<div class="form-group" style="border-bottom: none;">
				<?php echo $this->Form->label(' ', ' ', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php echo $this->Form->label('Japan', 'Japanese', array('class' => 'control-label col-md-3 col-sm-3 col-xs-5')); ?>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
					<span class=" error">
						<?php echo $this->Form->input('japanese_level', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							)); ?>
					</span>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<?php echo $this->Form->label('Chinese', 'Chinese', array('class' => 'control-label col-md-3 col-sm-3 col-xs-5')); ?>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
					<span class=" error">
						<?php echo $this->Form->input('chinese_level', array(
							'type' => 'select',
							'options' => $language_skill ,
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							)); ?>
					</span>
				</div>
			</div>

			<div class="form-group" style="border-bottom: none;">
				<?php echo $this->Form->label(' ', ' ', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-1 col-sm-1 col-xs-12">
					<?php echo $this->Form->label('Other', 'Other', array('class' => 'control-label col-md-3 col-sm-3 col-xs-5')); ?>
				</div>
			</div>

			<?php
				$i = 0;
				if (!empty($cmp_data['HeadhunterOtherLanguage']) || !empty($requestData['HeadhunterOtherLanguage'])) :
					$data['HeadhunterOtherLanguage'] = !empty($requestData['HeadhunterOtherLanguage']) ? $requestData['HeadhunterOtherLanguage'] : $cmp_data['HeadhunterOtherLanguage'];
				endif;
			?>
			<?php if (!empty($data)): ?>
				<?php foreach ($data['HeadhunterOtherLanguage'] as $key => $value) : ?>
					<div class="form-group" <?php if ($i == 0) echo "id=language"; ?> style="border-bottom: none; ">
					<?php echo $this->Form->label(' ', ' ', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
					<div class="col-md-2 col-sm-2 col-xs-2 main_lang">
						<span class=" error">
							<?php echo $this->Form->input('HeadhunterOtherLanguage.'.$i.'.lang_type', array(
								'type' => 'select',
								'options' => $language,
								'label' => false,
								'value' => $value['lang_type'],
								'empty' => 'select language',
								'class' => 'form-control col-md-7 col-xs-5 lang_type',
								)); ?>
						</span>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-2">
						<span class=" error">
							<?php echo $this->Form->input('HeadhunterOtherLanguage.'.$i.'.lang_skill', array(
								'type' => 'select',
								'options' => $language_skill ,
								'label' => false,
								'value' => $value['lang_skill'],
								'empty' => 'Select Level',
								'class' => 'form-control col-md-7 col-xs-5',
								)); ?>
						</span>
					</div>
					<?php if (!empty($i)) :?>
						<div class="col-md-2 col-sm-2 col-xs-2" >
							<span class="btn btn-primary remove_exercise">
								<i class="fa fa-minus" ></i>
							</span>
						</div>
					<?php endif; ?>
					<div class="btn-delete"></div>
				</div>
				<?php $i++; ?>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="form-group" id="language">
					<?php echo $this->Form->label(' ', ' ', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
					<div class="col-md-2 col-sm-2 col-xs-2 main_lang">
						<span class=" error">
							<?php echo $this->Form->input('HeadhunterOtherLanguage.0.lang_type', array(
								'type' => 'select',
								'options' => $language,
								'label' => false,
								'empty' => 'select language',
								'class' => 'form-control col-md-7 col-xs-5 lang_type',
								)); ?>
						</span>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-2">
						<span class=" error">
							<?php echo $this->Form->input('HeadhunterOtherLanguage.0.lang_skill', array(
								'type' => 'select',
								'options' => $language_skill ,
								'label' => false,
								'empty' => 'Select Level',
								'class' => 'form-control col-md-7 col-xs-5',
								)); ?>
						</span>
					</div>
					<div class="btn-delete"></div>
				</div>
			<?php endif; ?>

			<div class="form-group" id="language-add-btn">
				<?php echo $this->Form->label(' ', ' ', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-2">
					<span class="btn btn-primary" id = "add-language">
						<i class="fa fa-plus"></i>
					</span>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('About', 'Shout
				', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('about', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'300')); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php echo $this->Form->label('noti', '<span class="required">※ </span>Post your latest situation, emotion or what you want to notice to jobseekers.', array('class' => 'control-label','style' => 'text-align: left;')); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label('profile', 'Profile', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('profile', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'3000')); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php echo $this->Form->label('noti', '<span class="required">※ </span> Describe your academic background and achievement as a headhunter.', array('class' => 'control-label','style' => 'text-align: left;')); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label('self_pr', 'Self PR', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('self_pr', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'300')); ?>
				</div>
			</div>

			<?php if ($cbox_error == true): ?>
				<div id="wizard" class="div_pass" style="display: block;">
			<?php else: ?>
				<div id="wizard" class="div_pass" >
			<?php endif; ?>
				<div class="form-group">
					<?php echo $this->Form->label('password', 'Password', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<span class="error">
							<?php echo $this->Form->input('password_update', array('type' => 'password', 'label' => false, 'class' => 'form-control col-md-7 col-xs-5', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'20')); ?>
						</span>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
					<?php echo $this->Form->label('noti', '<span class="required">※ </span>Password must be 8 and 20 digits . ', array('class' => 'control-label','style' => 'text-align: left;')); ?>
				</div>
				</div>
				<div class="form-group no-line">
					<?php echo $this->Form->label('confirm_password', 'Confirm Password', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<span class="error">
							<?php echo $this->Form->input('confirm_password_update', array('type' => 'password', 'label' => false, 'class' => 'form-control col-md-7 col-xs-5', 'autocomplete' => 'off' , 'placeholder' => '','maxlength'=>'20', 'required' => false)); ?>
						</span>
					</div>
				</div>
			</div>
			<div id="btn" class="pass_checkbox">
				<input type="checkbox" id='cbox'>
				&nbsp;<label>If you want to change password,check this button</label>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'masterprofiles', 'action' => 'headhunterBrowse',$cmp_data['CmpHeadhunter']['id']), array('onclick' => 'return confirm(" Do you want to cancel ? ")', 'class' => 'btn btn-gray btn-sm')); ?>
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
	.error, .required{
		color: red;
	}
	.form-group {
		padding-bottom: 10px;
		border-bottom: 1px solid #D9DEE4;
	}
	.form-group.no-line {
		border-bottom: none;
	}
	input[type=checkbox]{
		/*width : 1.85em;
		height : 1.25em;*/
		margin-right : 3px;
	}
</style>

<script type="text/javascript">
	$(function () {
		$('#inde').change(function () {
		var status = this.checked;
		if (status){
			$('#companyName').val('');
			$('#companyName').prop("disabled", true);
		}
		else
			$('#companyName').prop("disabled", false);
		})
	})

	$(document).ready(function(){
		// Sorting the options of the select boxes
		$('.lang_type').each(function(){
			var this_val = $(this).val();
			$(this).html($(this).children().sort(function(x, y){
				return $(x).val() < $(y).val() ? -1 : 1;
			}));
			this.value = this_val;
		});

		// back up of the first select box
		original = $('.lang_type').first().clone();

		// back up of the first select box's options
		options = $('.lang_type:first > option').clone();

		// Remove all options except selected options of all select boxes
		var val = 0;
		var value = [];
		$( "select.lang_type" ).each(function() {
			if ($('select.lang_type').length != 1){
				$(this).children('option').not('option:selected').remove();
			}
		});

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

	$(document).on('click', '#add-language', function(){

		// Clone div
		var language = $('#language').last().clone();

		// Get the selected options of all of the select boxes
		var selected_value = [];
		$('.lang_type').each(function(){
			selected_value[selected_value.length] = $(this).val();
		});

		// Removing the selected options of other select boxes
		language.children('.main_lang').find('.lang_type').children('option').not(':first').remove();
		$.each(options, function(i, selectData) {
			if ((selected_value.indexOf(selectData.value)) == -1) {
				language.children('.main_lang').find('.lang_type').append($("<option>",{
				value: selectData.value,
				text: selectData.text
				}));
			}
		});

		var time = new Date().getTime();
		var deleteBtn = '<div class="col-md-2 col-sm-2 col-xs-2" >'+
							'<span class="btn btn-primary remove_exercise">'+
								'<i class="fa fa-minus" ></i>'+
							'</span></div>';

		// For Skill and Type
		language.find('select').each(function() {

			// assign replace name of skill
			var select1 = "data[HeadhunterOtherLanguage][0][lang_skill]";
			var select2 = "data[HeadhunterOtherLanguage]["+time+"][lang_skill]";

			// assign replace name of type
			var select3 = "data[HeadhunterOtherLanguage][0][lang_type]";
			var select4 = "data[HeadhunterOtherLanguage]["+time+"][lang_type]";

			// initialize empty value after clone
			$(this).val('');

			// Replace Skill select1 to select2
			var changedName1 = $(this).attr('name').replace(select1, select2);
			$(this).attr('name', changedName1);

			// Replace Type select3 to select4
			var changedName2 = $(this).attr('name').replace(select3, select4);
			$(this).attr('name', changedName2);
		});

		// Set delete btn
		language.append(deleteBtn).before('.btn-delete');
		$("#language-add-btn").before(language);
	});

	// Removing the changed option from the other select boxes
	$(document).on('change', '.lang_type', function(){
		$('.lang_type').not(this).find('option[value='+$(this).val()+']').remove();
	});

	var previous_value;
	var previous_text;
	var select_index;

	// Getting the selected option of the box focused
	$(document).on('focus', 'select.lang_type', function () {
		if (this.value != undefined){
			previous_value = this.value;
			previous_text = $(this).children('option:selected').text();
			select_index = $('select.lang_type').index(this);
		}
	}).on('change','select.lang_type',function() {
	// Arranging the options if the user change the selected options
		if ($(this).val() == "") {
			// Appending the options changed to the other select boxes
			$('select.lang_type').not(this).append($("<option>",{
				value: previous_value,
				text: previous_text
			}));
			original.append($("<option>",{
				value: previous_value,
				text: previous_text
			}));

			// Sorting the options of the select boxes
			$('.lang_type').each(function(){
				var this_val = $(this).val();
				$(this).html($(this).children().sort(function(x, y){
					return $(x).val() < $(y).val() ? -1 : 1;
				}));
				this.value = this_val;
			});
		} else {
			$('.lang_type').not(this).find('option[value='+$(this).val()+']').remove();
			if (select_index === $('.lang_type').index(this)){
				if (previous_value != ""){
					// Appending the options changed to the other select boxes
					$('select.lang_type').not(this).append($("<option>",{
					value: previous_value,
					text: previous_text
					}));
					original.append($("<option>",{
					value: previous_value,
					text: previous_text
					}));
				}

				// Sorting the options of the select boxes
				$('.lang_type').each(function(){
					var this_val = $(this).val();
					$(this).html($(this).children().sort(function(x, y){
						return $(x).val() < $(y).val() ? -1 : 1;
					}));
					this.value = this_val;
				});
			}
		}
		previous_value = this.value;
		previous_text = $(this).children('option:selected').text();
	});

	$(document).on('click', '.remove_exercise', function() {
		// Getting the value and text of the selected option of the deleted box
		detached1 = $(this).parent().siblings('.main_lang').find('select.lang_type').val();
		detached2 = $(this).parent().siblings('.main_lang').find('select.lang_type').children('option:selected').text();

		// Deleting the the whole group of elements
		$(this).parent().parent().remove();

		// Appending the deleted option to the other select boxes
		if (detached1 != ""){
			$('select.lang_type').append($("<option>",{
				value: detached1,
				text: detached2
			}));
		}

		// Sorting the options of the select boxes
		$('.lang_type').each(function(){
			var this_val = $(this).val();
			$(this).html($(this).children().sort(function(x, y){
				return $(x).val() < $(y).val() ? -1 : 1;
			}));
			this.value = this_val;
		});
	});

	// Removing the changed option from the other select boxes
	$(document).on('change', '.lang_type', function(){
		$('.lang_type').not(this).find('option[value='+$(this).val()+']').remove();
	});

</script>