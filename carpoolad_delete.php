<?php

use App\Controllers\CarpooladController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpooladController();
echo $controller->deleteCarpoolad();

?>

<p>Supression d'une annonce</p>
<form method="post" action="carpoolad_delete.php" name ="carpooladDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une annonce">
</form>
