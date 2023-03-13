<?php

session_start();

define("TITLE", "Suppression d'un RDV");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();


require_once(__DIR__ . "/controllers/appointmentController.php");
$appointmentController = new AppointmentController;
$appointments = $appointmentController->deleteValidate();



include("assets/inc/header.php");
include("views/suppressionRDV.php");
include("assets/inc/footer.php");