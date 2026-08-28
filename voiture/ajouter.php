<?php
require("../config/db.php");

$message = "";
$lien = OuvrirBase();

if (isset($_POST['ajouter'])) {
    $idvoit = $_POST['idvoit'];
    $design = $_POST['design'];
    $codeit = $_POST['codeit'];
    $frais  = $_POST['frais'];

    $requete = "INSERT INTO Voiture (idvoit, design, codeit, frais) 
                VALUES ('$idvoit', '$design', '$codeit', '$frais')";
    $result = mysqli_query($lien, $requete);

    if ($result) {
        $message = "Voiture ajoutée avec succès !";
    } else {
        $message = "Erreur : " . mysqli_error($lien);
    }
}

$resIt = mysqli_query($lien, "SELECT * FROM Itineraire");

$titre = "Ajouter une voiture";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Ajouter une voiture</h2>
    <a href="liste.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if ($message != "") echo '<div class="alert alert-success mt-3">' . $message . '</div>'; ?>

<div class="card mt-3" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="ajouter.php">
            <div class="mb-3">
                <label class="form-label">ID Voiture</label>
                <input type="text" name="idvoit" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Désignation</label>
                <input type="text" name="design" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Itinéraire</label>
                <select name="codeit" class="form-select">
                    <?php while($it = mysqli_fetch_array($resIt)) { ?>
                    <option value="<?php echo $it['codeit']; ?>">
                        <?php echo $it['codeit'] . " - " . $it['villedep'] . " → " . $it['villearr']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Frais</label>
                <input type="number" name="frais" class="form-control" required>
            </div>
            <button type="submit" name="ajouter" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Ajouter
            </button>
        </form>
    </div>
</div>

<?php
FermerBase($lien);
require("../config/footer.php");
?>