<?php

namespace sdmd\ValueObjects\ExpirationTime;


use DateTime;

class ExpirationTimeFactoryImp implements ExpirationTimeFactory
{

    public function create(int $seconds): ExpirationTime
    {
        return new ExpirationTimeImp($seconds);
    }
}