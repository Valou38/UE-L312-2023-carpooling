<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
    <h1>Création d'une réservation</h1>
    <?php echo $controller->createReservation(); ?>
    <div class="form-container">
        <form method="post" action="reservations_create.php" name="reservationCreateForm">
            <div class="form-field">
                <label for="ad_id">ID annonce de covoiturage:</label>
                <select name="ad_id">
                    <option value="">--Choisissez une annonce--</option>
                    <?php
                    $ads = $controller->getAds();
                    foreach ($ads as $ad) {
                        echo "<option value='{$ad['id']}'>{$ad['id']} - {$ad['car_id']} {$ad['departure']}-{$ad['destination']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="user_id">ID utilisateur :</label>
                <select name="user_id">
                    <option value="">--Choisissez un utilisateur--</option>
                    <?php
                    $users = $controller->getUsers();
                    foreach ($users as $user) {
                        echo "<option value='{$user['id']}'>{$user['id']} - {$user['first_name']} {$user['last_name']} </option>";
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
    </div>
</body>