<?php

namespace sdmd\ValueObjects;

use sdmd\ValueObjects\ExpirationTime\ExpirationTimeFactory;
use sdmd\ValueObjects\ExpirationTime\ExpirationTimeFactoryImp;
use sdmd\ValueObjects\LinkForShare\LinkForShareFactory;
use sdmd\ValueObjects\LinkForShare\LinkForShareFactoryImp;
use sdmd\ValueObjects\Mail\MailFactory;
use sdmd\ValueObjects\Mail\MailFactoryImp;
use sdmd\ValueObjects\Message\MessageFactory;
use sdmd\ValueObjects\Message\MessageFactoryImp;
use sdmd\ValueObjects\SecretId\SecretIdFactory;
use sdmd\ValueObjects\SecretId\SecretIdFactoryImp;

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