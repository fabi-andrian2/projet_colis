<?php
function OuvrirBase()
{
    $host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";      // Exemple: gateway01.ap-southeast-1.prod.aws.tidbcloud.com
    $user = "bySeK84j6r5z3iE.root";      // Exemple: XXXXX.root
    $pass = "6bfmv35t0c8aFJeP";
    $dbname = "sys";               // Nom par défaut ou celui créé dans TiDB
    $port = 4000;                   // Port TiDB (par défaut 4000)

    $lien = mysqli_init();
    mysqli_ssl_set($lien, NULL, NULL, NULL, NULL, NULL);
    
    if (!mysqli_real_connect($lien, $host, $user, $pass, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
        die("Impossible d'établir la connexion : " . mysqli_connect_error());
    }
    return $lien;
}

function FermerBase($lien)
{
    mysqli_close($lien);
}
?>