<?php

namespace SharedSecret\Infrastructure\Mailers;


use SharedSecret\Infrastructure\Mailers\Local\LocalMailerImp;
use SharedSecret\Infrastructure\Mailers\Memory\MemoryMailerImp;

class MailerFactory
{
    static public function createMemoryMailer(): Mailer
    {
        return new MemoryMailerImp();
    }

    static public function createLocalMailer(): Mailer
    {
        return new LocalMailerImp();
    }
}