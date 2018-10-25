<?php

use SharedSecret\Infrastructure\Mailers\MailerFactory;
use SharedSecret\Infrastructure\Repositories\RepositoriesFactory;
use SharedSecret\Services\SecretCreateService\SecretCreateService;
use SharedSecret\Services\SecretDeleteService\SecretDeleteService;
use SharedSecret\Services\SecretUnveilService\SecretUnveilService;
use SharedSecret\Services\ServicesFactory;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class ServicesFactoryTest extends TestCase
{
    public function testShouldReturnASecretCreateService()
    {
        // Arrange
        $secretRepository = RepositoriesFactory::getMemorySecretRepository();
        $mailer = MailerFactory::createMemoryMailer();
        $service = ServicesFactory::createSecretCreateService($secretRepository, $mailer);

        // Act
        $isServiceASecretCreateService = $service instanceof SecretCreateService;

        // Assert
        $this->assertEquals(true, $isServiceASecretCreateService);
    }

    public function testShouldReturnASecretDeleteService()
    {
        // Arrange
        $secretRepository = RepositoriesFactory::getMemorySecretRepository();
        $service = ServicesFactory::createSecretDeleteService($secretRepository);

        // Act
        $isServiceASecretCreateService = $service instanceof SecretDeleteService;

        // Assert
        $this->assertEquals(true, $isServiceASecretCreateService);
    }

    public function testShouldReturnASecretUnveilService()
    {
        // Arrange
        $secretRepository = RepositoriesFactory::getMemorySecretRepository();
        $service = ServicesFactory::createSecretUnveilService($secretRepository);

        // Act
        $isServiceASecretShowAndDestroyService = $service instanceof SecretUnveilService;

        // Assert
        $this->assertEquals(true, $isServiceASecretShowAndDestroyService);
    }

}