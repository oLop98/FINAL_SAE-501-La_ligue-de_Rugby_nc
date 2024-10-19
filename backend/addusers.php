<?php
// Démarrer la session
session_start();

// Inclure la connexion à la base de données
require 'connexion.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}

// Récupérer les droits de l'utilisateur depuis la base de données
$stmt = $pdo->prepare('SELECT DroitPartenaire, DroitUser, DroitScore, DroitActualite, DroitClub, DroitAction FROM users WHERE id = :id');
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur a les droits pour gérer les utilisateurs
if (!$user || $user['DroitUser'] != 1) {
    // Rediriger vers une page d'erreur ou d'accès refusé si l'utilisateur n'a pas les droits
    header('Location: access_denied.php');
    exit();
}

// Si le formulaire d'ajout d'utilisateur a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $username = $_POST['username'];

    // Vérifier si le nom d'utilisateur existe déjà
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        // Si l'utilisateur existe déjà, afficher un message d'erreur
        echo "<script>alert('Le nom d\'utilisateur est déjà pris. Veuillez en choisir un autre.');</script>";
    } else {
        // Sinon, procéder à l'ajout de l'utilisateur
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hacher le mot de passe
        $droitScore = isset($_POST['DroitScore']) ? 1 : 0;
        $droitActualite = isset($_POST['DroitActualite']) ? 1 : 0;
        $droitUser = isset($_POST['DroitUser']) ? 1 : 0;
        $droitClub = isset($_POST['DroitClub']) ? 1 : 0;
        $droitPartenaire = isset($_POST['DroitPartenaire']) ? 1 : 0;
        $droitAction = isset($_POST['DroitAction']) ? 1 : 0; // Nouveau champ

        // Préparer et exécuter l'insertion des données
        $stmt = $pdo->prepare('INSERT INTO users (username, password, DroitScore, DroitActualite, DroitUser, DroitClub, DroitPartenaire, DroitAction) 
                               VALUES (:username, :password, :droitScore, :droitActualite, :droitUser, :droitClub, :droitPartenaire, :droitAction)');
        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'droitScore' => $droitScore,
            'droitActualite' => $droitActualite,
            'droitUser' => $droitUser,
            'droitClub' => $droitClub,
            'droitPartenaire' => $droitPartenaire,
            'droitAction' => $droitAction  // Nouveau champ
        ]);

        // Rediriger après l'ajout
        header('Location: addusers.php');
        exit();
    }
}

// Si le formulaire de mise à jour a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $droitScore = isset($_POST['DroitScore']) ? 1 : 0;
    $droitActualite = isset($_POST['DroitActualite']) ? 1 : 0;
    $droitUser = isset($_POST['DroitUser']) ? 1 : 0;
    $droitClub = isset($_POST['DroitClub']) ? 1 : 0;
    $droitPartenaire = isset($_POST['DroitPartenaire']) ? 1 : 0;
    $droitAction = isset($_POST['DroitAction']) ? 1 : 0; // Nouveau champ

    // Mettre à jour les informations dans la base de données
    $stmt = $pdo->prepare('UPDATE users SET DroitScore = :droitScore, DroitActualite = :droitActualite, DroitUser = :droitUser, DroitClub = :droitClub, DroitPartenaire = :droitPartenaire, DroitAction = :droitAction WHERE id = :id');
    $stmt->execute([
        'droitScore' => $droitScore,
        'droitActualite' => $droitActualite,
        'droitUser' => $droitUser,
        'droitClub' => $droitClub,
        'droitPartenaire' => $droitPartenaire,
        'droitAction' => $droitAction,  // Nouveau champ
        'id' => $id
    ]);

    // Rediriger après la mise à jour
    header('Location: addusers.php');
    exit();
}

// Si le formulaire de suppression a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];

    // Supprimer l'utilisateur de la base de données
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $stmt->execute(['id' => $id]);

    // Rediriger après la suppression
    header('Location: addusers.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - Ligue de Rugby de Nouvelle-Calédonie</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
        <!-- NavBar -->
        <?php include('backendnavbar.php'); ?>

    <div class="container mt-5">
        <h2>Gestion des Utilisateurs</h2>
        
        <!-- Bouton pour afficher le formulaire -->
        <button class="btn btn-primary mb-3" id="toggleFormButton">Ajouter un Utilisateur</button>
        
        <!-- Formulaire d'ajout d'utilisateur, caché par défaut -->
        <div id="addUserForm" style="display: none;">
            <form method="POST" action="addusers.php">
                <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="DroitScore" name="DroitScore">
                    <label class="form-check-label" for="DroitScore">Droit de gérer les Scores</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="DroitActualite" name="DroitActualite">
                    <label class="form-check-label" for="DroitActualite">Droit de gérer les Actualités</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="DroitUser" name="DroitUser">
                    <label class="form-check-label" for="DroitUser">Droit de gérer les Utilisateurs</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="DroitClub" name="DroitClub">
                    <label class="form-check-label" for="DroitClub">Droit de gérer les Clubs</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="DroitPartenaire" name="DroitPartenaire">
                    <label class="form-check-label" for="DroitPartenaire">Droit de gérer les Partenaires</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="DroitAction" name="DroitAction">
                    <label class="form-check-label" for="DroitAction">Droit de gérer les Actions</label>
                </div>
                <button type="submit" class="btn btn-success">Ajouter l'utilisateur</button>
            </form>
        </div>

        <h2 class="mt-5">Liste des utilisateurs</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Gestion Score</th>
                    <th>Gestion Actualité</th>
                    <th>Gestion User</th>
                    <th>Gestion Club</th>
                    <th>Gestion Partenaire</th>
                    <th>Gestion Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Récupérer et afficher les utilisateurs
                $stmt = $pdo->query('SELECT * FROM users');
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr id="row-' . htmlspecialchars($row['id']) . '">';
                    echo '<td>' . htmlspecialchars($row['username'] ?? '') . '</td>';
                    echo '<td>' . ($row['DroitScore'] ? 'Oui' : 'Non') . '</td>';
                    echo '<td>' . ($row['DroitActualite'] ? 'Oui' : 'Non') . '</td>';
                    echo '<td>' . ($row['DroitUser'] ? 'Oui' : 'Non') . '</td>';
                    echo '<td>' . ($row['DroitClub'] ? 'Oui' : 'Non') . '</td>';
                    echo '<td>' . ($row['DroitPartenaire'] ? 'Oui' : 'Non') . '</td>';
                    echo '<td>' . ($row['DroitAction'] ? 'Oui' : 'Non') . '</td>';
                    echo '<td>';
                    echo '<button class="btn btn-link edit-icon" onclick="editUser(' . htmlspecialchars($row['id']) . ')"><i class="bi bi-pencil-fill"></i></button>';
                    echo '<form method="POST" action="addusers.php" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\');" style="display:inline-block;">';
                    echo '<input type="hidden" name="action" value="delete">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<button type="submit" class="btn btn-link delete-icon"><i class="bi bi-trash-fill"></i></button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';

                    // Ajouter le formulaire de modification
                    echo '<tr id="edit-row-' . htmlspecialchars($row['id']) . '" style="display:none;">';
                    echo '<form method="POST" action="addusers.php">';
                    echo '<input type="hidden" name="action" value="update">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<td>' . htmlspecialchars($row['username'] ?? '') . '</td>';
                    echo '<td><input type="checkbox" name="DroitScore" ' . ($row['DroitScore'] ? 'checked' : '') . '></td>';
                    echo '<td><input type="checkbox" name="DroitActualite" ' . ($row['DroitActualite'] ? 'checked' : '') . '></td>';
                    echo '<td><input type="checkbox" name="DroitUser" ' . ($row['DroitUser'] ? 'checked' : '') . '></td>';
                    echo '<td><input type="checkbox" name="DroitClub" ' . ($row['DroitClub'] ? 'checked' : '') . '></td>';
                    echo '<td><input type="checkbox" name="DroitPartenaire" ' . ($row['DroitPartenaire'] ? 'checked' : '') . '></td>';
                    echo '<td><input type="checkbox" name="DroitAction" ' . ($row['DroitAction'] ? 'checked' : '') . '></td>'; // Ajout de DroitAction
                    echo '<td>';
                    echo '<button type="submit" class="btn btn-success btn-sm">Confirmer</button>';
                    echo '</td>';
                    echo '</form>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Footer -->
    <?php include('backendfooter.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function editUser(id) {
            const editRow = document.getElementById('edit-row-' + id);
            const displayRow = document.getElementById('row-' + id);

            if (editRow.style.display === 'none' || editRow.style.display === '') {
                editRow.style.display = 'table-row';
                displayRow.style.display = 'none';
            } else {
                editRow.style.display = 'none';
                displayRow.style.display = 'table-row';
            }
        }

        document.getElementById('toggleFormButton').addEventListener('click', function() {
            const form = document.getElementById('addUserForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
</body>

</html>
