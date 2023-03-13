<?php

session_start();

define("TITLE", "Suppression d'un patient");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();

require_once(__DIR__ . "/controllers/patientController.php");
$patientController = new PatientController;
$patientController->deleteValidate();


include("assets/inc/header.php");
include("views/suppressionPatient.php");
include("assets/inc/footer.php");