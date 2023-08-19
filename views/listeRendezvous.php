<h1>Liste des RDV</h1>

<main>

<p class="linkBookAppointment">Ajoutez un RDV en cliquant <a href="/ajoutRendezvous.php">ICI</a>.</p>

<div class="row">
<?php 
    foreach($appointments as $appointment) {
    ?>

    <div class="col-sm-6 col-md-4 p-3">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Numéro du rdv : <?= $appointment->id ?></h3>
                <p class="card-text">Date et heure du RDV : <?= $appointment->dateHour ?></p>
                <p class="card-text">Id du patient : <?= $appointment->idPatients ?></p>
                <p class="card-text">Nom et prénom du patient : <?= $appointment->patient->lastname . " " . $appointment->patient->firstname ?></p>
                <a href="/rendezvous.php?id=<?=$appointment->id?>">Détails du RDV</a>
                <br/>
                <div class="passedAppointment">
                    <?php $appointment->isPassed(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
    }
?>
</div>

</main>