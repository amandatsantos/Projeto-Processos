<?php
// Validators/CivilValidator.php
interface ValidatorInterface {
    public function validate(Process $process): bool;
}

class CivilValidator implements ValidatorInterface {
    // rever quais são melhores para validação ainda ta meio tosco
    private const VALID_PROCESS_TYPES = ['Civil'];
    private const VALID_CONFLICT_OBJECTS = ['Direitos e obrigações privadas'];
    private const VALID_PARTIES = ['Indivíduos', 'Empresas'];
    private const VALID_PROCEDURES = ['Ações de conhecimento', 'Ações de execução'];
    private const VALID_COURTS = ['Varas cíveis', 'Juizados especiais'];

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

        // Verifica se os procedimentos legais são válidos
        if (!in_array($process->getProcedures(), self::VALID_PROCEDURES)) {
            throw new Exception("Procedimentos legais inválidos.");
        }

        // Verifica se os tribunais competentes são válidos
        if (!in_array($process->getCourt(), self::VALID_COURTS)) {
            throw new Exception("Tribunais competentes inválidos.");
        }

        return true;
    }

    
}
    ?>
