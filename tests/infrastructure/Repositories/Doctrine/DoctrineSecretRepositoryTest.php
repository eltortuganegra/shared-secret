<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;
use sdmd\Infrastructure\Repositories\RepositoriesFactory;
use sdmd\Infrastructure\Repositories\SecretRepository;
use sdmd\ValueObjects\SecretId\SecretId;

class DoctrineSecretRepositoryTest extends TestCase
{
    private $secretRepository;

    public function setUp()
    {
        $paths = [
            dirname(__FILE__) . '/entities'
        ];
        $isDevMode = false;
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'shared_secret',
            'password' => 'shared_secret',
            'dbname'   => 'shared_secret',
        );

        $entityManager = EntityManager::create($dbParams, $config);
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