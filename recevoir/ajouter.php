<?php
require("../config/db.php");
require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");
require("../PHPMailer-master/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$message = "";
$lien = OuvrirBase();

if (isset($_POST['ajouter'])) {
    $idenvoi    = $_POST['idenvoi'];
    $dateRecept = $_POST['dateRecept'];

    $requete = "INSERT INTO Recevoir (idenvoi, dateRecept) 
                VALUES ('$idenvoi', '$dateRecept')";
    $result = mysqli_query($lien, $requete);

    if ($result) {
        $message = "Réception enregistrée avec succès !";

        $req2 = "SELECT e.colis, e.nomEnvoyeur, e.emailEnvoyeur, 
                        e.nomRecepteur, v.design, i.villedep, i.villearr
                 FROM Envoyer e, Voiture v, Itineraire i
                 WHERE e.idvoit = v.idvoit
                 AND v.codeit = i.codeit
                 AND e.idenvoi = '$idenvoi'";
        $res2  = mysqli_query($lien, $req2);
        $envoi = mysqli_fetch_array($res2);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'andrianirinafabrice2024@gmail.com';
            $mail->Password   = 'rsyc limr pcie vsma';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('andrianirinafabrice2024@gmail.com', 'Cooperative Colis');
            $mail->addAddress($envoi['emailEnvoyeur'], $envoi['nomEnvoyeur']);
            $mail->isHTML(true);
            $mail->Subject = 'Votre colis a été réceptionné';
            $mail->Body    = "
                <p>Bonjour <b>" . $envoi['nomEnvoyeur'] . "</b>,</p>
                <p>Votre colis <b>'" . $envoi['colis'] . "'</b> a bien été réceptionné.</p>
                <ul>
                    <li>Voiture : " . $envoi['design'] . "</li>
                    <li>Trajet : " . $envoi['villedep'] . " - " . $envoi['villearr'] . "</li>
                    <li>Récepteur : " . $envoi['nomRecepteur'] . "</li>
                    <li>Date de réception : " . $dateRecept . "</li>
                </ul>
                <p>Merci de votre confiance.<br>La Coopérative</p>
            ";
            $mail->send();
            $message .= " | Mail envoyé à " . $envoi['emailEnvoyeur'];
        } catch (Exception $e) {
            $message .= " | Erreur mail : " . $mail->ErrorInfo;
        }
    } else {
        $message = "Erreur : " . mysqli_error($lien);
    }
}

$resEnvoi = mysqli_query($lien,
    "SELECT e.idenvoi, e.colis, e.nomEnvoyeur, e.nomRecepteur 
     FROM Envoyer e
     WHERE e.idenvoi NOT IN (SELECT idenvoi FROM Recevoir)");

$titre = "Enregistrer une réception";
require("../config/header.php");
?>

<div class="d-flex justify-content-between align-items-center">
    <h2>Enregistrer une réception de colis</h2>
    <a href="liste.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if ($message != "") echo '<div class="alert alert-success mt-3">' . $message . '</div>'; ?>

<div class="card mt-3" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="ajouter.php">
            <div class="mb-3">
                <label class="form-label">Colis (N° envoi)</label>
                <select name="idenvoi" class="form-select">
                    <?php while($e = mysqli_fetch_array($resEnvoi)) { ?>
                    <option value="<?php echo $e['idenvoi']; ?>">
                        <?php echo "N°" . $e['idenvoi'] . " - " . $e['colis'] . " (De: " . $e['nomEnvoyeur'] . " → " . $e['nomRecepteur'] . ")"; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Date de réception</label>
                <input type="datetime-local" name="dateRecept" class="form-control">
            </div>
            <button type="submit" name="ajouter" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Enregistrer
            </button>
        </form>
    </div>
</div>

<?php
FermerBase($lien);
require("../config/footer.php");
?>