<?php
session_start();

require 'backend/connexion.php';

// Vérifier si un ID d'action est passé dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Rediriger si aucun ID n'est présent
    header('Location: nos-actions.php');
    exit();
}

// Récupérer l'ID de l'action
$action_id = intval($_GET['id']);

// Récupérer les détails de l'action depuis la base de données
$stmt = $pdo->prepare('SELECT titre, description, images, contenu FROM action WHERE id = :id');
$stmt->execute(['id' => $action_id]);
$action = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'action existe
if (!$action) {
    echo "Action non trouvée.";
    exit();
}

// Décoder les images stockées en JSON, vérifier si la valeur est non nulle
$images = !empty($action['images']) ? json_decode($action['images'], true) : [];

// Récupérer les trois dernières actions sauf l'action actuelle
$stmt_recent = $pdo->prepare('
    SELECT id, titre, description, images
    FROM action 
    WHERE id != :current_id
    ORDER BY id DESC 
    LIMIT 3
');
$stmt_recent->execute(['current_id' => $action_id]);
$recent_actions = $stmt_recent->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navbar.css">
    <title><?= htmlspecialchars($action['titre']); ?> - Détail de l'action</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style général pour la page */
        body {
            background-color: #f7f7f7;
        }

        .action-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .action-images {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .action-images img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .action-images img:hover {
            transform: scale(1.1);
        }

        .recent-actions {
            margin-top: 30px;
        }

        .recent-action-card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .recent-action-card:hover {
            transform: translateY(-5px);
        }

        .recent-action-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .recent-action-img {
            width: 80px; /* Image plus petite */
            height: 80px;
            object-fit: cover;
            margin-left: 15px; /* Place l'image à droite */
            border-radius: 5px;
        }

        .recent-action-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .recent-action-description {
            font-size: 0.9rem;
            color: #555;
        }

        /* Ajustements pour le modal */
        .modal-lg {
            max-width: 70%; /* Réduit encore un peu la largeur du modal pour une meilleure visibilité */
        }

        .modal-content {
            max-height: 80vh; /* Réduit la hauteur pour éviter le scroll */
            overflow: hidden; /* Empêche le contenu de dépasser */
        }

        .carousel-item img {
            max-height: 70vh; /* Assure que l'image n'occupe pas plus de 70% de la hauteur de l'écran */
            margin: auto; /* Centrer l'image */
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

    <div class="container mt-5 pt-5">
        <div class="row">
            <!-- Section principale : Détail de l'action -->
            <div class="col-md-9">
                <h1 class="action-title"style="margin-top:20px;"><?= htmlspecialchars($action['titre']); ?></h1>
                
                <div class="action-images">
                    <?php if (!empty($images)): ?>
                        <?php foreach ($images as $index => $image): ?>
                            <img src="<?= htmlspecialchars($image); ?>" alt="Image pour <?= htmlspecialchars($action['titre']); ?>" data-bs-toggle="modal" data-bs-target="#carouselModal" data-index="<?= $index; ?>">
                        <?php endforeach; ?>
                    <?php else: ?>

                    <?php endif; ?>
                </div>

                <div class="action-content mt-3">
                    <?= $action['contenu']; ?> <!-- Le contenu est interprété comme du HTML -->
                </div>
            </div>

            <!-- Section des actions récentes : à droite -->
            <div class="col-md-3">
                <div class="recent-actions">
                    <h3>Actions Récentes</h3>
                    <?php foreach ($recent_actions as $recent): ?>
                        <a href="action.php?id=<?= $recent['id']; ?>" class="text-decoration-none">
                            <div class="card recent-action-card">
                                <div class="card-body">
                                    <h4 class="recent-action-title"><?= htmlspecialchars($recent['titre']); ?></h4>
                                    <div class="recent-action-content">
                                        <p class="recent-action-description"><?= htmlspecialchars(substr($recent['description'], 0, 100)) . '...'; ?></p>
                                        <?php if (!empty($recent['images'])): ?>
                                            <?php 
                                            $recent_images = json_decode($recent['images'], true);
                                            if (!empty($recent_images[0])): ?>
                                                <img src="<?= htmlspecialchars($recent_images[0]); ?>" alt="<?= htmlspecialchars($recent['titre']); ?>" class="recent-action-img">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel Modal -->
    <div class="modal fade" id="carouselModal" tabindex="-1" aria-labelledby="carouselModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($images as $index => $image): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                                    <img src="<?= htmlspecialchars($image); ?>" class="d-block mx-auto" alt="Image pour <?= htmlspecialchars($action['titre']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script pour ouvrir le carousel sur l'image sélectionnée
        document.querySelectorAll('.action-images img').forEach((img, index) => {
            img.addEventListener('click', function() {
                const carousel = document.getElementById('carouselImages');
                const activeItem = carousel.querySelector('.carousel-item.active');
                if (activeItem) {
                    activeItem.classList.remove('active');
                }
                carousel.querySelectorAll('.carousel-item')[index].classList.add('active');
            });
        });
    </script>

    <!-- Footer -->
    <?php include('footer.php'); ?>


</body>

</html>
