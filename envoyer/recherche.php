<?php
require("../config/db.php");

$result = null;
$message = "";
$lien = OuvrirBase();

if (isset($_POST['rechercher'])) {
    $mot = $_POST['mot'];

    $requete = "SELECT e.idenvoi, e.colis, e.nomEnvoyeur, e.dateEnvoi,
                       e.frais, e.nomRecepteur, e.contactRecepteur,
                       v.design, i.villedep, i.villearr
                FROM Envoyer e, Voiture v, Itineraire i
                WHERE e.idvoit = v.idvoit 
                AND v.codeit = i.codeit
                AND (e.idenvoi LIKE '%$mot%' OR e.colis LIKE '%$mot%')";

    $result = mysqli_query($lien, $requete);

    if (mysqli_num_rows($result) == 0) {
        $message = "Aucun colis trouvé pour : $mot";
    }
}

$titre = "Recherche de colis";
require("../config/header.php");
?>

<h2>Rechercher un colis</h2>

<div class="card mt-3" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="recherche.php">
            <div class="input-group">
                <input type="text" name="mot" class="form-control" 
                       placeholder="Code d'envoi ou désignation...">
                <button type="submit" name="rechercher" class="btn btn-primary">
                    <i class="bi bi-search"></i> Rechercher
                </button>
            </div>
        </form>
    </div>
</div>

<br>
<?php if ($message != "") echo '<div class="alert alert-warning mt-3">' . $message . '</div>'; ?>

<?php if ($result != null && mysqli_num_rows($result) > 0) { ?>
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
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>

<?php
FermerBase($lien);
require("../config/footer.php");
?>