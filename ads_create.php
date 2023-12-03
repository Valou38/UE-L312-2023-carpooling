<?php

use App\Controllers\AdsController;
use App\Services\DataBaseService;

require __DIR__ . '/vendor/autoload.php';

$controller = new AdsController();
echo $controller->createAd();

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
        <form method="post" action="ads_create.php" name="adCreateForm">
            <div class="form-field">
                <label for="user_car">Choisir un utilisateur et sa voiture :</label>
                <select name="user_car">
                    <option value="">--Choisissez un utilisateur et sa voiture--</option>
                    <?php
                        $adsService = new DataBaseService();
                        $userCars = $adsService->getUsersWithCars();

                        foreach ($userCars as $userCar) {
                        $userCarId = $userCar['user_car_id'];
                        $userId = $userCar['user_id'];
                        $userName = $userCar['first_name'] . ' ' . $userCar['last_name'];
                        $carId = $userCar['car_id'];
                        $carDetails = "{$userCar['brand']} {$userCar['model']}";

                        echo "<option value='{$userId}|{$carId}'>{$userName} - {$carDetails}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="description">Description de l'annonce</label>
                <input type="text" name="description">
            </div>
            <div class="form-field">
                <label for="date_time">Jour et heure du départ</label>
                <input type="datetime-local" name="date_time">
            </div>
            <div class="form-field">
                <label for="departure">Lieu de départ</label>
                <input type="text" name="departure">
            </div>
            <div class="form-field">
                <label for="destination">Lieu d'arrivée</label>
                <input type="text" name="destination">
            </div>
            <div class="form-field">
                <label for="available_seats">Nombre de sièges disponibles</label>
                <select name="available_seats">
                    <option value="">--Nombre de sièges--</option>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="price">Prix</label>
                <input type="number" name="price" min="0" step="1">
            </div>
            <div class="form-field">
                <input type="submit" value="Créer une annonce">
            </div>
        </form>
    </div>
</body>