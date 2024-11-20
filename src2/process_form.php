<?php
require_once 'Models/Process.php';
require_once 'Controller/ProcessFacade.php';
require_once 'Models/ProcessValidator.php';
require_once 'Validators/CivilValidator.php';
require_once 'Validators/CriminalValidator.php';
require_once 'Validators/FamilyValidator.php';
require_once 'Validators/LaborValidator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // obtem  todos os dados do forms
    $tipoProcesso = $_POST['tipo_processo'];
    $nomeCliente = $_POST['nome_cliente'];
    $cpfCliente = $_POST['cpf_cliente'];
    $oponente = $_POST['oponente'];
    $cpfOponente = $_POST['cpf_oponente'];
    $descricao = $_POST['descricao'];
    $fatos = $_POST['fatos'];
    $direitoViolado = $_POST['direito_violado'];
    $pedido = $_POST['pedido'];
    $juizo = $_POST['juizo'];
    $cortes = $_POST['cortes'];
    $comarca = $_POST['comarca'];
    $valorCausa = $_POST['valor_causa'];
    $advogado = $_POST['advogado'];
    $oab = $_POST['oab'];
    $contatoAdvogado = $_POST['contato_advogado'];
    $objetoConflito= $_POST['objeto_conflito'];

    try {
        // Criar o objeto Process com os dados dinâmicos
        $process = new Process(
            $tipoProcesso,
            $nomeCliente,
            $cpfCliente,
            $oponente,
            $cpfOponente,
            $descricao,
            $fatos,
            $direitoViolado,
            $pedido,
            $juizo,
            $cortes,
            $comarca,
            $valorCausa,
            $advogado,
            $oab,
            $contatoAdvogado,
            date('Y-m-d'), // Data do cadastro
            $objetoConflito
        );

        // Validar e salvar o processo
        $processValidator = new ProcessValidator();
        $validatorClass = ucfirst(strtolower($tipoProcesso)) . 'Validator';

        if (class_exists($validatorClass)) {
            $validator = new $validatorClass();
            $processValidator->setStrategy($validator);
            $processValidator->validate($process);

            $facade = new ProcessFacade();
            $facade->createProcess($process);
            echo "Processo do tipo $tipoProcesso cadastrado com sucesso!";
        } else {
            throw new Exception("Validador para o tipo de processo não encontrado.");
        }
        echo  "$process" ;
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
