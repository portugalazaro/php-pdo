<?php

namespace Alura\Pdo\infrastructure\Persistence;

class ConnectionCreate
{

    public static function  createConnection(): PDO
    {
        $caminhoBanco = __DIR__ . "../../../banco.sqlite";
        return new PDO('sqlite:'. $caminhoBanco);
    }
}