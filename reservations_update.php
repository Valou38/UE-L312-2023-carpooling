<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->updateReservation();

?>

<p>Modification d'une réservation</p>
<form method="post" action="reservations_update.php" name="reservationUpdateForm">
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
    <br/>
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
    <br/>
    <label for="dateandtime">Date et heure:</label>
    <input type="datetime-local" name="dateandtime">
    <br>
    <label for="reservedseats">Nombre de siège réservé:</label>
    <select name="reservedseats">
        <option value="">--Choisissez un nombre--</option>
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
    <br/>
    <input type="submit" value="Modifier une réservation">
</form>