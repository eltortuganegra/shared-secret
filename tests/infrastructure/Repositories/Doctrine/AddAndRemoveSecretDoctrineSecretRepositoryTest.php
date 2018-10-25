<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;
use sdmd\Entities\EntitiesFactory;
use sdmd\Infrastructure\Repositories\Doctrine\EntityManagerFactory;
use sdmd\Infrastructure\Repositories\RepositoriesFactory;
use sdmd\ValueObjects\ValueObjectsFactory;
use Ramsey\Uuid\Uuid;

class AddAndRemoveSecretDoctrineSecretRepositoryTest extends TestCase
{
    private $secret;
    private $secretRepository;
    private $secretId;

    public function setUp()
    {
//        // Arrange
//        $paths = [
//            dirname(__FILE__) . '/../../../../../src/Infrastructure/Repositories/Doctrine/Entities'
//        ];
//        var_dump(
//        dirname(__FILE__) . '/../../../../src/Infrastructure/Repositories/Doctrine/Entities'
//        );
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

        $entityManagerFactory = new EntityManagerFactory();
        $entityManager = $entityManagerFactory->getEntityManager();

        $this->secretRepository = RepositoriesFactory::getDoctrineSecretRepository($entityManager);

        $identifier = Uuid::uuid4();
        $messageText = 'This is a secret message.';
        $messageFactory = ValueObjectsFactory::getMessageFactory();
        $message = $messageFactory->create($messageText);
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();
        $this->secretId = $secretIdFactory->create($identifier);
        $secretFactory = EntitiesFactory::getSecretFactory();
        $expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();
        $expirationSecretSeconds = 60;
        $expirationTime = $expirationTimeFactory->create($expirationSecretSeconds);
        $this->secret = $secretFactory->create($this->secretId, $message, $expirationTime);

    }

    public function testSecretMustCanBePersisted()
    {
        // Arrange
        $this->secretRepository->add($this->secret);
        $expirationDate = $this->secret->getExpirationDate()->format('Y-m-d H:i:s');
        $result = $this->secretRepository->findBySecretId($this->secretId);

        // Act
        $returnedExpirationDate = $result->getExpirationDate()->format('Y-m-d H:i:s');

        // Assert
        $this->assertEquals($expirationDate, $returnedExpirationDate);
    }

    public function testShouldRemoveASecretFromRepository()
    {
        // Arrange
        $this->secretRepository->add($this->secret);
        $this->secretRepository->remove($this->secret);

        // Act
        $result = $this->secretRepository->findBySecretId($this->secretId);

        // Assert
        $this->assertEquals(null, $result);
    }

}