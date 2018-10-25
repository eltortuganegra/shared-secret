<?php

use SharedSecret\ValueObjects\ExpirationTime\ExpirationTimeFactory;
use SharedSecret\ValueObjects\LinkForShare\LinkForShareFactory;
use SharedSecret\ValueObjects\Message\MessageFactory;
use SharedSecret\ValueObjects\SecretId\SecretIdFactory;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class ValueObjectsFactoryTest extends TestCase
{
    public function testShouldReturnASecretIdFactory()
    {
        // Arrange
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();

        // Act
        $isSecretIdFactory = $secretIdFactory instanceof SecretIdFactory;

        //Assert
        $this->assertEquals(true, $isSecretIdFactory);
    }

    public function testShouldReturnAMessageFactory()
    {
        // Arrange
        $secretIdFactory = ValueObjectsFactory::getMessageFactory();

        // Act
        $isMessageFactory = $secretIdFactory instanceof MessageFactory;

        //Assert
        $this->assertEquals(true, $isMessageFactory);
    }

    public function testShouldReturnALinkForShareFactory()
    {
        // Arrange
        $linkForShareFactory = ValueObjectsFactory::getLinkForShareFactory();

        // Act
        $isLinkForShareFactory = $linkForShareFactory instanceof LinkForShareFactory;

        //Assert
        $this->assertEquals(true, $isLinkForShareFactory);
    }

    public function testShouldReturnAnExpirationTimeFactory()
    {
        // Arrange
        $expirationTimeFactory = ValueObjectsFactory::getExpirationTimeFactory();

        // Act
        $isExpirationTimeFactory = $expirationTimeFactory instanceof ExpirationTimeFactory;

        //Assert
        $this->assertEquals(true, $isExpirationTimeFactory);
    }
}