<?php

namespace App\tests\domain\Services;

use SharedSecret\Entities\EntitiesFactory;
use SharedSecret\Infrastructure\Repositories\RepositoriesFactory;
use SharedSecret\Services\SecretDeleteService\SecretDeleteServiceRequest;
use SharedSecret\Services\ServicesFactory;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class SecretDeleteServiceTest extends TestCase
{
    public function testShouldRemoveSecretFromRepositoryWhenServiceIsExecute()
    {
        // Arrange
        $identifier = 'valid identifier';
        $message = 'valid message';
        $expirationTime = 60;
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();
        $secretId = $secretIdFactory->create($identifier);
        $secretFactory = EntitiesFactory::getSecretFactory();
        $messageFactory = ValueObjectsFactory::getMessageFactory();
        $message = $messageFactory->create($message);
        $expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();
        $expirationDate = $expirationTimeFactory->create($expirationTime);
        $secret = $secretFactory->create($secretId, $message, $expirationDate );
        $secretRepository = RepositoriesFactory::getMemorySecretRepository();
        $secretRepository->add($secret);

        $serviceRequest = new SecretDeleteServiceRequest($identifier);
        $service = ServicesFactory::createSecretDeleteService($secretRepository);
        $serviceResponse = $service->execute($serviceRequest);

        // Act
        $result = $secretRepository->findBySecretId($secretId);

        // Assert
        $this->assertEquals(null, $result);
    }

}