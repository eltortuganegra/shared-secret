<?php

namespace sdmd\Infrastructure\Repositories\Memory;


use sdmd\ValueObjects\SecretId\SecretId;

class FixedNextIdMemorySecretRepository extends MemorySecretRepository
{
    const defaultNextIdentity = '42aa8aef-6af5-4b59-9a21-a492d581676a';

    public function nextIdentity(): SecretId
    {
        $secretId = $this->secretIdFactory->create(self::defaultNextIdentity);

        return $secretId;
    }
}