<?php

use App\Controllers\AdsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AdsController();
echo $controller->updateAd();

$carService = new \App\Services\CarsService();
$adService = new \App\Services\AdsService();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
    <h1>Mise à jour d'une annonce</h1>
    <div class="form-container">
        <form method="post" action="ads_update.php" name="carpooladUpdateForm">
            <div class="form-field">
                <label for="id">ID de l'annonce :</label>
                <select name="id">
                    <option value="">--Choisissez une annonce--</option>
                    <?php
                    $ads = $adService->getAds();
                    foreach ($ads as $ad) {
                        echo "<option value='{$ad->getId()}'>{$ad->getId()}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="carid">ID du véhicule:</label>
                <select name="carid">
                    <option value="">--Choisissez un véhicule--</option>
                    <?php
                    $cars = $carService->getCars();
                    foreach ($cars as $car) {
                        echo "<option value='{$car->getId()}'>{$car->getId()}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="description">Description de l'annonce : </label>
                <input type="text" name="description">
            </div>
            <div class="form-field">
                <label for="dateandtime">Jour et heure du départ :</label>
                <input type="datetime-local" name="dateandtime">
            </div>
            <div class="form-field">
                <label for="departurelocation">Lieu de départ :</label>
                <input type="text" name="departurelocation">
            </div>
            <div class="form-field">
                <label for="destination">Lieu d'arrivée :</label>
                <input type="text" name="destination">
            </div>
            <div class="form-field">
                <label for="availableseats">Nombre de sièges disponibles : </label>
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
                <input type="submit" value="Modifier l'annonce">
            </div>
        </form>
    </div>
</body>