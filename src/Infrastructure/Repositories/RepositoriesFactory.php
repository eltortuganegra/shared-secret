<?php

namespace sdmd\Infrastructure\Repositories;


use sdmd\Entities\EntitiesFactory;
use sdmd\Infrastructure\Repositories\Doctrine\DoctrineSecretRepository;
use sdmd\Infrastructure\Repositories\Memory\MemorySecretRepository;
use sdmd\ValueObjects\ValueObjectsFactory;
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