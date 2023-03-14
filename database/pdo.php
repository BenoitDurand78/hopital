<?php

$db_user = "root";
$db_password = "";
$db_host = "localhost";
$db_name = "hospitale2n";

$dsn = "mysql:dbname=" . $db_name . ";host=127.0.0.1";

$pdo = new PDO($dsn, $db_user, $db_password); 