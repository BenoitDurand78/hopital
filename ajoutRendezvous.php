<?php

session_start();

define("TITLE", "Prise de rendez-vous");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();

require_once(__DIR__ . "/controllers/patientController.php");
$patientController = new PatientController;
$patients = $patientController->readAllValidate();

require_once(__DIR__ . "/controllers/appointmentController.php");
$appointmentController = new AppointmentController;
$messages = $appointmentController->createAppointmentValidate();


include("assets/inc/header.php");
include("views/ajoutRendezvous.php");
include("assets/inc/footer.php");