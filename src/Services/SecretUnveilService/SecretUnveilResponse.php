<?php

namespace sdmd\Services\SecretUnveilService;


use sdmd\Entities\Secret\Secret;
use sdmd\Services\ServiceResponse;
use sdmd\ValueObjects\LinkForShare\LinkForShare;

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