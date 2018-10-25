<?php

namespace sdmd\ValueObjects\Message;


interface Message
{
    public function getContent(): string;
}