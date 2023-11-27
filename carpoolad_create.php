<?php

use App\Controllers\CarpooladController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpooladController();
echo $controller->createCarpoolad();

?>


<p>Création d'une annonce</p>
<form method="post" action="carpoolad_create.php" name ="carpooladCreateForm">
    <label for="carid">Choisir une voiture :</label>
    <select name="carid">
          <option value="">--Choisissez l'ID de votre voiture--</option>
    <?php
        $cars = $service->getCars();
        foreach ($cars as $car) {
            echo "<option value='{$car->getId()}'>{$car->getId()}</option>";
        }
    ?>
    </select>
    <br />
    <label for="description">Description de l'annonce</label>
    <input type="text" name="description">
    <br />
    <label for="dateandtime">Jour et heure du départ</label>
    <input type="datetime-local" name="dateandtime">
    <br />
    <label for="departurelocation">Lieu de départ</label>
    <input type="text" name="départurelocation">
    <br />
    <label for="destination">Lieu d'arrivée</label>
    <input type="text" name="destination">
    <br />
    <label for="availableseats">Nombre de sièges disponibles</label>
        <select name="availableseats">
        <option value="">--Nombre de sièges--</option>
        <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'>$i</option>";
            }
        ?>
        </select>
    <br />

    <input type="submit" value="Créer une annonce">
</form>
