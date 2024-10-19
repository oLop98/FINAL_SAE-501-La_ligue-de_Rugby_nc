<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligue de Rugby de Nouvelle-Calédonie</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vos CSS personnalisés -->
    <!-- <link rel="stylesheet" href="style/index.css"> -->
    <link rel="stylesheet" href="style/css.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navbar.css">
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v21.0&appId=463066019462030"></script>
    <!-- NavBar -->
    <?php include('navbar.php'); ?>

    <!-- Bloc Histoire Rugby -->
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center" style="margin-top:5vh;">
            <div class="col-md-8 text-center">
                <h2 class="lastresult">Histoire Rugby</h2>
                <p style="red"><strong>EN COURS D'ÉCRITURE</strong></p>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include('footer.php'); ?>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>