<?php

use App\Controllers\CarpooladController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpooladController();
echo $controller->createCarpoolad();

?>

<p>Création d'une annonce</p>
<form method="post" action="carpoolad_create.php" name ="carpooladCreateForm">
    <label for="carid">Choisir une voiture :</label>
    <input type="int" name="carid">
    <br />
    <label for="description">Description de l'annonce</label>
    <input type="text" name="description">
    <br />
    <label for="dateandtime">Jour et heure du départ</label>
    <input type="datetime" name="dateandtime">
    <br />
    <label for="departurelocation">Lieu de départ</label>
    <input type="text" name="départurelocation">
    <br />
    <label for="destination">Lieu d'arrivée</label>
    <input type="text" name="destination">
    <br />
    <label for="availableseats">Nombre de sièges disponibles</label>
        <select type="int" name="availableseats">
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
    <input type="submit" value="Créer une annonce">
</form>

