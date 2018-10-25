<?php

namespace SharedSecret\Infrastructure\Repositories\Doctrine;


use SharedSecret\Entities\Secret\Secret;
use SharedSecret\Entities\Secret\SecretFactory;
use SharedSecret\ValueObjects\ExpirationTime\ExpirationTimeFactory;
use SharedSecret\ValueObjects\Message\MessageFactory;
use SharedSecret\ValueObjects\SecretId\SecretId;
use SharedSecret\ValueObjects\SecretId\SecretIdFactory;
use Doctrine\ORM\EntityManager;

class FindSecretFromDoctrineSecretRepository
{
    private $entityManager;
    private $secretFactory;
    private $secretIdFactory;
    private $messageFactory;
    private $expirationTimeFactory;

    public function __construct(
        EntityManager $entityManager,
        SecretFactory $secretFactory,
        SecretIdFactory $secretIdFactory,
        MessageFactory $messageFactory,
        ExpirationTimeFactory $expirationTimeFactory)
    {
        $this->entityManager = $entityManager;
        $this->secretFactory = $secretFactory;
        $this->secretIdFactory = $secretIdFactory;
        $this->messageFactory = $messageFactory;
        $this->expirationTimeFactory = $expirationTimeFactory;
    }

    public function execute(SecretId $secretId): ?Secret
    {
        $result = $this->entityManager->getRepository(\SharedSecret\Infrastructure\Repositories\Doctrine\Entities\Secret::class)->findOneBy([
            'secretId' => $secretId->getIdentifier()
        ]);

        if (empty($result)) {
            return null;
        }

        $secretId = $this->secretIdFactory->create($result->getSecretId());
        $message = $this->messageFactory->create($result->getMessage());
        $expirationTime = $this->expirationTimeFactory->create($result->getExpirationTime());
        $expirationDate = $result->getExpiredAt();
        $secret = $this->secretFactory->createFromRepository($secretId, $message, $expirationTime, $expirationDate);

        return $secret;
    }

}