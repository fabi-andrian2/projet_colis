<?php
$titre = isset($titre) ? $titre : "Gestion des Colis";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titre; ?> - Coopérative Colis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #1a3c5e !important; }
        h2 { color: #1a3c5e; margin: 20px 0; }
        .table thead { background-color: #1a3c5e; color: white; }
        .btn-action { margin: 2px; }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/projet_colis/index.php">
            <i class="bi bi-truck"></i> Coopérative Colis
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/projet_colis/itineraire/liste.php">Itinéraires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projet_colis/voiture/liste.php">Voitures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projet_colis/envoyer/liste.php">Envois</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projet_colis/recevoir/liste.php">Réceptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projet_colis/envoyer/recherche.php">Recherche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projet_colis/envoyer/statistiques.php">Statistiques</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">