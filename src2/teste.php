<?php
// teste.php
require_once 'Process.php';
require_once 'ProcessFacade.php';
require_once 'Validators/CivilValidator.php';

// Criação de um novo processo
$process = new Process(
    'Civil',
    '12345',
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


// Criando um validador
$civilValidator = new CivilValidator();

// Debug para ver os valores passados
echo "Tipo de Processo: " . $process->getType() . "\n";
echo "Objeto do Conflito: " . $process->getConflictObject() . "\n";
echo "Partes: " . $process->getParties() . "\n";
echo "Tribunal: " . $process->getCourt() . "\n";

// Validação
try {
    $civilValidator->validate($process);
    echo "Validação bem-sucedida.\n";
    
    // caso a validação for feita com sucesso, salvaa no banco
    $facade = new ProcessFacade();
    $facade->createProcess($process);
    echo "Processo salvo com sucesso!";
} catch (Exception $e) {
    echo "Erro na validação: " . $e->getMessage();
}
?>
