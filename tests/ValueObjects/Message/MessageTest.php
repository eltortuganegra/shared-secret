<?php

use SharedSecret\ValueObjects\Message\MessageFactoryImp;
use SharedSecret\ValueObjects\Message\MessageIsVoidException;
use SharedSecret\ValueObjects\ValueObjectsFactory;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testFactoryShouldReturnMessageWhenCreateMethodIsExecuted()
    {
        // Assert
        $this->expectException(MessageIsVoidException::class);

        // Arrange
        $message = '';
        $messageFactory = ValueObjectsFactory::getMessageFactory();

        // Act
        $messageFactory->create($message);
    }
}