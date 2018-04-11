<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	// Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/admin/login',array('controller' => 'adminusers', 'action' => 'login'));
	Router::connect('/admin',array('controller' => 'adminusers', 'action' => 'login'));
	Router::connect('/admin/logout',array('controller' => 'adminusers', 'action' => 'logout'));
	Router::connect('/admin/headhunter/:action/*',array('controller' => 'adminheadhunters'));
	Router::connect('/admin/occupation/:action/*',array('controller' => 'adminoccupations'));
	Router::connect('/admin/industry/:action/*',array('controller' => 'adminindustrys'));
	Router::connect('/admin/region/:action/*',array('controller' => 'adminregions'));
	Router::connect('/admin/vjob/:action/*',array('controller' => 'adminvjobs'));
	Router::connect('/admin/jobseeker/:action/*',array('controller' => 'adminjobseekers'));
	Router::connect('/admin/company/:action/*',array('controller' => 'admincompanys'));
	Router::connect('/admin/message/outbox/*',array('controller' => 'adminmessages', 'action' => 'sentMessage'));
	Router::connect('/admin/message/inbox/*',array('controller' => 'adminmessages', 'action' => 'index'));
	Router::connect('/admin/message/trash/*',array('controller' => 'adminmessages', 'action' => 'trash'));
	Router::connect('/admin/message/detail/*',array('controller' => 'adminmessages', 'action' => 'detailMessage'));
	Router::connect('/admin/message/:action/*',array('controller' => 'adminmessages'));
	Router::connect('/admin/occupation/:action/*',array('controller' => 'adminoccupations', 'action' => 'browse'));
	Router::connect('/admin/appliedjobseeker/:action/*',array('controller' => 'adminappliedjobseekers', 'action' => 'index'));
	Router::connect('/admin/report/:action/*',array('controller' => 'adminreports', 'action' => 'index'));
	Router::connect('/admin/pickup/:action/*',array('controller' => 'adminpickups'));
	Router::connect('/admin/warnings/:action/*',array('controller' => 'adminwarnings'));

	Router::connect('/master/headhunter/:action/*',array('controller' => 'masterheadhunters'));
	Router::connect('/master/job/:action/*',array('controller' => 'masteroccupations'));
	Router::connect('/master/login',array('controller' => 'masterusers', 'action' => 'login'));
	Router::connect('/master',array('controller' => 'masterusers', 'action' => 'login'));
	Router::connect('/master/logout',array('controller' => 'masterusers', 'action' => 'logout'));
	Router::connect('/master/jobseeker/:action/*',array('controller' => 'masterjobseekers'));
	Router::connect('/master/profile/:action/*',array('controller' => 'masterprofiles'));
	Router::connect('/master/message/outbox/*',array('controller' => 'mastermessages', 'action' => 'sentMessage'));
	Router::connect('/master/message/inbox/*',array('controller' => 'mastermessages', 'action' => 'index'));
	Router::connect('/master/message/trash/*',array('controller' => 'mastermessages', 'action' => 'trash'));
	Router::connect('/master/message/detail/*',array('controller' => 'mastermessages', 'action' => 'detailMessage'));
	Router::connect('/master/message/:action/*',array('controller' => 'mastermessages'));
	Router::connect('/master/keptjobseeker/:action/*',array('controller' => 'masterkeptjobseekers', 'action' => 'index'));
	Router::connect('/master/appliedjobseeker/:action/*',array('controller' => 'masterappliedjobseekers', 'action' => 'index'));
	Router::connect('/master/savedjobseeker/:action/*',array('controller' => 'mastersavedjobseekers', 'action' => 'index'));

	Router::connect('/',array('controller' => 'usertpages', 'action' => 'index'));
	Router::connect('/user/login',array('controller' => 'users', 'action' => 'login'));
	Router::connect('/user/facebooklogin',array('controller' => 'users', 'action' => 'facebookLogin'));
	Router::connect('/user/facebook/fallback', array('controller' => 'users', 'action' => 'fbcallback'));
	Router::connect('/user/register', array('controller' => 'users', 'action' => 'add'));
	Router::connect('/user/logout',array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/user/job/result_list/*',array('controller' => 'usertpages', 'action' => 'job_search'));
	Router::connect('/user/userabouts/:action/*',array('controller' => 'userabouts'));
	Router::connect('/user/job/:action/*',array('controller' => 'useroccupations'));
	Router::connect('/user/profile/:action/*',array('controller' => 'userprofiles'));
	Router::connect('/user/setting/:action/*',array('controller' => 'usersettings'));
	Router::connect('/user/register/personal_info',array('controller' => 'mypages', 'action' => 'personalInfo'));
	Router::connect('/user/register/education',array('controller' => 'mypages', 'action' => 'education'));
	Router::connect('/user/register/language_skill',array('controller' => 'mypages', 'action' => 'language_skill'));
	Router::connect('/user/mypage',array('controller' => 'mypages', 'action' => 'mypage'));
	Router::connect('/user/message/outbox/*',array('controller' => 'usermessages', 'action' => 'sentMessage'));
	Router::connect('/user/message/inbox/*',array('controller' => 'usermessages', 'action' => 'index'));
	Router::connect('/user/message/trash/*',array('controller' => 'usermessages', 'action' => 'trash'));
	Router::connect('/user/message/detail/*',array('controller' => 'usermessages', 'action' => 'detailMessage'));
	Router::connect('/user/message/:action/*',array('controller' => 'usermessages'));
	Router::connect('/company/register/*',array('controller' => 'users', 'action' => 'company_add'));
	Router::connect('/headhunter/register/*',array('controller' => 'users', 'action' => 'headhunter_add'));
	Router::connect('/user/register/*',array('controller' => 'users', 'action' => 'add'));
	Router::connect('/user/message/:action/*',array('controller' => 'usermessages'));

	// Essence for CakePdf
	Router::mapResources(array('Masterappliedjobseekers'));

	Router::mapResources(array('Userprofiles'));
	Router::parseExtensions('pdf');
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	// Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
