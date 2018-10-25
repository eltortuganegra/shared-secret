<?php

namespace SharedSecret\ValueObjects\SecretId;


interface SecretIdFactory
{
    public function create(string $identifier): SecretId;
}