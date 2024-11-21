<?php
// Validators/FamilyValidator.php

require_once __DIR__ . '/../Models/ProcessValidator.php';


class LaborValidator implements ValidatorInterface {
    private const VALID_PROCESS_TYPES = ['Trabalhista']; // talvez fazer o validador de tipo de processo no validator geral

    private const VALID_DIREITO_VIOLADO = [
        'relacao empregaticia',
        'demissao',
        'ferias',
        '13 salario',
        'demissao sem justa causa',
        'atraso no pagamento de salarios',
        'horas extras nao pagas',
        'acidente de trabalho'
    ];

    private const VALID_CONFLICT_OBJECTS = [
        'pagamento de horas extras',
        'salario minimo',
        'horas extras'
    ];

    private const VALID_COURTS = [
        '1 vara do trabalho',
        '2 vara do trabalho',
        '3 vara do trabalho'
    ];

    public function validate(Process $process): bool {
        // Verifica se o tipo de processo é válido
        if (!in_array($process->getTipoProcesso(), self::VALID_PROCESS_TYPES)) {
            throw new Exception("Tipo de processo inválido.");
        }

        // Verifica se o objeto do conflito é válido
        if (!in_array($process->getObjetoConflito(), self::VALID_CONFLICT_OBJECTS)) {
            throw new Exception("Objeto do conflito inválido.");
        }
        // Verifica se as partes envolvidas são válidas
        if (!in_array($process->getDireitoViolado(), self::VALID_DIREITO_VIOLADO)) {
            throw new Exception("Partes envolvidas inválidas.");
        }

        // Verifica se os tribunais competentes são válidos
        if (!in_array($process->getVaraTribunal(), self::VALID_COURTS)) {
            throw new Exception("Tribunais competentes inválidos.");
        }

        return true;
    }

    public static function getTipoProcesso(): array {
        return self::VALID_PROCESS_TYPES;
    }

    public static function getObjetoConflito(): array {
        return self::VALID_CONFLICT_OBJECTS;
    }

    public static function getDireitoViolado(): array {
        return self::VALID_DIREITO_VIOLADO;
    }

    public static function getCortes(): array {
        return self::VALID_COURTS;
    }
}
?>
