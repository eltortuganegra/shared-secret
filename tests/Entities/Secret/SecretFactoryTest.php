<?php

namespace App\tests\domain;


use sdmd\Entities\EntitiesFactory;
use sdmd\Entities\Secret\Secret;
use sdmd\Entities\Secret\SecretFactoryImp;
use sdmd\ValueObjects\ExpirationTime\ExpirationTimeFactoryImp;
use sdmd\ValueObjects\Message\MessageFactoryImp;
use sdmd\ValueObjects\SecretId\SecretIdFactoryImp;
use sdmd\ValueObjects\ValueObjectsFactory;
use DateTime;
use PHPUnit\Framework\TestCase;

class SecretFactoryTest extends TestCase
{
    public function testFactoryMustReturnSecret()
    {
        // Arrange
        $identifier = '1234';
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();
        $secretId = $secretIdFactory->create($identifier);
        $messageText = 'This is a message.';
        $messageFactory = ValueObjectsFactory::getMessageFactory();
        $message = $messageFactory->create($messageText);
        $secretFactory = EntitiesFactory::getSecretFactory();
        $expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();
        $expirationTimeInSeconds = 120;
        $expirationTime = $expirationTimeFactory->create($expirationTimeInSeconds);
        $secret = $secretFactory->create($secretId, $message, $expirationTime);

        // Act
        $isReturnedInstanceASecret = $secret instanceof Secret;

        // Assert
        $this->assertEquals(true, $isReturnedInstanceASecret);
    }

}