<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
    <h1>Liste des véhicules</h1>
    <?php

        use App\Controllers\CarsController;

        require __DIR__ . '/vendor/autoload.php';

        $controller = new CarsController();
        echo $controller->getCars();

    ?>
    <div class="center">
        <a href="index.php"><button>Retour à l'accueil</button></a>
    </div>
</body>
