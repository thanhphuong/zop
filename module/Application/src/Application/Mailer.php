<?php
namespace Application;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class Mailer
{
	public function __construct()
	{
	
	}
	
	public function sendMail()
	{	
		$message = new Message();
		$message->addTo('btphuong2345@yahoo.com')
		->addFrom('buithanhphuong230485@zing.vn')
		->setSubject('Greetings and Salutations!')
		->setBody("Sorry, I'm going to be late today!");
		
		// Setup SMTP transport using LOGIN authentication
		$transport = new SmtpTransport();
		$options   = new SmtpOptions(array(				
				'host'              => 'smtp.zing.vn',	
				'connection_class'  => 'login',
				'port'			    => '25',
				'connection_config' => array(
						'username' => 'buithanhphuong230485@zing.vn',
						'password' => 'btphuong2345',
				),
		));
		$transport->setOptions($options);
		$transport->send($message);
	}
}