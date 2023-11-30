<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
    <h1>Liste des réservations</h1>
    <?php

        use App\Controllers\ReservationsController;

        require __DIR__ . '/vendor/autoload.php';

        $controller = new ReservationsController();
        echo $controller->getReservations();

    ?>
</body>
