<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->deleteCar();

$service = new \App\Services\CarsService();

?>

<p>Suppression d'un véhicule</p>
<form method="post" action="cars_delete.php" name ="carDeleteForm">
    <label for="id">ID véhicule :</label>
    <select name="id">
        <option value="">--Choisissez un ID de véhicule--</option>
        <?php
        $cars = $service->getCars();
        foreach ($cars as $car) {
            echo "<option value='{$car->getId()}'>{$car->getId()}</option>";
        }
        ?>
    </select>
    <br />
    <input type="submit" value="Supprimer un véhicule">
</form>
