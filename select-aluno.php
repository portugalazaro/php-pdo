<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\infrastructure\Persistence\ConnectionCreate;
use Alura\Pdo\infrastructure\Repository\PdoRepositoryStudent;
// use PDO;
require_once "vendor/autoload.php";

$pdo = ConnectionCreate::createConnection();

$repository = new PdoRepositoryStudent($pdo);
$studentList = $repository->allStudent();


print_r($studentList);