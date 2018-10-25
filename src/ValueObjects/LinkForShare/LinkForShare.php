<?php

namespace SharedSecret\ValueObjects\LinkForShare;


interface LinkForShare
{
    public function getUrl(): string;
}