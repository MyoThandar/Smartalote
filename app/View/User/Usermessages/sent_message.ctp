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
							<li class="active">
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
							 <div class="mail-option">
									<div class="chk-all">
											 <input type="checkbox" class="mail-group-checkbox" id="chk_boxes">
											 <div class="btn-group">
													 <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
															All
													 </a>
											 </div>
									 </div>
									 <div class="btn-group hidden-phone">
											<a href="#" class="btn mini blue delete-all-mess" aria-expanded="false">
													Delete
													<i class="fa fa-trash-o"></i>
											</a>
									 </div>

									  <ul class="unstyled inbox-pagination">
											<li><span class="pagi-num">
											<?php echo $this->Paginator->counter(array('format' => __('{:start}-{:end} of {:count} Items'))); ?>
											</span></li>
											<li>
												<?php echo $this->Paginator->prev(__('<'), array(), null, array('class' => 'np-btn', 'id' => 'example_first', 'tag' => 'a', 'escape' => false));?>
											 </li>
											 <li>
												<?php echo $this->Paginator->next(__('>'), array(), null, array('class' => 'np-btn', 'id' => 'example_next', 'tag' => 'a', 'escape' => false)); ?>
											 </li>
									 </ul>
							 </div>
							 <?php echo $this->Form->create('Sender', array('url' => array('controller' => 'usermessages', 'action' => 'deleteAllMessages'), 'id' => 'form', 'autocomplete' => 'off')); ?>
								<table class="table table-inbox table-hover">
									<tbody>
									<?php if (!empty($senderDatas)): ?>
										<?php foreach ($senderDatas as $key => $val): ?>
										<tr id="<?php echo $val['Sender']['id']; ?>">
												<td class="inbox-small-cells">
														<input type="checkbox" name="checkbox[]" class="mail-checkbox" value="<?php echo $val['Sender']['id']; ?>">
												</td>
												<td class="view-message dont-show sender">To:
													<?php
														$name = '';
														foreach ($val['Receiver'] as $keyRece => $valRece):
															$data = explode('&lt;', $valRece['reception_mail']);
															$name .= $data[0]. ',';
														endforeach; ?>
													<?php echo $name; ?>
													<span class="label label-danger pull-right"></span></td>
												<td class="view-message sender"><?php echo $val['Message']['subject']; ?></td>
												<td class="view-message inbox-small-cells sender"></td>
												<td class="view-message text-right sender"><?php echo date('d M Y', strtotime($val['Sender']['created'])); ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
								</tbody>
								</table>
							<?php echo $this->Form->end(); ?>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('.sender').click(function() {
		var senderId = $(this).parent().attr('id');
		var url = "<?php echo Router::url(array('controller' => 'usermessages', 'action' => 'detailMessage')); ?>";
		window.location.href = window.location.protocol + "//" + window.location.host + url + '/send/' +senderId;
	});

	$('#chk_boxes').click(function(){

		if($(this).is(':checked'))
			var chk = true;  // checked
		else
			var chk = false;

		$('.mail-checkbox').prop('checked', chk);
	});

	$('.delete-all-mess').click(function(){
		$('#form').submit();
	});
});
</script>