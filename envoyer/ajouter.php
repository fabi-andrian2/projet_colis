<?php
require("../config/db.php");

$message = "";
$lien = OuvrirBase();

if (isset($_POST['ajouter'])) {
    $idvoit           = $_POST['idvoit'];
    $colis            = $_POST['colis'];
    $nomEnvoyeur      = $_POST['nomEnvoyeur'];
    $emailEnvoyeur    = $_POST['emailEnvoyeur'];
    $dateEnvoi        = $_POST['dateEnvoi'];
    $frais            = $_POST['frais'];
    $nomRecepteur     = $_POST['nomRecepteur'];
    $contactRecepteur = $_POST['contactRecepteur'];

    $requete = "INSERT INTO Envoyer 
                (idvoit, colis, nomEnvoyeur, emailEnvoyeur, dateEnvoi, frais, nomRecepteur, contactRecepteur)
                VALUES ('$idvoit', '$colis', '$nomEnvoyeur', '$emailEnvoyeur', 
                        '$dateEnvoi', '$frais', '$nomRecepteur', '$contactRecepteur')";
    $result = mysqli_query($lien, $requete);

    if ($result) {
        $message = "Envoi enregistré avec succès !";
    } else {
        $message = "Erreur : " . mysqli_error($lien);
    }
}

$resVoit = mysqli_query($lien, "SELECT v.idvoit, v.design, i.villedep, i.villearr 
                                 FROM Voiture v, Itineraire i 
                                 WHERE v.codeit = i.codeit");

$titre = "Nouvel envoi";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Enregistrer un envoi de colis</h2>
    <a href="liste.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if ($message != "") echo '<div class="alert alert-success mt-3">' . $message . '</div>'; ?>

<div class="card mt-3" style="max-width: 600px;">
    <div class="card-body">
        <form method="POST" action="ajouter.php">
            <div class="mb-3">
                <label class="form-label">Voiture</label>
                <select name="idvoit" class="form-select">
                    <?php while($v = mysqli_fetch_array($resVoit)) { ?>
                    <option value="<?php echo $v['idvoit']; ?>">
                        <?php echo $v['idvoit'] . " - " . $v['design'] . " / " . $v['villedep'] . " → " . $v['villearr']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Désignation du colis</label>
                <input type="text" name="colis" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nom de l'envoyeur</label>
                <input type="text" name="nomEnvoyeur" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email de l'envoyeur</label>
                <input type="email" name="emailEnvoyeur" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Date d'envoi</label>
                <input type="datetime-local" name="dateEnvoi" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Frais</label>
                <input type="number" name="frais" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nom du récepteur</label>
                <input type="text" name="nomRecepteur" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact du récepteur</label>
                <input type="text" name="contactRecepteur" class="form-control">
            </div>
            <button type="submit" name="ajouter" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Enregistrer
            </button>
        </form>
    </div>
</div>

<?php
FermerBase($lien);
require("../config/footer.php");
?>