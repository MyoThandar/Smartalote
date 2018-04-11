<?php
App::uses('UserAppController', 'Controller');
class UseraboutsController extends UserAppController {
	public $uses = array('User');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'user_new';
	}
	public function term_condition() {

	}
	public function privacy_policy() {

	}
	public function help() {

	}
	public function receipt() {

	}
	public function contactus() {
		$emailTo = 'admin@smartalote.net';
		if ($this->request->is(array('post', 'put'))) {
			$name = trim($this->request->data['User']['name']);
			$email = trim($this->request->data['User']['email']);
			$about_myself = trim($this->request->data['User']['about_myself']);
			$subject = "【Important 】$about_myself's main registration";
			$imput_subject = $this->request->data['User']['subject'];
			$message = trim($this->request->data['User']['message']);

			$body ="About Myself  ： $about_myself \n".
			"Name ： $name\n\n".
			"Subject ：$imput_subject\n\n".

			"Body  ： $message\n\n".
			"------------------------------------\n".
			"SmartAlote\n".
			"http://smartalote.com\n".
			"------------------------------------";


			$headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

			mail($emailTo, $subject, $body, $headers);

			$respondSubject = '[SmartAlote] Inquiry receipt confirmation';
			$respondBody ="Thank you very much for using SmartAlote all the time. This mail has been sent automatically from SmartAlote.\n\n".

			"Your inquiries have been successfully sent to the administrator. We will confirm the contents of the inquiry and will reply as soon as possible. However, please understand that it may take several days to answer.\n\n".

			"If you do not remember this email, it is possible that other customers mistakenly entered your email address to our contact form and the email was misdelivered. In that case, sorry to trouble you, but please disregard this mail.\n\n".

			"------------------------------------\n".
			"SmartAlote\n".
			"http://smartalote.com\n".
			"------------------------------------";
			$respondHeaders = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $emailTo;
			if(mail($email, $respondSubject, $respondBody, $respondHeaders)){
				$this->redirect( array('action' => 'receipt'));
			}
			$emailSent = true;
		}

		$title_for_layout = "お問合せ | 転職サイト「seekfor」";
		$this->set('title_for_layout', $title_for_layout);
	}
}