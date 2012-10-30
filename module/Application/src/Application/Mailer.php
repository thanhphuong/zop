<?php
namespace Application;

use Zend\Mail\Headers;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class Mailer
{
	public function __construct()
	{
	
	}
	
	public function sendMail()
	{	
		$content = '<b>Xin lỗi, vì tui đã tới trễ hôm nay ạ</b>';
		$text = new MimePart('<b>Hi Phuong</b>');
        $text->type = "text/html";

        $html = new MimePart($content);
        $html->type = "text/html";

        $body = new MimeMessage();
        $body->setParts(array($html,));
               		
        
		$message = new Message();
		$message->addTo('bvphuong2345@yahoo.com')
		->addFrom('buithanhphuong230485@zing.vn')		
		->setEncoding('UTF-8')				
		->setSubject('Greetings and Salutations!')
		->setBody($body);
		
		foreach ($message->getHeaders() as $header) {
			echo $header->toString();
			// or grab values: $header->getFieldName(), $header->getFieldValue()
		}
		
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