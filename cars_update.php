<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->updateCar();

?>

<p>Mise à jour d'un véhicule</p>
<form method="post" action="cars_update.php" name ="carUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="brand">Marque :</label>
    <input type="text" name="brand">
    <br />
    <label for="model">Modèle :</label>
    <input type="text" name="model">
    <br />
    <label for="year">Année :</label>
    <input type="text" name="year">
    <br />
    <label for="mileage">Kilométrage :</label>
    <input type="text" name="mileage">
    <br />
    <input type="submit" value="Modifier le véhicule">
</form>
