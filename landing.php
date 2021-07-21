<?php
    session_start();
    if(!isset($_SESSION['user']))//si la session user nexiste pas alors
    header('Location:index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Connexion</title>
</head>
<body>
    <div class="text-center">
        <h4>Bonjour <?php echo $_SESSION['user']?></h4>
        <H6>Soyez le bienvenue dans notre site</H6>
        <a href="deconnexion.php" class="btn btn-danger btn-lg">Deconnexion</a>
    </div>
</body>
</html>
