<?php
function OuvrirBase()
{
    $lien = mysqli_connect("localhost", "root", "", "colis_db");
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