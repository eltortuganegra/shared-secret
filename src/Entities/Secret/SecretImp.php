<?php

namespace SharedSecret\Entities\Secret;


use SharedSecret\ValueObjects\ExpirationTime\ExpirationTime;
use SharedSecret\ValueObjects\Message\Message;
use SharedSecret\ValueObjects\SecretId\SecretId;
use DateInterval;
use DateTime;

class SecretImp implements Secret
{
    private $secretId;
    private $message;
    private $linkForShare;
    private $expirationTime;
    private $expirationDate;

    public function __construct(SecretId $secretId, Message $message, ExpirationTime $expirationTime, DateTime $expirationDate)
    {
        $this->secretId = $secretId;
        $this->message = $message;
        $this->expirationTime = $expirationTime;
        $this->expirationDate = $expirationDate;
    }

    public function getSecretId(): SecretId
    {
        return $this->secretId;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

    public function getLinkForShare(): string
    {
        return $this->linkForShare;
    }

    public function getExpirationTime(): ExpirationTime
    {
        return $this->expirationTime;
    }

    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }


}