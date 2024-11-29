<?php

require_once __DIR__ . '/Controller/ProcessFacade.php';

$facade = new ProcessFacade();
$result = $facade->executeQuery('SELECT * FROM process');
print_r($result);
