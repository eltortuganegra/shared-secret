<?php

use sdmd\ValueObjects\SecretId\SecretId;
use sdmd\ValueObjects\SecretId\SecretIdFactoryImp;

use sdmd\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class SecretIdTest extends TestCase
{
    public function testCheckSecretId()
    {
        // Arrange
        $identifier = '1234';
        $secretIdFactory = ValueObjectsFactory::getSecretIdFactory();
        $secretId = $secretIdFactory->create($identifier);

        // Act
        $isInstanceOfSecretId = $secretId instanceof SecretId;

        // Assert
        $this->assertEquals(true, $isInstanceOfSecretId);
    }

}
