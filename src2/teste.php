<?php
// teste.php

require_once 'Models/Process.php';
require_once 'Controller/ProcessFacade.php';
require_once 'Models/ProcessValidator.php';
require_once __DIR__ . '/Validators/FamilyValidator.php';
require_once __DIR__ . '/Validators/CriminalValidator.php';
require_once __DIR__ . '/Validators/LaborValidator.php';
require_once __DIR__ . '/Validators/CivilValidator.php';



// Criação de um processo de exemplo


// $processLabor = new Process(
//     "Trabalhista", // tipo processo 
//     "teste  da Silva teste ", "123456789", "Empresa XYZ", "987654321",
//     "Descrição do caso", "Fatos do caso", 
//     "horas extras nao pagas",// direito violado
//      "Pedido",
//     "Juízo 1", 
//     "3 vara do trabalho",// qual instancia de uso
//      "Comarca Central", 50000.00, 
//     "Advogado Fulano", "OAB-12345", "99999-9999", "2024-11-18", 
//     "horas extras"// obejto de conflito
// );

// $processCriminal = new Process(
//     "Criminal", // tipo processo 
//     "teste  da Silva teste ", "123456789", "Empresa XYZ", "987654321",
//     "Descrição do caso", "Fatos do caso", 
//     "direito a propriedade",// direito violado
//      "Pedido",
//     "Juízo 1", 
//     "teste",// qual instancia de uso
//      "Comarca Central", 50000.00, 
//     "Advogado Fulano", "OAB-12345", "99999-9999", "2024-11-18", 
//     "roubo"// obejto de conflito
// );
// // Criação de um processo de exemplo com novos campos
// $processCivil = new Process(
//     "Civil", // tipo processo 
//     "teste  da Silva teste ", "123456789", "Empresa XYZ", "987654321",
//     "Descrição do caso", "Fatos do caso", 
//     "Direito do consumidoro",// direito violado
//      "Pedido",
//     "Juízo 1", 
//     "1 Vara cívil",// qual instancia de uso
//      "Comarca Central", 50000.00, 
//     "Advogado Fulano", "OAB-12345", "99999-9999", "2024-11-18", 
//     "Restituição do valor pago"// obejto de conflito
// );

$processFamily = new Process(
    "Familiar", // tipo processo 
    "teste  da Silva teste ", "123456789", "Empresa XYZ", "987654321",
    "Descrição do caso", "Fatos do caso", 
    "prestacao de alimentos",// direito violado
     "Pedido",
    "Juízo 1", 
    "2 vara familiar",// qual instancia de uso
     "Comarca Central", 50000.00, 
    "Advogado Fulano", "OAB-12345", "99999-9999", "2024-11-18", 
    "pensao"// obejto de conflito
);



$processValidator = new ProcessValidator();
try {
    if (isset($processCivil) && $processCivil->getTipoProcesso() === 'Civil') {
        $validator = new CivilValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processCivil);
        echo "Validação do processo civil bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processCivil);
        echo "Processo civil salvo com sucesso!\n";
    }

    if (isset($processCriminal) && $processCriminal->getTipoProcesso() === 'Criminal') {
        $validator = new CriminalValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processCriminal);
        echo "Validação do processo criminal bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processCriminal);
        echo "Processo criminal salvo com sucesso!\n";
    }

    if (isset($processFamily) && $processFamily->getTipoProcesso() === 'Familiar') {
        $validator = new FamilyValidator();
        $processValidator->setStrategy($validator);
        $processValidator->validate($processFamily);
        echo "Validação do processo familiar bem-sucedida.\n";

        // Salva o processo se a validação passar
        $facade = new ProcessFacade();
        $facade->createProcess($processFamily);
        echo "Processo familiar salvo com sucesso!\n";
    }

    if (isset($processLabor) && $processLabor->getTipoProcesso() === 'Trabalhista') {
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
