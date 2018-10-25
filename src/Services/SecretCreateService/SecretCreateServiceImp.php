<?php

namespace sdmd\Services\SecretCreateService;


use sdmd\Entities\Secret\SecretFactory;
use sdmd\Infrastructure\Mailers\Mailer;
use sdmd\Infrastructure\Repositories\SecretRepository;
use sdmd\Notifications\Email\SomebodyHasSharedASecretWithYouEmailNotification;
use sdmd\Services\Service;
use sdmd\Services\ServiceRequest;
use sdmd\Services\ServiceResponse;
use sdmd\ValueObjects\LinkForShare\LinkForShare;
use sdmd\ValueObjects\LinkForShare\LinkForShareFactory;
use sdmd\ValueObjects\ValueObjectsFactory;


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