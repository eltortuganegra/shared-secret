<?php

namespace sdmd\Infrastructure\Repositories;

use sdmd\Entities\Secret\Secret;
use sdmd\ValueObjects\SecretId\SecretId;

interface SecretRepository
{
    public function add(Secret $secret): void;
    public function remove(Secret $secret): void;
    public function findBySecretId(SecretId $secretId): ?Secret;
    public function nextIdentity(): SecretId;
}