<h2>Connexion employés</h2>

<?php

if (count($messages) > 0) {
    foreach ($messages as $message) {
        if ($message["success"]) { ?>
            <p class="alert alert-success"><?= $message["text"] ?></p>
        <?php } else { ?>
            <p class="alert alert-danger"><?= $message["text"] ?></p>
<?php }
    }
}

if(isset($_SESSION["message"])) { ?>
    <p class="alert alert-warning"> <?= $_SESSION["message"] ?> </p>
    <?php 
    unset($_SESSION["message"]);
}



?>

<form action="#" method="POST">
<label for="username">Nom d'utilisateur :</label>
<input type="text" name="username" id="username" class="form-control">

<label for="password">Mot de passe :</label>
<input type="password" name="password" id="password" class="form-control">

<button type="submit" name="submit" class="btn btn-success">Envoyer</button>

</form>