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
        if(isset($_GET["patientSearch"])) {
            $patients = Patient::patientSearch();
        } else {
            $patients = Patient::readAll();
        }
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

    public function updateValidate(): array {
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

                Patient::update($_GET["id"], $lastname, $firstname, $_POST["birthdate"], $_POST["phone"], $_POST["mail"]);
            }
        }
        return $messages;
    }

    public function deleteValidate(): void {
        if (!isset($_GET["id"])) {
            echo "Veuillez indiquer l'id du patient que vous souhaitez supprimer.";
            die;
        } elseif (!is_numeric($_GET["id"])) {
            echo "L'id du patient à supprimer doit être de type numérique.";
            die;
        } else {
            Patient::delete($_GET["id"]);
        }
    }


    public function currentPage(): int {
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) strip_tags($_GET['page']);
        }else{
            $currentPage = 1;
        }
        return $currentPage;
    }


    public static function numberOfPages() {
        $byPage = 10;
        $nbPatients = Patient::numberOfPatients(); 

        $pages = ceil($nbPatients / $byPage);

        return $pages;
        
    }

    
    public function readPatientsValidate(): array {
        $patientsList = [];
        $currentPage = PatientController::currentPage();
        if(!isset($_GET["page"])) {
            echo "Veuillez indiquer le numéro d'une page à afficher.";
            die;
        } elseif(!is_numeric($_GET["page"])) {
            echo "Le numéro de la page de la liste des patients doit être de type numérique.";
            die;
        } else {
            $patientsList = Patient::readPatients($currentPage); 
        }
        return $patientsList; 
    }

}