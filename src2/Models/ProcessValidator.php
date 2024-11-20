<?php
// ProcessValidator.php

interface ValidatorInterface {
    public function validate(Process $process): bool;
}

class ProcessValidator {
    private $strategy;

    public function setStrategy(ValidatorInterface $strategy) {
        $this->strategy = $strategy;
    }

    public function validate(Process $process): bool {
        return $this->strategy->validate($process);
    }
}
?>