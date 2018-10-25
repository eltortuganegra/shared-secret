<?php

namespace SharedSecret\ValueObjects\Message;


interface MessageFactory
{
    public function create(string $message): Message;
}