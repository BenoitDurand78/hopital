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
    
        $sql = "SELECT id, dateHour, idPatients FROM appointments";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "Appointment");
        $appointments = $statement->fetchAll();
        foreach($appointments as $appointment) {
            $idPatient = $appointment->idPatients;
            $sql = "SELECT id, lastname, firstname FROM patients WHERE id = :idPatient";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(":idPatient", $idPatient, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, "Patient");
            $patient = $statement->fetch();
            $appointment->patient = $patient; 
        }
        return $appointments;
    }


}