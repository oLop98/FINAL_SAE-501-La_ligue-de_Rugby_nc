<?php
session_start();

require 'connexion.php'; // Assurez-vous que ce fichier établit une connexion à la base de données

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Récupérer les droits de l'utilisateur depuis la base de données
$stmt = $pdo->prepare('SELECT DroitClub, DroitUser, DroitActualite, DroitScore, DroitPartenaire, DroitAction FROM users WHERE id = :id');
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Ligue de Rugby de Nouvelle-Calédonie</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
        <!-- NavBar -->
        <?php include('backendnavbar.php'); ?>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <h1 class="text-center">Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?> !</h1>
        <p class="text-center">Vous êtes connecté à la plateforme de gestion du contenu de la Ligue de Rugby de Nouvelle-Calédonie.</p>

        <!-- Section des containers -->
        <div class="row mt-5">
            <?php if ($user['DroitClub'] == 1): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Clubs</h5>
                        <p class="card-text">Gérez les clubs affiliés à la ligue.</p>
                        <a href="addclub.php" class="btn btn-primary">Gérer les Clubs</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user['DroitScore'] == 1): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Scores</h5>
                        <p class="card-text">Gérez les scores des matchs.</p>
                        <a href="addscore.php" class="btn btn-primary">Gérer les Scores</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user['DroitActualite'] == 1): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Actualités</h5>
                        <p class="card-text">Publiez et modifiez les actualités de la ligue.</p>
                        <a href="addactualite.php" class="btn btn-primary">Gérer les Actualités</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user['DroitUser'] == 1): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Utilisateurs</h5>
                        <p class="card-text">Gérez les utilisateurs et leurs droits.</p>
                        <a href="addusers.php" class="btn btn-primary">Gérer les Utilisateurs</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user['DroitPartenaire'] == 1): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Partenaires</h5>
                        <p class="card-text">Gérez les partenaires de la ligue.</p>
                        <a href="addpartenaire.php" class="btn btn-primary">Gérer les Partenaires</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user['DroitAction'] == 1): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Actions</h5>
                        <p class="card-text">Gérez les actions de la ligue.</p>
                        <a href="addaction.php" class="btn btn-primary">Gérer les Actions</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include('backendfooter.php'); ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
