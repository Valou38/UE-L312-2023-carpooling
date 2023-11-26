<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->createReservation();

?>

<p>Création d'une réservation</p>
<form method="post" action="reservations_create.php" name="reservationCreateForm">
    <label for="adid">ID annonce de covoiturage:</label>
    <select name="adid">
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
        <?php
        $users = $controller->getUsers();
        foreach ($users as $user) {
            echo "<option value='{$user['id']}'>{$user['id']}</option>";
        }
        ?>
    </select>
    <br/>
    <label for="dateandtime">Date et heure :</label>
    <input type="datetime" name="dateandtime">
    <br>
    <label for="reservedseats">Nombre de siège réservé:</label>
    <select name="reservedseats">
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
    <br/>
    <input type="submit" value="Créer une réservation">
</form>