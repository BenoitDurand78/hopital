<?php

session_start();

define("TITLE", "Liste des RDV");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();


require_once(__DIR__ . "/controllers/appointmentController.php");
$appointmentController = new AppointmentController;
$appointments = $appointmentController->readAllValidate();


include("assets/inc/header.php");
include("views/listeRendezvous.php");
include("assets/inc/footer.php");