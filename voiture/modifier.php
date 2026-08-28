<?php
require("../config/db.php");

$message = "";
$lien = OuvrirBase();

$idvoit = $_GET['idvoit'] ?? $_POST['idvoit'];
$result = mysqli_query($lien, "SELECT * FROM Voiture WHERE idvoit='$idvoit'");
$ligne  = mysqli_fetch_array($result);

if (isset($_POST['modifier'])) {
    $design = $_POST['design'];
    $codeit = $_POST['codeit'];
    $frais  = $_POST['frais'];

    $req = "UPDATE Voiture SET design='$design', codeit='$codeit', frais='$frais' 
            WHERE idvoit='$idvoit'";
    $res = mysqli_query($lien, $req);

    if ($res) {
        $message = "Voiture modifiée avec succès !";
        $r2    = mysqli_query($lien, "SELECT * FROM Voiture WHERE idvoit='$idvoit'");
        $ligne = mysqli_fetch_array($r2);
    } else {
        $message = "Erreur : " . mysqli_error($lien);
    }
}

$resIt = mysqli_query($lien, "SELECT * FROM Itineraire");

$titre = "Modifier une voiture";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Modifier une voiture</h2>
    <a href="liste.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if ($message != "") echo '<div class="alert alert-success mt-3">' . $message . '</div>'; ?>

<div class="card mt-3" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="modifier.php">
            <input type="hidden" name="idvoit" value="<?php echo $ligne['idvoit']; ?>">
            <div class="mb-3">
                <label class="form-label">ID Voiture</label>
                <input type="text" class="form-control" value="<?php echo $ligne['idvoit']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Désignation</label>
                <input type="text" name="design" class="form-control" value="<?php echo $ligne['design']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Itinéraire</label>
                <select name="codeit" class="form-select">
                    <?php while($it = mysqli_fetch_array($resIt)) { ?>
                    <option value="<?php echo $it['codeit']; ?>"
                        <?php if ($it['codeit'] == $ligne['codeit']) echo "selected"; ?>>
                        <?php echo $it['codeit'] . " - " . $it['villedep'] . " → " . $it['villearr']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Frais</label>
                <input type="number" name="frais" class="form-control" value="<?php echo $ligne['frais']; ?>" required>
            </div>
            <button type="submit" name="modifier" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Modifier
            </button>
        </form>
    </div>
</div>

<?php
FermerBase($lien);
require("../config/footer.php");
?>