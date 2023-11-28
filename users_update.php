<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->updateUser();

$service = new \App\Services\UsersService();

?>

<p>Mise à jour d'un utilisateur</p>
<form method="post" action="users_update.php" name ="userUpdateForm">
    <label for="id">ID  :</label>
    <select name="id">
        <option value="">--Choisissez un ID d'utilisateur--</option>
        <?php
        $users = $service->getUsers();
        foreach ($users as $user) {
            echo "<option value='{$user->getId()}'>{$user->getId()}</option>";
        }
        ?>
    </select>
    <br />
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname">
    <br />
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname">
    <br />
    <label for="email">Email :</label>
    <input type="text" name="email">
    <br />
    <label for="birthday">Date d'anniversaire au format dd-mm-yyyy :</label>
    <input type="text" name="birthday">
    <br />
    <input type="submit" value="Modifier l'utilisateur">
</form>