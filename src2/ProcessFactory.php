<?php
// ProcessFactory.php

class ProcessFactory {
    public function createProcess($type) {
        switch ($type) {
// adicionar o resto dos casos
            case 'Civil':
                return new Process('Civil');

            default:
                throw new Exception("Tipo de processo inválido");
        }
    }
}
?>
