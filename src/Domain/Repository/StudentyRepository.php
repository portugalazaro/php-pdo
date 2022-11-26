<?php

namespace Alura\Pdo\Domain\Repository;

interface StudentRepository {

    public function allStudent():array;
    public function studentBirthAt(DateTimeInterface $birthDate):array;
    public function save($student):bool;
    public function remove($student):bool;


}