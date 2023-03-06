<?php

require_once(__DIR__ . "/../database/pdo.php");


class Appointment {

    public int $id;
    public string $dateHour;
    public int $idPatients;
    public Patient $patient;

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

}