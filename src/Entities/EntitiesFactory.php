<?php

namespace SharedSecret\Entities;

use SharedSecret\Entities\Secret\SecretFactory;
use SharedSecret\Entities\Secret\SecretFactoryImp;

class EntitiesFactory
{
    static public function getSecretFactory(): SecretFactory
    {
        return new SecretFactoryImp();
    }

}