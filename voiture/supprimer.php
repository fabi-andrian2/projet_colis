<?php
require("../config/db.php");
$lien = OuvrirBase();

$idvoit = $_GET['idvoit'];
mysqli_query($lien, "DELETE FROM Voiture WHERE idvoit='$idvoit'");

FermerBase($lien);
header("Location: liste.php");
exit;
?>