<?php

require_once "vendor/autoload.php";
require_once "./conexao.php";


$statement = $pdo->query("SELECT * FROM students");
$dados = $statement->fetchAll(PDO::FETCH_ASSOC);

print_r($dados);
