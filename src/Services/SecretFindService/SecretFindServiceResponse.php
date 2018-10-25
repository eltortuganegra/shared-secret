<?php

namespace SharedSecret\Services\SecretFindService;


use SharedSecret\Entities\Secret\Secret;
use SharedSecret\Services\ServiceResponse;

class SecretFindServiceResponse implements ServiceResponse
{
    private $secret;

    public function __construct(Secret $secret)
    {
        $this->secret = $secret;
    }

    public function getSecret()
    {
        return $this->secret;
    }
}