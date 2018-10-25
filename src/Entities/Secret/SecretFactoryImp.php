<?php

namespace sdmd\Entities\Secret;


use sdmd\ValueObjects\ExpirationTime\ExpirationTime;
use sdmd\ValueObjects\Message\Message;
use sdmd\ValueObjects\SecretId\SecretId;
use DateTime;

class SecretFactoryImp implements SecretFactory
{
    public function create(
        SecretId $secretId,
        Message $message,
        ExpirationTime $expirationTime
    ): Secret
    {
        $expirationDate = $this->calculateExpirationDate($expirationTime);

        return new SecretImp($secretId, $message, $expirationTime, $expirationDate);
    }

    private function calculateExpirationDate(ExpirationTime $expirationTime): DateTime
    {
        $expiredAt = new DateTime();
        $expiredAt->add(new \DateInterval('PT' . $expirationTime->getSeconds() . 'S'));

        return $expiredAt;
    }

    public function createFromRepository(
        SecretId $secretId,
        Message $message,
        ExpirationTime $expirationTime,
        DateTime $expirationDate
    ): Secret
    {
        return new SecretImp($secretId, $message, $expirationTime, $expirationDate);
    }

}