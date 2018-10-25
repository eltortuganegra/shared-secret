<?php

namespace App\tests\domain;


use SharedSecret\Entities\EntitiesFactory;
use SharedSecret\Entities\Secret\Secret;
use SharedSecret\Entities\Secret\SecretFactoryImp;
use SharedSecret\ValueObjects\ExpirationTime\ExpirationTimeFactoryImp;
use SharedSecret\ValueObjects\Message\MessageFactoryImp;
use SharedSecret\ValueObjects\SecretId\SecretIdFactoryImp;
use SharedSecret\ValueObjects\ValueObjectsFactory;
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