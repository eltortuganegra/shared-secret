<?php

namespace sdmd\ValueObjects\ExpirationTime;


use DateTime;

interface ExpirationTimeFactory
{
    public function create(int $seconds): ExpirationTime;
}