<?php

namespace SharedSecret\ValueObjects\LinkForShare;


class LinkForShareFactoryImp implements LinkForShareFactory
{
    public function create(string $protocol, string $domain, string $identifier): LinkForShare
    {
        return new LinkForShareImp($protocol, $domain, $identifier);
    }
}