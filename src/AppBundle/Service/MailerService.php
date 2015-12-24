<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 21/12/15
 * Time: 23:05
 */

namespace AppBundle\Service;


class MailerService
{
    private $swiftMailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->swiftMailer = $mailer;
    }

    public function sendEmail($from, $to, $subject, $body)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body)
            ->setCharset('UTF-8')
            ->setContentType('text/html');

        $this->swiftMailer->send($message);
    }

}