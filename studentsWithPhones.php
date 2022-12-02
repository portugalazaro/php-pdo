<?php

require_once "vendor/autoload.php";

use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\infrastructure\Persistence\ConnectionCreate;
use Alura\Pdo\infrastructure\Repository\PdoRepositoryStudent;


$pdo = ConnectionCreate::createConnection();

$repository = new PdoRepositoryStudent($pdo);

$repository->studentWithPhones();