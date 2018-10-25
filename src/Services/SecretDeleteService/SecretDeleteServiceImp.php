<?php

namespace SharedSecret\Services\SecretDeleteService;

use SharedSecret\Infrastructure\Repositories\SecretRepository;
use SharedSecret\Services\Service;
use SharedSecret\Services\ServiceRequest;
use SharedSecret\Services\ServiceResponse;

class SecretDeleteServiceImp implements Service, SecretDeleteService
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
        $this->secretRepository->remove($secret);
        $response = new SecretDeleteServiceResponse($secretId);

        return $response;
    }
}