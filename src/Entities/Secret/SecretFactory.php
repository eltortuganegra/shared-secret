<?php

namespace SharedSecret\Entities\Secret;


use SharedSecret\ValueObjects\ExpirationTime\ExpirationTime;
use SharedSecret\ValueObjects\Message\Message;
use SharedSecret\ValueObjects\SecretId\SecretId;
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