<?php

namespace SharedSecret\ValueObjects\Mail;


class MailFactoryImp implements MailFactory
{

    public function create(string $value): Mail
    {
        return new MailImp($value);
    }
}