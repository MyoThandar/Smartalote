<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
Thank you for using SmartAlote all the time. This mail has been sent automatically from SmartAlote.

Please click on the following URL and proceed to reset password.

<?php echo Router::url(array('member' => true, 'controller' => 'users', 'action' => 'remind', $token), true); ?>
