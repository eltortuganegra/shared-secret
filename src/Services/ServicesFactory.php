<?php

namespace SharedSecret\Services;


use SharedSecret\Entities\EntitiesFactory;
use SharedSecret\Infrastructure\Mailers\Mailer;
use SharedSecret\Infrastructure\Repositories\SecretRepository;
use SharedSecret\Services\SecretCreateService\SecretCreateServiceImp;
use SharedSecret\Services\SecretDeleteService\SecretDeleteServiceImp;
use SharedSecret\Services\SecretFindService\SecretFindServiceImp;
use SharedSecret\Services\SecretUnveilService\SecretUnveilServiceImp;
use SharedSecret\ValueObjects\ValueObjectsFactory;

class ServicesFactory
{
    static public function createSecretDeleteService(SecretRepository $secretRepository): Service
    {
        $service = new SecretDeleteServiceImp($secretRepository);

        return $service;
    }

    static public function createSecretCreateService(SecretRepository $secretRepository, Mailer $mailer): Service
    {
        $secretFactory = EntitiesFactory::getSecretFactory();
        $linkForShareFactory = ValueObjectsFactory::getLinkForShareFactory();
        $service = new SecretCreateServiceImp($secretFactory, $linkForShareFactory, $secretRepository, $mailer);

        return $service;
    }

    static public function createSecretUnveilService(SecretRepository $secretRepository): Service
    {
        $linkForShareFactory = ValueObjectsFactory::getLinkForShareFactory();
        $service = new SecretUnveilServiceImp($secretRepository, $linkForShareFactory, $secretRepository);

        return $service;
    }

    static public function createSecretFindService(SecretRepository $secretRepository): Service
    {
        $service = new SecretFindServiceImp($secretRepository);

        return $service;
    }

}