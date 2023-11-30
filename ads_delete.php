<?php

use App\Controllers\AdsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AdsController();
echo $controller->deleteAd();

$adService = new \App\Services\AdsService();

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
        <form method="post" action="ads_delete.php" name="carpooladDeleteForm">
            <div class="form-field">
                <label for="ad_id">ID de l'annonce :</label>
                <select name="ad_id">
                    <option value="">--Choisissez une annonce--</option>
                    <?php
                    $ads = $adService->getAds();
                    foreach ($ads as $ad) {
                        echo "<option value='{$ad->getId()}'>{$ad->getId()} - {$ad->getCarId()} {$ad->getDeparture()}-{$ad->getDestination()}</option>";
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
