<?php
function OuvrirBase()
{
    $host = getenv('DB_HOST') ?: 'localhost';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '';
    $dbname = getenv('DB_NAME') ?: 'colis_db';
    $port = getenv('DB_PORT') ?: 3306;

    $lien = mysqli_connect($host, $user, $pass, $dbname, (int)$port);
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