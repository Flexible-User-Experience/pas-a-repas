<?php

namespace AppBundle\Service;

/**
 * Class MailerService
 *
 * @category Service
 * @package  AppBundle\Service
 * @author   David Romaní <david@flux.cat>
 */
class MailerService
{
    /** @var \Swift_Mailer */
    private $swiftMailer;

    /**
     * MailerService constructor.
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->swiftMailer = $mailer;
    }

    /**
     * Send email
     *
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     */
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
