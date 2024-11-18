<?php
// teste.php

require_once 'Process.php';
require_once 'ProcessFacade.php';
require_once 'ProcessValidator.php';
require_once 'Validators/CivilValidator.php';
require_once 'Validators/CriminalValidator.php';
require_once 'Validators/FamilyValidator.php';
require_once 'Validators/LaborValidator.php';
// require 'vendor/autoload.php'; // Se estiver usando Composer


// Criação de um processo de exemplo


$processFamily = new Process(
    'Familiar', //tipo processo
    '123655',
    '2024-11-15',
    'ex-cônjuges', // partes envolvidas
    'João Silva vs. Maria Souza',
    'Advogado Y',
    'Vara Familiar', // corte de tramitação
    '2024-10-01',
    '2024-10-15',
    '2024-10-20',
    'Decisão 1',
    '2024-11-05',
    50000,
    '2024-11-06',
    'Ativo',
    'Guarda dos filhos' // objeto de conflito
);

$processCriminal = new Process(
    'Criminal', //tipo processo
    '151515',
    '2024-11-20',
    'Ministério Público', // partes envolvidas
    'João Silva vs. Estado',
    'Advogado Y',
    'Vara Criminal', // corte de tramitação
    '2024-10-01',
    '2024-10-15',
    '2024-10-20',
    'Decisão 1',
    '2024-11-05',
    50000,
    '2024-11-06',
    'Ativo',
    'contravenções' // objeto de conflito
);

$processLabor = new Process(
    'Trabalhista', //tipo processo
    '151515',
    '2024-11-20',
    'Empregado', // partes envolvidas
    'João Silva vs. Azaleia',
    'Advogado Y',
    'Vara do Trabalho', // corte de tramitação
    '2024-10-01',
    '2024-10-15',
    '2024-10-20',
    'Decisão 1',
    '2024-11-05',
    50000,
    '2024-11-06',
    'Ativo',
    'demissao' // objeto de conflito
);

$processCivil = new Process(
    'Civil', //tipo processo
    '151515',
    '2024-11-20',
    'jurídica', // partes envolvidas
    'João Silva vs. Azaleia',
    'Advogado Y',
    'Vara cívil', // corte de tramitação
    '2024-10-01',
    '2024-10-15',
    '2024-10-20',
    'Decisão 1',
    '2024-11-05',
    50000,
    '2024-11-06',
    'Ativo',
    'contratos' // objeto de conflito
);

// lm,ebrar de fazer a validação com  maiscula ou minuscula
// Instancia o validador correto com base no tipo de processo
$processValidator = new ProcessValidator();
try {
    if (isset($processCivil) && $processCivil->getType() === 'Civil') {
        $validator = new CivilValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processCivil);
        echo "Validação do processo civil bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processCivil);
        echo "Processo civil salvo com sucesso!\n";
    }

    if (isset($processCriminal) && $processCriminal->getType() === 'Criminal') {
        $validator = new CriminalValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processCriminal);
        echo "Validação do processo criminal bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processCriminal);
        echo "Processo criminal salvo com sucesso!\n";
    }

    if (isset($processFamily) && $processFamily->getType() === 'Familiar') {
        $validator = new FamilyValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processFamily);
        echo "Validação do processo familiar bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processFamily);
        echo "Processo familiar salvo com sucesso!\n";
    }

    if (isset($processLabor) && $processLabor->getType() === 'Trabalhista') {
        $validator = new LaborValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processLabor);
        echo "Validação do processo trabalhista bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processLabor);
        echo "Processo trabalhista salvo com sucesso!\n";
    }
} catch (Exception $e) {
    echo "Erro na validação: " . $e->getMessage();
}
?>