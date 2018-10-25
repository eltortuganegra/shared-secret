<?php

namespace SharedSecret\ValueObjects;

use SharedSecret\ValueObjects\ExpirationTime\ExpirationTimeFactory;
use SharedSecret\ValueObjects\ExpirationTime\ExpirationTimeFactoryImp;
use SharedSecret\ValueObjects\LinkForShare\LinkForShareFactory;
use SharedSecret\ValueObjects\LinkForShare\LinkForShareFactoryImp;
use SharedSecret\ValueObjects\Mail\MailFactory;
use SharedSecret\ValueObjects\Mail\MailFactoryImp;
use SharedSecret\ValueObjects\Message\MessageFactory;
use SharedSecret\ValueObjects\Message\MessageFactoryImp;
use SharedSecret\ValueObjects\SecretId\SecretIdFactory;
use SharedSecret\ValueObjects\SecretId\SecretIdFactoryImp;

class ValueObjectsFactory
{
    static function getSecretIdFactory(): SecretIdFactory
    {
        return new SecretIdFactoryImp();
    }

    static function getLinkForShareFactory(): LinkForShareFactory
    {
        return new LinkForShareFactoryImp();
    }

    static function getMessageFactory(): MessageFactory
    {
        return new MessageFactoryImp();
    }

    static function getExpirationTimeFactory(): ExpirationTimeFactory
    {
        return new ExpirationTimeFactoryImp();
    }

    static function getMailFactory(): MailFactory
    {
        return new MailFactoryImp();
    }

}