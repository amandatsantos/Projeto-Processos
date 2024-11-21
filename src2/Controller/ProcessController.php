<?php

require_once __DIR__ . '/../Models/Process.php';
require_once __DIR__ . '/../Models/ProcessFactory.php';
require_once __DIR__ . '/../Controller/ProcessFacade.php';
require_once __DIR__ . '/../Models/ProcessValidator.php';
require_once __DIR__ . '/../Validators/FamilyValidator.php';
require_once __DIR__ . '/../Validators/LaborValidator.php';
require_once __DIR__ . '/../Validators/CivilValidator.php';
require_once __DIR__ . '/../Validators/CriminalValidator.php';

class ProcessController {
    private $processFacade;

    public function __construct() {
        $this->processFacade = new ProcessFacade();
    }

    // principal para tratar requisições
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (isset($_POST['delete_id'])) {
                    $this->deleteProcess($_POST['delete_id']);
                } elseif (isset($_POST['update_id'])) {
                    $process = $this->createProcessFromPost($_POST);
                    $this->updateProcess($process);
                } else {
                    $this->createOrUpdateProcess($_POST);
                }
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
    }

    public function getAllProcesses() {
        try {
            // Chama a Facade para pegar todos os processos
            return $this->processFacade->getAllProcesses(); 
        } catch (Exception $e) {
            echo "Erro ao buscar todos os processos: " . $e->getMessage();
        }
    }
    //  processo pelo ID - CAHAMADA DO DETALHAMENTO
    public function getProcessById($id) {
        return $this->processFacade->readProcess($id);
    }

    // Excluir processo
    public function deleteProcess($id) {
        try {
            $this->processFacade->deleteProcess($id);
            header("Location: visualizar_processos.php"); // Redirecionar excluIR
            exit();
        } catch (Exception $e) {
            echo "Erro ao excluir processo: " . $e->getMessage();
        }
    }

    // Buscar processo
    public function searchProcess($searchTerm) {
        try {
            return $this->processFacade->searchProcess($searchTerm);  //  Facade a busca
        } catch (Exception $e) {
            echo "Erro ao buscar processo: " . $e->getMessage();
        }
    }
    // Atualizar processo
    public function updateProcess($process) {
        try {
            $this->processFacade->updateProcess($process);
            header("Location: visualizar_processos.php"); // Redirec  atualização
            exit();
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar o processo: " . $e->getMessage());
        }
    }

    // criar ou atualizar processo
    public function createOrUpdateProcess($postData) {
        try {
            // No ProcessController, onde  fACTORY
$processFactory = new ProcessFactory();
$process = $processFactory->createProcess($_POST);  // Passando todos os dados do POST


            // Validar o processo
            $validatorClass = $this->getValidatorClass($process->getTipoProcesso());
            if (class_exists($validatorClass)) {
                $validator = new $validatorClass();
                $processValidator = new ProcessValidator();
                $processValidator->setStrategy($validator);
                $processValidator->validate($process);

                // Criar o processo no banco de dados ou outro armazenamento
                $this->processFacade->createProcess($process);
                echo "Processo do tipo {$process->getTipoProcesso()} cadastrado com sucesso!";
            } else {
                throw new Exception("Validador para o tipo de processo não encontrado.");
            }
        } catch (Exception $e) {
            echo "Erro ao criar/atualizar processo: " . $e->getMessage();
        }
    }
    // Criar objeto de processo a partir do POST
    private function createProcessFromPost($postData) {
        return new Process(
            $postData['tipo_processo'],
            $postData['nome_cliente'],
            $postData['cpf_cliente'],
            $postData['oponente'],
            $postData['cpf_oponente'],
            $postData['descricao'],
            $postData['fatos'],
            $postData['direito_violado'],
            $postData['pedido'],
            $postData['juizo'],
            $postData['cortes'],
            $postData['comarca'],
            $postData['valor_causa'],
            $postData['advogado'],
            $postData['oab'],
            $postData['contato_advogado'],
            $postData['data_protocolacao'] ?? date('Y-m-d'),
            $postData['objeto_conflito']
        );
    }

    // Obter validador para o tipo de processo - VALIDATROS
    private function getValidatorClass($tipoProcesso) {
        switch ($tipoProcesso) {
            case 'Familiar':
                return 'FamilyValidator';
            case 'Trabalhista':
                return 'LaborValidator';
            case 'Civil':
                return 'CivilValidator';
            case 'Criminal':
                return 'CriminalValidator';
            default:
                return null;
        }
    }
}
?>
