<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
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
						</div>
						<ul class="inbox-nav inbox-divider">
							<li>
								<?php echo $this->Html->link('<i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right"></span>', array('controller' => 'usermessages', 'action' => 'index'), array('class' => 'send', 'escape' => false)); ?>
								</a>
							</li>
							<li>
									<?php echo $this->Html->link('<i class="fa fa-envelope-o"></i> Outbox', array('controller' => 'usermessages', 'action' => 'sentMessage'), array('class' => 'send', 'escape' => false)); ?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class=" fa fa-trash-o"></i> Trash', array('controller' => 'usermessages', 'action' => 'trashMessage'), array('class' => 'send', 'escape' => false)); ?>
							</li>
						</ul>
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
															<small>
																<?php if (!empty($val['CmpHeadhunter']['company_name'])): ?>
																	<?php echo $val['CmpHeadhunter']['company_name']; ?>
																<?php else: ?>
																	<?php echo $val['CmpHeadhunter']['headhunter_name']; ?>
																<?php endif; ?>
															</small>
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
											<?php echo $this->Html->link('Back', array('controller' => 'usermessages', 'action' => 'trashMessage'), array('class' => 'btn btn-default btn-sm')); ?>
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
		overflow-y: auto;
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
	.row {
		margin-bottom: 0px;
	}
	.message-detail .bg {
		background: #e5e8ef;
	}
</style>