<?php

namespace Alura\Pdo\Domain\Model;

class Student
{
    private ?int $id;
    private string $name;
    private \DateTimeInterface $birthDate;
    private array $phones = [];

    public function __construct(?int $id, string $name, \DateTimeInterface $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    // Retorna o id do Student
    public function id(): ?int
    {
        return $this->id;
    }

    // Retorna o name 
    public function name(): string
    {
        return $this->name;
    }


    // Modifica o name 
    public function changeName(string $name):void
    {
        $this->name = $name;
    }

    // Retorna a data de Nascimento
    public function birthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    // Retorna Idade
    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }


    // Adiciona telefones ao Student 
    public function addPhone(Phone $phone):void
    {
        $this->phones[] = $phone;
    }

    // Retorna uma lista contendo todos os telefones de um determinado Student
    public function phones():array
    {
        return $this->phones;
    }
}
