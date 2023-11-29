<?php

use App\Controllers\CarpooladController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpooladController();
echo $controller->createCarpoolad();

$carService = new \App\Services\CarsService();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
    <h1>Création d'une annonce</h1>
    <div class="form-container">
        <form method="post" action="carpoolad_create.php" name="carpooladCreateForm">
            <div class="form-field">
                <label for="carid">Choisir une voiture :</label>
                <select name="carid">
                    <option value="">--Choisissez l'ID de votre voiture--</option>
                    <?php
                    $cars = $carService->getCars();
                    foreach ($cars as $car) {
                        echo "<option value='{$car->getId()}'>{$car->getId()}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="description">Description de l'annonce</label>
                <input type="text" name="description">
            </div>
            <div class="form-field">
                <label for="dateandtime">Jour et heure du départ</label>
                <input type="datetime-local" name="dateandtime">
            </div>
            <div class="form-field">
                <label for="departurelocation">Lieu de départ</label>
                <input type="text" name="departurelocation">
            </div>
            <div class="form-field">
                <label for="destination">Lieu d'arrivée</label>
                <input type="text" name="destination">
            </div>
            <div class="form-field">
                <label for="availableseats">Nombre de sièges disponibles</label>
                <select name="availableseats">
                    <option value="">--Nombre de sièges--</option>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <input type="submit" value="Créer une annonce">
            </div>
        </form>
    </div>
</body>