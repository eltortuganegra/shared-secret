<?php

namespace SharedSecret\Services\SecretCreateService;

use SharedSecret\Services\ServiceRequest;
use SharedSecret\ValueObjects\ExpirationTime\ExpirationTimeFactoryImp;
use SharedSecret\ValueObjects\Message\MessageFactoryImp;
use SharedSecret\ValueObjects\SecretId\SecretId;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use DateInterval;
use DateTime;
use Symfony\Component\Validator\Constraints\Date;

class SecretCreateServiceRequest implements ServiceRequest
{
    private $messageFactory;
    private $expirationTimeFactory;
    private $secretId;
    private $message;
    private $protocol;
    private $domain;
    private $expirationTime;
    private $fromMail;
    private $toMail;

    public function __construct()
    {
        $this->messageFactory = ValueObjectsFactory::getMessageFactory();
        $this->expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();
    }

    public function setSecretId(SecretId $secretId): void
    {
        $this->secretId = $secretId;
    }

    public function getSecretId()
    {
        return $this->secretId;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->messageFactory->create($this->message);
    }

    public function setProtocol(string $protocol): void
    {
        $this->protocol = $protocol;
    }
    public function getProtocol()
    {
        return $this->protocol;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setExpirationTimeInSeconds(int $expirationTimeInSeconds)
    {
        $this->expirationTime = $this->expirationTimeFactory->create($expirationTimeInSeconds);
    }

    public function getExpirationTime()
    {
        return $this->expirationTime;
    }

    public function getFromMail()
    {
        return $this->fromMail;
    }

    public function setFromMail($fromMail): void
    {
        $this->fromMail = $fromMail;
    }

    public function getToMail()
    {
        return $this->toMail;
    }

    public function setToMail($toMail): void
    {
        $this->toMail = $toMail;
    }

}