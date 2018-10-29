<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;
use SharedSecret\Entities\EntitiesFactory;
use SharedSecret\Infrastructure\Repositories\Doctrine\DataBaseConnectionParameters;
use SharedSecret\Infrastructure\Repositories\Doctrine\EntityManagerFactory;
use SharedSecret\Infrastructure\Repositories\RepositoriesFactory;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use Ramsey\Uuid\Uuid;

class AddAndRemoveSecretDoctrineSecretRepositoryTest extends TestCase
{
    private $secret;
    private $secretRepository;
    private $secretId;

    public function setUp()
    {
        $config = new DataBaseConnectionParameters(
            'pdo_mysql',
            'shared_secret',
            'shared_secret',
            'shared_secret'
        );
        $entityManagerFactory = new EntityManagerFactory($config);
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