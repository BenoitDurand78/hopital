<h2>Liste des patients</h2>

<form action="#" method="GET">
    <label for="patientSearch">Chercher un patient :</label>
    <input type="search" id="patientSearch" name="patientSearch" placeholder="Nom ou prénom du patient" size="30">

    <button class="btn btn-primary">Rechercher</button>
</form>


<table class="table caption-top table-dark table-striped m-4 w-75">

    <thead>
        <tr>
            <th scope="col">Lastname</th>
            <th scope="col">Firstname</th>
            <th scope="col">Birthdate</th>
            <th scope="col">Lien</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($patients as $patient) { ?>
            <tr>
                <td><?= $patient->lastname ?></td>
                <td><?= $patient->firstname ?></td>
                <td><?= $patient->displayDate() ?></td>
                <td><a href='/patients/<?=$patient->id?>'>Voir plus d'infos.</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<nav>
  <ul class="pagination m-5 w-75 justify-content-center">
    <li class="page-item <?= ($currentPage == 1 ? "disabled" : "") ?>">
      <a class="page-link" href="/patients/<?= $currentPage - 1 ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php 
    for ($i = 1; $i <= $nbPage; $i++) { ?>
        <li class="page-item <?= ($i == $currentPage ? "active" : "") ?>">
            <a class="page-link" href="/patients/<?= $i ?>">
                <?= $i ?>
            </a>
        </li>
    <?php } ?>
    <li class="page-item <?= ($currentPage == $nbPage ? "disabled" : "") ?>">
      <a class="page-link" href="/patients/<?= $currentPage + 1 ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

<a href="/ajoutPatient.php" class="btn btn-success mt-5 mb-5">Ajouter un patient</a>

<div class="button">
    <button class="btn btn-info" onclick="location.href='/ajoutPatient.php'">Ajouter un patient</a></button>
</div>