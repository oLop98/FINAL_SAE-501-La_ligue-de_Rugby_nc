<?php
require '../backend/connexion.php';

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pseudo'], $_POST['temps'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $temps = (int) $_POST['temps'];

    // Insérer le score dans la base de données
    $stmt = $pdo->prepare("INSERT INTO score_jeux (pseudo, temps) VALUES (:pseudo, :temps)");
    $stmt->execute(['pseudo' => $pseudo, 'temps' => $temps]);
}

// Récupérer le top 5 des scores
$query = "SELECT pseudo, temps FROM score_jeux ORDER BY temps DESC LIMIT 3";
$topScores = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu de Mémoire - Clubs et Localités</title>
    <link rel="stylesheet" href="jeu.css">
    <link rel="stylesheet" href="../style/css.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
                .navbar div div ul li a
        {
            color:black;
        }
    </style>
</head>

<body>
<!-- Navbar -->
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg shadow-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index">
            <img src="/assets/logo.jpeg" width="70" alt="Logo de la ligue de rugby de Nouvelle-Calédonie.">
        </a>
        <button class="navbar-toggler burger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item px-2">
                    <a class="nav-link" href="/index">Accueil</a>
                </li>
                <li class="nav-item px-2">
                    <a href="/qui-sommes-nous" class="nav-link">Qui sommes-nous ?</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/notre-organisation">Notre organisation</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link " href="/nos-actions">Nos actions</a>
                </li>
                <!--
                <li class="nav-item px-2">
                    <a class="nav-link" href="/histoire-rugby">Histoire Rugby</a>
                </li>
                -->
                <li class="nav-item px-2">
                    <a class="nav-link" href="/resultats">Résultats</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/actualites">Actualités</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="jeu">Jeu 🏉</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<section class="gamescreenez">
    <audio id="background-music" src="music/fond-jeux-rugby.wav" loop></audio>

    <!-- Page d'accueil avec les consignes -->
    <div id="welcome-screen" class="welcome-screen modal-content">
        <h1>Jeu de Mémoire - Clubs et Localités</h1><br>
        <p>Le but du jeu est de glisser chaque logo de club vers sa localité correspondante. Vous avez 80 secondes pour
            compléter le jeu. Bonne chance !</p>
        <div id="score-board">
            <h3>Les plus vifs</h3>
            <ul>
                <?php foreach ($topScores as $score): ?>
                    <li><?= htmlspecialchars($score['pseudo']) ?> - <?= (int)$score['temps'] ?> sec</li>
                <?php endforeach; ?>
            </ul>
        </div>
        <button id="start-button" class="start-button">Commencer le jeu 🏉</button>

    </div>

    <!-- Conteneur principal du jeu -->
    <div id="game-screen" class="game-container" style="display: none;margin-top:70px;margin-bottom:70px;">

        <!-- Instructions de jeu -->
        <div class="instructions-container">
            <!-- Instructions et contrôles -->
            <div id="controls">
                <button id="reset-button" class="control-button">🔄</button>
                <button id="sound-toggle-button" class="control-button">
                    <span id="sound-icon">🔊</span> <!-- Icône pour le son activé -->
                </button>
            </div>
            <h2><strong>Trouver le club correspondant à sa localité</strong></h2>
            💻 Sur ordinateur : Glissez et déposez les logos des clubs sur les localités avec la souris 🖱️.<br>
            📱 Sur mobile/tablette : Touchez un logo, puis la localité correspondante pour associer.
            <p class="timer-instruction">Vous avez 80 secondes pour compléter le jeu. Bonne chance !</p>
        </div>

        <!-- Timer et conteneurs des localités et des clubs -->
        <div id="timer">Temps: 01:20</div>
        <div class="localities localities-top" id="localities-top-container"></div>
        <div class="clubs" id="clubs-container"></div>
        <div class="localities localities-bottom" id="localities-bottom-container"></div>
    </div>

    <!-- Fenêtre modale de fin de jeu -->
    <div id="end-game-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <h2 id="end-game-message"></h2>

            <!-- Formulaire pour enregistrer le pseudo -->
            <div>
                <form id="save-score-form">
                    <label for="pseudo">Entrez votre pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" required>
                    <input type="hidden" id="temps" name="temps">
                    <button type="submit" class="replay-button">Enregistrer le score</button>
                </form>
            </div>

            <!-- Tableau des scores -->
            <div id="score-board">
                <h3>Les plus vifs</h3>
                <ul>
                    <?php foreach ($topScores as $score): ?>
                        <li><?= htmlspecialchars($score['pseudo']) ?> - <?= (int)$score['temps'] ?> sec</li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <button id="replay-button">Rejouer</button>
        </div>
    </div>

    <!-- Script JavaScript pour gérer le jeu -->
    <script src="jeu.js"></script>
</section>

</body>

</html>