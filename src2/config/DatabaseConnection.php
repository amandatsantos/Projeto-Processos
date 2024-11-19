<?php
class DatabaseConnection {
    private $host = 'localhost'; 
    private $db_name = 'protocalacao_processo'; 
    private $username = 'root';
    private $password = 'root'; 
    private $conn;

    // conectar ao banco de dados
    public function connect() {
        $this->conn = null;

        try {
            // Tentando conectar ao banco de dados
            $this->conn = new PDO("mysql:host={$this->host}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            if (!$this->databaseExists($this->db_name)) {
                $this->createDatabase($this->db_name); // 
            }
          

           
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // n dar BO na criação ou uso do banco
            $this->conn->exec("USE protocalacao_processo;");
            $this->createTables();
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }

    // verificar se o banco de dados existe
    private function databaseExists($dbName) {
        $stmt = $this->conn->prepare("SHOW DATABASES LIKE :dbName");
        $stmt->bindParam(':dbName', $dbName);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    //  criar o banco de dados
    private function createDatabase($dbName) {
        try {
            $query = "CREATE DATABASE IF NOT EXISTS {$dbName}";
            $this->conn->exec($query);
            echo "Banco de dados '{$dbName}' criado com sucesso.\n";
        } catch (PDOException $e) {
            echo "Erro ao criar banco de dados: " . $e->getMessage();
        }
    }

    
    private function createTables() {
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
            dataProtocolacao DATE
        );";
        try {
            $this->conn->exec($query);
        } catch (PDOException $e) {
            echo "Erro ao criar a tabela: " . $e->getMessage();
        }
    }}
?>
