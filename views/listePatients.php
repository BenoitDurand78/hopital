<h2>Liste des patients</h2>
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


<button><a href="/ajoutPatient.php">Ajouter un patient</a></button>