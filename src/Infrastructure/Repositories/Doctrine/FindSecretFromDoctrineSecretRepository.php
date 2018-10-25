<?php

namespace sdmd\Infrastructure\Repositories\Doctrine;


use sdmd\Entities\Secret\Secret;
use sdmd\Entities\Secret\SecretFactory;
use sdmd\ValueObjects\ExpirationTime\ExpirationTimeFactory;
use sdmd\ValueObjects\Message\MessageFactory;
use sdmd\ValueObjects\SecretId\SecretId;
use sdmd\ValueObjects\SecretId\SecretIdFactory;
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
        $result = $this->entityManager->getRepository(\sdmd\Infrastructure\Repositories\Doctrine\Entities\Secret::class)->findOneBy([
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