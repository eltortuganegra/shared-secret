<?php

namespace sdmd\Infrastructure\Mailers;


use sdmd\Infrastructure\Mailers\Local\LocalMailerImp;
use sdmd\Infrastructure\Mailers\Memory\MemoryMailerImp;

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