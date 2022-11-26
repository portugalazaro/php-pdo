<?php

require_once "vendor/autoload.php";
require_once "./conexao.php"; 

$sql = "DELETE FROM students WHERE id = :id";

// $id  = 1;

$statement = $pdo->prepare($sql); 
$statement->bindValue('id', 1, PDO::PARAM_INT);
// o nome do campo da tabela | valor | otipo
$statement->execute();


