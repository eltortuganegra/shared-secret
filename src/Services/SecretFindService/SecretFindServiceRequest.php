<?php

namespace SharedSecret\Services\SecretFindService;


use SharedSecret\Services\ServiceRequest;
use SharedSecret\ValueObjects\ValueObjectsFactory;

class SecretFindServiceRequest implements ServiceRequest
{
    private $secretId;

    public function __construct(string $secretIdentifier)
    {
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();
        $this->secretId = $secretIdFactory->create($secretIdentifier);
    }

    public function getSecretId()
    {
        return $this->secretId;
    }

}