<!DOCTYPE html>
<html lang="en"><!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<?php echo $this->Html->meta(null, null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
	<?php echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
	<?php echo $this->fetch('meta'); ?>
	<!-- ========== Title ========== -->
	<title><?php echo 'SmartAlote.com_Administrator Portal' ?></title>
	<!-- ========== CSS ========== -->
	<?php echo $this->Html->css('bootstrap.min'); ?>
	<?php echo $this->Html->css('font-awesome.min'); ?>
	<?php echo $this->Html->css('nprogress'); ?>
	<?php echo $this->Html->css('custom.min'); ?>
</head>
<body class="login" >
	<?php echo $this->fetch('content'); ?>
</body>
</html>