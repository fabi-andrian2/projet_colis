<?php
require("../config/db.php");
$lien = OuvrirBase();

$requete = "SELECT * FROM Itineraire";
$result = mysqli_query($lien, $requete);

$titre = "Liste des itinéraires";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Liste des itinéraires</h2>
    <a href="ajouter.php" class="btn btn-success">+ Ajouter un itinéraire</a>
</div>

<table class="table table-bordered table-hover mt-3">
    <thead>
        <tr>
            <th>Code</th>
            <th>Ville départ</th>
            <th>Ville arrivée</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($ligne = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $ligne['codeit']; ?></td>
            <td><?php echo $ligne['villedep']; ?></td>
            <td><?php echo $ligne['villearr']; ?></td>
            <td>
                <a href="modifier.php?codeit=<?php echo $ligne['codeit']; ?>" 
                   class="btn btn-warning btn-sm btn-action">Modifier</a>
                <a href="supprimer.php?codeit=<?php echo $ligne['codeit']; ?>" 
                   class="btn btn-danger btn-sm btn-action"
                   onclick="return confirm('Supprimer cet itinéraire ?')">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
FermerBase($lien);
require("../config/footer.php");
?>