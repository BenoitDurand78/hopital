<?php

session_start();
echo $_SESSION["username"];

define("TITLE", "Accueil");

?>

<h1>Site de l'hôpital</h1>

<?php

require_once(__DIR__ . "/assets/inc/header.php");
require_once(__DIR__ . "/assets/inc/footer.php");