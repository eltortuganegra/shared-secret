<?php

use sdmd\ValueObjects\Message\MessageFactoryImp;
use sdmd\ValueObjects\Message\MessageIsVoidException;
use sdmd\ValueObjects\ValueObjectsFactory;
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