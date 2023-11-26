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
    <input type="int" name="carid">
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
    <input type="int" name="availableseats">
    <br />
    <input type="submit" value="Modifier l'annonce">
</form>
