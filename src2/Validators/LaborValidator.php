<?php
// Validators/FamilyValidator.php

require_once __DIR__ . '/../Models/ProcessValidator.php';


class LaborValidator implements ValidatorInterface {
    private const VALID_PROCESS_TYPES = ['Trabalhista']; 

    private const VALID_DIREITO_VIOLADO = [
        'relação empregatícia',
        'demissão',
        'férias não concedidas',
        '13º salário não pago',
        'demissão sem justa causa',
        'atraso no pagamento de salários',
        'horas extras não pagas',
        'acidente de trabalho',
        'não recolhimento do FGTS',
        'assédio moral no ambiente de trabalho',
        'assédio sexual no ambiente de trabalho',
        'diferenças salariais',
        'estabilidade por acidente de trabalho ou gravidez',
        'não fornecimento de EPI',
        'rescisão indireta do contrato de trabalho',
        'reintegração ao emprego',
        'desvio ou acúmulo de função'
    ];

    private const VALID_CONFLICT_OBJECTS = [
        'pagamento de horas extras',
        'salário mínimo',
        'horas extras',
        'pagamento de verbas rescisórias',
        'adicional noturno',
        'adicional de insalubridade',
        'adicional de periculosidade',
        'reconhecimento de vínculo empregatício',
        'acidente de trabalho e indenizações',
        'equiparação salarial',
        'rescisão contratual',
        'dano moral trabalhista'
    ];

    private const VALID_COURTS = [
        '1ª Vara do Trabalho',
        '2ª Vara do Trabalho',
        '3ª Vara do Trabalho',
        'Vara de Execuções Trabalhistas',
        'Tribunal Regional do Trabalho',
        'Juízo de Conciliação e Julgamento'
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
