<?php
/*
This class is responsible for sending mail messages
*/
class Mailer
{
	/*
	Method sends a given message to the specific email address
	*/
	public function sendMail($to, $subject, $message,$cc='')
	{
		//Header we will use to create an HTML message
		$headers = "From: Dental Clinic <dentalc734@gmail.com>\r\n". 
               "MIME-Version: 1.0" . "\r\n" . 
               "Content-type: text/html; charset=UTF-8" . "\r\n"; 
		
		if(!empty($cc))
		{
			$headers .= "Reply-To: ".$cc."\r\n";
			$headers .= 'Cc: '.$cc."\r\n";			
		}
		
		return mail($to, $subject, $message, $headers); 
	}
}
?>