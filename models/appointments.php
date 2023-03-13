<?php

require_once(__DIR__ . "/../database/pdo.php");
require_once(__DIR__ . "/patients.php");


class Appointment {

    public int $id;
    public string $dateHour;
    public int $idPatients;
    public ?Patient $patient;


    public function displayDate(): string {
        $dateHour = new DateTime($this->dateHour);
        return $dateHour->format("d/m/Y H:i");
    }
    

    public static function create(string $dateHour, int $idPatients) {
        global $pdo; 

        $sql = "INSERT INTO appointments (dateHour, idPatients) VALUES (:dateHour, :idPatients)";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":dateHour", $dateHour, PDO::PARAM_STR);
        $statement->bindParam(":idPatients", $idPatients, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function readAll() : array {
        global $pdo; 
    
        $sql = "SELECT id, dateHour, idPatients FROM appointments ORDER BY dateHour";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "Appointment");
        $appointments = $statement->fetchAll();
        foreach($appointments as $appointment) {
            $idPatients = $appointment->idPatients;
            $sql = "SELECT id, lastname, firstname, birthdate, phone, mail FROM patients WHERE id = :idPatients";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(":idPatients", $idPatients, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, "Patient");
            $patient = $statement->fetch();
            $appointment->patient = $patient; 
        }
        return $appointments;
    }

    public function isPassed() {
        $dateHour = new DateTime($this->dateHour);
        $now = new DateTime();

        if($dateHour < $now) { ?>
            <i class="bi bi-calendar-check-fill" style="font-size: 60px"></i> 
            <?php 
        }
    }


    public static function readOne(int $id) : Appointment|false {
        global $pdo; 
    
        $sql = "SELECT id, dateHour, idPatients FROM appointments WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "Appointment");
        $appointments = $statement->fetch();

        if($appointments == false)  {
            return false;
        } else {
            $patient = Patient::readOne($appointments->idPatients);

            $appointments->patient = $patient;
        }

        return $appointments; 
    }

    public static function update(int $id, string $dateHour, int $idPatients): void {
        global $pdo;

        $sql = "UPDATE appointments
        SET dateHour = :dateHour, 
        idPatients = :idPatients
        WHERE id = :id";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":dateHour", $dateHour, PDO::PARAM_STR);
        $statement->bindParam(":idPatients", $idPatients, PDO::PARAM_INT);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function readAllForPatient(int $idPatients) {
        global $pdo;

        $sql = "SELECT id, dateHour, idPatients FROM appointments WHERE idPatients = :idPatients";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":idPatients", $idPatients, PDO::PARAM_INT);
        $statement->setFetchMode(PDO::FETCH_CLASS, "Appointment");
        $statement->execute();
        $appointments = $statement->fetchAll();
        foreach($appointments as $appointment) {
            $idPatients = $appointment->idPatients;
            $sql = "SELECT id, lastname, firstname, birthdate, phone, mail FROM patients WHERE id = :idPatients";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(":idPatients", $idPatients, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, "Patient");
            $patient = $statement->fetch();
            $appointment->patient = $patient; 
        }
        return $appointments;  
    }


    public static function delete(int $id) {
        global $pdo; 
    
        $sql = "DELETE FROM appointments WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

}