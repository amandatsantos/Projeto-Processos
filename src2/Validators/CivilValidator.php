<?php
// Validators/CivilValidator.php

require_once __DIR__ . '/../Models/ProcessValidator.php';


class CivilValidator implements ValidatorInterface {
   
    private const VALID_PROCESS_TYPES = ['Civil']; 
    private const VALID_CONFLICT_OBJECTS = [
        'conflito sobre contrato comercial',
        'contratos',
        'indenizações',
        'propriedade',
        'conflito de terras',
        'restituição do valor pago',
        'conflitos familiares',
        'questões de inventário e partilha',
        'execuções fiscais',
        'disputas trabalhistas',
        'questões tributárias',
        'direitos autorais',
        'responsabilidade civil',
        'locação de imóveis',
        'alienação fiduciária',
        'direitos de vizinhança',
        'dissolução de sociedade',
        'danos morais'
    ];
    
    private const VALID_DIREITO_VIOLADO = ['direito do consumidor',
    'direito de propriedade',
    'direito contratual',
    'direito de vizinhança',
    'direito sucessório',
    'direito à indenização',
    'direito à restituição de valores',
    'direito de locação',
    'direito à posse'];
    
    private const VALID_COURTS = [    '1ª Vara Cível',
    '2ª Vara Cível',
    '3ª Vara Cível',
    'Vara de Família',
    'Juizado Especial Cível',
    'Vara de Registro de Imóveis'];
    

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
