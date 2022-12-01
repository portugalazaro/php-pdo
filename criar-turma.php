<?php

require_once "vendor/autoload.php";

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\infrastructure\Persistence\ConnectionCreate;
use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\infrastructure\Repository\PdoRepositoryStudent;

$connection = ConnectionCreate::createConnection();

$studentRepostory  = new PdoRepositoryStudent($connection);

try {
    $connection->beginTransaction();
    $Student = new Student(null,"Savio gay Portugal", new DateTimeImmutable("1996-12-30"));
    $studentRepostory->save($Student);
    
    $connection->commit();
}catch(\RuntimeException $e){
    echo $e->getMessage();

    $connection->rollBack();
}

// print_r($studentRepostory);