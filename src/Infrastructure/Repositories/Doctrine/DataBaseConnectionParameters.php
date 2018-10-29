<?php

namespace SharedSecret\Infrastructure\Repositories\Doctrine;


class DataBaseConnectionParameters
{
    private $driver;
    private $username;
    private $password;
    private $databaseName;

    public function __construct(string $driver, string $username, string $password, string $databaseName)
    {
        $this->driver = $driver;
        $this->username = $username;
        $this->password = $password;
        $this->databaseName = $databaseName;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

}