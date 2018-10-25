<?php

namespace sdmd\ValueObjects\Mail;


interface MailFactory
{
    public function create(string $value): Mail;
}