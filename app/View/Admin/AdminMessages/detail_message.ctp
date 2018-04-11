<div class="row">
	<div class="col-md-12 col-sm-8 col-xs-12" >
		<?php echo $this->Session->flash(); ?>
		<div class="x_panel">
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
								<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myReplyModal" class="modal fade" style="display: none;">
										<div class="modal-dialog">
												<div class="modal-content">
														<div class="modal-header">
																<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
																<h4 class="modal-title">Reply</h4>
														</div>
														<div class="modal-body">
																<?php echo $this->Form->create('Message', array(
																	'url' => array(
																		'controller' => 'adminmessages',
																		'action' => 'replyMessage'
																	),
																	'class' => 'form-horizontal',
																	'id' => 'reply-message-form',
																	'label' => false,
																	'role' => 'form'
																)); ?>

																	<div class="form-group">
																		<label class="col-lg-2 control-label">To</label>
																		<div class="col-lg-10">
																				<?php echo $this->Form->input('to', array(
																					'label' => false,
																					'value' => $mgeReceiver['Sender']['reception_mail'].'&gt;',
																					'readonly' => true,
																					'class' => 'form-control',
																					'escape' => false
																				)); ?>
																		</div>
																	</div>

																	<div class="form-group">
																		<label class="col-lg-2 control-label">Subject</label>
																		<?php $re = !empty($mgeReceiver['Message']['reply_to']) ? '' : 'Re:'; ?>
																		<div class="col-lg-10">
																			<?php echo $this->Form->input('subject', array(
																				'label' => false,
																				'class' => 'form-control',
																				'readonly' => true,
																				'value' => $re.$mgeReceiver['Message']['subject']
																			)); ?>
																		</div>
																	</div>

																	<div class="form-group">
																		<label class="col-lg-2 control-label">Message</label>
																		<div class="col-lg-10">
																			<div class='message-body-text'>
																				<div class="message-new"></div>
																				<div class="message-old">
																				<?php $name = explode('&lt', $mgeReceiver['Sender']['reception_mail']); ?>
																				<?php $history = "On ".date('d M Y H:m', strtotime($mgeReceiver['Sender']['created'])).", ". $name[0]." wrote"; ?>
																				<span class="history"><?php echo trim($history); ?></span>
																				<br/>
																				<br/>
																				<?php echo $mgeReceiver['Message']['message_body']; ?>
																				<?php if (!empty($replyMessage)): ?>
																						<br/>
																						<?php foreach ($replyMessage as $key => $val): ?>
																							<?php $history = "On ".date('d M Y h:i A', strtotime($val['Sender'][0]['created'])).", ". $val['Reply']['username']." wrote"; ?>
																							<span class="history"><?php echo trim($history); ?></span>
																							<br/>
																							<br/>
																							<?php echo $val['Message']['message_body']; ?>
																							<br/>
																						<?php endforeach; ?>
																				<?php endif; ?>
																				</div>
																			</div>

																			<!-- // Hidden fields // -->
																			<?php echo $this->Form->input('message_body', array('type' => 'hidden', 'id' => 'message-body-txt-val')); ?>
																			<?php echo $this->Form->input('to', array('type' => 'hidden', 'value' => $mgeReceiver['Sender']['creator_id'].':'.$mgeReceiver['Sender']['sender_user_type'])); ?>
																			<?php echo $this->Form->input('screen_type', array('type' => 'hidden', 'value' => "inbox")); ?>
																			<?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $mgeReceiver['Receiver']['id'])); ?>
																			<?php echo $this->Form->input('message_id', array('type' => 'hidden', 'value' => $mgeReceiver['Message']['id'])); ?>
																			<?php echo $this->Form->input('reply_to', array('type' => 'hidden', 'value' => $mgeReceiver['Message']['reply_to'])); ?>
																			<!-- /////////////////////// -->

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
					</aside>
					<aside class="lg-side">
						<div class="inbox-head">
						</div>
						<div class="inbox-body">
							<div class="message-detail">
								<?php if (!empty($mgeDetails) || !empty($mgeReceiver)): ?>
									<div class="bg row" >
											<div class="col-md-2"><b><?php echo $messFlg; ?></b></div>
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
										<div class="col-md-2"><b>Subject</b></div>
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
										<?php if (!empty($mgeDetails['Sender']['id'])): ?>
											<?php
												$id = $mgeDetails['Sender']['id'];
												$type = 'send';
												$action = 'sentMessage';
											?>
										<?php endif; ?>

										<?php if (!empty($mgeReceiver['Receiver']['id'])): ?>
											<?php
												$id = $mgeReceiver['Receiver']['id'];
												$type = 'inbox';
												$action = 'index';
											?>
										<?php endif; ?>

										<div class="col-md-12">
											<?php echo $this->Html->link('Back', array('controller' => 'adminmessages', 'action' => $action), array('class' => 'btn btn-default btn-sm')); ?>
											<?php if (!empty($mgeReceiver['Receiver']['id'])): ?>
												<a href="#myReplyModal" data-toggle="modal" title="Compose"  class="btn btn-royal-blue btn-sm">
													Reply
												</a>
											<?php endif; ?>
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
		height: 250px;
		max-height: 250px;
		overflow-y: auto;
	}

	.col-md-1 {
		width:2px;
	}
	.row.button-pl {
		border:none;
	}
	.message-body-text {
		border: 1px solid #cccccc;
		border-radius: 2px;
		color: #555555;
		padding: 4px;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		-webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s; */
		transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	}
	.message-new{
		width:100%;
		min-height: 30px;
		height: 100%;
		background-color:#fff;
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
<script type="text/javascript">
$(document).ready(function(){
	$('.message-new').each(function(){
		this.contentEditable = true;
	});

	$('#reply-message-form').on('submit', function() {
		var newMesTxt = $('.message-new').html();
		var oldMesTxt = $('.message-old').html();

		// For newMesTxt
		var regex1 = /<div><br\s*[\/]?><\s*[\/]div>/gi;
		var regex2 = /<div\s*[\/]?>/gi;
		var regex3 = /<\s*[\/]?div>/gi;
		var regex4 = /<br\s*[\/]?>/gi;
		var data1 = newMesTxt.replace(regex1, "\n");
		var data2 = data1.replace(regex2, "\n");
		var data3 = data2.replace(regex3, "");
		var data4 = data3.replace(regex4, "\n");

		var messageBodyTxt = data4;

		$("#message-body-txt-val").val(messageBodyTxt);

	});

});
</script>