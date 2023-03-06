<?php

session_start();

define("TITLE", "Fiche patient");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();


require_once(__DIR__ . "/controllers/patientController.php");
$patientController = new PatientController;
$patient = $patientController->readOneValidate();

$messages = $patientController->updateValidate();


include("assets/inc/header.php");
include("views/profilPatient.php");
include("views/modifierPatient.php");
include("assets/inc/footer.php");