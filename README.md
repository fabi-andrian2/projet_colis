# Projet 6 — Gestion des colis d'une coopérative

Projet individuel réalisé dans le cadre du cours de développement web en L2 à l'ENI.

## Présentation

Application web de gestion des envois et réceptions de colis pour une coopérative de transport. Elle permet de suivre les colis de l'envoi jusqu'à la réception, avec génération de reçu PDF et notification par email.

## Fonctionnalités

- Gestion des itinéraires et des voitures (CRUD complet)
- Enregistrement des envois de colis
- Enregistrement des réceptions
- Recherche d'un colis par code ou désignation
- Recherche des colis entre deux dates
- Calcul de la recette totale de la coopérative
- Génération d'un reçu PDF par envoi
- Envoi automatique d'un email à l'envoyeur lors de la réception

## Technologies

- PHP 8 / MySQL
- Bootstrap 5 + Bootstrap Icons
- FPDF (génération PDF)
- PHPMailer (envoi email via Gmail SMTP)
- XAMPP (environnement local)

## Structure du projet

```
projet_colis/
├── config/
│   ├── db.php
│   ├── header.php
│   └── footer.php
├── itineraire/
│   ├── liste.php
│   ├── ajouter.php
│   ├── modifier.php
│   └── supprimer.php
├── voiture/
│   ├── liste.php
│   ├── ajouter.php
│   ├── modifier.php
│   └── supprimer.php
├── envoyer/
│   ├── liste.php
│   ├── ajouter.php
│   ├── modifier.php
│   ├── supprimer.php
│   ├── recherche.php
│   ├── statistiques.php
│   └── recu.php
├── recevoir/
│   ├── liste.php
│   ├── ajouter.php
│   └── supprimer.php
├── fpdf19/
├── PHPMailer-master/
└── index.php
```

## Installation

1. Cloner le dépôt dans `C:\xampp\htdocs\`
2. Démarrer XAMPP — Apache et MySQL
3. Créer une base de données nommée `colis_db`
4. Exécuter les requêtes SQL suivantes dans phpMyAdmin :

```sql
CREATE TABLE Itineraire (
  codeit VARCHAR(20) PRIMARY KEY,
  villedep VARCHAR(100) NOT NULL,
  villearr VARCHAR(100) NOT NULL
);

CREATE TABLE Voiture (
  idvoit VARCHAR(20) PRIMARY KEY,
  design VARCHAR(100) NOT NULL,
  codeit VARCHAR(20),
  frais INT NOT NULL,
  FOREIGN KEY (codeit) REFERENCES Itineraire(codeit)
);

CREATE TABLE Envoyer (
  idenvoi INT AUTO_INCREMENT PRIMARY KEY,
  idvoit VARCHAR(20),
  colis VARCHAR(100),
  nomEnvoyeur VARCHAR(100),
  emailEnvoyeur VARCHAR(100),
  dateEnvoi DATETIME,
  frais INT,
  nomRecepteur VARCHAR(100),
  contactRecepteur VARCHAR(50),
  FOREIGN KEY (idvoit) REFERENCES Voiture(idvoit)
);

CREATE TABLE Recevoir (
  idrecept INT AUTO_INCREMENT PRIMARY KEY,
  idenvoi INT,
  dateRecept DATETIME,
  FOREIGN KEY (idenvoi) REFERENCES Envoyer(idenvoi)
);
```

5. Accéder à l'application : `http://localhost/projet_colis/`

## Configuration email

Dans `recevoir/ajouter.php`, renseigner :

```php
$mail->Username = 'votre_email@gmail.com';
$mail->Password = 'mot_de_passe_application';
```

Le mot de passe d'application se génère depuis `myaccount.google.com/apppasswords`.

## Auteur

Projet réalisé seul — L2 ENI — Juin 2026
