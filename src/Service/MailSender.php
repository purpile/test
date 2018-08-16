<?php
/**
 * Date: 16.08.18
 * Time: 20:45
 */

namespace App\Service;


class MailSender {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $email;

    public function __construct(\Swift_Mailer $mailer, $email) {

        $this->mailer = $mailer;
        $this->email = $email;
    }

    public function sendMailToAdmin() {

        $message = (new \Swift_Message('New Device added!'))
            ->setFrom($this->email)
            ->setTo($this->email)
            ->setBody('New device');
        $this->mailer->send($message);
    }

}