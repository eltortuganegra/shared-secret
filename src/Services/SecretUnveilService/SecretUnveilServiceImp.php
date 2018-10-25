<?php

namespace sdmd\Services\SecretUnveilService;

use sdmd\Infrastructure\Repositories\SecretRepository;
use sdmd\Services\Service;
use sdmd\Services\ServiceRequest;
use sdmd\Services\ServiceResponse;
use sdmd\ValueObjects\LinkForShare\LinkForShare;
use sdmd\ValueObjects\LinkForShare\LinkForShareFactory;
use DateTime;

class SecretUnveilServiceImp implements Service, SecretUnveilService
{
    private $secretRepository;
    private $linkForShareFactory;
    private $secret;

    public function __construct(SecretRepository $secretRepository, LinkForShareFactory $linkForShareFactory)
    {
        $this->secretRepository = $secretRepository;
        $this->linkForShareFactory = $linkForShareFactory;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $this->findSecretInRepository($serviceRequest);
        $this->validations();
        $this->removeSecretFromRepository();

        return $this->builtResponse($serviceRequest);
    }

    private function validations(): void
    {
        if (empty($this->secret)) {
            throw new SecretNotFoundException('WTF');
        }
        if ($this->isSecretExpired()) {
            throw new ExpirationTimeIsExpiredException();
        }
    }

    private function isSecretExpired(): bool
    {
        return $this->secret->getExpirationDate() < new DateTime();
    }

    private function builtLinkForShare(ServiceRequest $serviceRequest): LinkForShare
    {
        $linkForShare = $this->linkForShareFactory->create(
            $serviceRequest->getProtocol(),
            $serviceRequest->getDomain(),
            $serviceRequest->getIdentifier()
        );

        return $linkForShare;
    }


    private function findSecretInRepository(ServiceRequest $serviceRequest): void
    {
        $secretId = $serviceRequest->getSecretId();
        $this->secret = $this->secretRepository->findBySecretId($secretId);
    }

    private function removeSecretFromRepository(): void
    {
        $this->secretRepository->remove($this->secret);
    }

    private function builtResponse(ServiceRequest $serviceRequest): SecretUnveilResponse
    {
        $linkForShare = $this->builtLinkForShare($serviceRequest);

        return new SecretUnveilResponse($this->secret, $linkForShare);
    }

}