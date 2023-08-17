<?php

session_start();

define("TITLE", "Accueil");

// Nous permet de vérifier que l'employé est bien connecté, et le renvoie vers index.php si ce n'est pas le cas
require_once(__DIR__ . "/controllers/employeeController.php");
$employeeController = new EmployeeController;
$employeeController->verifyLogin();


include(__DIR__ . "/assets/inc/header.php");
include(__DIR__ . "/views/index.php");
include(__DIR__ . "/assets/inc/footer.php");