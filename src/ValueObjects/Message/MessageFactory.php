<?php

namespace sdmd\ValueObjects\Message;


interface MessageFactory
{
    public function create(string $message): Message;
}