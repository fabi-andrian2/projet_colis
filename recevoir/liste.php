<?php
require("../config/db.php");
$lien = OuvrirBase();

$requete = "SELECT r.idrecept, r.dateRecept, 
                   e.idenvoi, e.colis, e.nomEnvoyeur, e.nomRecepteur
            FROM Recevoir r, Envoyer e
            WHERE r.idenvoi = e.idenvoi
            ORDER BY r.dateRecept DESC";
$result = mysqli_query($lien, $requete);

$titre = "Liste des réceptions";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Liste des réceptions de colis</h2>
    <a href="ajouter.php" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Enregistrer une réception
    </a>
</div>

<table class="table table-bordered table-hover mt-3">
    <thead>
        <tr>
            <th>N° Réception</th>
            <th>N° Envoi</th>
            <th>Colis</th>
            <th>Envoyeur</th>
            <th>Récepteur</th>
            <th>Date réception</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($ligne = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $ligne['idrecept']; ?></td>
            <td><?php echo $ligne['idenvoi']; ?></td>
            <td><?php echo $ligne['colis']; ?></td>
            <td><?php echo $ligne['nomEnvoyeur']; ?></td>
            <td><?php echo $ligne['nomRecepteur']; ?></td>
            <td><?php echo $ligne['dateRecept']; ?></td>
            <td>
                <a href="supprimer.php?idrecept=<?php echo $ligne['idrecept']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Supprimer cette réception ?')">
                   <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
FermerBase($lien);
require("../config/footer.php");
?>