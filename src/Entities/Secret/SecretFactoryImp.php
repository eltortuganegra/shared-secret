<?php

namespace SharedSecret\Entities\Secret;


use SharedSecret\ValueObjects\ExpirationTime\ExpirationTime;
use SharedSecret\ValueObjects\Message\Message;
use SharedSecret\ValueObjects\SecretId\SecretId;
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