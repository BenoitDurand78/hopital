<?php

session_start();

define("TITLE", "Fiche patient");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();

$messages = $patientController->updateValidate();

require_once(__DIR__ . "/controllers/patientController.php");
$patientController = new PatientController;
$patient = $patientController->readOneValidate();




include("assets/inc/header.php");
include("views/profilPatient.php");
include("views/modifierPatient.php");
include("assets/inc/footer.php");