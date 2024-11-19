<?php
// Validators/CivilValidator.php

require_once 'ProcessValidator.php';

// interface ValidatorInterface {
//     public function validate(Process $process): bool;
// }

class CivilValidator implements ValidatorInterface {
    // verificarse serão esses que darão a validação para cada campo
    private const VALID_PROCESS_TYPES = ['Civil']; // talvez fazer o validador de tipo de processo no validator geral
    private const VALID_CONFLICT_OBJECTS = ['Conflito sobre contrato comercial', 'contratos', 'indenizações', 'propriedade', 'Conflito de terras','Restituição do valor pago' ]; 
    private const VALID_DIREITO_VIOLADO= ['Direito do consumidoro'];
    private const VALID_COURTS = ['1 Vara cívil' ,'1 Vara cívi', '2 Vara cívil']; 

    public function validate(Process $process): bool {
        // // Verifica se o tipo de processo é válido
        if (!in_array($process->getTipoProcesso(), self::VALID_PROCESS_TYPES)) {
            throw new Exception("Tipo de processo inválido.");
        }

        // Verifica se o objeto do conflito é válido
        if (!in_array($process->getObjetoConflito(), self::VALID_CONFLICT_OBJECTS)) {
            throw new Exception("Objeto do conflito inválido. teste");
        }

        // Verifica se as partes envolvidas são válidas
        if (!in_array($process->getDireitoViolado(), self::VALID_DIREITO_VIOLADO)) {
            throw new Exception("Partes envolvidas inválidas.");
        }

        // // Verifica se os tribunais competentes são válidos
        if (!in_array($process->getVaraTribunal(), self::VALID_COURTS)) {
            throw new Exception("Tribunais competentes inválidos.");
        }

        return true;
    }
}
?>
