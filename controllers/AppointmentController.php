<?php

require_once(__DIR__ . "/../models/appointments.php");

class AppointmentController
{

    public function createAppointmentValidate(): array
    {

        $messages = [];

        if (isset($_POST["submit"])) {

            if (!isset($_POST["datetimeAppointment"]) || !DateTime::createFromFormat("Y-m-d\TH:i", $_POST["datetimeAppointment"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer une date et un horaire valide pour le RDV."
                ];
            }
            if (!isset($_POST["patientChoice"]) || !is_numeric($_POST["patientChoice"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez choisir un patient existant pour valider la prise de RDV."
                ];
            }
            if (count($messages) == 0) {
                $messages[] = [
                    "success" => true,
                    "text" => "Le RDV est bien enregistré."
                ];
                Appointment::create($_POST["datetimeAppointment"], $_POST["patientChoice"]);
            }
        }
        return $messages;
    }


    public function readAllValidate(): array
    {
        $appointments = Appointment::readAll();
        return $appointments;
    }


    public function readOneValidate(): Appointment
    {

        if (!isset($_GET["id"])) {
            echo "Veuillez indiquer l'id d'un RDV existant.";
            die;
        } elseif (!is_numeric($_GET["id"])) {
            echo "L'id du RDV doit être de type numérique.";
            die;
        } else {
            $id = $_GET["id"];
            $appointments = Appointment::readOne($id);

            if ($appointments == false) {
                echo "Aucun RDV n'a été trouvé avec cet ID : " . $id;
                die;
            }
        }
        return $appointments;
    }

    public function updateValidate(): array
    {
        $messages = [];
        if (isset($_POST["submit"])) {
            if (!isset($_POST["datetimeAppointment"]) || !DateTime::createFromFormat("Y-m-d\TH:i", $_POST["datetimeAppointment"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer une date et un horaire valide pour le RDV."
                ];
            }
            if (!isset($_POST["patientChoice"]) || !is_numeric($_POST["patientChoice"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez choisir un patient existant pour valider la prise de RDV."
                ];
            }
            if (count($messages) == 0) {
                $messages[] = [
                    "success" => true,
                    "text" => "Le patient a bien été modifié."
                ];


                Appointment::update($_GET["id"], $_POST["datetimeAppointment"], $_POST["patientChoice"]);
            }
        }
        return $messages;
    }


    public function readAllForPatientValidate(): array
    {

        if (!isset($_GET["id"])) {
            echo "Veuillez indiquer l'id d'un patient existant.";
            die;
        } elseif (!is_numeric($_GET["id"])) {
            echo "L'id du patient doit être de type numérique.";
            die;
        } else {
            $appointments = Appointment::readAllForPatient($_GET["id"]);
            return $appointments;
        }
    }


    public function deleteValidate() {
        if (!isset($_GET["id"])) {
            echo "Veuillez indiquer l'id du RDV que vous souhaitez supprimer.";
            die;
        } elseif (!is_numeric($_GET["id"])) {
            echo "L'id du RDV à supprimer doit être de type numérique.";
            die;
        } else {
            $appointments = Appointment::delete($_GET["id"]);
            return $appointments;
        }
    }
}