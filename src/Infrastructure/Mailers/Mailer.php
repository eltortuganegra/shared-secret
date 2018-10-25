<?php

namespace sdmd\Infrastructure\Mailers;

use sdmd\ValueObjects\Mail\Mail;

interface Mailer
{
    public function send(Mail $from, Mail $to, string $subject, string $body): void;
    public function isMailSent(): bool;
}