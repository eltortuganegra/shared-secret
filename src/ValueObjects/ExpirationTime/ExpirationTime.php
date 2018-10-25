<?php

namespace SharedSecret\ValueObjects\ExpirationTime;


interface ExpirationTime
{
    public function getSeconds(): int;
}