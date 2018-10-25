<?php

namespace sdmd\Services;


interface Service
{
    public function execute(ServiceRequest $serviceRequest): ServiceResponse;
}