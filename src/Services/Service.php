<?php

namespace SharedSecret\Services;


interface Service
{
    public function execute(ServiceRequest $serviceRequest): ServiceResponse;
}