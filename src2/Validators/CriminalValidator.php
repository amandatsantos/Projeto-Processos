<?php
// Validators/CriminalValidator.php

require_once __DIR__ . '/../Models/ProcessValidator.php';

class CriminalValidator implements ValidatorInterface {
    // verificarse serão esses que darão a validação para cada campo
    private const VALID_PROCESS_TYPES = ['Criminal']; // talvez fazer o validador de tipo de processo no validator geral

    private const VALID_CONFLICT_OBJECTS = [
        'infrações penais',
        'contravenções',
        'homicídio',
        'roubo',
        'furto',
        'lesão corporal',
        'tráfico de drogas',
        'ameaça',
        'estupro',
        'crimes contra a honra',
        'lavagem de dinheiro',
        'corrupção',
        'extorsão',
        'sequestro e cárcere privado',
        'porte ilegal de arma',
        'crimes ambientais',
        'organização criminosa',
        'violência doméstica',
        'crimes cibernéticos'
    ];

    private const VALID_DIREITO_VIOLADO = [
        'direito à vida',
        'direito à liberdade',
        'direito à integridade física',
        'direito à propriedade',
        'direito à segurança',
        'direito à honra',
        'direito à dignidade',
        'direito à saúde pública',
        'direito ao meio ambiente',
        'direito à proteção da infância e juventude'
    ];

    private const VALID_COURTS = [
      '1ª Vara Criminal',
    '2ª Vara Criminal',
    '3ª Vara Criminal',
    'Vara do Júri',
    'Vara de Execuções Penais',
    'Vara de Violência Doméstica',
    'Juizado Especial Criminal'
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
