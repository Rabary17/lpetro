<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class LpMailerService
{
    private $mailer;
    private $sender;
    private $flashBag;

    /**
     * [__construct description]
     *
     * @param \Swift_Mailer     $mailer   [description]
     * @param string            $sender   [description]
     * @param FlashBagInterface $flashBag description
     */
    public function __construct(\Swift_Mailer $mailer, $sender, FlashBagInterface $flashBag)
    {
        $this->mailer = $mailer;
        $this->sender = $sender;
        $this->flashBag = $flashBag;
    }

    /**
     * [sendMail description]
     *
     * @param  string $to           [description]
     * @param  string $subject      [description]
     * @param  string $body         [description]
     * @param  string $flashTitle   titre du message flash [optionnel]
     * @param  string $flashMessage contentu du message flash [optionnel]
     * @return array                [description]
     */
    public function sendMail($to, $subject, $body, $flashTitle = '', $flashMessage = '')
    {
        $message = (new \Swift_Message($subject))
            ->setSubject($subject)
            ->setFrom([$this->sender])
            ->setTo($to)
            ->setCharset('utf-8')
            ->setContentType('text/html')
            ->setBody($body);

        $response = $this->mailer->send($message);

        if ($response && isset($flashTitle)) {
            $this->flashBag->add(
                $flashTitle,
                $flashMessage
            );
        }

        return $response;
    }
}
