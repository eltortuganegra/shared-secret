<?php

namespace sdmd\ValueObjects\SecretId;


interface SecretId
{
    public function getIdentifier(): string;
}