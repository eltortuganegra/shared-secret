<?php

namespace SharedSecret\Infrastructure\Repositories;


use SharedSecret\Entities\EntitiesFactory;
use SharedSecret\Infrastructure\Repositories\Doctrine\DoctrineSecretRepository;
use SharedSecret\Infrastructure\Repositories\Memory\MemorySecretRepository;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use Doctrine\ORM\EntityManagerInterface;

class RepositoriesFactory
{
    static public function getMemorySecretRepository()
    {
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();

        return new MemorySecretRepository($secretIdFactory);
    }

    static public function getDoctrineSecretRepository(EntityManagerInterface $entityManager)
    {
        $secretFactory = EntitiesFactory::getSecretFactory();
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();
        $messageFactory = ValueObjectsFactory::getMessageFactory();
        $expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();

        return new DoctrineSecretRepository(
            $entityManager,
            $secretFactory,
            $secretIdFactory,
            $messageFactory,
            $expirationTimeFactory

        );
    }
}