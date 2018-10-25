<?php

namespace sdmd\ValueObjects\SecretId;


interface SecretIdFactory
{
    public function create(string $identifier): SecretId;
}