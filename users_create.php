<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->createUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/UE-L312-2023-carpooling/assets/css/styles.css">
</head>
<body>
    <h1>Création d'un utilisateur</h1>
    <div class="form-container">
        <form method="post" action="users_create.php" name ="userCreateForm">
            <div class="form-field">
                <label for="first_name">Prénom :</label>
                <input type="text" name="first_name">
            </div>
            <div class="form-field">
                <label for="last_name">Nom :</label>
                <input type="text" name="last_name">
            </div>
            <div class="form-field">
                <label for="email">Email :</label>
                <input type="text" name="email">
            </div>
            <div class="form-field">
                <label for="birthday">Date de naissance :</label>
                <input type="date" name="birthday">
            </div>
            <div class="form-field">
                <input type="submit" value="Créer un utilisateur">
            </div>
        </form>
    </div>
</body>