<div class="container">
<!-- 	<div id="signupbox" style="margin-top:20px" class="mainbox col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2 ">
		<div class="panel panel-info w3-hover-shadow" >

			<div class="panel-heading" >
				<h4>Thank you for your  registration!</h4>
			</div> -->
			<div id="signupbox" class="login_box mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
				<div class="sub_box" >
					<div class="Utitle" >
						<h2>Receipt</h2>
					</div>

					<div class="panel-body" >

						<div class="form-group" ></div>
						<div class="form-group" >
							<div class="col-md-10 col-md-offset-1 ">
								<p>Thank you! Your inquiry was duly received. Please note that the reply may take several days</p>
							</div>
						</div>
						<?php echo $this->Html->image('Success.jpg', array('class' => 'img_reg col-md-10 col-sm-12 col-xs-12')); ?>

						<div class="col-md-10 col-md-offset-1 col-xs-12  col-xs-offset-0">
							<?php echo $this->Html->link('Home', array('controller' => 'usertpages', 'action' => 'index'), array('class'=>"success_btn btn btn-info col-md-10 col-sm-12 col-xs-12 ",'style'=> 'width :100%')); ?>
						</div>

					</div>

				</div>

			</div>
		</div>
	</div>