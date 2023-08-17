<h1>Formulaire d'ajout d'un patient</h1>

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

?>
<main>
    <form action="#" method="POST">

    <label for="lastname">Nom du patient :</label>
    <input type="text" name="lastname" id="lastname" class="form-control">

    <label for="firstname">Prénom du patient :</label>
    <input type="text" name="firstname" id="firstname" class="form-control">

    <label for="birthdate">Date de naissance du patient :</label>
    <input type="date" name="birthdate" id="birthdate" class="form-control">

    <label for="phone">Numéro de téléphone du patient :</label>
    <input type="text" name="phone" id="phone" class="form-control">

    <label for="mail">Adresse mail du patient :</label>
    <input type="email" name="mail" id="mail" class="form-control">

    <div class="button">
    <button type="submit" name="submit" class="btn btn-success">Ajouter le patient</button>
    </div>
    </form>
</main>