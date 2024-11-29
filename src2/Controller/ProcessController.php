<?php

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
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['delete_id'])) {
                    $this->deleteProcess((int) $_POST['delete_id']);
                } elseif (isset($_POST['update_id'])) {
                    $process = $this->createProcessFromPost($_POST);
                    $this->updateProcess($process);
                } else {
                    $this->createProcess($_POST);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (isset($_GET['id'])) {
                    echo json_encode($this->getProcessById((int) $_GET['id']));
                } elseif (isset($_GET['search'])) {
                    echo json_encode($this->searchProcess($_GET['search']));
                }
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo "Erro ao processar a requisição: " . $e->getMessage();
        } }

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
    // Attr processo
    public function updateProcess($process) {
        try {
            $this->processFacade->updateProcess($process);
            header("Location: visualizar_processos.php"); // Redirec  atualização
            exit();
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar o processo: " . $e->getMessage());
        }
    }

    public function createProcess($postData) {
        try {
            // usando a fábrica para criar o processo
            $processFactory = new ProcessFactory();
            $process = $processFactory->createProcess($postData);  // Passando todos os dados do POST
    
            // vlida o processo
            $validatorClass = $this->getValidatorClass($process->getTipoProcesso());
            if (class_exists($validatorClass)) {
                $validator = new $validatorClass();
                $processValidator = new ProcessValidator();
                $processValidator->setStrategy($validator);
                $processValidator->validate($process);
    
                // cria o processo no banco de dados ou outro armazenamento
                $this->processFacade->createProcess($process);
                "Processo do tipo {$process->getTipoProcesso()} cadastrado com sucesso!";
            } else {
                throw new Exception("Validador para o tipo de processo não encontrado.");
            }
        } catch (Exception $e) {
            error_log("Erro ao criar/atualizar processo: " . $e->getMessage(), 3, "erro.log");
        }
    }

    // obter validador para o tipo de processo - VALIDATROS
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
