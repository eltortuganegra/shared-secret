<?php

namespace sdmd\Entities;

use sdmd\Entities\Secret\SecretFactory;
use sdmd\Entities\Secret\SecretFactoryImp;

class EntitiesFactory
{
    static public function getSecretFactory(): SecretFactory
    {
        return new SecretFactoryImp();
    }

}