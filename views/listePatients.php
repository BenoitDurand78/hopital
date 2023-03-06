<h2>Liste des patients</h2>
<ul>
<?php 
    foreach($patients as $patient) {
    ?>
    <hr/> 
    <li><?= $patient->lastname . " " . $patient->lastname ?></li>
    <li>né(e) le <?= $patient->birthdate ?></li>
    <li>Numéro de téléphone : <?= $patient->phone ?></li>
    <li>Adresse email : <?= $patient->mail ?></li>
    
    <?php 
    }
?>
</ul>


<button><a href="/ajoutPatient.php">Ajouter un patient</a></button>