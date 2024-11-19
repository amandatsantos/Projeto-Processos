<?php
require_once 'config/DatabaseConnection.php';

// Facade
class ProcessFacade {
    private $conn;

    public function __construct() {
        $database = new DatabaseConnection();
        $this->conn = $database->connect();
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
            :advogadoOAB, :advogadoContato, :dataProtocolacao
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
            $dataProtocolacao = $process->getDataProtocolacao();
    
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
            $stmt->bindParam(':dataProtocolacao', $dataProtocolacao);
    
            if ($stmt->execute()) {
                return $this->conn->lastInsertId(); // Retorna o ID do processo inserido
            }
            return false; // Falha na execução
        } catch (Exception $e) {
            // 
            echo "Erro ao salvar processo: " . $e->getMessage();
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

    public function updateProcess($process) {
        $sql = "UPDATE process SET 
                    tipoProcesso = :tipoProcesso,
                    autorNome = :autorNome,
                    autorIdentificacao = :autorIdentificacao,
                    reuNome = :reuNome,
                    reuIdentificacao = :reuIdentificacao,
                    objetoConflito=:objetoConflito,
                    descricaoCaso = :descricaoCaso,
                    fatos = :fatos,
                    direitoViolado = :direitoViolado,
                    pedido = :pedido,
                    juizo = :juizo,
                    varaTribunal = :varaTribunal,
                    comarca = :comarca,
                    valorCausa = :valorCausa,
                    advogadoNome = :advogadoNome,
                    advogadoOAB = :advogadoOAB,
                    advogadoContato = :advogadoContato,
                    dataProtocolacao = :dataProtocolacao
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $process->id);
        $stmt->bindParam(':tipoProcesso', $process->tipoProcesso);
        $stmt->bindParam(':autorNome', $process->autorNome);
        $stmt->bindParam(':autorIdentificacao', $process->autorIdentificacao);
        $stmt->bindParam(':reuNome', $process->reuNome);
        $stmt->bindParam(':reuIdentificacao', $process->reuIdentificacao);
        $stmt->bindParam(':objetoConflit', $process->objetoConflito);
        $stmt->bindParam(':descricaoCaso', $process->descricaoCaso);
        $stmt->bindParam(':fatos', $process->fatos);
        $stmt->bindParam(':direitoViolado', $process->direitoViolado);
        $stmt->bindParam(':pedido', $process->pedido);
        $stmt->bindParam(':juizo', $process->juizo);
        $stmt->bindParam(':varaTribunal', $process->varaTribunal);
        $stmt->bindParam(':comarca', $process->comarca);
        $stmt->bindParam(':valorCausa', $process->valorCausa);
        $stmt->bindParam(':advogadoNome', $process->advogadoNome);
        $stmt->bindParam(':advogadoOAB', $process->advogadoOAB);
        $stmt->bindParam(':advogadoContato', $process->advogadoContato);
        $stmt->bindParam(':dataProtocolacao', $process->dataProtocolacao);

        return $stmt->execute();
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
