<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->createReservation();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
    <h1>Création d'une réservation</h1>
    <div class="form-container">
        <form method="post" action="reservations_create.php" name="reservationCreateForm">
            <div class="form-field">
                <label for="adid">ID annonce de covoiturage:</label>
                <select name="adid">
                    <option value="">--Choisissez une annonce--</option>
                    <?php
                    $ads = $controller->getCarpoolad();
                    foreach ($ads as $ad) {
                        echo "<option value='{$ad['id']}'>{$ad['id']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="userid">ID utilisateur :</label>
                <select name="userid">
                    <option value="">--Choisissez un utilisateur--</option>
                    <?php
                    $users = $controller->getUsers();
                    foreach ($users as $user) {
                        echo "<option value='{$user['id']}'>{$user['id']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="reserved_seats">Nombre de siège réservé:</label>
                <select name="reserved_seats">
                    <option value="">--Choisissez un nombre--</option>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <input type="submit" value="Créer une réservation">
            </div>
        </form>
        <p>Le prix total de votre réservation est de : </p>
    </div>
</body>