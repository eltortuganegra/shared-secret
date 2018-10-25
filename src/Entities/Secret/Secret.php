<?php

namespace SharedSecret\Entities\Secret;

use SharedSecret\ValueObjects\ExpirationTime\ExpirationTime;
use SharedSecret\ValueObjects\Message\Message;
use SharedSecret\ValueObjects\SecretId\SecretId;
use DateTime;

interface Secret
{
    public function getSecretId(): SecretId;
    public function getMessage(): Message;
    public function getLinkForShare(): string;
    public function getExpirationTime(): ExpirationTime;
    public function getExpirationDate(): DateTime;
}