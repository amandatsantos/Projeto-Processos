<?php


//teste.php
require_once 'Process.php';
require_once 'ProcessFacade.php';
require_once 'Validators/CivilValidator.php';

//  criação de um novo processo
$newProcess = new Process(
    'Civil',
    '12345',
    '2024-10-28',
    'Indivíduos', // melhorar isso aqui
    'Advogado A',
    'Juiz A',
    'Varas cíveis', // melhorar isso aqui tmb
    '2024-01-01',
    '2024-02-01', // rever quais datas são mais interessantes
    '2024-03-01',
    'Decisão A',
    '2024-04-01',
    10000,
    '2024-05-01',
    'Ativo',
    'Descrição do processo'
);

# passa pelo strategy -> validator -> civil validator
$civilValidator = new CivilValidator();

try {
    $civilValidator->validate($newProcess);
    // passou pela validação save db
    $facade = new ProcessFacade();
    $facade->createProcess($newProcess);
    echo "Processo salvo com sucesso!";
} catch (Exception $e) {
    echo "Erro na validação: " . $e->getMessage();
}
?>