<?php

session_start();

define("TITLE", "Suppression d'un RDV");

require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();


// Lancer une fonction (faite sur le model et controller) ici faisant la suppression du rdv






include("assets/inc/header.php");

include("assets/inc/footer.php");