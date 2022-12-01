<?php

require_once "vendor/autoload.php";
use  Alura\Pdo\infrastructure\Persistence\ConnectionCreate;
use Alura\Pdo\Domain\Model\Student;

$connexao = ConnectionCreate::createConnection();

$aluno = new Student(NULL, "Sávio Portugal", new DateTimeImmutable("199-12-30"));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?, ?);";

$stement  = $connexao->prepare($sqlInsert);
$stement->bindValue(1, $aluno->name());
$stement->bindValue(2, $aluno->birthDate()->format('Y-m-d'));

if($stement->execute()){
    echo 'deu liga';
}