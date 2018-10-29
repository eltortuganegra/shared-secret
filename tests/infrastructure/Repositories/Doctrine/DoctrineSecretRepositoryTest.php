<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;
use SharedSecret\Infrastructure\Repositories\Doctrine\DataBaseConnectionParameters;
use SharedSecret\Infrastructure\Repositories\Doctrine\EntityManagerFactory;
use SharedSecret\Infrastructure\Repositories\RepositoriesFactory;
use SharedSecret\Infrastructure\Repositories\SecretRepository;
use SharedSecret\ValueObjects\SecretId\SecretId;

class DoctrineSecretRepositoryTest extends TestCase
{
    private $secretRepository;

    public function setUp()
    {
//        $paths = [
//            dirname(__FILE__) . '/entities'
//        ];
//        $isDevMode = false;
//        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
//        $dbParams = array(
//            'driver'   => 'pdo_mysql',
//            'user'     => 'shared_secret',
//            'password' => 'shared_secret',
//            'dbname'   => 'shared_secret',
//        );
//
//        $entityManager = EntityManager::create($dbParams, $config);

        $config = new DataBaseConnectionParameters(
            'pdo_mysql',
            'shared_secret',
            'shared_secret',
            'shared_secret'
        );
        $entityManagerFactory = new EntityManagerFactory($config);
        $entityManager = $entityManagerFactory->getEntityManager();

        $this->secretRepository = RepositoriesFactory::getDoctrineSecretRepository($entityManager);
    }

    public function testShouldReturnNextSecretId()
    {
        // Arrange
        $secretId = $this->secretRepository->nextIdentity();

        // Act
        $isSecretId = $secretId instanceof SecretId;

        // Assert
        $this->assertEquals(true, $isSecretId);
    }

    public function testShouldReturnDoctrineSecretRepository()
    {
        // Act
        $isSecretRepository = $this->secretRepository instanceof SecretRepository;

        // Assert
        $this->assertEquals(true, $isSecretRepository);
    }

}