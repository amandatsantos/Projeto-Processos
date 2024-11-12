<?php
require_once 'config/DatabaseConnection.php';


//facade
class ProcessFacade {
    private $conn;

    public function __construct() {
        $database = new DatabaseConnection();
        $this->conn = $database->connect();
    }

    //rever essa query
    public function createProcess($process) {
        $sql = "INSERT INTO Processos (
                    tipoProcesso, numeroProcesso, dataDistribuicao, nomePartes, advogados, 
                    juizResponsavel, tribunal, dataPeticaoInicial, dataContestacao, 
                    dataAudienciaConciliacao, decisoesInterlocutorias, dataSentenca, 
                    valorCausa, dataIntimacao, situacao, descricao
                ) VALUES (
                    :tipoProcesso, :numeroProcesso, :dataDistribuicao, :nomePartes, :advogados, 
                    :juizResponsavel, :tribunal, :dataPeticaoInicial, :dataContestacao, 
                    :dataAudienciaConciliacao, :decisoesInterlocutorias, :dataSentenca, 
                    :valorCausa, :dataIntimacao, :situacao, :descricao
                )";
        
        $stmt = $this->conn->prepare($sql);
    
       
        $stmt->bindParam(':tipoProcesso', $process->tipoProcesso);
        $stmt->bindParam(':numeroProcesso', $process->numeroProcesso);
        $stmt->bindParam(':dataDistribuicao', $process->dataDistribuicao);
        $stmt->bindParam(':nomePartes', $process->nomePartes);
        $stmt->bindParam(':advogados', $process->advogados);
        $stmt->bindParam(':juizResponsavel', $process->juizResponsavel);
        $stmt->bindParam(':tribunal', $process->tribunal);
        $stmt->bindParam(':dataPeticaoInicial', $process->dataPeticaoInicial);
        $stmt->bindParam(':dataContestacao', $process->dataContestacao);
        $stmt->bindParam(':dataAudienciaConciliacao', $process->dataAudienciaConciliacao);
        $stmt->bindParam(':decisoesInterlocutorias', $process->decisoesInterlocutorias);
        $stmt->bindParam(':dataSentenca', $process->dataSentenca);
        $stmt->bindParam(':valorCausa', $process->valorCausa);
        $stmt->bindParam(':dataIntimacao', $process->dataIntimacao);
        $stmt->bindParam(':situacao', $process->situacao);
        $stmt->bindParam(':descricao', $process->descricao);
    
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function readProcess($id) {
        $sql = "SELECT * FROM processes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProcess($process) {
        $sql = "UPDATE processes SET type = :type, number = :number, start_date = :start_date, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $process->id);
        $stmt->bindParam(':type', $process->type);
        $stmt->bindParam(':number', $process->number);
        $stmt->bindParam(':start_date', $process->startDate);
        $stmt->bindParam(':status', $process->status);

        return $stmt->execute();
    }

    public function deleteProcess($id) {
        $sql = "DELETE FROM processes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // 
    public function getAllProcesses() {
        $sql = "SELECT * FROM processos";
        $result = $this->conn->query($sql);
        $processos = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $processos[] = $row;
            }
        }

        return $processos;
    }

}
?>