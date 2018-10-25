<?php

namespace sdmd\Services\SecretDeleteService;

use sdmd\Infrastructure\Repositories\SecretRepository;
use sdmd\Services\Service;
use sdmd\Services\ServiceRequest;
use sdmd\Services\ServiceResponse;

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