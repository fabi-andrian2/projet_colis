<?php
require("../config/db.php");
$lien = OuvrirBase();

$codeit = $_GET['codeit'];

$requete = "DELETE FROM Itineraire WHERE codeit='$codeit'";
mysqli_query($lien, $requete);

FermerBase($lien);
header("Location: liste.php");
exit;
?>