<?php

namespace SharedSecret\Services\SecretUnveilService;


use SharedSecret\Entities\Secret\Secret;
use SharedSecret\Services\ServiceResponse;
use SharedSecret\ValueObjects\LinkForShare\LinkForShare;

class SecretUnveilResponse implements ServiceResponse
{
    private $secret;
    private $linkForShare;

    public function __construct(Secret $secret, LinkForShare $linkForShare)
    {
        $this->secret = $secret;
        $this->linkForShare = $linkForShare;
    }

    public function getSecret(): Secret
    {
        return $this->secret;
    }

    public function getLinkForShare()
    {
        return $this->linkForShare;
    }
}