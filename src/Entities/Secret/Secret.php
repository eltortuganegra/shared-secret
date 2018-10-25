<?php

namespace sdmd\Entities\Secret;

use sdmd\ValueObjects\ExpirationTime\ExpirationTime;
use sdmd\ValueObjects\Message\Message;
use sdmd\ValueObjects\SecretId\SecretId;
use DateTime;

interface Secret
{
    public function getSecretId(): SecretId;
    public function getMessage(): Message;
    public function getLinkForShare(): string;
    public function getExpirationTime(): ExpirationTime;
    public function getExpirationDate(): DateTime;
}