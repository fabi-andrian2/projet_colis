<?php
function OuvrirBase()
{
    $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: 'localhost';
    $user = $_ENV['DB_USER'] ?? getenv('DB_USER') ?: 'root';
    $pass = $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?: '';
    $dbname = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: 'colis_db';
    $port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?: 3306;

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