<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Liste des réservations</h1>
    <?php

        use App\Controllers\ReservationsController;

        require '../../vendor/autoload.php';

        $controller = new ReservationsController();
        echo $controller->getReservations();

    ?>
    <div class="center">
        <a href="../../index.php"><button>Retour à l'accueil</button></a>
    </div>
</body>
