<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions Légales - Ligue de Rugby de Nouvelle-Calédonie</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/css.css">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/footer.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h1 style="margin-top:100px;">Mentions Légales</h1>

        <h2>1. Éditeur du Site</h2>
        <p>Ligue de Rugby de Nouvelle-Calédonie<br>
        Adresse : Maison du Sport Roger Kaddour, 24 Rue Duquesne, Nouméa 98800, Nouvelle-Calédonie<br>
        Numéro de téléphone : +687 28.10.57<br>
        Email pour les réclamations et demandes liées aux données personnelles : patnav@lagoon.nc<br>
        Représentant légal : Patrick NAVARRO</p>

        <h2>2. Hébergeur</h2>
        <p>Enova<br>
        Adresse : PK4, 6 rue Jean Chalier, Nouméa 98800, Nouvelle-Calédonie<br>
        Téléphone : +687 29.70.00<br>
        Mail: contact@enova.nc
        </p>

        <h2>3. Propriété Intellectuelle</h2>
        <p>Les contenus (textes, images, vidéos, logos, etc.) présents sur ce site sont la propriété exclusive de la Ligue de Rugby de Nouvelle-Calédonie ou sont utilisés avec l'autorisation préalable des clubs et autres entités membres de la Ligue. Toute reproduction, diffusion, ou utilisation des contenus sans autorisation est interdite, sauf à des fins d’information personnelle et privée.</p>

        <h2>4. Données Personnelles</h2>
        <p>Le site ne collecte pas de données personnelles, à l’exception des données de connexion, qui sont gérées par l’hébergeur Enova. Ces données ne sont ni partagées, ni revendues et sont conservées pour une durée de 30 jours avant d'être supprimées. Pour toute demande concernant la protection des données, vous pouvez nous contacter à l’adresse suivante : patnav@lagoon.nc.</p>

        <h2>5. Cookies</h2>
        <p>Le site utilise des cookies uniquement pour des analyses de performance liées au jeu intégré. Ces cookies permettent de mesurer les performances et d’améliorer l’expérience utilisateur. Une bannière d’information sur les cookies est présente sur le site pour informer les utilisateurs et leur permettre de gérer leurs préférences.</p>

        <h2>6. Liens Hypertextes</h2>
        <p>Les liens hypertextes présents sur le site ont été vérifiés et jugés sûrs. La Ligue de Rugby de Nouvelle-Calédonie ne peut toutefois pas garantir le contenu des sites externes. L'insertion de liens redirigeant vers ce site est soumise à une autorisation préalable de la Ligue.</p>

        <h2>7. Limitation de Responsabilité</h2>
        <p>La Ligue de Rugby de Nouvelle-Calédonie met tout en œuvre pour fournir des informations fiables et actualisées. Toutefois, elle ne garantit pas l'exactitude ou l'exhaustivité des informations présentes sur le site et ne saurait être tenue responsable des erreurs ou omissions. L’utilisation des informations présentes sur le site se fait sous la seule responsabilité de l’utilisateur.</p>

        <h2>8. Loi Applicable et Attribution de Juridiction</h2>
        <p>Les présentes mentions légales sont soumises au droit français. En cas de litige et après échec de toute tentative de recherche d’une solution amiable, les tribunaux du ressort de la Cour d'Appel de Paris seront seuls compétents pour connaître du litige.</p>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
