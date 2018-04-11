<div class="form-group" style="height: 20px;"> </div>
<div class="container" style="border: 1px solid #DCDCDC;">
	<?php
		echo $this->Form->create('CmpHeadhunter', array(
			'url' =>  array('controller' => 'usertpages', 'action' => 'headhunter_add'),
			'type' => 'file',
			'class' => 'form-horizontal form-label-left',
			'inputDefaults' => array('label' => false, 'div' => false),
			'id' => 'demo-form2',
			'autocomplete' => 'off'
		));
	?>

		<h2 class="cv7-name" >
			Headhunter Register
		</h2>

		<!--HeadHunter Name-->
		<div class="form-group">
			<?php
				echo $this->Form->label('headhunter_name', 'Headhunter Name<span class="error">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
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
						'required' => false,
					));
				?>
			</div>

			<div id='headhunterValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The HeadHunter Name.</div>
		</div>

		<!--Phone Number-->
		<div class="form-group" style="border-bottom: none;">
			<?php
				echo $this->Form->label('phone_no', 'Phone Number<span class="error">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<span class=" error">
					<?php
						echo $this->Form->input('company_phone', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '20',
							'id' => 'phoneMain',
							'required' => false,
						));
					?>
				</span>
			</div>

			<div id='phoneMainValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Phone Number.</div>
		</div>

		<!--Email Address-->
		<div class="form-group">
			<?php
				echo $this->Form->label('email', 'Email Address<span class="required">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<span class=" error">
					<?php
						echo $this->Form->input('email', array(
							'type' => 'email',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength'=>'60',
							'id' => 'email',
							'required' => false,
						));
					?>
				</span>
			</div>

			<div id='emailValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Email Address.</div>
		</div>

		<!--Company Name-->
		<div class="form-group">
			<?php
				echo $this->Form->label('Company_name', 'Company Name<span class="required">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-3 col-sm-3 col-xs-8">
				<?php if (($company == 'empty' || $company == '') && !empty($this->request->data)) : ?>
					<?php
						echo $this->Form->input('company_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12 test',
							'id'=>'companyName',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'disabled' => true
						));
					?>

				<?php else : ?>
					<?php
						echo $this->Form->input('company_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12 test',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength'=>'100',
							'id' => 'companyName',
							'required' => false,
						));
					?>

				<?php endif; ?>
			</div>

			<?php
				echo $this->Form->input('independents', array(
					'type' => 'checkbox',
					'id'=>'inde',
					'label' => array('text' =>'independent', 'class' => 'checkbox-label'),
					'format' => array('independent')
				));
			?>

			<div id='companyValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Company Name</div>
		</div>

		<!--Address-->
		<div class="form-group" style="border-bottom: none;">
			<?php
				echo $this->Form->label('location', 'Address<span class="error">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php
					echo $this->Form->input('location', array(
						'type' => 'text',
						'label' => false,
						'class' => 'form-control col-md-7 col-xs-12',
						'autocomplete' => 'off' ,
						'placeholder' => '',
						'maxlength' => '100',
						'id' => 'address',
						'required' => false
					));
				?>
			</div>

			<div id='addressValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Address</div>
		</div>

		<!--Region-->
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-3"></div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<span class=" error">
					<?php
						echo $this->Form->input('region', array(
							'type' => 'select',
							'options' => $location,
							'label' => false,
							'class' => 'form-control'
						));
					?>
				</span>
			</div>
		</div>

		<!--Photo-->
		<div class="form-group">
			<?php
				echo $this->Form->label('logo', 'Your Photo <span class="error">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php if (!empty($image)) : ?>

					<div class="resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
						<?php
							echo $this->Form->input('image', array(
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
								'style' => 'position: absolute;',
								'class' => 'preview',
							));
						?>
					</div>
					<br/>
					<label for="file-7" class="btn btn-default">
						<span></span>
						<strong>
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
							</svg>
							Choose a file&hellip;
						</strong>
					</label>
					<span id="img-name"><?php echo $image; ?></span>

				<?php else : ?>

					<div>
						<img id="previewHolder" alt="Uploaded Image Preview Holder" class="hide" style="position: absolute;" />
					</div>

					<div class="clearfix"></div>

					<label for="file-7" class="btn btn-default">
						<span></span>
						<strong>
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
							</svg>
							Choose a file&hellip;
						</strong>
					</label>
					<span id="img-name"></span>

				<?php endif; ?>

				<?php
					echo $this->Form->input('logo', array(
						'type' => 'file',
						'label' => false,
						'id' => 'file-7',
						'style' => 'display:none',
						'required' => false
					));
				?>
			</div>

			<div id='imageValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose The Image</div>
		</div>

		<!--Education-->
		<div class="form-group">
			<?php
				echo $this->Form->label('Education', 'Education<span class="required">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php
					echo $this->Form->input('education', array(
						'type' => 'select',
						'class' => 'form-control col-md-7 col-xs-12',
						'options' => $education,
						'empty' => 'Final Education',
						'label' => false,
						'id' => 'education',
						'required' => false,
					));
				?>
			</div>

			<div id='educationValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose the Education level.</div>
		</div>

		<!--Industry-->
		<div class="form-group">
			<?php
				echo $this->Form->label('industry', 'Industry<span class="required">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12','style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-3  col-sm-3 col-xs-12">
				<div class="checkboxes">
					<span class=" error">
						<?php
							echo $this->Form->input('industry_big', array(
								'type' => 'select',
								'multiple' => 'checkbox',
								'value' => !empty($industry1) ? $industry1 : '',
								'label' => false,
								'class' => 'multiple-chb',
								'options' => $big_industry,
								'id' => 'industry',
								'required' => false,
							));
						?>
					</span>
				</div>
			</div>

			<div id='industryValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose The Industry.</div>
		</div>

		<!--Password-->
		<div class="form-group">
			<?php
				echo $this->Form->label('password', 'Password<span class="error">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php
					echo $this->Form->input('password', array(
						'type' => 'password',
						'label' => false,
						'class' => 'form-control col-md-7 col-xs-5',
						'autocomplete' => 'off' ,
						'placeholder' => '',
						'maxlength' => '20',
						'minlength' => '8',
						'id' => 'password',
						'required' => false,
					));
				?>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<?php
					echo $this->Form->label('noti', '<span class="required">※ </span>Password must be 8 to 20 digits.', array(
						'class' => 'control-label',
						'style' => 'text-align: left;'
					));
				?>
			</div>

			<div id='passwordValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Password.</div>
		</div>

		<!--Confirm Password-->
		<div class="form-group no-line">
			<?php
				echo $this->Form->label('confirm_password', 'Confirm Password<span class="error">*</span>', array(
					'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
					'style' => 'font-size: 0.9em;'
				));
			?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<span class="error">
					<?php
						echo $this->Form->input('confirm_password', array(
							'type' => 'password',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '20',
							'minlength' => '8',
							'id' => 'passwordConfirm',
							'required' => false,
						));
					?>
				</span>
			</div>

			<div id='passwordConfirmValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Fill Up The Confirm Password.</div>
		</div>

		<div class="form-group">
			<div class="col-md-4 col-md-offset-4 ">
				<?php
					echo $this->Form->button('Register', array(
						'class'=>'btn btn-warning',
						'type'=>'submit',
						'style'=>'width:98% !important;',
						'id' => 'imageSubmit'
					));
				?>
			</div>
		</div>

	<?php echo $this->Form->end(); ?>
</div>

<style type="text/css">
	.error-message,.error, .required{
		color: red;
	}
	.form-group {
		padding-bottom: 10px;
		margin-right: 0px !important;
		margin-left: 0px !important;
	}
	.form-group.no-line {
		border-bottom: none;
	}
	.logo-space{
		margin-left: -65px;
		border:none;
		color:red;
	}
	.logo-space-before{
		margin-left: -14px;
		border:none;
		color:red;
	}
	.space{
		padding-left: 65px;
	}
	.multiple-chb {
		padding-left: 6px;
		position : relative !important;
		font-size: 0.9em;
		color:black;
	}
	input[type=checkbox]{
		/*width : 1.85em;
		height : 1.25em;*/
		margin-right : 3px;
	}

</style>

<script type="text/javascript">
	$('#inde').change(function () {
		var status = this.checked;
		if (status){
			$('#companyName').val('');
			$('#companyName').prop("disabled", true);
		}
		else {
			$('#companyName').prop("disabled", false);
		}
	});

	$(document).ready(function() {
		OnImageLoad();

		$("#file-7").on("change", function(evt){
			readURL(this);
		});

		function readURL(input) {

			// Set the file name
			var file = input.files[0].name;
			if($('#img-name').text() != ""){
				$('#img-name').text(file);
				$('#img-hidden-val').attr('value', file);
			} else {
				$('#img-name').text(file);
				$('#img-hidden-val').attr('value', file);
			}
			$(".resize-img").removeAttr('style');

			// Set the image for preview before upload
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				var targetleft = 0;
				var targettop = 0;
				var t_width = 0;
				var t_height = 0;
				reader.onload = function(e) {
					var image = new Image();
					image.src = e.target.result;
					image.onload = function() {
						var w = this.width;
						var h = this.height;
						var tw = 200;
						var th = 200;
						// compute the new size and offsets
						var result = ScaleImage(w, h, tw, th, true);
						// adjust the image coordinates and size
						t_width = result.width;
						t_height = result.height;
						targetleft = result.targetleft;
						targettop = result.targettop;
						$('#previewHolder').css("width", result.width);
						$('#previewHolder').css('height', result.height);
						$('#previewHolder').attr('src', image.src);
						$('#previewHolder').css("left", targetleft);
						$('#previewHolder').css("top", targettop);
						$('#previewHolder').attr("width", t_width);
						$('#previewHolder').attr("height", t_height);

					};
					$('#previewHolder').parent().attr('class' ,'resize-img').attr('style', 'width: 210px; height: 210px; border: thick solid #666666; overflow: hidden; position: relative;');
					$('#previewHolder').removeClass('hide');
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		function ScaleImage(srcwidth, srcheight, targetwidth, targetheight, fLetterBox) {
			var result = { width: 0, height: 0, fScaleToTargetWidth: true };

			if ((srcwidth <= 0) || (srcheight <= 0) || (targetwidth <= 0) || (targetheight <= 0)) {
				return result;
			}

			// scale to the target width
			var scaleX1 = targetwidth;
			var scaleY1 = (srcheight * targetwidth) / srcwidth;

			// scale to the target height
			var scaleX2 = (srcwidth * targetheight) / srcheight;
			var scaleY2 = targetheight;

			// now figure out which one we should use
			var fScaleOnWidth = (scaleX2 > targetwidth);
			if (fScaleOnWidth) {
				fScaleOnWidth = fLetterBox;
			}
			else {
				fScaleOnWidth = !fLetterBox;
			}

			if (fScaleOnWidth) {
				result.width = Math.floor(scaleX1);
				result.height = Math.floor(scaleY1);
				result.fScaleToTargetWidth = true;
			}
			else {
				result.width = Math.floor(scaleX2);
				result.height = Math.floor(scaleY2);
				result.fScaleToTargetWidth = false;
			}
			result.targetleft = Math.floor((targetwidth - result.width) / 2);
			result.targettop = Math.floor((targetheight - result.height) / 2);
			return result;
		}

		function OnImageLoad() {
			var img = $('.preview');
			if (img.length != 0) {
				// what's the size of this image and it's parent
				var w = parseInt($(img).css("width").replace('px',''));
				var h = parseInt($(img).css("height").replace('px',''));
				var tw = $(img).parent().width();
				var th = $(img).parent().height();
				// compute the new size and offsets
				var result = ScaleImage(w, h, tw, th, true);
				// adjust the image coordinates and size
				img.css("width", result.width);
				img.css('height', result.height);
				$(img).css("left", result.targetleft);
				$(img).css("top", result.targettop);
			}
		}
	});

	$(document).ready(function() {
		//Validation
		$("#imageSubmit").on('click', function(){
			var error = 0;
			var val = [];

			var company = $('#companyName').val();
			var companyDisable = $('#companyName').prop('disabled');
			var address = $('#address').val();
			var image = $('#file-7').val();
			var coImage = '';

			// Image validation not empty
				if ($('#CmpHeadhunterCologo').length) {
					coImage = $('#CmpHeadhunterCologo').val();
				}

				if ($('#img-hidden-val').length) {
					coImage = $('#img-hidden-val').val();
				}

				if ($('#SubHeadhunterCologo').length) {
					coImage = $('#SubHeadhunterCologo').val();
				}

				if (!image && !coImage){
					$('#imageValidate').css('display','block');
					error = 1;
				} else {
					$('#imageValidate').hide();
				}
			// Image validation not empty

			// company
			if (!company && !companyDisable) {
				$('#companyValidate').css('display','block');
				error = 1;
			} else {
				$('#companyValidate').hide();
			}

			// address
			if (!address) {
				$('#addressValidate').css('display','block');
				error = 1;
			} else {
				$('#addressValidate').hide();
			}

			// industry big and small
			if ($('#industry-big').length) {
				var bigIndustry = $('#industry-big').val();

				if (!bigIndustry) {
					$('#industryValidate').css('display','block');
					error = 1;
				} else {

					var smallIndustry = $('#industry-small-' + bigIndustry).children().val();
					if (smallIndustry) {
						$('#industryValidate').hide();
					} else {
						$('#industryValidate').css('display','block');
						error = 1;
					}
				}
			}

			// headhunter
			if ($('#headhunter').length) {
				var headhunter = $('#headhunter').val();

				if (!headhunter) {
					$('#headhunterValidate').css('display', 'block');
					error = 1;
				} else {
					$('#headhunterValidate').hide();
				}
			}

			// education
			if ($('#education').length) {
				var education = $('#education').val();

				if (!education) {
					$('#educationValidate').css('display', 'block');
					error = 1;
				} else {
					$('#educationValidate').hide();
				}
			}

			// industry
			if ($('#industry').length) {
				// get the checked value of the checkboxes by parent's class.
				$('.checkboxes input:checked').each(function(i){
					val[i] = $(this).val();
				});

				if (val.length === 0) {
					$('#industryValidate').css('display', 'block');
					error = 1;
				} else {
					$('#industryValidate').hide();
				}
			}

			// company phone number
			if ($('#phoneMain').length) {
				var phoneMain = $('#phoneMain').val();

				if (!phoneMain) {
					$('#phoneMainValidate').css('display', 'block');
					error = 1;
				} else {
					$('#phoneMainValidate').hide();
				}
			}

			// Reprensitive Position
			if ($('#rPosition').length) {
				var rPosition = $('#rPosition').val();

				if (!rPosition) {
					$('#positionValidate1').css('display', 'block');
					error = 1;
				} else {
					$('#positionValidate1').hide();
				}
			}

			// Reprensitive Name
			if ($('#rName').length) {
				var rName = $('#rName').val();

				if (!rName) {
					$('#nameValidate1').css('display', 'block');
					error = 1;
				} else {
					$('#nameValidate1').hide();
				}
			}

			// Contact Position
			if ($('#cPosition').length) {
				var cPosition = $('#cPosition').val();

				if (!cPosition) {
					$('#positionValidate2').css('display', 'block');
					error = 1;
				} else {
					$('#positionValidate2').hide();
				}
			}

			// Contact Name
			if ($('#cName').length) {
				var cName = $('#cName').val();

				if (!cName) {
					$('#nameValidate2').css('display', 'block');
					error = 1;
				} else {
					$('#nameValidate2').hide();
				}
			}

			// Email not empty and pattern
			if ($('#email').length) {
				var email = $('#email').val();
				if (!email) {
					$('#emailValidate').css('display', 'block');
					error = 1;
				} else {
					if (email.indexOf('@') == -1) {
						$('#emailValidate').css('display', 'block');
						$('#emailValidate').text('Email address is wrong.');
						error = 1;
					} else {
						$('#emailValidate').hide();
					}
				}
			}

			// Contact email
			if ($('#emailAdd').length) {
				var emailAdd = $('#emailAdd').val();
				if (!emailAdd) {
					$('#emailAddValidate').css('display', 'block');
					error = 1;
				} else {
					if (emailAdd.indexOf('@') == -1) {
						$('#emailAddValidate').css('display', 'block');
						$('#emailAddValidate').text('Email address is wrong.');
						error = 1;
					} else {
						$('#emailAddValidate').hide();
					}
				}
			}

			// Number of employee
			if ($('#numberOfEmp').length) {
				var numberOfEmp = $('#numberOfEmp').val();

				if (!numberOfEmp) {
					$('#empValidate').css('display', 'block');
					error = 1;
				} else {
					$('#empValidate').hide();
				}
			}

			// Password
			if ($('#password').length) {
				var password = $('#password').val();
				if (!password) {
					$('#passwordValidate').css('display', 'block');
					error = 1;
				} else {
					$('#passwordValidate').hide();
				}
			}

			// Confirm password
			if ($('#passwordConfirm').length) {
				var passwordConfirm = $('#passwordConfirm').val();
				if (!passwordConfirm) {
					$('#passwordConfirmValidate').css('display', 'block');
					error = 1;
				} else {
					$('#passwordConfirmValidate').hide();
				}
			}

			if (error === 1) {
				// scroll to the top of the page without onload.
				$(document).scrollTop(0);
				return false;
			}
		});
	});
</script>