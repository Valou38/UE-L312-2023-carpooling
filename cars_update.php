<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->updateCar();

$service = new \App\Services\CarsService();

?>

<p>Mise à jour d'un véhicule</p>
<form method="post" action="cars_update.php" name ="carUpdateForm">
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
    <label for="color">Couleur :</label>
    <select name="color">
        <option value="">--Choisissez une couleur--</option>
        <option value="Rouge">Rouge</option>
        <option value="Bleu">Bleu</option>
        <option value="Vert">Vert</option>
        <option value="Jaune">Jaune</option>
        <option value="Noir">Noir</option>
        <option value="Blanc">Blanc</option>
        <option value="Gris">Gris</option>
        <option value="Orange">Orange</option>
        <option value="Violet">Violet</option>
        <option value="Rose">Rose</option>
        <option value="Marron">Marron</option>
    </select>
    <br />
    <label for="nbrSlots">Nombre de places:</label>
    <select name="nbrSlots">
        <option value="">--Choisissez un nombre--</option>
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
    <br />
    <input type="submit" value="Modifier le véhicule">
</form>