<?php

require_once(__DIR__ . "/../models/appointments.php");

class AppointmentController {

    public function createAppointmentValidate(): array {
    
        $messages = [];

        if(isset($_POST["submit"])) {
            $dateTime = new DateTime($_POST["datetimeAppointment"]); 
            if (!isset($_POST["datetimeAppointment"]) || ($dateTime < new DateTime()) || (!$dateTime->format("d/m/Y H:i"))) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez indiquer une date et un horaire valide pour le RDV."
                ];
            } 
            if(!isset($_POST["patientChoice"]) || !is_numeric($_POST["patientChoice"])) {
                $messages[] = [
                    "success" => false,
                    "text" => "Veuillez choisir un patient existant pour valider la prise de RDV."
                ];
            } 
            if(count($messages) == 0) {
                $messages[] = [
                    "success" => true,
                    "text" => "Le RDV est bien enregistré."
                ];
                Appointment::create($_POST["datetimeAppointment"], $_POST["patientChoice"]);
            }
        }
        return $messages;
    }    


    public function readAllValidate(): array {
        $appointments = Appointment::readAll();
        return $appointments;
    }
}