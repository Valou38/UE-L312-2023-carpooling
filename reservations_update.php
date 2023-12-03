<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();

$service = new \App\Services\ReservationsService();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
    <h1>Modification d'une réservation</h1>
    <?php echo $controller->updateReservation(); ?>
    <div class="form-container">
        <form method="post" action="reservations_update.php" name="reservationUpdateForm">
            <div class="form-field">
                <label for="id">ID réservation :</label>
                <select name="id">
                    <option value="">--Choisissez un ID de réservation--</option>
                    <?php
                    $reservations = $service->getReservations();
                    foreach ($reservations as $reservation) {
                        echo "<option value='{$reservation->getId()}'>{$reservation->getId()} - {$reservation->getReservedSeats()} place(s) réservé(s), {$reservation->getTotalPrice()} euro(s)</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="ad_id">ID annonce de covoiturage:</label>
                <select name="ad_id">
                    <option value="">--Choisissez une annonce--</option>
                    <?php
                    $ads = $controller->getAds();
                    foreach ($ads as $ad) {
                        echo "<option value='{$ad['id']}'>{$ad['id']} - {$ad['departure']} - {$ad['destination']} à {$ad['date_time']}</option>";
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
                        echo "<option value='{$user['id']}'>{$user['id']} - {$user['first_name']} {$user['last_name']}</option>";
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
                <input type="submit" value="Modifier une réservation">
            </div>
        </form>
    </div>
</body>