<?php

namespace Config;

use PDO;

class DatabaseConnection
{
    private string $host;
    private int $port;
    private string $database;
    private string $username;
    private string $password;
    private ?PDO $connection = null;

    public function __construct(string $host, int $port, string $database, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect(): PDO
    {
        if ($this->connection === null) {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database}";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
            $this->createTables();
        }

        return $this->connection;
    }

    private function createTables()
    {
        $query = "
            CREATE TABLE IF NOT EXISTS process (
               
 id INT AUTO_INCREMENT PRIMARY KEY,
            tipoProcesso VARCHAR(255) NOT NULL,
            autorNome VARCHAR(255),
            autorIdentificacao VARCHAR(255),
            reuNome VARCHAR(255),
            reuIdentificacao VARCHAR(255),
            objetoConflito VARCHAR(255),
            descricaoCaso TEXT,
            fatos TEXT,
            direitoViolado TEXT,
            pedido TEXT,
            juizo VARCHAR(255),
            varaTribunal VARCHAR(255),
            comarca VARCHAR(255),
            valorCausa DECIMAL(10, 2),
            advogadoNome VARCHAR(255),
            advogadoOAB VARCHAR(50),
            advogadoContato VARCHAR(50),
            dataProtocolacao  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";

        $this->connection->exec($query);
    }
}
