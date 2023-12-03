<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../../assets/css/styles.css">
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <?php

        use App\Controllers\UsersController;

        require '../../vendor/autoload.php';

        $controller = new UsersController();
        echo $controller->getUsers();

    ?>
    <div class="center">
        <a href="../../index.php"><button>Retour à l'accueil</button></a>
    </div>
</body>
