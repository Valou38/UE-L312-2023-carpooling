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
    <h1>Suppression d'une réservation</h1>
    <?php echo $controller->deleteReservation(); ?>
    <div class="form-container">
        <form method="post" action="reservations_delete.php" name="reservationDeleteForm">
            <div class="form-field">
                <label for="id">ID réservation :</label>
                <select name="id">
                    <option value="">--Choisissez un ID de réservation--</option>
                    <?php
                    $reservations = $service->getReservations();
                    foreach ($reservations as $reservation) {
                        echo "<option value='{$reservation->getId()}'>{$reservation->getId()}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <input type="submit" value="Supprimer une réservation">
            </div>
        </form>
    </div>
</body>