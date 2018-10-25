<?php

use SharedSecret\Entities\EntitiesFactory;
use SharedSecret\Infrastructure\Repositories\RepositoriesFactory;
use SharedSecret\Infrastructure\Repositories\SecretRepository;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class MemorySecretRepositoryTest extends TestCase
{
    private $secret;
    private $secretRepository;

    public function setUp()
    {
        $this->loadSecretRepository();
        $this->loadSecret();
    }

    private function loadSecretRepository(): void
    {
        $this->secretRepository = RepositoriesFactory::getMemorySecretRepository();
    }

    private function loadSecret(): void
    {
        $secretFactory = EntitiesFactory::getSecretFactory();
        $secretId = $this->secretRepository->nextIdentity();
        $messageFactory = ValueObjectsFactory::getMessageFactory();
        $messageText = 'This is a valid message';
        $message = $messageFactory->create($messageText);
        $expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();
        $expirationTimeInSeconds = 120;
        $expirationTime = $expirationTimeFactory->create($expirationTimeInSeconds);
        $this->secret = $secretFactory->create($secretId, $message, $expirationTime);
    }

    public function testShouldAddASecretToRepository()
    {
        // Arrange
        $this->secretRepository->add($this->secret);

        // Act
        $result = $this->secretRepository->findBySecretId($this->secret->getSecretId());

        // Assert
        $this->assertEquals($this->secret, $result);
    }

    public function testShouldRemoveASecretToRepository()
    {
        // Arrange
        $this->secretRepository->remove($this->secret);

        // Act
        $result = $this->secretRepository->findBySecretId($this->secret->getSecretId());

        // Assert
        $this->assertEquals(null, $result);
    }

    public function testShouldReturnMemorySecretRepository()
    {
        // Arrange
        $secretRepository = RepositoriesFactory::getMemorySecretRepository();

        // Act
        $isSecretRepository = $secretRepository instanceof SecretRepository;

        // Assert
        $this->assertEquals(true, $isSecretRepository);
    }

}