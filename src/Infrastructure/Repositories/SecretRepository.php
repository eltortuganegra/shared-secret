<?php

namespace SharedSecret\Infrastructure\Repositories;

use SharedSecret\Entities\Secret\Secret;
use SharedSecret\ValueObjects\SecretId\SecretId;

interface SecretRepository
{
    public function add(Secret $secret): void;
    public function remove(Secret $secret): void;
    public function findBySecretId(SecretId $secretId): ?Secret;
    public function nextIdentity(): SecretId;
}