<?php

require 'connexion.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<style>
        .delete-icon {
            color: red;
            cursor: pointer;
        }

        .edit-icon {
            color: blue;
            cursor: pointer;
        }

        .dropzone {
            width: 100%;
            height: 200px;
            border: 2px dashed #007bff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #007bff;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .navbar-nav-centered {
            display: flex;
            justify-content: center;
            flex-grow: 1;
            align-items: center;
        }

        .navbar-nav-centered .nav-item {
            margin-right: 10px;
        }

        .navbar-nav-centered .nav-link {
            padding-top: 10px;
            padding-bottom: 10px;
            margin: 0;
        }

        .navbar-nav-right {
            margin-left: auto;
            align-items: center;
        }

        .checkbox-disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../assets/logo.jpeg" width="70" alt="Logo de la ligue de rugby de Nouvelle-Calédonie.">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-nav-centered">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Accueil</a>
                    </li>
                    <?php if ($user['DroitUser'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="addusers.php">Gestion des utilisateurs</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($user['DroitScore'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="addscore.php">Gestion des Scores</a>
                        </li>
                    <?php endif; ?>

                    <?php if ($user['DroitAction'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="addaction.php">Gestion des Actions</a>
                        </li>
                    <?php endif; ?>
                                        <?php if ($user['DroitActualite'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="addactualite.php">Gestion des Résultats</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($user['DroitClub'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="addclub.php">Gestion des Clubs</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($user['DroitPartenaire'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="addpartenaire.php">Gestion des Partenaires</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-in-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>