<?php

session_start();

define("TITLE", "Fiche patient");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();

require_once(__DIR__ . "/controllers/patientController.php");
$patientController = new PatientController;
$messages = $patientController->updateValidate();
$patient = $patientController->readOneValidate();

require_once(__DIR__ . "/controllers/appointmentController.php");
$appointmentController = new AppointmentController;
$appointments = $appointmentController->readAllForPatientValidate();


include("assets/inc/header.php");
include("views/profilPatient.php");
include("views/modifierPatient.php");
include("views/listeRendezvous.php");
include("assets/inc/footer.php");