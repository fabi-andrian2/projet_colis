<?php
require("../config/db.php");

$message = "";
$lien = OuvrirBase();

$idenvoi = $_GET['idenvoi'] ?? $_POST['idenvoi'];
$result  = mysqli_query($lien, "SELECT * FROM Envoyer WHERE idenvoi='$idenvoi'");
$ligne   = mysqli_fetch_array($result);

if (isset($_POST['modifier'])) {
    $idvoit           = $_POST['idvoit'];
    $colis            = $_POST['colis'];
    $nomEnvoyeur      = $_POST['nomEnvoyeur'];
    $emailEnvoyeur    = $_POST['emailEnvoyeur'];
    $dateEnvoi        = $_POST['dateEnvoi'];
    $frais            = $_POST['frais'];
    $nomRecepteur     = $_POST['nomRecepteur'];
    $contactRecepteur = $_POST['contactRecepteur'];

    $req = "UPDATE Envoyer SET 
                idvoit='$idvoit', colis='$colis', nomEnvoyeur='$nomEnvoyeur',
                emailEnvoyeur='$emailEnvoyeur', dateEnvoi='$dateEnvoi',
                frais='$frais', nomRecepteur='$nomRecepteur',
                contactRecepteur='$contactRecepteur'
            WHERE idenvoi='$idenvoi'";
    $res = mysqli_query($lien, $req);

    if ($res) {
        $message = "Envoi modifié avec succès !";
        $r2    = mysqli_query($lien, "SELECT * FROM Envoyer WHERE idenvoi='$idenvoi'");
        $ligne = mysqli_fetch_array($r2);
    } else {
        $message = "Erreur : " . mysqli_error($lien);
    }
}

$resVoit = mysqli_query($lien, "SELECT v.idvoit, v.design, i.villedep, i.villearr 
                                 FROM Voiture v, Itineraire i 
                                 WHERE v.codeit = i.codeit");

$titre = "Modifier un envoi";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Modifier un envoi</h2>
    <a href="liste.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if ($message != "") echo '<div class="alert alert-success mt-3">' . $message . '</div>'; ?>

<div class="card mt-3" style="max-width: 600px;">
    <div class="card-body">
        <form method="POST" action="modifier.php">
            <input type="hidden" name="idenvoi" value="<?php echo $ligne['idenvoi']; ?>">
            <div class="mb-3">
                <label class="form-label">N° Envoi</label>
                <input type="text" class="form-control" value="<?php echo $ligne['idenvoi']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Voiture</label>
                <select name="idvoit" class="form-select">
                    <?php while($v = mysqli_fetch_array($resVoit)) { ?>
                    <option value="<?php echo $v['idvoit']; ?>"
                        <?php if ($v['idvoit'] == $ligne['idvoit']) echo "selected"; ?>>
                        <?php echo $v['idvoit'] . " - " . $v['design'] . " / " . $v['villedep'] . " → " . $v['villearr']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Désignation du colis</label>
                <input type="text" name="colis" class="form-control" value="<?php echo $ligne['colis']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nom de l'envoyeur</label>
                <input type="text" name="nomEnvoyeur" class="form-control" value="<?php echo $ligne['nomEnvoyeur']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email de l'envoyeur</label>
                <input type="email" name="emailEnvoyeur" class="form-control" value="<?php echo $ligne['emailEnvoyeur']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Date d'envoi</label>
                <input type="datetime-local" name="dateEnvoi" class="form-control"
                    value="<?php echo date('Y-m-d\TH:i', strtotime($ligne['dateEnvoi'])); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Frais</label>
                <input type="number" name="frais" class="form-control" value="<?php echo $ligne['frais']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nom du récepteur</label>
                <input type="text" name="nomRecepteur" class="form-control" value="<?php echo $ligne['nomRecepteur']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact du récepteur</label>
                <input type="text" name="contactRecepteur" class="form-control" value="<?php echo $ligne['contactRecepteur']; ?>">
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