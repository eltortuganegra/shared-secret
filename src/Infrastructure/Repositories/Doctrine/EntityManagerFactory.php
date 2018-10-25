<?php

namespace sdmd\Infrastructure\Repositories\Doctrine;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

class EntityManagerFactory
{
    private $entityManager;

    public function __construct()
    {
        $paths = [
            dirname(__FILE__) . '/Entities'
        ];

        $isDevMode = false;
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'shared_secret',
            'password' => 'shared_secret',
            'dbname'   => 'shared_secret',
        );

        $this->entityManager = EntityManager::create($dbParams, $config);

//        $secret = $this->entityManager->find("Secret", 5);
//        var_dump($secret);
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}