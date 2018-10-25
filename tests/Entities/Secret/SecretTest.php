<?php

namespace App\tests\domain;

use sdmd\Entities\EntitiesFactory;
use sdmd\ValueObjects\ExpirationTime\ExpirationTime;
use sdmd\ValueObjects\ExpirationTime\ExpirationTimeFactoryImp;
use sdmd\ValueObjects\Message\MessageFactoryImp;
use sdmd\ValueObjects\ValueObjectsFactory;
use DateTime;
use PHPUnit\Framework\TestCase;
use sdmd\Entities\Secret\SecretFactoryImp;

class SecretTest extends TestCase
{
    private $secretId;
    private $message;
    private $secret;

    public function setUp()
    {
        $identifier = '1234';
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();
        $this->secretId = $secretIdFactory->create($identifier);
        $messageFactory = ValueObjectsFactory::getMessageFactory();
        $this->message = $messageFactory->create('This is a secret.');
        $secretFactory = EntitiesFactory::getSecretFactory();
        $expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();
        $expirationTimeInSeconds = 120;
        $expirationTime = $expirationTimeFactory->create($expirationTimeInSeconds);
        $this->secret = $secretFactory->create($this->secretId, $this->message, $expirationTime);
    }

    public function testGetIdentifier()
    {
        // Act
        $secretId = $this->secret->getSecretId();

        // Arrange
        $this->assertEquals($this->secretId, $secretId);
    }

    public function testGetMessage()
    {
        // Act
        $message = $this->secret->getMessage();

        // Arrange
        $this->assertEquals($this->message, $message);
    }

    public function testGetExpirationTime()
    {
        // Arrange
        $expirationTime = $this->secret->getExpirationTime();

        // Act
        $isExpirationTime = $expirationTime instanceof ExpirationTime;


        // Arrange
        $this->assertEquals(true, $isExpirationTime);
    }

    public function testGetExpirationDate()
    {
        // Arrange
        $expirationDate = $this->secret->getExpirationDate();

        // Act
        $isExpirationDateADateTime = $expirationDate instanceof DateTime;


        // Arrange
        $this->assertEquals(true, $isExpirationDateADateTime);
    }

}
