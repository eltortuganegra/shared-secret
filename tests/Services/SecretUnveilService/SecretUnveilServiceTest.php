<?php

use sdmd\Entities\EntitiesFactory;
use sdmd\Infrastructure\Repositories\RepositoriesFactory;
use sdmd\Services\SecretUnveilService\SecretUnveilServiceRequest;
use sdmd\Services\Service;
use sdmd\Services\ServicesFactory;
use sdmd\ValueObjects\ExpirationTime\ExpirationTime;
use sdmd\ValueObjects\Message\Message;
use sdmd\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class SecretUnveilServiceTest extends TestCase
{
    private $serviceResponse;
    private $secret;
    private $secretRepository;

    public function setUp()
    {
        $this->loadSecretRepository();
        $this->createDefaultSecret();
        $this->addSecretToTheRepository();
        $serviceRequest = $this->buildServiceRequest();
        $service = $this->buildSecretUnveilService();
        $this->serviceResponse = $service->execute($serviceRequest);
    }

    private function createDefaultSecret(): void
    {
        $secretId = $this->generateSecretId();
        $message = $this->generateMessage();
        $expirationTime = $this->generateExpirationTime();
        $this->generateSecret($secretId, $message, $expirationTime);
    }

    private function loadSecretRepository(): void
    {
        $this->secretRepository = RepositoriesFactory::getMemorySecretRepository();
    }

    private function generateSecretId()
    {
        $secretId = $this->secretRepository->nextIdentity();

        return $secretId;
    }

    private function generateMessage(): Message
    {
        $messageText = 'This is awesome secret message.';
        $messageFactory = ValueObjectsFactory::getMessageFactory();
        $message = $messageFactory->create($messageText);

        return $message;
    }

    private function generateExpirationTime(): ExpirationTime
    {
        $expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();
        $expirationTimeInSeconds = 120;
        $expirationTime = $expirationTimeFactory->create($expirationTimeInSeconds);

        return $expirationTime;
    }

    private function generateSecret($secretId, $message, $expirationTime): void
    {
        $secretFactory = EntitiesFactory::getSecretFactory();
        $this->secret = $secretFactory->create($secretId, $message, $expirationTime);
    }

    private function addSecretToTheRepository(): void
    {
        $this->secretRepository->add($this->secret);
    }

    private function buildServiceRequest()
    {
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();
        $serviceRequest = new SecretUnveilServiceRequest($secretIdFactory);
        $serviceRequest->setIdentifier($this->secret->getSecretId()->getIdentifier());
        $serviceRequest->setDomain('test.com');
        $serviceRequest->setProtocol('https');

        return $serviceRequest;
    }

    private function buildSecretUnveilService(): Service
    {
        $service = ServicesFactory::createSecretUnveilService($this->secretRepository);

        return $service;
    }

    public function testServiceMustReturnSecret()
    {
        // Act
        $returnedSecret = $this->serviceResponse->getSecret();

        // Assert
        $this->assertEquals($this->secret, $returnedSecret);
    }

    public function testServiceMustDeleteReturnedSecret()
    {
        // Arrange
        $secretId = $this->secret->getSecretId();

        // Act
        $returnedSecret = $this->secretRepository->findBySecretId($secretId);

        // Assert
        $this->assertEquals(null, $returnedSecret);
    }
}