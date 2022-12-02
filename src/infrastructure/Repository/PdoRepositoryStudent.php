<?php

namespace Alura\Pdo\infrastructure\Repository;

use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Domain\Model\{Phone,Student };
use DateTimeImmutable;
use PDO;

class PdoRepositoryStudent implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudent():array
    {
        $statement = $this->connection->query("SELECT * FROM students");
        return $this->hydrateStudentList($statement);
    }
    

    private function hydrateStudentList(\PDOStatement $stmt):array
    {
        $studentListData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listStudent = [];

        foreach($studentListData as $studentData){
            $listStudent[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
            // $this->fillPhonesOf($student);
        }

        return $listStudent;
    }


    public function studentWithPhones()
    {
        $sql = "SELECT students.id,
                    students.name, 
                    students.birth_date, 
                    phones.id as phone_id,
                    phones.area_code,
                    phones.number            
                FROM students
                JOIN phones ON students.id = phones.student_id";

        $statement = $this->connection->query($sql);
        $result = $statement->fetchAll();

        $studentList = [];

        foreach($result as $row){
            if(!array_key_exists($row['id'], $studentList)) {

                $studentList[$row['id']] = new Student(
                    $row['id'],
                    $row['name'],
                    new DateTimeImmutable("199-12-30")
                );
            }

            $phone = new Phone($row['phone_id'], $row['area_code'], $row['number']);
            $studentList[$row['id']]->addPhone($phone);
        }

        return $studentList;
    }



    private function fillPhonesOf(Student $student):void
    {

        $querySql = "SELECT id, area_code, number FROM phones WHERE student_id = ?";
        $statement = $this->connection->prepare($querySql);
        $statement->bindValue(1, $student->id(), PDO::PARAM_INT);
        $statement->execute();

        $phonesDataList = $statement->fetchAll();


        foreach($phonesDataList as $phoneData){
            $phone = new Phone(
                $phoneData['id'],
                $phoneData['area_code'],
                $phoneData['number']
            );

            $student->addPhone($phone);
        }
        
    }


    public function insert(Student $student):bool
    {
        $sql = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            'name' => $student->name(),
            'birth_date' => $student->birthDate()->format('Y-m-d')
        ]);
    }

    
    public function studentBirthAt(\DateTimeInterface $birthDate):array
    {
        $sql = "SELECT * FROM students WHERE birth_date = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $birthDate->birthDate());
        $statement->execute();

        return [];
    }

    public function update(Student $student):bool
    {
        $sql = "UPDATE students SET name = :name WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        return $statement->execute(['name'=> $student->name(), 'id' => $student->id()]);
    }

    
    public function save(Student $student):bool
    {   
        if($student->id() === NULL){
            return $this->insert($student);
        }

        return $this->update($student);
    }

    
    public function remove(Student $student):bool
    {
        $statement = $this->connection->prepare("DELETE FROM students WHERE id = ?");
        $statement->bindValue(1, $student->id(), PDO::PARAM_INT);
        return $statement->execute();
    }
}