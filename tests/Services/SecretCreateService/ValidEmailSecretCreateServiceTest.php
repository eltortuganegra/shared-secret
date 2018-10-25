<?php

namespace App\tests\domain\Services;


use SharedSecret\Infrastructure\Mailers\MailerFactory;
use SharedSecret\Infrastructure\Mailers\MemoryMailerFactoryInterfaceImp;
use SharedSecret\Infrastructure\Repositories\RepositoriesFactory;
use SharedSecret\Services\SecretCreateService\SecretCreateServiceRequest;
use SharedSecret\Services\ServicesFactory;
use PHPUnit\Framework\TestCase;

class ValidEmailSecretCreateServiceTest extends TestCase
{
    private $requestService;
    private $service;
    private $responseService;

    public function testItShouldCreateSecretAndSendMail()
    {
        // Arrange
        $this->buildRequestService();
        $this->buildService();
        $this->executeService();

        // Act
        $wasMailSent = $this->responseService->wasMailSent();

        // Assert
        $this->assertTrue($wasMailSent);

    }

    private function buildRequestService(): void
    {
        $message = 'This is de body of message';
        $expirationTime = 600;
        $protocol = 'http';
        $domain = 'sharedsecrets.eltortuganegra.com';
        $fromMail = 'no-reply@eltortuganegar.com';
        $toMail = 'test@eltortuganegra.com';

        $this->requestService = new SecretCreateServiceRequest();
        $this->requestService->setMessage($message);
        $this->requestService->setProtocol($protocol);
        $this->requestService->setDomain($domain);
        $this->requestService->setExpirationTimeInSeconds($expirationTime);
        $this->requestService->setFromMail($fromMail);
        $this->requestService->setToMail($toMail);
    }

    private function buildService(): void
    {
        $memoryRepository = RepositoriesFactory::getMemorySecretRepository();
        $memoryMailer = MailerFactory::createMemoryMailer();

        $this->service = ServicesFactory::createSecretCreateService($memoryRepository, $memoryMailer);
    }

    private function executeService(): void
    {
        $this->responseService = $this->service->execute($this->requestService);
    }

}
