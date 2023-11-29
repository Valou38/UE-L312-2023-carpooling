<?php

use App\Controllers\CarpooladController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpooladController();
echo $controller->deleteCarpoolad();

$adService = new \App\Services\CarpooladService();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
    <h1>Suppression d'une annonce</h1>
    <div class="form-container">
        <form method="post" action="carpoolad_delete.php" name="carpooladDeleteForm">
            <div class="form-field">
                <label for="adid">Id :</label>
                <select name="adid">
                    <option value="">--Choisissez une annonce--</option>
                    <?php
                    $ads = $adService->getCarpoolad();
                    foreach ($ads as $ad) {
                        echo "<option value='{$ad->getId()}'>{$ad->getId()}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <input type="submit" value="Supprimer l'annonce">
            </div>
        </form>
    </div>
</body>
