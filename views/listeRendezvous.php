<h2>Liste des RDV</h2>

<ul>
<?php 
    foreach($appointments as $appointment) {
    ?>
    <hr/> 
    <li>Numéro du rdv : <?= $appointment->id ?></li>
    <li>Date et heure du RDV : <?= $appointment->dateHour ?></li>
    <li>Id, nom et prénom du patient : <?= $appointment->idPatients . " " . $appointment->patient->lastname . " " . $appointment->patient->firstname ?></li>

    <?php 
    }
?>
</ul>