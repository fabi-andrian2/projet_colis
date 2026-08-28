<?php
require("../config/db.php");
$lien = OuvrirBase();

$requete = "SELECT v.idvoit, v.design, v.frais, i.villedep, i.villearr 
            FROM Voiture v, Itineraire i 
            WHERE v.codeit = i.codeit";
$result = mysqli_query($lien, $requete);

$titre = "Liste des voitures";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Liste des voitures</h2>
    <a href="ajouter.php" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Ajouter une voiture
    </a>
</div>

<table class="table table-bordered table-hover mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Désignation</th>
            <th>Itinéraire</th>
            <th>Frais</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($ligne = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $ligne['idvoit']; ?></td>
            <td><?php echo $ligne['design']; ?></td>
            <td><?php echo $ligne['villedep'] . " - " . $ligne['villearr']; ?></td>
            <td><?php echo number_format($ligne['frais'], 0, ',', ' '); ?> Ar</td>
            <td>
                <a href="modifier.php?idvoit=<?php echo $ligne['idvoit']; ?>" 
                   class="btn btn-warning btn-sm">
                   <i class="bi bi-pencil"></i> Modifier</a>
                <a href="supprimer.php?idvoit=<?php echo $ligne['idvoit']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Supprimer cette voiture ?')">
                   <i class="bi bi-trash"></i> Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
FermerBase($lien);
require("../config/footer.php");
?>