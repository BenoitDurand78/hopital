<h1>Fiche patient</h1>

<main>

<p>Numéro du patient : <?= $patient->id ?></p>
<p>Nom du patient : <?= $patient->lastname ?></p>
<p>Prénom du patient : <?= $patient->firstname ?></p>
<p>Date de naissance du patient du patient : <?= $patient->displayDate() ?></p>
<p>Adresse email du patient : <?= $patient->mail ?></p>
<p>Numéro de téléphone du patient : <?= $patient->phone ?></p>

<div class="button">
    <button class="btn btn-danger" onclick="location.href='/suppressionPatient.php?id=<?= $patient->id ?>'">Supprimer le patient</button>
</div>

</main>