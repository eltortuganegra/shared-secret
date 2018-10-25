<?php

namespace sdmd\Services\SecretFindService;


use sdmd\Entities\Secret\Secret;
use sdmd\Services\ServiceResponse;

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