<h2>Fiche patient</h2>

<p>Nom du patient : <?= $patient->lastname ?></p>
<p>Prénom du patient : <?= $patient->firstname ?></p>
<p>Date de naissance du patient du patient : <?= $patient->displayDate() ?></p>
<p>Adresse email du patient : <?= $patient->mail ?></p>
<p>Numéro de téléphone du patient : <?= $patient->phone ?></p>