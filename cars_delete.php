<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();

$service = new \App\Services\CarsService();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
<h1>Suppression d'un véhicule</h1>
<?php echo $controller->deleteCar(); ?>
    <div class="form-container">
        <form method="post" action="cars_delete.php" name="carDeleteForm">
            <div class="form-field">
                <label for="id">ID véhicule :</label>
                <select name="id">
                    <option value="">--Choisissez un ID de véhicule--</option>
                    <?php
                    $cars = $service->getCars();
                    foreach ($cars as $car) {
                        echo "<option value='{$car->getId()}'>{$car->getId()} - {$car->getBrand()} {$car->getModel()} {$car->getColor()}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <input type="submit" value="Supprimer un véhicule">
            </div>
        </form>
    </div>
</body>