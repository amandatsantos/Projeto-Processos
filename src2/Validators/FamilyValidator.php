<?php
// Validators/FamilyValidator.php

require_once __DIR__ . '/../Models/ProcessValidator.php';



class FamilyValidator implements ValidatorInterface {
    // verificarse serão esses que darão a validação para cada campo
    private const VALID_PROCESS_TYPES = ['Familiar']; // talvez fazer o validador de tipo de processo no validator geral

    private const VALID_CONFLICT_OBJECTS = [
        'divórcio',
        'investigação de paternidade',
        'adoção',
        'guarda',
        'pensão alimentícia',
        'interdição',
        'partilha de bens',
        'regulamentação de visitas',
        'reconhecimento e dissolução de união estável',
        'alienação parental',
        'emancipação',
        'direito de sucessão',
        'convivência com os avós',
        'destituição do poder familiar',
        'medidas protetivas envolvendo violência doméstica'
    ];

    private const VALID_DIREITO_VIOLADO = [
        'direito à dissolução do vínculo matrimonial',
    'direito à filiação',
    'prestação de alimentos',
    'convivência familiar',
    'direito à guarda compartilhada',
    'direito à proteção contra alienação parental',
    'direito à sucessão',
    'direito à adoção',
    'direito à proteção de incapazes',
    'direito à convivência digna no núcleo familiar'
    ];

    private const VALID_COURTS = [
        '1ª Vara de Família',
        '2ª Vara de Família',
        '3ª Vara de Família',
        'Juizado de Violência Doméstica',
        'Vara de Infância e Juventude',
        'Vara de Sucessões'

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


// utilização desses para validar no cadastro

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
