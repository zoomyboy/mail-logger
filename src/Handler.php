<?php

namespace Zoomyboy\MailLogger;

use Monolog\Handler\SwiftMailerHandler;
use Monolog\Logger;

class Handler extends SwiftMailerHandler {
    public function __construct($host, $user, $password, $subject, $to) {
        $transport = (new \Swift_SmtpTransport($host, 25))
          ->setUsername($user)
          ->setPassword($password)
        ;

        $mailer = new \Swift_Mailer($transport);

        $this->messageTemplate = (new \Swift_Message())
            ->setSubject($subject)
            ->setFrom([config('mail.from.address') => config('mail.from.name')])
            ->setTo([$to[0] => $to[1]])
            ->setBody('TEST');

        parent::__construct($mailer, $this->messageTemplate, Logger::NOTICE);
    }
}
