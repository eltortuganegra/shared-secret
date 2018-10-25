<?php

namespace SharedSecret\Services\SecretCreateService;


use SharedSecret\Entities\Secret\SecretFactory;
use SharedSecret\Infrastructure\Mailers\Mailer;
use SharedSecret\Infrastructure\Repositories\SecretRepository;
use SharedSecret\Notifications\Email\SomebodyHasSharedASecretWithYouEmailNotification;
use SharedSecret\Services\Service;
use SharedSecret\Services\ServiceRequest;
use SharedSecret\Services\ServiceResponse;
use SharedSecret\ValueObjects\LinkForShare\LinkForShare;
use SharedSecret\ValueObjects\LinkForShare\LinkForShareFactory;
use SharedSecret\ValueObjects\ValueObjectsFactory;


class SecretCreateServiceImp implements Service, SecretCreateService
{
    private $secretFactory;
    private $linkForShareFactory;
    private $secretRepository;
    private $secret;
    private $serviceRequest;
    private $serviceResponse;
    private $mailer;

    public function __construct(
        SecretFactory $secretFactory,
        LinkForShareFactory $linkForShareFactory,
        SecretRepository $secretRepository,
        Mailer $mailer)
    {
        $this->secretFactory = $secretFactory;
        $this->linkForShareFactory = $linkForShareFactory;
        $this->secretRepository = $secretRepository;
        $this->mailer = $mailer;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $this->loadServiceRequest($serviceRequest);
        $this->createSecretFromServiceRequest();
        $this->persistSecret();
        $this->buildResponse();
        if ($this->doesUserWantSendByEmailTheSharedLink()) {
            $this->sendNotificationByEmail();
        }

        return $this->serviceResponse;
    }

    private function createSecretFromServiceRequest()
    {
        $secretId = $this->secretRepository->nextIdentity();

        $this->secret = $this->secretFactory->create(
            $secretId,
            $this->serviceRequest->getMessage(),
            $this->serviceRequest->getExpirationTime()
        );
    }

    private function persistSecret(): void
    {
        $this->secretRepository->add($this->secret);
    }

    private function buildResponse(): void
    {
        $secret = $this->secretRepository->findBySecretId($this->secret->getSecretId());
        $linkForShare = $this->linkForShareFactory->create(
            $this->serviceRequest->getProtocol(),
            $this->serviceRequest->getDomain(),
            $this->secret->getSecretId()->getIdentifier()
        );

        $this->serviceResponse = new SecretCreateServiceResponse($secret, $linkForShare, $this->mailer->isMailSent());
    }

    private function loadServiceRequest(ServiceRequest $serviceRequest): void
    {
        $this->serviceRequest = $serviceRequest;
    }

    private function doesUserWantSendByEmailTheSharedLink(): bool
    {
        return ! empty($this->serviceRequest->getToMail());
    }

    private function sendNotificationByEmail(): void
    {
        $linkForShare = $this->serviceResponse->getLinkForShare();
        $mailFactory = ValueObjectsFactory::getMailFactory();
        $fromMail = $mailFactory->create($this->serviceRequest->getFromMail());
        $toMail = $mailFactory->create($this->serviceRequest->getToMail());
        $somebodyHasSharedASecretWithYouEmailNotification = new SomebodyHasSharedASecretWithYouEmailNotification($linkForShare);
        $subject = $somebodyHasSharedASecretWithYouEmailNotification->getSubject();
        $body = $somebodyHasSharedASecretWithYouEmailNotification->getBody();

        $this->mailer->send($fromMail, $toMail, $subject, $body);
    }
}