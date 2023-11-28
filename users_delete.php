<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->deleteUser();

$service = new \App\Services\UsersService();

?>

<p>Supression d'un utilisateur</p>
<form method="post" action="users_delete.php" name ="userDeleteForm">
    <label for="id">ID utilisateur :</label>
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
    <input type="submit" value="Supprimer un utilisateur">
</form>