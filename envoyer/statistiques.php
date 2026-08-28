<?php
require("../config/db.php");
$lien = OuvrirBase();

$reqRecette = "SELECT SUM(frais) as total FROM Envoyer";
$resRecette = mysqli_query($lien, $reqRecette);
$ligneRecette = mysqli_fetch_array($resRecette);
$total = $ligneRecette['total'] ?? 0;

$result = null;
$message = "";

if (isset($_POST['rechercher'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $requete = "SELECT e.idenvoi, e.colis, e.nomEnvoyeur, e.dateEnvoi,
                       e.frais, e.nomRecepteur,
                       v.design, i.villedep, i.villearr
                FROM Envoyer e, Voiture v, Itineraire i
                WHERE e.idvoit = v.idvoit
                AND v.codeit = i.codeit
                AND e.dateEnvoi BETWEEN '$date1' AND '$date2'
                ORDER BY e.dateEnvoi";

    $result = mysqli_query($lien, $requete);

    if (mysqli_num_rows($result) == 0) {
        $message = "Aucun colis trouvé entre ces deux dates.";
    }
}

$titre = "Statistiques";
require("../config/header.php");
?>

<h2>Statistiques de la coopérative</h2>

<!-- Recette totale -->
<div class="card mt-3 mb-4" style="max-width: 400px; border-left: 5px solid #1a3c5e;">
    <div class="card-body">
        <h5 class="card-title">Recette totale accumulée</h5>
        <h3 class="text-success">
            <i class="bi bi-cash-stack"></i>
            <?php echo number_format($total, 0, ',', ' '); ?> Ar
        </h3>
    </div>
</div>

<hr>

<!-- Recherche par période -->
<h4>Recherche des colis par période</h4>

<div class="card mt-3" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="statistiques.php">
            <div class="mb-3">
                <label class="form-label">Date début</label>
                <input type="datetime-local" name="date1" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Date fin</label>
                <input type="datetime-local" name="date2" class="form-control">
            </div>
            <button type="submit" name="rechercher" class="btn btn-primary">
                <i class="bi bi-calendar-range"></i> Rechercher
            </button>
        </form>
    </div>
</div>

<br>
<?php if ($message != "") echo '<div class="alert alert-warning">' . $message . '</div>'; ?>

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
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>

<?php
FermerBase($lien);
require("../config/footer.php");
?>