<?php

use App\Controllers\CarpooladController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpooladController();
echo $controller->deleteCarpoolad();

$adService = new \App\Services\CarpooladService();

?>

<p>Supression d'une annonce</p>
<form method="post" action="carpoolad_delete.php" name ="carpooladDeleteForm">
    <label for="id">Id :</label>
    <select name="adid">
    <option value="">--Choisissez une annonce--</option>
<?php
        $ads = $adService->getCarpoolad();
        foreach ($ads as $ad) {
            echo "<option value='{$ad->getId()}'>{$ad->getId()}</option>";
        }
    ?>
    </select>
    <br />
    <input type="submit" value="Supprimer l'annonce">
</form>
