<?php

namespace sdmd\Services;


use sdmd\Entities\EntitiesFactory;
use sdmd\Infrastructure\Mailers\Mailer;
use sdmd\Infrastructure\Repositories\SecretRepository;
use sdmd\Services\SecretCreateService\SecretCreateServiceImp;
use sdmd\Services\SecretDeleteService\SecretDeleteServiceImp;
use sdmd\Services\SecretFindService\SecretFindServiceImp;
use sdmd\Services\SecretUnveilService\SecretUnveilServiceImp;
use sdmd\ValueObjects\ValueObjectsFactory;

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