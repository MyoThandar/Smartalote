Thank you for your new registration to SmartAlote, a comprehensive job search portal site for Myanmar people!

Please click on the following URL to activate your account. You cannot log in to SmartAlote with your registered account until you click the following URL. The URL is valid for 24 hours from issue. If 24 hours have elapsed since the e-mail reception, please register again from smartalote.com.


<?php echo Router::url(array(
    'controller' => 'users',
    'action' => 'activate',
    '?'  => array(
    	'email' => $email,
    	'activate_token' => $token,
    	'expired' => $expired)
), true); ?>