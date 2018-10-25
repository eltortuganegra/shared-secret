<?php

namespace SharedSecret\Infrastructure\Repositories\Memory;

use SharedSecret\Entities\Secret\Secret;
use SharedSecret\Infrastructure\Repositories\SecretRepository;
use SharedSecret\ValueObjects\SecretId\SecretId;
use SharedSecret\ValueObjects\SecretId\SecretIdFactory;
use Ramsey\Uuid\Uuid;

class MemorySecretRepository implements SecretRepository
{
    private $secrets = [];
    protected $secretIdFactory;

    public function __construct(SecretIdFactory $secretIdFactory)
    {
        $this->secretIdFactory = $secretIdFactory;
    }

    public function add(Secret $secret): void
    {
        $identifier = $secret->getSecretId()->getIdentifier();
        $this->secrets[$identifier] = $secret;
    }

    public function findBySecretId(SecretId $secretId): ?Secret
    {
        $identifier = $secretId->getIdentifier();

        return $this->doesIdentifierInRepository($identifier)
            ? $this->secrets[$identifier]
            : null;
    }

    private function doesIdentifierInRepository($identifier): bool
    {
        return array_key_exists($identifier, $this->secrets);
    }

    public function remove(Secret $secret): void
    {
        $identifier = $secret->getSecretId()->getIdentifier();

        unset($this->secrets[$identifier]);
    }

    public function nextIdentity(): SecretId
    {
        $identifier = Uuid::uuid4();
        $secretId = $this->secretIdFactory->create($identifier);

        return $secretId;
    }

}