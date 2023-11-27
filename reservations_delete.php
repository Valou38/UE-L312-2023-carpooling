<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->deleteReservation();

?>

<p>Suppression d'une réservation</p>
<form method="post" action="reservations_delete.php" name ="reservationDeleteForm">
    <label for="id">ID réservation :</label>
    <select name="id">
        <option value="">--Choisissez un ID de réservation--</option>
        <?php
        $cars = $controller->getReservations();
        foreach ($cars as $car) {
            echo "<option value='{$car->getId()}'>{$car->getId()}</option>";
        }
        ?>
    </select>
    <br />
    <input type="submit" value="Supprimer une réservation">
</form>