<?php
// teste.php
require_once 'Process.php';
require_once 'ProcessFacade.php';
require_once 'ProcessValidator.php';
require_once 'Validators/CivilValidator.php';
require_once 'Validators/CriminalValidator.php';

// Criação de um processo de exemplo
$processCivil = new Process(
    'Civil',
    '11111',
    '2024-11-11',
    'Indivíduos',
    'João Silva vs. Maria Souza',
    'Advogado X',
    'Varas cíveis', 
    '2024-10-01',
    '2024-10-15',
    '2024-10-20',
    'Decisão 1',
    '2024-11-05',
    50000,
    '2024-11-06',
    'Ativo', 
    'Direitos e obrigações privadas'
);

$processCriminal = new Process(
    'Criminal',
    '67890',
    '2024-11-12',
    'Indivíduos',
    'Carlos Silva vs. Estado',
    'Advogado Y',
    'Tribunal Penal',
    '2024-10-05',
    '2024-10-18',
    '2024-10-25',
    'Decisão preliminar',
    '2024-11-08',
    200000,
    '2024-11-10',
    'Em julgamento',
    'Crime de responsabilidade'
);

// Instancia o validador correto com base no tipo de processo
$processValidator = new ProcessValidator();
try {
    if ($processCivil->tipoProcesso === 'Civil') {
        $validator = new CivilValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processCivil);
        echo "Validação do processo civil bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processCivil);
        echo "Processo civil salvo com sucesso!\n";
    }

    if ($processCriminal->tipoProcesso === 'Criminal') {
        $validator = new CriminalValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processCriminal);
        echo "Validação do processo criminal bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processCriminal);
        echo "Processo criminal salvo com sucesso!";
    }
} catch (Exception $e) {
    echo "Erro na validação: " . $e->getMessage();
}
?>