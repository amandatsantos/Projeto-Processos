<?php
// Validators/FamilyValidator.php

require_once 'ProcessValidator.php';


class FamilyValidator implements ValidatorInterface {
    // verificarse serão esses que darão a validação para cada campo
    private const VALID_PROCESS_TYPES = ['Familiar']; // talvez fazer o validador de tipo de processo no validator geral
    private const VALID_CONFLICT_OBJECTS = ['Divorcio', 'Guarda dos filhos', 'Pensao','reconhecimento de paternidade']; 
    private const VALID_PARTIES = ['Cônjuges', 'ex-cônjuges', 'filhos', 'parentes próximos'];
    private const VALID_COURTS = ['Vara Familiar']; 

    public function validate(Process $process): bool {
        // Verifica se o tipo de processo é válido
        if (!in_array($process->getTipoProcesso(), self::VALID_PROCESS_TYPES)) {
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
