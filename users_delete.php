<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();

$service = new \App\Services\UsersService();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
    <h1>Suppression d'un utilisateur</h1>
    <?php echo $controller->deleteUser(); ?>
    <div class="form-container">
        <form method="post" action="users_delete.php" name ="userDeleteForm">
            <div class="form-field">
                <label for="id">ID de l'utilisateur :</label>
                <select name="id">
                    <option value="">--Choisissez un ID d'utilisateur--</option>
                    <?php
                    $users = $service->getUsers();
                    foreach ($users as $user) {
                        echo "<option value='{$user->getId()}'>{$user->getId()} - {$user->getFirstName()} {$user->getLastName()} ({$user->getEmail()})</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-field">
                <input type="submit" value="Supprimer un utilisateur">
            </div>
        </form>
        <div class="center">
            <a href="index.php"><button>Retour à l'accueil</button></a>
        </div>
    </div>
</body>