<h2>Liste des RDV</h2>

<p class="linkBookAppointment">Ajoutez un RDV en cliquant <a href="/ajoutRendezvous.php">ICI</a>.</p>

<ul>
<?php 
    foreach($appointments as $appointment) {
    ?>
    <hr/> 
    <li>Numéro du rdv : <?= $appointment->id ?></li>
    <li>Date et heure du RDV : <?= $appointment->dateHour ?></li>
    <li>Id, nom et prénom du patient : <?= $appointment->idPatients . " " . $appointment->patient->lastname . " " . $appointment->patient->firstname ?></li>
    <li><a href="/rendezvous.php?id=<?=$appointment->id?>">Détails du RDV</a></li>
    
    <?php 
    $appointment->isPassed(); 
    }
?>
</ul>

