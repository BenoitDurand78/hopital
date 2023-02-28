<?php

require_once(__DIR__ . "/../models/employees.php");

class EmployeeController {

    public function signUp(): array  {

        $messages = [];

        if(isset($_POST["submit"])) {
            if(!isset($_POST["username"]) || strlen($_POST["username"]) == 0 || strlen($_POST["username"]) > 50) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer un nom d'utilisateur entre 1 et 50 caractères."
                ];
            }

            var_dump(!isset($_POST["username"]));

            var_dump(strlen($_POST["username"] == 0));
            
            var_dump(strlen($_POST["username"] > 50));


            $uppercase = preg_match('@[A-Z]@', $_POST["password"]);
            $lowercase = preg_match('@[a-z]@', $_POST["password"]);
            $number = preg_match('@[0-9]@', $_POST["password"]);
            if (!isset($_POST["password"]) || !$uppercase || !$lowercase || !$number || strlen($_POST["password"]) < 8) {
                $messages[] = [
                    "success" => false,
                    "text" => "Votre mot de passe n'est pas valide. Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre."
                ];
            }
            if (!isset($_POST["passwordVerify"]) || ($_POST["passwordVerify"] != $_POST["password"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Les mots de passe ne correspondent pas."
                ];
            }
            if(count($messages) == 0) {
                $messages[] = [
                    "success" => true,
                    "text" => "L'employé est bien enregistré."
                ];

                // Préparation des données avant de les envoyer dans la BDD
                $username = htmlspecialchars($_POST["username"]);
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                Employees::create($username, $password);
            }
        }
        return $messages;
    }


    public function signIn(): array {

    }

}