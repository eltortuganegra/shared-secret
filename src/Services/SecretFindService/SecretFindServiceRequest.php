<?php

namespace sdmd\Services\SecretFindService;


use sdmd\Services\ServiceRequest;
use sdmd\ValueObjects\ValueObjectsFactory;

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