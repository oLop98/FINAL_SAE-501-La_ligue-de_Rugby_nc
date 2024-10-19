<?php
session_start();

require 'backend/connexion.php';

// Récupérer les actions depuis la base de données
$stmt = $pdo->query('SELECT id, titre, description, images FROM action ORDER BY id DESC');
$actions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Actions - Ligue de Rugby de Nouvelle-Calédonie</title>
    <link rel="stylesheet" href="style/css.css">
    <link rel="stylesheet" href="style/actualite.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navbar.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Style général pour la page */
        body {
            background-color: #f7f7f7;
        }

        /* Style des cartes */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 15px;
            text-decoration: none;
            color: #000;
            transition: color 0.3s ease;
        }

        .card-title:hover {
            color: #E22B39;
        }

        .description-text {
            margin-bottom: 15px;
            font-size: 1rem;
        }

        /* Disposition en deux colonnes */
        .card-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Style de l'image à droite */
        .article-image {
            width: 150px; /* Taille fixe de l'image */
            max-width: 150px; /* Assure que l'image ne dépasse pas cette largeur */
            height: auto; /* Conserve le ratio de l'image */
            border-radius: 5px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card-content {
                flex-direction: column;
            }

            .article-image {
                margin-top: 100px;
                width: 100%;
                max-width: 100%; /* Empêche que l'image dépasse la taille de la fenêtre sur petit écran */
            }

            .card-title {
                font-size: 1.5rem;
            }
        }

        /* Supprimer la décoration de lien pour toute la carte */
        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .navbar div div ul li a
        {
            color:black;
        }
    </style>
</head>

<body>

    <!-- NavBar -->
    <?php include('navbar.php'); ?>

    <!-- Contenu principal -->
    <div class="container mt-5 pt-5">
        <div class="row" style="margin-top:5vh;">
            <h1 class="text-center mb-4"><strong>Nos actions</strong></h1>
            <?php foreach ($actions as $action): ?>
                <div class="col-md-6 mb-4"> <!-- Deux actions par ligne -->
                    <!-- Toute la carte est un lien cliquable -->
                    <a href="action.php?id=<?= $action['id']; ?>" class="card-link">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-content">
                                    <!-- Texte à gauche -->
                                    <div>
                                        <h2 class="card-title">
                                            <?= htmlspecialchars($action['titre']); ?>
                                        </h2>
                                        <p class="description-text"><?= htmlspecialchars($action['description']); ?></p>
                                    </div>
                                    <!-- Image à droite -->
                                    <?php 
                                    $images = !empty($action['images']) ? json_decode($action['images'], true) : [];
                                    if (!empty($images) && isset($images[0])): ?>
                                        <img src="<?= htmlspecialchars($images[0]); ?>" alt="<?= htmlspecialchars($action['titre']); ?>" class="article-image">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
