<h2>Liste des patients</h2>

<form action="#" method="GET">
    <label for="patientSearch">Chercher un patient :</label>
    <input type="search" id="patientSearch" name="patientSearch" placeholder="Nom ou prénom du patient" size="30">

    <button class="btn btn-primary">Rechercher</button>
</form>


<ul>
<?php 
    foreach($patients as $patient) {
    ?>
    <hr/> 
    <li><?= $patient->lastname . " " . $patient->firstname ?></li>
    <li>né(e) le <?= $patient->displayDate() ?></li>
    <li>Numéro de téléphone : <?= $patient->phone ?></li>
    <li>Adresse email : <?= $patient->mail ?></li>
    <li><a href="/profilPatient.php?id=<?=$patient->id?>">Détails du patient</a></li>
    
    <?php 
    }
?>
</ul>

<div class="button">
    <button class="btn btn-info" onclick="location.href='/ajoutPatient.php'">Ajouter un patient</a></button>
</div>