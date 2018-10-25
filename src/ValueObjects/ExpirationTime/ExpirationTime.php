<?php

namespace sdmd\ValueObjects\ExpirationTime;


interface ExpirationTime
{
    public function getSeconds(): int;
}