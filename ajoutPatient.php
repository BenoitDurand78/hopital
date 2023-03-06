<?php

session_start();

define("TITLE", "Ajout d'un patient");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();

require_once(__DIR__ . "/controllers/patientController.php");
$patientController = new PatientController;
$messages = $patientController->createValidate();


include("assets/inc/header.php");
include("views/ajoutPatient.php");
include("assets/inc/footer.php");