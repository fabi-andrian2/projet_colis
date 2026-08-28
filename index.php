<?php
require("config/db.php");
$lien = OuvrirBase();

// Statistiques rapides
$nbItineraires = mysqli_fetch_array(mysqli_query($lien, "SELECT COUNT(*) as nb FROM Itineraire"))['nb'];
$nbVoitures    = mysqli_fetch_array(mysqli_query($lien, "SELECT COUNT(*) as nb FROM Voiture"))['nb'];
$nbEnvois      = mysqli_fetch_array(mysqli_query($lien, "SELECT COUNT(*) as nb FROM Envoyer"))['nb'];
$nbReceptions  = mysqli_fetch_array(mysqli_query($lien, "SELECT COUNT(*) as nb FROM Recevoir"))['nb'];
$recette       = mysqli_fetch_array(mysqli_query($lien, "SELECT SUM(frais) as total FROM Envoyer"))['total'] ?? 0;

FermerBase($lien);

$titre = "Accueil";
require("config/header.php");
?>

<!-- Bannière -->
<div class="p-5 mb-4 rounded-3 text-white" style="background-color: #1a3c5e;">
    <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">
            <i class="bi bi-truck"></i> Coopérative Colis
        </h1>
        <p class="col-md-8 fs-4">Système de gestion des envois et réceptions de colis</p>
        <a href="envoyer/ajouter.php" class="btn btn-light btn-lg">
            <i class="bi bi-plus-circle"></i> Nouvel envoi
        </a>
        <a href="recevoir/ajouter.php" class="btn btn-outline-light btn-lg ms-2">
            <i class="bi bi-check-circle"></i> Enregistrer une réception
        </a>
    </div>
</div>

<!-- Statistiques -->
<h4 class="mb-3">Tableau de bord</h4>
<div class="row g-3 mb-5">
    <div class="col-md-3">
        <div class="card text-white h-100" style="background-color: #1a3c5e;">
            <div class="card-body text-center">
                <i class="bi bi-signpost-2" style="font-size: 2rem;"></i>
                <h2 class="mt-2"><?php echo $nbItineraires; ?></h2>
                <p class="mb-0">Itinéraires</p>
            </div>
            <div class="card-footer text-center">
                <a href="itineraire/liste.php" class="text-white">Voir la liste →</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white h-100" style="background-color: #2e6da4;">
            <div class="card-body text-center">
                <i class="bi bi-truck" style="font-size: 2rem;"></i>
                <h2 class="mt-2"><?php echo $nbVoitures; ?></h2>
                <p class="mb-0">Voitures</p>
            </div>
            <div class="card-footer text-center">
                <a href="voiture/liste.php" class="text-white">Voir la liste →</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white h-100" style="background-color: #17a589;">
            <div class="card-body text-center">
                <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
                <h2 class="mt-2"><?php echo $nbEnvois; ?></h2>
                <p class="mb-0">Envois</p>
            </div>
            <div class="card-footer text-center">
                <a href="envoyer/liste.php" class="text-white">Voir la liste →</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white h-100" style="background-color: #e67e22;">
            <div class="card-body text-center">
                <i class="bi bi-check2-circle" style="font-size: 2rem;"></i>
                <h2 class="mt-2"><?php echo $nbReceptions; ?></h2>
                <p class="mb-0">Réceptions</p>
            </div>
            <div class="card-footer text-center">
                <a href="recevoir/liste.php" class="text-white">Voir la liste →</a>
            </div>
        </div>
    </div>
</div>

<!-- Recette totale -->
<div class="card mb-5" style="border-left: 5px solid #1a3c5e; max-width: 400px;">
    <div class="card-body">
        <h5 class="card-title">
            <i class="bi bi-cash-stack text-success"></i> Recette totale accumulée
        </h5>
        <h3 class="text-success"><?php echo number_format($recette, 0, ',', ' '); ?> Ar</h3>
    </div>
</div>

<!-- Accès rapides -->
<h4 class="mb-3">Accès rapides</h4>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5><i class="bi bi-search"></i> Recherche</h5>
                <p class="text-muted">Rechercher un colis par code ou désignation</p>
                <a href="envoyer/recherche.php" class="btn btn-outline-primary btn-sm">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5><i class="bi bi-calendar-range"></i> Statistiques</h5>
                <p class="text-muted">Recherche par période et recette totale</p>
                <a href="envoyer/statistiques.php" class="btn btn-outline-primary btn-sm">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5><i class="bi bi-file-pdf"></i> Reçu PDF</h5>
                <p class="text-muted">Générer un reçu PDF depuis la liste des envois</p>
                <a href="envoyer/liste.php" class="btn btn-outline-primary btn-sm">Accéder</a>
            </div>
        </div>
    </div>
</div>

<?php require("config/footer.php"); ?>