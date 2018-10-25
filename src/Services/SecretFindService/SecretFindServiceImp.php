<?php

namespace sdmd\Services\SecretFindService;


use sdmd\Entities\Secret\Secret;
use sdmd\Infrastructure\Repositories\SecretRepository;
use sdmd\Services\SecretUnveilService\SecretNotFoundException;
use sdmd\Services\Service;
use sdmd\Services\ServiceRequest;
use sdmd\Services\ServiceResponse;
use DateTime;

class SecretFindServiceImp implements Service, SecretFindService
{
    private $secretRepository;

    public function __construct(SecretRepository $secretRepository)
    {
        $this->secretRepository = $secretRepository;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $secretId = $serviceRequest->getSecretId();
        $secret = $this->secretRepository->findBySecretId($secretId);


        if ($this->isSecretNotFound($secret)) {
            throw new SecretNotFoundException();
        }

        if ($this->isSecretExpired($secret)) {
            throw new SecretIsExpiredException();
        }

        return new SecretFindServiceResponse($secret);
    }

    private function isSecretNotFound($secret): bool
    {
        return empty($secret);
    }

    private function isSecretExpired(Secret $secret): bool
    {
        return $secret->getExpirationDate() < new DateTime();
    }
}