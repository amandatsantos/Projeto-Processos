<?php
// Validators/FamilyValidator.php

require_once 'ProcessValidator.php';


class LaborValidator implements ValidatorInterface {
    // verificarse serão esses que darão a validação para cada campo
    private const VALID_PROCESS_TYPES = ['Trabalhista']; // talvez fazer o validador de tipo de processo no validator geral
    private const VALID_CONFLICT_OBJECTS = ['Direitos e obrigações privadas', 'teste']; 
    private const VALID_PARTIES = ['Indivíduos', 'Empresas'];
    private const VALID_COURTS = ['Varas cíveis', 'Juizados especiais', 'Tribunal Penal','Vara Familiar']; 

    public function validate(Process $process): bool {
        // Verifica se o tipo de processo é válido
        if (!in_array($process->getType(), self::VALID_PROCESS_TYPES)) {
            throw new Exception("Tipo de processo inválido.");
        }

        // Verifica se o objeto do conflito é válido
        if (!in_array($process->getConflictObject(), self::VALID_CONFLICT_OBJECTS)) {
            throw new Exception("Objeto do conflito inválido.");
        }

        // Verifica se as partes envolvidas são válidas
        if (!in_array($process->getParties(), self::VALID_PARTIES)) {
            throw new Exception("Partes envolvidas inválidas.");
        }

        // Verifica se os tribunais competentes são válidos
        if (!in_array($process->getCourt(), self::VALID_COURTS)) {
            throw new Exception("Tribunais competentes inválidos.");
        }

        return true;
    }
}
?>