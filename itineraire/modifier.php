<?php
require("../config/db.php");

$message = "";
$lien = OuvrirBase();

$codeit = $_GET['codeit'] ?? $_POST['codeit'];
$result = mysqli_query($lien, "SELECT * FROM Itineraire WHERE codeit='$codeit'");
$ligne  = mysqli_fetch_array($result);

if (isset($_POST['modifier'])) {
    $villedep = $_POST['villedep'];
    $villearr = $_POST['villearr'];

    $req = "UPDATE Itineraire SET villedep='$villedep', villearr='$villearr' WHERE codeit='$codeit'";
    $res = mysqli_query($lien, $req);

    if ($res) {
        $message = "Itinéraire modifié avec succès !";
        $r2    = mysqli_query($lien, "SELECT * FROM Itineraire WHERE codeit='$codeit'");
        $ligne = mysqli_fetch_array($r2);
    } else {
        $message = "Erreur : " . mysqli_error($lien);
    }
}

FermerBase($lien);

$titre = "Modifier un itinéraire";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Modifier un itinéraire</h2>
    <a href="liste.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if ($message != "") echo '<div class="alert alert-success mt-3">' . $message . '</div>'; ?>

<div class="card mt-3" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="modifier.php">
            <input type="hidden" name="codeit" value="<?php echo $ligne['codeit']; ?>">
            <div class="mb-3">
                <label class="form-label">Code itinéraire</label>
                <input type="text" class="form-control" value="<?php echo $ligne['codeit']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Ville de départ</label>
                <input type="text" name="villedep" class="form-control" value="<?php echo $ligne['villedep']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ville d'arrivée</label>
                <input type="text" name="villearr" class="form-control" value="<?php echo $ligne['villearr']; ?>" required>
            </div>
            <button type="submit" name="modifier" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Modifier
            </button>
        </form>
    </div>
</div>

<?php require("../config/footer.php"); ?>