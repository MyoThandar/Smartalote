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
																		'controller' => 'mastermessages',
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
																		'controller' => 'mastermessages',
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

																			<!-- // Hidden fields // -->
																			<?php echo $this->Form->input('to', array('type' => 'hidden', 'value' => $mgeReceiver['Sender']['creator_id'].':'.$mgeReceiver['Sender']['sender_user_type'])); ?>
																			<?php echo $this->Form->input('screen_type', array('type' => 'hidden', 'value' => "inbox")); ?>
																			<?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $mgeReceiver['Receiver']['id'])); ?>
																			<?php echo $this->Form->input('message_id', array('type' => 'hidden', 'value' => $mgeReceiver['Message']['id'])); ?>
																			<?php echo $this->Form->input('reply_to', array('type' => 'hidden', 'value' => $mgeReceiver['Message']['reply_to'])); ?>
																			<!-- /////////////////////// -->
																			<div class="form-group">
																				<div class="col-lg-offset-2 col-lg-10">
																					<?php echo $this->Form->button('Send', array('type' => 'submit', 'class' => 'btn btn-send')); ?>
																				</div>
																			</div>

																	</div>

																<?php echo $this->Form->end(); ?>
														</div>
												</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
						<ul class="inbox-nav inbox-divider">
								<li>
									<?php echo $this->Html->link('<i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right"></span>', array('controller' => 'mastermessages', 'action' => 'index'), array('class' => 'send', 'escape' => false)); ?>
									</a>
								</li>
								<li>
										<?php echo $this->Html->link('<i class="fa fa-envelope-o"></i> Outbox', array('controller' => 'mastermessages', 'action' => 'sentMessage'), array('class' => 'send', 'escape' => false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class=" fa fa-trash-o"></i> Trash', array('controller' => 'mastermessages', 'action' => 'trashMessage'), array('class' => 'send', 'escape' => false)); ?>
								</li>
						</ul>
					</aside>
					<aside class="lg-side">
						<div class="inbox-head">
						</div>
						<div class="inbox-body">
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


										<?php if (!empty($job_info)): ?>
											<div class="recomand">
												<h4>Recomanded Jobs</h4>
											</div>
											<?php foreach ($job_info as $key => $val): ?>
											<div class="col-md-6">
												<div class="job-info">
													<div class="left">
														<div class="cmp-img">
															<?php echo $this->Html->image($val['CmpHeadhunter']['logo'], array('alt' => $val['CmpHeadhunter']['logo'])); ?>
														</div>
													</div>
													<div class="right">
														<div class="title">
															<h4><?php echo $val['Occupation']['job_title']; ?></h4>
															<small>	<?php if (!empty($val['CmpHeadhunter']['company_name'])): ?>
																	<?php echo $val['CmpHeadhunter']['company_name']; ?>
																<?php else: ?>
																	<?php echo $val['CmpHeadhunter']['headhunter_name']; ?>
																<?php endif; ?></small>
														</div>
														<div class="detail-btn">
															<?php echo $this->Html->link('Detail', array('controller' => 'useroccupations', 'action' => 'detail', $val['Occupation']['id']), array('class' => 'btn btn-orange', 'target' => '_blank')); ?>
														</div>
													</div>
												</div>
											</div>
											<?php endforeach; ?>

										<?php endif; ?>
										</div>
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
											<?php echo $this->Html->link('Back', array('controller' => 'mastermessages', 'action' => $action), array('class' => 'btn btn-default btn-sm')); ?>
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

	.cmp-img {
		display: block;
		width: 100px;
		position: relative;
		height: 100px;
		padding: 56.25% 0 0 0;
		overflow: hidden;
		border: 1px solid #cccccc;
	}

	.cmp-img img{
		position: absolute;
		display: block;
		max-width: 100%;
		max-height: 100%;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		margin: auto;
	}

	.job-info {
		border: 1px solid #ccc;
		height: 130px;
		padding: 14px 0px 10px 10px;
		margin-bottom: 20px;
	}

	.left {
		margin-right:15px;
	}
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

	.message-body{
		height: 250px;
		max-height: 250px;
		overflow-y: scroll;
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
	.history	{
		font-weight: bold;
	}

	.message-detail .bg {
		background: #e5e8ef;
	}

</style>
