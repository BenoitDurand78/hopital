<?php

session_start();

define("TITLE", "Détails RDV");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();

require_once(__DIR__ . "/controllers/patientController.php");
$patientController = new PatientController;
$patients = $patientController->readAllValidate();

require_once(__DIR__ . "/controllers/appointmentController.php");
$appointmentController = new AppointmentController;
$messages = $appointmentController->updateValidate();
$appointment = $appointmentController->readOneValidate();



include("assets/inc/header.php");
include("views/rendezvous.php");
include("views/modifierRendezvous.php");
include("assets/inc/footer.php");