<?php
session_start();

require 'backend/connexion.php';

// Récupérer l'ID depuis l'URL
$id = $_GET['id'];

// Préparer la requête pour récupérer l'article avec cet ID
$stmt = $pdo->prepare('
    SELECT a.*, s.score_winner, s.score_looser, cw.nom AS equipeWinner, cl.nom AS equipeLooser 
    FROM actualite a
    LEFT JOIN score s ON a.fk_score = s.id
    LEFT JOIN club cw ON s.fk_equipeWinner = cw.id
    LEFT JOIN club cl ON s.fk_equipeLooser = cl.id
    WHERE a.id = :id
');
$stmt->execute(['id' => $id]);
$actualite = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'article existe
if (!$actualite) {
    header('Location: resultat.php'); // Rediriger si l'article n'existe pas
    exit();
}


// Récupérer les deux derniers articles sauf l'article actuel
$stmt_recent = $pdo->prepare('
    SELECT id, titre, description, img
    FROM actualite 
    WHERE active = 1 AND id != :current_id
    ORDER BY id DESC 
    LIMIT 3
');
$stmt_recent->execute(['current_id' => $id]);
$recent_articles = $stmt_recent->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($actualite['titre']); ?> - Ligue de Rugby de Nouvelle-Calédonie</title>
    <link rel="stylesheet" href="style/article.css"> <!-- Fichier CSS principal -->
    <link rel="stylesheet" href="style/css.css"> <!-- Fichier CSS principal -->
    <link rel="stylesheet" href="style/footer.css"> <!-- Fichier CSS pour le footer -->
    <link rel="stylesheet" href="style/navbar.css"> <!-- Fichier CSS pour la navbar -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

    <!-- NavBar -->
    <?php include('navbar.php'); ?>
    <!-- Contenu principal -->
    <div class="container main-content mt-5 pt-5">
        <!-- Section de l'article -->
        <div class="article-text-container" style="margin-top:5vh;">
            <h1 class="article-title"><?= htmlspecialchars($actualite['titre']); ?></h1>

            <?php if (!empty($actualite['fk_score'])): ?>
                <p class="score-info">
                    <?= htmlspecialchars($actualite['equipeWinner']); ?> <?= $actualite['score_winner']; ?> - <?= $actualite['score_looser']; ?> <?= htmlspecialchars($actualite['equipeLooser']); ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($actualite['img'])): ?>
                <img src="../<?= htmlspecialchars($actualite['img']); ?>" alt="<?= htmlspecialchars($actualite['titre']); ?>" class="article-image">
            <?php endif; ?>

            <p class="article-text"><?= htmlspecialchars($actualite['contenu']); ?></p>


        </div>

        <!-- Section des articles récents -->
        <div class="recent-articles" style="margin-top:5vh;">
            <h3>Derniers Résultats</h3>
            <?php foreach ($recent_articles as $recent): ?>
                <a href="article.php?id=<?= $recent['id']; ?>" class="card">
                    <div class="card-body">
                        <?php if (!empty($recent['img'])): ?>
                            <img src="../<?= htmlspecialchars($recent['img']); ?>" alt="<?= htmlspecialchars($recent['titre']); ?>" class="article-image">
                        <?php endif; ?>
                        <h4 class="card-title"><?= htmlspecialchars($recent['titre']); ?></h4>
                        <p class="card-text"><?= htmlspecialchars(substr($recent['description'], 0, 100)) . '...'; ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>