<?php

namespace sdmd\Infrastructure\Repositories\Doctrine;


use sdmd\Entities\Secret\Secret;
use Doctrine\ORM\EntityManager;

class RemoveSecretFromDoctrineSecretRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(Secret $secret): void
    {
        $secretEntity = $this->entityManager->getRepository(\sdmd\Infrastructure\Repositories\Doctrine\Entities\Secret::class)->findOneBy([
            'secretId' => $secret->getSecretId()->getIdentifier()
        ]);
        $this->entityManager->remove($secretEntity);
        $this->entityManager->flush();
    }

}