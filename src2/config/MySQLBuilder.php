<?php


namespace Config;

require_once __DIR__ . '/DatabaseBuilder.php'; 
require_once __DIR__ . '/DatabaseConnection.php'; 


class MySQLBuilder implements DatabaseBuilder
{
    private string $host;
    private int $port;
    private string $database;
    private string $username;
    private string $password;

    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    public function setDatabase(string $database): self
    {
        $this->database = $database;
        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getResult(): DatabaseConnection
    {
        return new DatabaseConnection($this->host, $this->port, $this->database, $this->username, $this->password);
    }
}
