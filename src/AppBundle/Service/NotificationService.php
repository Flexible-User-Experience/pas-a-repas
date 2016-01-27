<?php

namespace AppBundle\Service;

use AppBundle\Entity\Contact;

/**
 * Class NotificationService
 *
 * @category Service
 * @package  AppBundle\Service
 * @author   David Romaní <david@flux.cat>
 */
class NotificationService
{
    /** @var CourierService */
    private $messenger;

    /** @var \Twig_Environment */
    private $twig;

    /** @var string */
    private $amd;

    /**
     * NotificationService constructor
     *
     * @param CourierService    $messenger
     * @param \Twig_Environment $twig
     * @param string            $amd
     */
    public function __construct(CourierService $messenger, \Twig_Environment $twig, $amd)
    {
        $this->messenger = $messenger;
        $this->twig = $twig;
        $this->amd = $amd;
    }

    /**
     * Send a contact form notification to administrator
     *
     * @param Contact $contactMessage
     */
    public function sendAdminNotification(Contact $contactMessage)
    {
        $this->messenger->sendEmail(
            $contactMessage->getEmail(),
            $this->amd,
            'www.asbelesteve.com contact form received',
            $this->twig->render(':Mails:contact_form_admin_notification.html.twig', array(
                'contact' => $contactMessage,
            ))
        );
    }

    /**
     * Send a contact form notification to web user
     *
     * @param Contact $contactMessage
     */
    public function sendUserNotification(Contact $contactMessage)
    {
        $this->messenger->sendEmail(
            $this->amd,
            $contactMessage->getEmail(),
            'www.asbelesteve.com question received',
            $this->twig->render(':Mails:contact_form_user_notification.html.twig', array(
                'contact' => $contactMessage,
            ))
        );
    }

    /**
     * Send backend answer notification to web user
     *
     * @param Contact $contactMessage
     */
    public function senddUserBackendNotification(Contact $contactMessage)
    {
        $this->messenger->sendEmail(
            $this->amd,
            $contactMessage->getEmail(),
            'www.asbelesteve.com contact form answer',
            $this->twig->render(':Mails:contact_form_user_backend_notification.html.twig', array(
                'contact' => $contactMessage,
            ))
        );
    }
}
