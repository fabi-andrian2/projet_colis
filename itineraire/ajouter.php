<?php
require("../config/db.php");

$message = "";

if (isset($_POST['ajouter'])) {
    $lien = OuvrirBase();
    
    $codeit   = $_POST['codeit'];
    $villedep = $_POST['villedep'];
    $villearr = $_POST['villearr'];
    
    $requete = "INSERT INTO Itineraire (codeit, villedep, villearr) 
                VALUES ('$codeit', '$villedep', '$villearr')";
    $result = mysqli_query($lien, $requete);
    
    if ($result) {
        $message = "Itinéraire ajouté avec succès !";
    } else {
        $message = "Erreur : " . mysqli_error($lien);
    }
    FermerBase($lien);
}

$titre = "Ajouter un itinéraire";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Ajouter un itinéraire</h2>
    <a href="liste.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if ($message != "") echo '<div class="alert alert-success mt-3">' . $message . '</div>'; ?>

<div class="card mt-3" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="ajouter.php">
            <div class="mb-3">
                <label class="form-label">Code itinéraire</label>
                <input type="text" name="codeit" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ville de départ</label>
                <input type="text" name="villedep" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ville d'arrivée</label>
                <input type="text" name="villearr" class="form-control" required>
            </div>
            <button type="submit" name="ajouter" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Ajouter
            </button>
        </form>
    </div>
</div>

<?php require("../config/footer.php"); ?>