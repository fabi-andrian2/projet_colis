<?php
require("../config/db.php");
$lien = OuvrirBase();

$requete = "SELECT e.idenvoi, e.colis, e.nomEnvoyeur, e.dateEnvoi, 
                   e.frais, e.nomRecepteur, e.contactRecepteur,
                   v.design, i.villedep, i.villearr
            FROM Envoyer e, Voiture v, Itineraire i
            WHERE e.idvoit = v.idvoit 
            AND v.codeit = i.codeit
            ORDER BY e.dateEnvoi DESC";
$result = mysqli_query($lien, $requete);

$titre = "Liste des envois";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Liste des envois de colis</h2>
    <a href="ajouter.php" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Nouvel envoi
    </a>
</div>

<table class="table table-bordered table-hover mt-3">
    <thead>
        <tr>
            <th>N° Envoi</th>
            <th>Colis</th>
            <th>Envoyeur</th>
            <th>Voiture / Destination</th>
            <th>Date envoi</th>
            <th>Frais</th>
            <th>Récepteur</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($ligne = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $ligne['idenvoi']; ?></td>
            <td><?php echo $ligne['colis']; ?></td>
            <td><?php echo $ligne['nomEnvoyeur']; ?></td>
            <td><?php echo $ligne['design'] . " / " . $ligne['villedep'] . " - " . $ligne['villearr']; ?></td>
            <td><?php echo $ligne['dateEnvoi']; ?></td>
            <td><?php echo number_format($ligne['frais'], 0, ',', ' '); ?> Ar</td>
            <td><?php echo $ligne['nomRecepteur']; ?></td>
            <td><?php echo $ligne['contactRecepteur']; ?></td>
            <td>
                <a href="modifier.php?idenvoi=<?php echo $ligne['idenvoi']; ?>" 
                   class="btn btn-warning btn-sm">
                   <i class="bi bi-pencil"></i></a>
                <a href="supprimer.php?idenvoi=<?php echo $ligne['idenvoi']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Supprimer cet envoi ?')">
                   <i class="bi bi-trash"></i></a>
                <a href="recu.php?idenvoi=<?php echo $ligne['idenvoi']; ?>" 
                   class="btn btn-primary btn-sm">
                   <i class="bi bi-file-pdf"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
FermerBase($lien);
require("../config/footer.php");
?>