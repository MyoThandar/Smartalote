<div class="container cv-container mypageedit_container">
	<?php echo $this->Form->create('User', array('type' => 'file', 'class' => ' form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'contact_form', 'autocomplete' => 'off')); ?>
		<div class="form-group">
				<div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm mypageedit_title">
					<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
						<h3 >Personal Information</h3>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 hidden-md hidden-lg mypageedit_title">
					<div class="col-md-12 col-sm-12 col-xs-12 cv7-title" >
						<h3 >Personal Information</h3>
					</div>
				</div>

		</div>

		<!-- Image Upload -->
		<div class = "form-group">
			<?php echo $this->Form->label('logo', 'Profile Photo
					', array('class' => 'control-label col-md-4 col-sm-3 col-xs-12 letter_color')); ?>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class = "resize-img" style="width: 200px; height: 200px; border: thick solid #084B8A; overflow: hidden; position: relative;">
					<?php if ($userInfo['User']['image']) : ?>
						<?php echo $this->Form->input('image',array('type' => 'hidden', 'label' => false,'value' => $userInfo['User']['image'])); ?>
						<?php echo $this->Html->image($userInfo['User']['image_url'], array('id' => 'previewHolder', "style" => "position: absolute;", "class" => "preview")); ?>
					<?php else: ?>
						<img src="/img/user/profil.jpg" id = "previewHolder" style="position: absolute;"/>
					<?php endif; ?>
				</div>
				<div class="clearfix"></div>
				<label for="file-7" class="btn btn-default" style="margin-top: 1%;"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label> <span id="img-name"></span>
				<?php echo $this->Form->input('image',array('type' => 'file', 'label' => false, 'id' => 'file-7', 'style' => 'display:none')); ?>
				<span id = 'image-message' ></span>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-4 control-label cv_three_font letter_color">Name<span class = "required"> *</span></div>
			<div class="col-md-6">
				<div class="input-group col-md-9 col-sm-6 col-xs-12" >
					<?php echo $this->Form->input('name', array('type' => 'text', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' =>'border-radius:3px;width: 106%;','maxlength' => 45)); ?>
				</div>
			</div>
		</div>

		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Gender<span class = "required"> *</span></p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12"><!-- input-group -->
					<?php echo $this->Form->input('gender', array('type' => 'select', 'options' => array(1=>'Male',2 => 'Female'), 'label' => false,'empty'=>'Gender', 'label'=>false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' , 'placeholder' => '','style' =>'border-radius:3px;width: 106%;')); ?>
				</div>
			</div>
		</div>

		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Birthday<span class = "required"> *</span></p>
			<div class="col-md-8" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12" >
					<div class="col-md-2 form-group" >
						<?php echo $this->Form->input('day', array('type'=>'select', 'options'=>$day, 'empty'=>'Day', 'label'=>false, 'class' => 'form-control select_height day_width ','style'=>'border-radius:3px;')); ?>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-2 form-group month_pad ">
						<?php echo $this->Form->input('month', array('type'=>'select', 'options'=>$month, 'empty'=>'Month', 'label'=>false, 'class' => 'form-control select_height day_width','style'=>'border-radius:3px')); ?>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-2 form-group year_pad" >
						<?php echo $this->Form->input('year', array('type'=>'select', 'options'=>$birthyear, 'empty'=>'Year', 'class' => 'form-control select_height day_width', 'label'=>false,'style'=>'border-radius:3px')); ?>
					</div>
				</div>
			</div>
			<p class="col-md-4 control-label cv_three_font letter_color">Nationality</p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('nationality', array('type' => 'select', 'options' =>$nationality, 'label' => false,'empty'=>'Nationality', 'label'=>false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' ,'style' =>'border-radius:3px;width: 106%;','maxlength' => 35)); ?>
				</div>
			</div>
		</div>

		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Address<span class = "required">  *</span></p>
			<div class="col-md-6" >
				<div class=" input-group col-md-9 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('location', array(
							'type' => 'select',
							'options' =>$location,
							'required' => true,
							'label' => false,
							'empty'=>'Location',
							'label'=>false,
							'class' => 'form-control cv_one_email select_height',
							'autocomplete' => 'off',
							'style' =>'border-radius:3px;width: 106%;'
						));
					?>
					<?php
						echo $this->Form->input('address', array(
							'type' => 'textarea',
							'label' => false,
							'required' => true,
							'class' => 'form-control cv_one_email select_height',
							'placeholder' => 'Address',
							'autocomplete' => 'off' ,
							'style' =>'border-radius:3px;margin-top:15px;width: 106%;',
							'maxlength' => 100
						));
					?>
				</div>
			</div>
		</div>

		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Phone<span class = "required"> *</span></p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('phone_number', array(
							'type' => 'text',
							'required' => true,
							'label' => false,
							'class' => 'form-control cv_one_email select_height',
							'autocomplete' => 'off',
							'maxlength' => 20,
							'style' =>'border-radius:3px;width: 106%;'
						));
					?>
				</div>
				<div class="col-md-12" style="margin-top: 10px;">
					<div  id = "check_character" style="display: none;">
						<span >Please choose valid Phone Number!</span>
					</div>
					<div  id = "least_three" style="display: none;">
						<span >Please enter at least 8 Number!</span>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Email</p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('email', array('type' => 'email', 'label' => false, 'class' => 'form-control cv_one_email select_height', 'value' => !empty($email) ? $email : '', 'autocomplete' => 'off' ,'readonly' => true,'style' =>'border-radius:3px;width: 106%;')); ?>
				</div>
			</div>
		</div>

		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Religion</p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('religion', array('type' => 'select', 'options' =>$religion, 'label' => false,'empty'=>'Religion', 'label'=>false, 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' ,'style' =>'border-radius:3px;width: 106%;')); ?>
				</div>
			</div>
		</div>

		<div class="form-group" >
			<p class="col-md-4 control-label cv_three_font letter_color">Marital Status</p>
			<div class="col-md-6" >
				<div class="input-group col-md-9 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('marital_status', array('type' => 'select', 'options' =>$marital_status, 'label' => false,'empty'=>'Marital status', 'class' => 'form-control cv_one_email select_height', 'autocomplete' => 'off' ,'style' =>'border-radius:3px;width: 106%;')); ?>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-sm-6 col-xs-12 btn_save_cancel" >
			<div class="col-md-3"></div>
			<div class="col-md-3 btn_cancel">
				<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'mypages', 'action' => 'mypage'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'cv-cancel')); ?>
			</div>
			<div class="hidden-md hidden-lg height_btn" ></div>
			<div class="col-md-3 btn_save">
				<?php echo $this->Form->button('Save', array('type' => 'submit', 'id' => 'save' , 'class' => 'cv-save', 'autocomplete' => 'off')); ?>
			</div>
		</div>

	<?php echo $this->Form->end(); ?>
</div>

<style type="text/css">
	.form-group.internal {
		margin-bottom: 0;
	}
	.indent-small {
		margin-left: 5px;
	}
	.attachment {
		margin-top: 30px;
	}

	.attachment ul {
		width: 100%;
		list-style: none;
		padding-left: 0;
		display: inline-block;
		margin-bottom: 30px;
	}

	.attachment ul li {
		float: left;
		width: 150px;
		margin-right: 10px;
		margin-bottom: 10px;
	}

	.attachment ul li img {
		height: 150px;
		border: 1px solid #ddd;
		padding: 5px;
		margin-bottom: 10px;
	}

	.attachment ul li span {
		float: right;
	}

	.attachment .file-name {
		float: left;
	}

	.attachment .links {
		width: 100%;
		display: inline-block;
	}

	button.btn, a.btn {
		margin: 0px 5px;
		transition: all 0.5s;
	}

	.error-message , .required {
		color : red;
	}

</style>

<script type="text/javascript">
	//validation phone number
	$("#save").click(function() {
		if ($("#UserPhoneNumber").val() != "") {
			if(!($.isNumeric($('#UserPhoneNumber').val()))){
				$("#least_three").hide();
				$("#check_character").show();
				$("#check_character").children().css({"color": "red"});
				$("#check_character").children().css({"margin-left": "-11px"});
				return false;
			}
			if (($("#UserPhoneNumber").val().length) < 8) {
				$("#check_character").hide();
				$("#least_three").show();
				$("#least_three").children().css({"color": "red"});
				$("#least_three").children().css({"margin-left": "-11px"});
				return false;
			}
		}
	});

	$(document).ready(function() {
		OnImageLoad();
		//image required alert
		$("#imageSubmit").click(function(){
			var name = $('#file-7').val().split('\\').pop();
			name = name.split('.')[0];
			if (!name) {
				alert("Please choose photo !!");
			}
		});

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

		if ($('.error-message').length) {

			// get the parent div.
			var par = $('.error-message').parent().parent();
			// detach the div.
			var validateMessage = $('.error-message').detach();
			validateMessage.addClass('col-md-12 col-xs-12');
			validateMessage.css('margin-top', '-2%');
			validateMessage.css('margin-left', '-3%');

			// add detached div to its corresponding parent div.
			$.each(par, function(index, value) {
				par[index].append(validateMessage[index]);
			});
		}

	});

</script>