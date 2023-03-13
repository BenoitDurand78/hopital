<?php

session_start();

define("TITLE", "Liste des patients");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();


require_once(__DIR__ . "/controllers/patientController.php");
$patientController = new PatientController;
$currentPage = $patientController->currentPage();
$pages = $patientController->numberOfPages();
$patients = $patientController->readPatientsValidate();


include("assets/inc/header.php");
include("views/listePatients.php");
include("assets/inc/footer.php");