<?php

namespace SharedSecret\ValueObjects\Mail;


interface MailFactory
{
    public function create(string $value): Mail;
}