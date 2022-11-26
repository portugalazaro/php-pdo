<?php

require_once "vendor/autoload.php";
require_once "./conexao.php";

use Alura\Pdo\Domain\Model\Student;


$aluno = new Student(NULL, "Evair Portugal", new DateTimeImmutable("1994-12-30"));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?, ?);";

$stement  = $pdo->prepare($sqlInsert);
$stement->bindValue(1, $aluno->name());
$stement->bindValue(2, $aluno->birthDate()->format('Y-m-d'));

if($stement->execute()){
    echo 'deu liga';
}