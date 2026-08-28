<?php
require("../config/db.php");
$lien = OuvrirBase();

$idenvoi = $_GET['idenvoi'];
mysqli_query($lien, "DELETE FROM Envoyer WHERE idenvoi='$idenvoi'");

FermerBase($lien);
header("Location: liste.php");
exit;
?>