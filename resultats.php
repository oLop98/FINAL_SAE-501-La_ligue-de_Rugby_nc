<?php
session_start();

require 'backend/connexion.php';


// Récupérer les actualités depuis la base de données
$stmt = $pdo->query('
    SELECT a.*, s.score_winner, s.score_looser, cw.nom AS equipeWinner, cl.nom AS equipeLooser, cw.image AS winner_img, cl.image AS looser_img
    FROM actualite a
    LEFT JOIN score s ON a.fk_score = s.id
    LEFT JOIN club cw ON s.fk_equipeWinner = cw.id
    LEFT JOIN club cl ON s.fk_equipeLooser = cl.id
    WHERE a.active = 1
    ORDER BY a.id DESC
');
$actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats - Ligue de Rugby de Nouvelle-Calédonie</title>
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

        .score-info {
            font-weight: bold;
            font-size: 0.9rem;
            /* Réduction de la taille de la police du score */
            margin-bottom: 10px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
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
            <h1 class="text-center mb-4"><strong>Résultats</strong></h1>
            <?php foreach ($actualites as $actualite): ?>
                <div class="col-md-6 mb-4"> <!-- Deux actualités par ligne -->
                    <!-- Toute la carte est désormais un lien cliquable -->
                        <div class="card h-100">

                            <div class="card-body">
                                <h2 class="card-title">
                                    <?= htmlspecialchars($actualite['titre']); ?>
                                </h2>

                                <!-- <?php if (!empty($actualite['img'])): ?>
                                <img src="../<?= htmlspecialchars($actualite['img']); ?>" alt="<?= htmlspecialchars($actualite['titre']); ?>" class="article-image" style="width:200px;border-radius:5px;">
                                <?php endif; ?> -->

                                <!-- Affichage du score s'il y a un score associé -->
                                <!-- <?php if (!empty($actualite['fk_score'])): ?>
                                    <p class="score-info">
                                        <?= htmlspecialchars($actualite['equipeWinner']); ?> <?= $actualite['score_winner']; ?> - <?= $actualite['score_looser']; ?> <?= htmlspecialchars($actualite['equipeLooser']); ?>
                                    </p>
                                <?php endif; ?>

                                <p class="card-text"><?= htmlspecialchars($actualite['description']); ?></p> -->

                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <img src="<?= !empty($actualite['winner_img']) ? htmlspecialchars($actualite['winner_img']) : 'assets/clubs/default.png'; ?>" alt="<?= htmlspecialchars($actualite['equipeWinner']); ?>" class="img-fluid" style="width: 100px;">
                                        <p><?= htmlspecialchars($actualite['equipeWinner']); ?></p>
                                    </div>
                                    <h3 class="mx-3"><?= htmlspecialchars($actualite['score_winner']) ?></h3>
                                    <h3 class="mx-3">-</h3>
                                    <h3 class="mx-3"><?= htmlspecialchars($actualite['score_looser']) ?></h3>
                                    <div class="text-center">
                                        <img src="<?= !empty($actualite['looser_img']) ? htmlspecialchars($actualite['looser_img']) : 'assets/clubs/default.png'; ?>" alt="<?= htmlspecialchars($actualite['equipeLooser']); ?>" class="img-fluid" style="width: 100px;">
                                        <p><?= htmlspecialchars($actualite['equipeLooser']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

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