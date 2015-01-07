<?php

class HomeController extends BaseController {

	public function home() {

		/*Mail::send('emails/auth/test', array('name' => 'Kamran'), function($message) {
			$message->to('kkhan1991@hotmail.com', 'Kamran Khan')->subject('Test Email');
		});*/

		return View::make('home');
	}
}
