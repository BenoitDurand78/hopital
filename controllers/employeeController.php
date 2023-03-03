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
            } else { 
                // Vérification que le nom d'utilisateur ne soit pas déjà utilisé
                if(Employee::readOne($_POST["username"]) != false) {
                    $messages[] = [
                        "success" => false,
                        "text" => "Ce nom d'utilisateur est déjà pris."
                    ];
                }
            }

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

                Employee::create($username, $password);
            }
        }
        return $messages;
    }


    public function signIn(): array {

        $messages = [];

        if(isset($_POST["submit"])) {
            if(!isset($_POST["username"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer un nom d'utilisateur."
                ];
            }
            if(!isset($_POST["password"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer un mot de passe."
                ];
            }

            if(count($messages) == 0) {
                // Essayons de récupérer un utilisateur avec les infos données

                $employee = Employee::readOne($_POST["username"]);
                if($employee == false) {
                    $messages[] = [
                        "success" => false,
                        "text" => "Aucun utilisateur avec ce nom trouvé."
                    ];
                } else {
                    // On vérifie si le mot de passe est correct
                    if(!password_verify($_POST["password"], $employee->password)) {
                        $messages[] = [
                            "success" => false,
                            "text" => "Mot de passe incorrect."
                        ]; 
                    } else {
                        $messages[] = [
                            "success" => true,
                            "text" => "Vous êtes désormais connecté."
                        ];

                        $_SESSION["username"] = $_POST["username"];

                        header("Location: /index.php");
                    }
                }
            }
        }
        return $messages;
    }


    public function verifyLogin(): void {
        if(!isset($_SESSION["username"])) {
            $_SESSION["message"] = "Merci de vous connecter pour accéder à ce contenu";
            header("Location: /connexion.php");
        }
    }
}