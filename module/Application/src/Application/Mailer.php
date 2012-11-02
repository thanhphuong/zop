<?php
namespace Application;
use Account\Model\Account;
use Zend\Mail\Headers;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class Mailer
{

    const EMAIL_NO_REPLY = 'buithanhphuong230485@zing.vn';

    const PASS_NO_REPLY = 'btphuong2345';

    public function __construct ()
    {}

    public function sendMailRegister ($controller, Account $account)
    {
        $service = new Service();
        $translate = $service->getTranslate($controller);
        
        $name = $account->full_name;
        $link = 'http://' . $_SERVER['HTTP_HOST'] . '\account\verify?verificationCode=' . $account->pid . '&email=' . $account->email ;
        
        // create body
        $content = $translate(
                sprintf('<p>Hi %s,</p>
                    <br/>
                    <p>To start using ProjectName, you need to <a href="%s" target="_blank" rel="nofollow">verify your email address</a>. Please click the link.</p>
                    <br/>
                    <p>The FIOSOFT crew</p>
                    ', $name, $link));
        
        $to = $account->email;
        $subject = $translate('Please verify your email address');
        
        $this->sendMail($to, $subject, $content);
    }

    public function sendMail ($to, $subject, $content)
    {
        $text = new MimePart('');
        $text->type = "text/plain";
        
        $html = new MimePart($content);
        $html->type = "text/html";
        
        $body = new MimeMessage();
        $body->setParts(array(
                $html,$text
        ));
        
        // crate message
        $message = new Message();
        $message->addTo($to)
            ->addFrom('buithanhphuong230485@zing.vn')
            ->setEncoding('UTF-8')
            ->setSubject($subject)
            ->setBody($body);
        
        // Setup SMTP transport using LOGIN authentication
        $transport = new SmtpTransport();
        $options = new SmtpOptions(
                array(
                        'host' => 'smtp.zing.vn',
                        'connection_class' => 'login',
                        'port' => '25',
                        'connection_config' => array(
                                'username' => Mailer::EMAIL_NO_REPLY,
                                'password' => Mailer::PASS_NO_REPLY
                        )
                ));
        $transport->setOptions($options);
        $transport->send($message);
    }
}