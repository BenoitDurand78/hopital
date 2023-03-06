<?php

require_once(__DIR__ . "/../models/patients.php");

class PatientController {

    public function createValidate(): array {

        $messages = [];

        if(isset($_POST["submit"])) {
            if(!isset($_POST["lastname"]) || strlen($_POST["lastname"]) == 0) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer le nom du patient."
                ];
            }
            if(!isset($_POST["firstname"]) || strlen($_POST["firstname"]) == 0) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer le prénom du patient."
                ];
            }
            $dateTime = new DateTime($_POST["birthdate"]); 
            if (!isset($_POST["birthdate"]) || ($dateTime > new DateTime())) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer la date de naissance du patient."
                ];
            } 
            if ((!isset($_POST["phone"]) || !preg_match("@(0|\+33|0033)[1-7][0-9]{8}@", $_POST["phone"]))) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer un numéro de téléphone valide."
                ];
            }
            if (!isset($_POST["mail"]) || !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer un email valide."
                ];
            }
            if(count($messages) == 0) {
                $messages[] = [
                    "success" => true,
                    "text" => "Le patient est bien enregistré."
                ];

                $lastname = htmlspecialchars($_POST["lastname"]);
                $firstname = htmlspecialchars($_POST["firstname"]);

                Patient::create($lastname, $firstname, $_POST["birthdate"], $_POST["phone"], $_POST["mail"]);
            }
        }
        return $messages;
    }


    public function readAllValidate(): array {
        $patients = Patient::readAll();
        return $patients;
    }

    public function readOneValidate(): Patient {

        if(!isset($_GET["id"])) {
            echo "Veuillez indiquer l'id d'un patient existant.";
            die;
        } elseif(!is_numeric($_GET["id"])) {
            echo "L'id du patient doit être de type numérique.";
            die;
        } else {
            $id = $_GET["id"];
            $patients = Patient::readOne($id);

            if($patients == false) {
                echo "Aucun patient n'a été trouvé avec cet ID : " . $id;
                die;
            }
        }
        return $patients; 
    }

}