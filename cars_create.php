<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->createCar();

?>

<p>Création d'un véhicule</p>
<form method="post" action="cars_create.php" name ="carCreateForm">
    <label for="brand">Marque :</label>
    <select name="brand">
        <option value="">--Choisissez une marque--</option>
        <option value="Toyota">Toyota</option>
        <option value="Volkswagen">Volkswagen</option>
        <option value="Ford">Ford</option>
        <option value="Honda">Honda</option>
        <option value="Nissan">Nissan</option>
        <option value="Hyundai">Hyundai</option>
        <option value="Chevrolet">Chevrolet</option>
        <option value="Mercedes-Benz">Mercedes-Benz</option>
        <option value="BMW">BMW</option>
        <option value="Audi">Audi</option>
        <option value="Peugeot">Peugeot</option>
        <option value="Renault">Renault</option>
        <option value="Citroën">Citroën</option>
        <option value="Fiat">Fiat</option>
        <option value="Lexus">Lexus</option>
        <option value="Porsche">Porsche</option>
    </select>
    <br />
    <label for="model">Modèle :</label>
    <input type="text" name="model">
    <br />
    <label for="year">Année :</label>
    <select name="year">
        <option value="">--Choisissez une année--</option>
        <?php
        $currentYear = date("Y");
        for ($year = 1995; $year <= $currentYear; $year++) {
            echo "<option value='{$year}'>{$year}</option>";
        }
        ?>
    </select>
    <br />
    <label for="mileage">Kilométrage :</label>
    <select name="mileage">
        <option value="">--Choisissez un kilométrage--</option>
        <?php
        for ($mileage = 0; $mileage <= 300000; $mileage += 50000) {
            echo "<option value='{$mileage}'>{$mileage}</option>";
        }
        ?>
    </select>
    <br />
    <input type="submit" value="Créer un véhicule">
</form>