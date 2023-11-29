<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->updateUser();

$service = new \App\Services\UsersService();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
    <h1>Mise à jour d'un utilisateur</h1>
    <div class="form-container">
        <form method="post" action="users_update.php" name ="userUpdateForm">
            <div class="form-field">
                <label for="id">ID :</label>
                <select name="id">
                    <option value="">--Choisissez un ID d'utilisateur--</option>
                    <?php
                    $users = $service->getUsers();
                    foreach ($users as $user) {
                        echo "<option value='{$user->getId()}'>{$user->getId()}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <label for="firstname">Prénom :</label>
                <input type="text" name="firstname">
            </div>
            <div class="form-field">
                <label for="lastname">Nom :</label>
                <input type="text" name="lastname">
            </div>
            <div class="form-field">
                <label for="email">Email :</label>
                <input type="text" name="email">
            </div>
            <div class="form-field">
                <label for="birthday">Date d'anniversaire au format dd-mm-yyyy :</label>
                <input type="text" name="birthday">
            </div>
            <div class="form-field">
                <input type="submit" value="Modifier l'utilisateur">
            </div>
        </form>
    </div>
</body>