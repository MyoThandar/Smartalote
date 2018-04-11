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
									<?php echo $this->Html->link('<i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right"></span>', array('controller' => 'mastermessages', 'action' => 'index'), array('class' => 'send', 'escape' => false)); ?>
									</a>
								</li>
								<li>
										<?php echo $this->Html->link('<i class="fa fa-envelope-o"></i> Outbox', array('controller' => 'mastermessages', 'action' => 'sentMessage'), array('class' => 'send', 'escape' => false)); ?>
								</li>
								<li class="active">
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
										</div>
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
									<div class="row button-pl">
										<div class="col-md-12">
											<?php echo $this->Html->link('Back', array('controller' => 'mastermessages', 'action' => 'trashMessage'), array('class' => 'btn btn-default btn-sm')); ?>
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
	.history	{
		font-weight: bold;
	}
	.message-detail .bg {
		background: #e5e8ef;
	}
</style>