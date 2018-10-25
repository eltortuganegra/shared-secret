<?php

namespace SharedSecret\ValueObjects\Message;


interface Message
{
    public function getContent(): string;
}