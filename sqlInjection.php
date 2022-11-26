<?php

require_once "vendor/autoload.php";

use Alura\Pdo\Domain\Model\Student;

$dataBasePath = __DIR__ . "/banco.sqlite";
$pdo = new PDO('sqlite:'. $dataBasePath);

$aluno = new Student(NULL, "Evair', ''); DELETE  FROM students ; -- Portugal", new DateTimeImmutable("1994-12-30"));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES ('{$aluno->name()}', '{$aluno->birthDate()->format('Y-m-d')}');";

$pdo->exec($sqlInsert);
// echo $sqlInsert;