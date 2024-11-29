<?php
require_once __DIR__ . '/../config/DatabaseDirector.php';
require_once __DIR__ . '/../config/MySQLBuilder.php';

use Config\Director;
use Config\MySQLBuilder;

class ProcessFacade {
    private $conn;

    public function __construct() {
        $builder = new MySQLBuilder();
        $director = new Director($builder);

        $databaseConnection = $director->buildConnection();
        $this->conn = $databaseConnection->connect();
    }

    public function executeQuery($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProcess($process) {
        $sql = "INSERT INTO process (
            tipoProcesso, autorNome, autorIdentificacao, reuNome, reuIdentificacao, objetoConflito,
            descricaoCaso, fatos, direitoViolado, pedido, juizo, 
            varaTribunal, comarca, valorCausa, advogadoNome, 
            advogadoOAB, advogadoContato, dataProtocolacao
        ) VALUES (
            :tipoProcesso, :autorNome, :autorIdentificacao, :reuNome, :reuIdentificacao, :objetoConflito,
            :descricaoCaso, :fatos, :direitoViolado, :pedido, :juizo, 
            :varaTribunal, :comarca, :valorCausa, :advogadoNome, 
            :advogadoOAB, :advogadoContato,  DEFAULT
        )";
    
        try {
            $stmt = $this->conn->prepare($sql);
    
            $tipoProcesso = $process->getTipoProcesso();
            $autorNome = $process->getAutorNome();
            $autorIdentificacao = $process->getAutorIdentificacao();
            $reuNome = $process->getReuNome();
            $reuIdentificacao = $process->getReuIdentificacao();
            $objetoConflito = $process->getObjetoConflito();
            $descricaoCaso = $process->getDescricaoCaso();
            $fatos = $process->getFatos();
            $direitoViolado = $process->getDireitoViolado();
            $pedido = $process->getPedido();
            $juizo = $process->getJuizo();
            $varaTribunal = $process->getVaraTribunal();
            $comarca = $process->getComarca();
            $valorCausa = $process->getValorCausa();
            $advogadoNome = $process->getAdvogadoNome();
            $advogadoOAB = $process->getAdvogadoOAB();
            $advogadoContato = $process->getAdvogadoContato();
    
            $stmt->bindParam(':tipoProcesso', $tipoProcesso);
            $stmt->bindParam(':autorNome', $autorNome);
            $stmt->bindParam(':autorIdentificacao', $autorIdentificacao);
            $stmt->bindParam(':reuNome', $reuNome);
            $stmt->bindParam(':reuIdentificacao', $reuIdentificacao);
            $stmt->bindParam(':objetoConflito', $objetoConflito);
            $stmt->bindParam(':descricaoCaso', $descricaoCaso);
            $stmt->bindParam(':fatos', $fatos);
            $stmt->bindParam(':direitoViolado', $direitoViolado);
            $stmt->bindParam(':pedido', $pedido);
            $stmt->bindParam(':juizo', $juizo);
            $stmt->bindParam(':varaTribunal', $varaTribunal);
            $stmt->bindParam(':comarca', $comarca);
            $stmt->bindParam(':valorCausa', $valorCausa);
            $stmt->bindParam(':advogadoNome', $advogadoNome);
            $stmt->bindParam(':advogadoOAB', $advogadoOAB);
            $stmt->bindParam(':advogadoContato', $advogadoContato);
    
            if ($stmt->execute()) {
                return $this->conn->lastInsertId(); // 
            }
            return false; // Falha na execução
        } catch (Exception $e) {
            // 
          //  echo "Erro ao salvar processo: " . $e->getMessage();
            return false;
        }
    }

    public function readProcess($id) {
        $sql = "SELECT * FROM process WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchProcess($searchTerm) {
        $query = "SELECT * FROM process WHERE id = :id ";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $searchTerm, PDO::PARAM_INT); // 
           
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar o processo: " . $e->getMessage());
        }
    }



    public function updateProcess($data) {
        $query = "UPDATE process SET 
                    tipoProcesso = :tipoProcesso,
                    autorNome = :autorNome,
                    autorIdentificacao = :autorIdentificacao,
                    reuNome = :reuNome,
                    reuIdentificacao = :reuIdentificacao,
                    descricaoCaso = :descricaoCaso,
                    valorCausa = :valorCausa
                  WHERE id = :id";
    
        try {
            $stmt = $this->conn->prepare($query); // 
            $stmt->bindValue(':tipoProcesso', $data['tipo_processo']);
            $stmt->bindValue(':autorNome', $data['nome_cliente']);
            $stmt->bindValue(':autorIdentificacao', $data['cpf_cliente']);
            $stmt->bindValue(':reuNome', $data['oponente']);
            $stmt->bindValue(':reuIdentificacao', $data['cpf_oponente']);
            $stmt->bindValue(':descricaoCaso', $data['descricao']);
            $stmt->bindValue(':valorCausa', $data['valor_causa']);
            $stmt->bindValue(':id', $data['update_id']); // 
    
            if (!$stmt->execute()) {
                throw new Exception("Erro ao atualizar o processo.");
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao executar o update: " . $e->getMessage());
        }
    }
    
    public function deleteProcess($id) {
        $sql = "DELETE FROM process WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAllProcesses() {
        $sql = "SELECT * FROM process";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
