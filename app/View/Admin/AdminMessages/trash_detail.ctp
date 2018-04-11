<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
	<?php echo $this->Session->flash(); ?>
		<div class="x_panel" style='width: 1060px'>
			<div class="x_title">
				<h2>Message</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="mail-box">
					<aside class="sm-side">
						<div class="inbox-body">
								<a href="#myModal" data-toggle="modal"  title="Compose"  class="btn btn-compose">
									New Message
								</a>
								<!-- Compose Modal -->
								<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
										<div class="modal-dialog">
												<div class="modal-content">
														<div class="modal-header">
																<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
																<h4 class="modal-title">New Message</h4>
														</div>
														<div class="modal-body">
																<?php echo $this->Form->create('Message', array(
																	'url' => array(
																		'controller' => 'adminmessages',
																		'action' => 'composeMessage'
																	),
																	'class' => 'form-horizontal',
																	'label' => false,
																	'role' => 'form'
																)); ?>
																		<div class="form-group">
																			<label class="col-lg-2 control-label">To</label>
																			<div class="col-lg-10">
																					<?php echo $this->Form->input('to', array(
																						'label' => false,
																						'options' => $data,
																						'multiple' => 'multiple',
																						'class' => 'form-control js-example-basic-multiple',
																						'required' => true
																					)); ?>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-lg-2 control-label">Subject</label>
																			<div class="col-lg-10">
																				<?php echo $this->Form->input('subject', array(
																					'label' => false,
																					'class' => 'form-control',
																					'required' => true
																				)); ?>
																			</div>
																		</div>

																		<div class="form-group">
																			<label class="col-lg-2 control-label">Message</label>
																			<div class="col-lg-10">
																				<?php echo $this->Form->input('message_body', array(
																					'type' => 'textarea',
																					'label' => false,
																					'rows' => 10,
																					'cols' => 30,
																					'class' => 'form-control',
																					'required' => true
																				)); ?>
																			</div>
																		</div>

																		<div class="form-group">
																			<div class="col-lg-offset-2 col-lg-10">
																				<?php echo $this->Form->button('Send', array('type' => 'submit', 'class' => 'btn btn-send')); ?>
																			</div>
																		</div>
																<?php echo $this->Form->end(); ?>
														</div>
												</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
						</div>
						<ul class="inbox-nav inbox-divider">
								<li>
									<?php echo $this->Html->link('<i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right"></span>', array('controller' => 'adminmessages', 'action' => 'index'), array('class' => 'send', 'escape' => false)); ?>
									</a>
								</li>
								<li>
										<?php echo $this->Html->link('<i class="fa fa-envelope-o"></i> Outbox', array('controller' => 'adminmessages', 'action' => 'sentMessage'), array('class' => 'send', 'escape' => false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class=" fa fa-trash-o"></i> Trash', array('controller' => 'adminmessages', 'action' => 'trashMessage'), array('class' => 'send', 'escape' => false)); ?>
								</li>
						</ul>
						<!-- <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
								<li> <h4>Labels</h4> </li>
								<li> <a href="#"> <i class=" fa fa-sign-blank text-danger"></i> Information <span class="label-information"></span></a> </li>
								<li> <a href="#"> <i class=" fa fa-sign-blank text-success"></i> Job Seeker <span class="label-job-seeker"></span></a> </li>
								<li> <a href="#"> <i class=" fa fa-sign-blank text-info "></i> Companies <span class="label-company"></span></a>
						</ul> -->
					</aside>
					<aside class="lg-side">
						<div class="inbox-head">
							<form action="#" class="pull-left position">
									<div class="input-append">
										<input type="text" class="sr-input" placeholder="Search Mail">
										<button class="btn sr-btn" type="button"><i class="fa fa-search"></i> Search</button>
									</div>
							</form>
						</div>
						<div class="inbox-body">
							 <div class="mail-option">
									 <div class="chk-all">
											 <input type="checkbox" class="mail-checkbox mail-group-checkbox">
											 <div class="btn-group">
													<a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
															All
													</a>
											 </div>
									 </div>
									 <div class="btn-group hidden-phone">
											 <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
													Delete
													<i class="fa fa-trash-o"></i> </a>
											 </a>
									 </div>
							</div>
							<div class="message-detail">
								<?php if (!empty($mgeDetails) || !empty($mgeReceiver)): ?>
									<div class="bg row">
											<div class="col-md-2"><?php echo $messFlg; ?></div>
											<div class="col-md-1">:</div>
											<div class="col-md-9">
											<?php if (!empty($mgeDetails['Receiver'])): ?>
												<?php foreach ($mgeDetails['Receiver'] as $key => $val): ?>
													<?php echo $val['reception_mail']; ?>&gt;,
												<?php endforeach; ?>
											<?php endif; ?>

											<?php if (!empty($mgeReceiver['Sender'])): ?>
												<?php echo $mgeReceiver['Sender']['reception_mail']; ?>&gt;,
											<?php endif; ?>
											</div>
									</div>
									<div class="bg row">
											<div class="col-md-2">Subject</div>
											<div class="col-md-1">:</div>
											<div class="col-md-9">
											<?php if (!empty($mgeDetails['Message']['subject'])): ?>
												<?php echo $mgeDetails['Message']['subject']; ?>
											<?php endif; ?>

											<?php if (!empty($mgeReceiver['Message']['subject'])): ?>
												<?php echo $mgeReceiver['Message']['subject']; ?>
											<?php endif; ?>
											</div>
									</div>
									<div class="row message-body">
										<div class="col-md-12">
											<?php if (!empty($mgeDetails['Message']['message_body'])): ?>
												<?php echo $mgeDetails['Message']['message_body']; ?>
											<?php endif; ?>

											<?php if (!empty($mgeReceiver['Message']['message_body'])): ?>
												<?php echo $mgeReceiver['Message']['message_body']; ?>
											<?php endif; ?>
										</div>
										<?php if (!empty($replyMessage)): ?>
											<div class="col-md-12 message-old">
												<?php foreach ($replyMessage as $key => $val): ?>
													<?php $history = "On ".date('d M Y h:i A', strtotime($val['Sender'][0]['created'])).", ". $val['Reply']['username']." wrote"; ?>
													<span class="history"><?php echo trim($history); ?></span>
													<br/>
													<br/>
													<?php echo $val['Message']['message_body']; ?>
													<br/>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</div>
									<div class="row button-pl">
										<div class="col-md-12">
											<?php echo $this->Html->link('Back', array('controller' => 'adminmessages', 'action' => 'trashMessage'), array('class' => 'btn btn-default btn-sm')); ?>
										</div>
									</div>
								<?php endif; ?>
							 </div>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(".js-example-basic-multiple").select2();
});
</script>
<style type="text/css" media="screen">
	.message-detail {
		border: 1px solid #d5d7de;
		height: 100%;
		padding: 15px 10px 10px 10px;
	}
	.message-detail .row {
		border:1px solid #d5d7de;
		margin-left: 7px;
		margin-right: 7px;
		padding-top:10px;
		padding-bottom:10px;
	}

	.message-detail .bg {
		background: #e5e8ef;
	}

	.message-body{
		max-height: 250px;
		height: 250px;
		overflow-y: scroll;
	}

	.col-md-1 {
		width:2px;
	}
	.row.button-pl {
		border:none;
	}
	.message-old{
		width:100%;
		background-color:#f5f5f5;
		border-left: 2px solid #cccccc;
		padding:5px;
	}
	.history
	{
		font-weight: bold;
	}
</style>