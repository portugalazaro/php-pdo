<?php

use Alura\Pdo\infrastructure\Persistence\ConnectionCreate;
use Alura\Pdo\Model\Repository\StudentyRepository;
use Alura\Pdo\Model\Student;

class PdoRepositoryStudent implements StudentRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreate::createConnection();
    }

    private function allStudent():array
    {
        $statement = $this->connection->query("SELECT * FROM students");

        return $this->hydrateStudentList($statement);

    }

    public function insert(Student $student)
    {
        $sql = "INSERT INTO students (name, birt    h_date) VALUES (:name, :birth_date);";
        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            'name' => $student->name(),
            'birth_date' => $student->birthDate()->format('Y-m-d')
        ]);
    }

    
    public function studentBirthAt(DateTimeInterface $birthDate):array
    {
        $sql = "SELECT * FROM students WHERE birth_date = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $birthDate->birthDate());
        $statement->execute();
    }



    public function update(Student $student)
    {
        $sql = "UPDATE students SET name = :name WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['name'=> $student->name(), 'id' => $student->id()]);
    }

    
    public function save(Student $student):bool
    {
        if($student->id() === NULL){
            return $this->insert($student);
        }

        return $this->update($student);
    }


    public function hydrateStudentList(PDOStatement $stmt):array 
    {
        $studentListData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listStudent = [];


        foreach($studentListData as $studentData){
            $studentListData = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $listStudent;
    }
    
    public function remove(Student $student):bool
    {
        $statement = $this->connection->prepare("DELETE FROM students WHERE id = ?");
        $statement->bindValue(1, $student->id(), PDO::PARAM_INT);
        return $statement->execute();
    }
}