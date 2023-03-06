<?php

require_once(__DIR__ . "/../database/pdo.php");


class Patient {

    public int $id;
    public string $lastname;
    public string $firstname;
    public string $birthdate;
    public ?string $phone;
    public string $mail;

    public function displayDate(): string {
        $birthdate = new DateTime($this->birthdate);
        return $birthdate->format("d/m/Y");
    }

    public static function create(string $lastname, string $firstname, string $birthdate, ?string $phone, string $mail): void {
        global $pdo; 

        $sql = "INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $statement->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $statement->bindParam(":birthdate", $birthdate, PDO::PARAM_STR);
        $statement->bindParam(":phone", $phone, PDO::PARAM_STR);
        $statement->bindParam(":mail", $mail, PDO::PARAM_STR);
        $statement->execute();
    }

}