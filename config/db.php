<?php
function OuvrirBase()
{
    $host = "VOTRE_HOST_TIDB";      // Exemple: gateway01.ap-southeast-1.prod.aws.tidbcloud.com
    $user = "VOTRE_USER_TIDB";      // Exemple: XXXXX.root
    $pass = "VOTRE_MOT_DE_PASSE";
    $dbname = "test";               // Nom par défaut ou celui créé dans TiDB
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