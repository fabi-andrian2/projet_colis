<?php
require("../fpdf19/fpdf.php");
require("../config/db.php");

$lien = OuvrirBase();

$idenvoi = $_GET['idenvoi'];

$requete = "SELECT e.idenvoi, e.colis, e.nomEnvoyeur, e.emailEnvoyeur,
                   e.dateEnvoi, e.frais, e.nomRecepteur, e.contactRecepteur,
                   v.idvoit, v.design, i.villedep, i.villearr
            FROM Envoyer e, Voiture v, Itineraire i
            WHERE e.idvoit = v.idvoit
            AND v.codeit = i.codeit
            AND e.idenvoi = '$idenvoi'";

$result = mysqli_query($lien, $requete);
$e = mysqli_fetch_array($result);

FermerBase($lien);

$date = date('d M Y', strtotime($e['dateEnvoi']));

// Fonction pour éviter les problèmes de caractères spéciaux
function t($texte) {
    return utf8_decode($texte);
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, t('Recu N' . $e['idenvoi']), 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetLineWidth(0.5);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(70, 8, t("Date d'envoi :"), 0, 0);
$pdf->Cell(0, 8, t($date), 0, 1);

$pdf->Cell(70, 8, t("Nom de l'Envoyeur :"), 0, 0);
$pdf->Cell(0, 8, t($e['nomEnvoyeur']), 0, 1);

$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, t('Voiture N' . $e['idvoit'] . ' / Destination = ' . $e['villedep'] . ' - ' . $e['villearr']), 0, 1);
$pdf->SetFont('Arial', '', 12);

$pdf->Ln(3);

$pdf->Cell(70, 8, t('Colis :'), 0, 0);
$pdf->Cell(0, 8, t($e['colis']), 0, 1);

$pdf->Cell(70, 8, t('Frais :'), 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, number_format($e['frais'], 0, ',', ' ') . ' Ar', 0, 1);
$pdf->SetFont('Arial', '', 12);

$pdf->Ln(3);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(5);

$pdf->Cell(70, 8, t('Nom du Recepteur :'), 0, 0);
$pdf->Cell(0, 8, t($e['nomRecepteur']), 0, 1);

$pdf->Cell(70, 8, t('Contact du Recepteur :'), 0, 0);
$pdf->Cell(0, 8, t($e['contactRecepteur']), 0, 1);

$pdf->Output('D', 'recu_' . $idenvoi . '.pdf');
?>