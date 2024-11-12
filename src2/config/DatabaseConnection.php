<?php
class DatabaseConnection {
    private $host = 'localhost'; 
    private $db_name = 'process_management'; 
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
            $this->conn->exec("USE process_management; ");
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
            CREATE TABLE if not exists processos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    tipoProcesso VARCHAR(255) NOT NULL,
                    numeroProcesso VARCHAR(50),
                    dataDistribuicao DATE,
                    nomePartes TEXT,
                    advogados TEXT,
                    juizResponsavel VARCHAR(255),
                    tribunal VARCHAR(255),
                    dataPeticaoInicial DATE,
                    dataContestacao DATE,
                    dataAudienciaConciliacao DATE,
                    decisoesInterlocutorias TEXT,
                    dataSentenca DATE,
                    valorCausa DECIMAL(15, 2),
                    dataIntimacao DATE,
                    situacao VARCHAR(100),
                    descricao TEXT
                );
                ";

        try {
            $this->conn->exec($query);
            echo "Tabela 'processos' criada com sucesso.\n";
        } catch (PDOException $e) {
            echo "Erro ao criar a tabela: " . $e->getMessage();
        }
    }
}
?>