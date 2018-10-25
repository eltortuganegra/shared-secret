<?php

namespace SharedSecret\Infrastructure\Mailers;

use SharedSecret\ValueObjects\Mail\Mail;

interface Mailer
{
    public function send(Mail $from, Mail $to, string $subject, string $body): void;
    public function isMailSent(): bool;
}