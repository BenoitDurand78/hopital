<h2>Liste des patients</h2>

<form action="#" method="GET">
    <label for="patientSearch">Chercher un patient :</label>
    <input type="search" id="patientSearch" name="patientSearch" placeholder="Nom ou prénom du patient" size="30">

    <button class="btn btn-primary">Rechercher</button>
</form>

<div class="row">

<?php 
    foreach($patients as $patient) {
    ?>
    <div class="col-sm-6 col-md-4 p-4">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h3 class="card-title"><?= $patient->firstname . " " . $patient->lastname ?></h3>
                <p class="card-text">né(e) le <?= $patient->displayDate() ?></p>
                <p class="card-text">Numéro de téléphone : <?= $patient->phone ?></p>
                <p class="card-text">Adresse email : <?= $patient->mail ?></p>
                <a href="/profilPatient.php?id=<?=$patient->id?>">Détails du patient</a>
            </div>
        </div>
    </div>
    <?php 
    }
?>

</div>


<nav>
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a href="listePatients.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a href="listePatients.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
            <a href="listePatients.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</nav>


<div class="button">
    <button class="btn btn-info" onclick="location.href='/ajoutPatient.php'">Ajouter un patient</a></button>
</div>