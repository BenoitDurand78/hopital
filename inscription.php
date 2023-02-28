<?php

define("TITLE", "Inscription");

require_once(__DIR__ . "/controllers/employeeController.php");

$employeeController = new EmployeeController;
$messages = $employeeController->signUp();

include("assets/inc/header.php");
include("views/signUp.php");
include("assets/inc/footer.php");