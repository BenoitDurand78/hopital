<?php

session_start();
define("TITLE", "Connexion");


require_once(__DIR__ . "/controllers/employeeController.php");


$employeeController = new EmployeeController;
$messages = $employeeController->signIn();


include("assets/inc/header.php");
include("views/signIn.php");
include("assets/inc/footer.php");