<?php

use App\Controllers\CarpooladController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpooladController();
echo $controller->updateCarpoolad();

?>

<p>Mise à jour d'une annonce</p>
<form method="post" action="carpoolad_update.php" name ="carpooladUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="carid">Choisir une voiture :</label>
    <select name="carid">
    <?php
        $cars = $controller->getCarpoolad();
        foreach ($cars as $car) {
            echo "<option value='{$car['id']}'>{$car['id']}</option>";
        }
    ?>
    </select>
    <br />
    <label for="description">Description de l'annonce : </label>
    <input type="text" name="description">
    <br />
    <label for="dateandtime">Jour et heure du départ :</label>
    <input type="datetime" name="dateandtime">
    <br />
    <label for="departurelocation">Lieu de départ :</label>
    <input type="text" name="départurelocation">
    <br />
    <label for="destination">Lieu d'arrivée :</label>
    <input type="text" name="destination">
    <br />
    <label for="availableseats">Nombre de sièges disponibles : </label>
        <select name="availableseats">
          <option value="">--Please choose an option--</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>
    <br />
    <input type="submit" value="Modifier l'annonce">
</form>
