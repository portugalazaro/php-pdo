<?php

namespace Alura\Pdo\Domain\Model;

class Phone 
{   
    private ?int $id;
    private string $areaCode;
    private string $number;
    // private Student $student;

    public function __construct($id, $areaCode, $number)
    {

        $this->id = $id;
        $this->areaCode = $areaCode;
        $this->number = $number;

    }

    // Retorna o numero de telefone formatado 
    public function formattedPhone():string
    {
        return "($this->areaCode) - $this->number";
    }
}