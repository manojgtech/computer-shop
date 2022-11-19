<?php

namespace App\Http\Traits;

use Mail;

trait MailTrait{
  
  public function sendmail($to,$name,$subject,$message){
       
		Mail::send('emails.email1', $data, function($message) use ($to_name, $to_email) {
		$message->to($to_email, $to_name)
		->subject($subject);
		$message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
		});
  }
	
}

?>

