<?php

namespace SharedSecret\ValueObjects\SecretId;


interface SecretId
{
    public function getIdentifier(): string;
}