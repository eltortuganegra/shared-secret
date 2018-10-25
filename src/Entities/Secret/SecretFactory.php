<?php

namespace sdmd\Entities\Secret;


use sdmd\ValueObjects\ExpirationTime\ExpirationTime;
use sdmd\ValueObjects\Message\Message;
use sdmd\ValueObjects\SecretId\SecretId;
use DateTime;


interface SecretFactory
{
    public function create(
        SecretId $secretId,
        Message $message,
        ExpirationTime $expirationTime
    ): Secret;

    public function createFromRepository(
        SecretId $secretId,
        Message $message,
        ExpirationTime $expirationTime,
        DateTime $expirationDate
    );
}