<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <!--<link rel="stylesheet" type="text/css" href="/Views/assets/css/styles.css">-->
    <style>
        .header {
            background-image: url('https://cdn.pixabay.com/photo/2015/09/01/03/42/driving-916405_960_720.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 500px;
            position: relative;
        }
        h1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            text-shadow: 2px 2px 4px #000000;
            text-transform: uppercase;
            font-size: 3rem;
        }
        .menu {
            display: flex;
            justify-content: space-around;
            background-color: #f2f2f2;
            padding: 10px 0;
            max-width: 80%;
            margin: -50px auto 0 auto;
            z-index: 1;
            position: relative;
        }
        .menu div {
            margin: 0 10px;
            position: relative;
        }
        .menu div a:not(:first-child) {
            display: none;
            padding: 5px;
            background-color: #ddd;
            text-align: center;
        }
        .menu div:hover a:not(:first-child) {
            display: block;
        }
        .menu a {
            color: #333;
            text-decoration: none;
            display: block;
        }
        .menu a:hover {
            background-color: #bbb;
        }
        /* Ajout de la règle pour changer la couleur de fond du sous-menu au survol */
        .menu div:hover a:not(:first-child):hover {
            background-color: #aaa;
        }
        .menu h2 {
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Carpooling</h1>
</div>
<div class="menu">
    <div>
        <h2>Utilisateurs</h2>
        <a href="users_create.php">Créer</a><!--<a href="Views/templates/users/users_create.php">Créer</a>-->
        <a href="users_read.php">Lire</a><!--<a href="Views/templates/users/users_read.php">Lire</a>-->
        <a href="users_update.php">Modifier</a><!--<a href="Views/templates/users/users_update.php">Modifier</a>-->
        <a href="users_delete.php">Supprimer</a><!--<a href="Views/templates/users/users_delete.php">Supprimer</a>-->
    </div>
    <div>
        <h2>Voitures</h2>
        <a href="cars_create.php">Créer</a><!--<a href="Views/templates/cars/cars_create.php">Créer</a>-->
        <a href="cars_read.php">Lire</a><!--<a href="Views/templates/cars/cars_read.php">Lire</a>-->
        <a href="cars_update.php">Modifier</a><!--<a href="Views/templates/cars/cars_update.php">Modifier</a>-->
        <a href="cars_delete.php">Supprimer</a><!--<a href="Views/templates/cars/cars_delete.php">Supprimer</a>-->
    </div>
    <div>
        <h2>Annonces</h2>
        <a href="carpoolad_create.php">Créer</a><!--<a href="Views/templates/cardpoolads/cardpoolad_create.php">Créer</a>-->
        <a href="carpoolad_read.php">Lire</a><!--<a href="Views/templates/cardpoolads/cardpoolad_read.php">Lire</a>-->
        <a href="carpoolad_update.php">Modifier</a><!--<a href="Views/templates/cardpoolads/cardpoolad_update.php">Modifier</a>-->
        <a href="carpoolad_delete.php">Supprimer</a><!--<a href="Views/templates/cardpoolads/cardpoolad_delete.php">Supprimer</a>-->
    </div>
    <div>
        <h2>Réservations</h2>
        <a href="reservations_create.php">Créer</a><!--<a href="Views/templates/reservations/reservations_create.php">Créer</a>-->
        <a href="reservations_read.php">Lire</a><!--<a href="Views/templates/reservations/reservations_read.php">Lire</a>-->
        <a href="reservations_update.php">Modifier</a><!--<a href="Views/templates/reservations/reservations_update.php">Modifier</a>-->
        <a href="reservations_delete.php">Supprimer</a><!--<a href="Views/templates/reservations/reservations_delete.php">Supprimer</a>-->
    </div>
</div>
</body>
</html>
