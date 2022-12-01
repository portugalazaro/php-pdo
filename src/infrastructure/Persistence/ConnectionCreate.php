<?php

namespace Alura\Pdo\infrastructure\Persistence;
use PDO;

class ConnectionCreate
{

    public static function  createConnection(): PDO
    {
        $caminhoBanco = __DIR__ . "/../../../banco.sqlite";
        $connnection =  new PDO('sqlite:'. $caminhoBanco);

        $connnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,   PDO::FETCH_ASSOC);

        return $connnection; 

    }
}