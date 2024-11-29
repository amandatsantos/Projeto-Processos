<?php

namespace Config;


interface DatabaseBuilder
{
    public function setHost(string $host): self;
    public function setPort(int $port): self;
    public function setDatabase(string $database): self;
    public function setUsername(string $username): self;
    public function setPassword(string $password): self;
    public function getResult(): DatabaseConnection;
}
