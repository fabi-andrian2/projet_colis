<?php
require("../config/db.php");
$lien = OuvrirBase();

$idrecept = $_GET['idrecept'];
mysqli_query($lien, "DELETE FROM Recevoir WHERE idrecept='$idrecept'");

FermerBase($lien);
header("Location: liste.php");
exit;
?>