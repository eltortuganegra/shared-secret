<?php

namespace SharedSecret\Infrastructure\Repositories\Doctrine;


use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

class EntityManagerFactory
{
    private $entityManager;

    public function __construct(DataBaseConnectionParameters $dataBaseConnectionParameters)
    {
        $config = $this->loadConfig();
        $this->loadEntityManager($dataBaseConnectionParameters, $config);
    }

    private function loadConfig(): Configuration
    {
        $paths = [
            dirname(__FILE__) . '/Entities'
        ];
        $isDevMode = false;
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

        return $config;
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    private function loadEntityManager(DataBaseConnectionParameters $dataBaseConnectionParameters, $config)
    {
        $dbParams = array(
            'driver' => $dataBaseConnectionParameters->getDriver(),
            'user' => $dataBaseConnectionParameters->getUsername(),
            'password' => $dataBaseConnectionParameters->getPassword(),
            'dbname' => $dataBaseConnectionParameters->getDatabaseName(),
        );

        $this->entityManager = EntityManager::create($dbParams, $config);
    }


}