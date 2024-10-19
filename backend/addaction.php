<?php
session_start();

require 'connexion.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer les droits de l'utilisateur depuis la base de données
$stmt = $pdo->prepare('SELECT DroitPartenaire, DroitUser, DroitScore, DroitActualite, DroitClub, DroitAction FROM users WHERE id = :id');
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur a les droits pour gérer les actions
if (!$user || $user['DroitActualite'] != 1) {
    header('Location: access_denied.php');
    exit();
}

// Gérer les actions (ajouter, mettre à jour, supprimer)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    try {
        if ($_POST['action'] === 'add') {
            // Récupérer les données du formulaire
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $contenu = $_POST['contenu'];

            $uploaded_images = []; // Tableau pour stocker les chemins des images

            // Vérifier si des fichiers sont bien uploadés
            if (!empty($_FILES['images']['name'][0])) {
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                    $file_name = $_FILES['images']['name'][$i];
                    $file_tmp = $_FILES['images']['tmp_name'][$i];
                    $file_error = $_FILES['images']['error'][$i];

                    if ($file_error === UPLOAD_ERR_OK) {
                        $uploadDir = '../assets/actions/';
                        $uploadFile = $uploadDir . basename($file_name);

                        if (move_uploaded_file($file_tmp, $uploadFile)) {
                            $uploaded_images[] = 'assets/actions/' . basename($file_name);
                        } else {
                            echo "Échec de l'upload de l'image : " . $file_name;
                        }
                    }
                }
            }

            // Insertion des données dans la base de données
            $stmt = $pdo->prepare('INSERT INTO action (titre, description, contenu, images) 
                                   VALUES (:titre, :description, :contenu, :images)');
            $stmt->execute([
                'titre' => $titre,
                'description' => $description,
                'contenu' => $contenu,
                'images' => json_encode($uploaded_images)
            ]);

            header('Location: addaction.php');
            exit();
        } elseif ($_POST['action'] === 'update') {
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $contenu = $_POST['contenu'];

            // Mettre à jour les données dans la base de données
            $stmt = $pdo->prepare('UPDATE action SET titre = :titre, description = :description, contenu = :contenu WHERE id = :id');
            $stmt->execute([
                'titre' => $titre,
                'description' => $description,
                'contenu' => $contenu,
                'id' => $id
            ]);

            header('Location: addaction.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'opération : " . $e->getMessage();
    }
}

// Supprimer une action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];

    $stmt = $pdo->prepare('DELETE FROM action WHERE id = :id');
    $stmt->execute(['id' => $id]);

    header('Location: addaction.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Actualité - Ligue de Rugby de Nouvelle-Calédonie</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
    <!-- NavBar -->
    <?php include('backendnavbar.php'); ?>

    <div class="container mt-5">
        <h1 class="mb-4">Gestion des Actions</h1>

        <!-- Bouton pour ajouter une action -->
        <button id="addActionBtn" class="btn btn-success mb-4">Ajouter une Action</button>

        <!-- Formulaire d'ajout d'action, masqué par défaut -->
        <form id="addActionForm" method="POST" enctype="multipart/form-data" class="mb-5" style="display: none;">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" name="titre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="contenu" class="form-label">Contenu</label>
                <!-- Quill Editor Container -->
                <div id="editor-container"></div>
                <textarea name="contenu" id="contenu" style="display:none;"></textarea>
            </div>

            <h5>Images</h5>
            <div class="mb-3">
                <input type="file" name="images[]" accept="image/*" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter Action</button>
            <button type="button" class="btn btn-secondary" id="cancelAddActionBtn">Annuler</button>
        </form>

        <!-- Formulaire de modification -->
        <form id="editActionForm" method="POST" class="mb-5" style="display: none;">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" id="edit_id">
            <div class="mb-3">
                <label for="edit_titre" class="form-label">Titre</label>
                <input type="text" name="titre" id="edit_titre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="edit_description" class="form-label">Description</label>
                <textarea name="description" id="edit_description" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="edit_contenu" class="form-label">Contenu</label>
                <!-- Quill Editor Container -->
                <div id="edit-editor-container"></div>
                <textarea name="contenu" id="edit_contenu" style="display:none;"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Modifier Action</button>
            <button type="button" class="btn btn-secondary" id="cancelEditActionBtn">Annuler</button>
        </form>

        <h2 class="mb-4">Liste des Actions</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Contenu</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query('SELECT * FROM action ORDER BY id DESC');
                while ($action = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($action['id'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($action['titre'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($action['description'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($action['contenu'] ?? '') . '</td>';

                    // Décoder le JSON des images
                    $images = !empty($action['images']) ? json_decode($action['images'], true) : [];
                    if (!empty($images)) {
                        echo '<td>';
                        foreach ($images as $image) {
                            echo '<img src="/' . htmlspecialchars($image) . '" width="100" height="100" alt="Image">';
                        }
                        echo '</td>';
                    } else {
                        echo '<td>Aucune image</td>';
                    }

                    echo '<td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="' . htmlspecialchars($action['id'] ?? '') . '">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-link text-danger p-0"><i class="bi bi-trash-fill"></i></button>
                            </form>
                            <button type="button" class="btn btn-link text-primary p-0 edit-btn" data-id="' . htmlspecialchars($action['id'] ?? '') . '" 
                            data-titre="' . htmlspecialchars($action['titre'] ?? '') . '" 
                            data-description="' . htmlspecialchars($action['description'] ?? '') . '" 
                            data-contenu="' . htmlspecialchars($action['contenu'] ?? '') . '">
                            <i class="bi bi-pencil-fill"></i></button>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        // Initialize Quill editors
        var quillAdd = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Écrivez quelque chose ici...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'image'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }]
                ]
            }
        });

        var quillEdit = new Quill('#edit-editor-container', {
            theme: 'snow',
            placeholder: 'Modifiez ici...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'image'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }]
                ]
            }
        });

        // Synchronize Quill content with hidden textarea on form submit
        document.getElementById('addActionForm').addEventListener('submit', function () {
            var contenu = document.getElementById('contenu');
            contenu.value = quillAdd.root.innerHTML;
        });

        document.getElementById('editActionForm').addEventListener('submit', function () {
            var contenu = document.getElementById('edit_contenu');
            contenu.value = quillEdit.root.innerHTML;
        });

        // Open the edit form and populate it with data
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('editActionForm').style.display = 'block';
                document.getElementById('addActionForm').style.display = 'none';
                
                // Set values in the edit form
                document.getElementById('edit_id').value = this.getAttribute('data-id');
                document.getElementById('edit_titre').value = this.getAttribute('data-titre');
                document.getElementById('edit_description').value = this.getAttribute('data-description');
                quillEdit.root.innerHTML = this.getAttribute('data-contenu');
            });
        });

        // Script pour afficher le formulaire d'ajout d'action
        document.getElementById('addActionBtn').addEventListener('click', function () {
            document.getElementById('addActionForm').style.display = 'block'; // Afficher le formulaire
            document.getElementById('editActionForm').style.display = 'none'; // Cacher le formulaire de modification
        });

        // Script pour annuler la modification
        document.getElementById('cancelEditActionBtn').addEventListener('click', function () {
            document.getElementById('editActionForm').style.display = 'none'; // Cacher le formulaire de modification
        });

        // Script pour annuler l'ajout d'action
        document.getElementById('cancelAddActionBtn').addEventListener('click', function () {
            document.getElementById('addActionForm').style.display = 'none'; // Cacher le formulaire d'ajout
        });
    </script>

        <!-- Footer -->
        <?php include('backendfooter.php'); ?>
</body>

</html>
