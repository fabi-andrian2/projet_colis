<?php
function OuvrirBase()
{
    $host = "sql310.infinityfree.com";
    $user = "if0_42778909";
    $pass = "PqC2Bo1HVp1fNRV";
    $dbname = "if0_42778909_colis_db";

    $lien = mysqli_connect($host, $user, $pass, $dbname);
    if (!$lien)
    {
        die("Impossible d'établir la connexion : " . mysqli_connect_error());
    }
    return $lien;
}

function FermerBase($lien)
{
    mysqli_close($lien);
}
?>