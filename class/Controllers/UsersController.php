<?php

namespace App\Controllers;

use App\Services\CarsService;
use App\Services\UsersService;
use App\Services\DataBaseService;

class UsersController
{
    /**
     * Return the html for the create action.
     */
    public function createUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (!empty($_POST['first_name']) &&
                !empty($_POST['last_name']) &&
                !empty($_POST['email']) &&
                !empty($_POST['birthday'])) {
                // Create the user :
                $usersService = new UsersService();
                $isOk = $usersService->setUser(
                    null,
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['email'],
                    $_POST['birthday']
                );
                if ($isOk) {
                    $html = 'Utilisateur créé avec succès.';
                } else {
                    $html = 'Erreur lors de la création de l\'utilisateur.';
                }
            } else {
                $html = 'Erreur : Il faut remplir tous les champs';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getUsers(): string
    {
        $html = '';

        // Get all users :
        $usersService = new UsersService();
        $users = $usersService->getUsers();

        // Get html :
        foreach ($users as $user) {
            $reservationsHtml = '';
            if (!empty($user->getReservations())) {

                $reservationsHtml .= '<br />';

                foreach ($user->getReservations() as $reservation) {
                    $reservationsHtml .= $reservation->getReservedSeats() . ' place(s) réservée(s) ' . $reservation->getTotalPrice() . ' €<br />';
                }
            }
        }

        // Get html :
        foreach ($users as $user) {
            $carsHtml = '';
            if (!empty($user->getCars())){

                $carsHtml .= '<br />';

                foreach ($user->getCars() as $car){
                    $carsHtml .= 'Marque : ' . $car->getBrand() .
                        '<br /> Modèle : ' . $car->getModel() .
                        '<br /> Année : ' . $car->getYear() .
                        '<br /> Kilométrage : ' . $car->getMileage() .
                        ' km <br /> Couleur : ' . $car->getColor() .
                        '<br /> Nombre de place(s) : ' . $car->getNbrSlots() .
                        '<hr />';
                }
            }

            $adsHtml = '';
            if (!empty($user->getAds())){

                $adsHtml .= '<br />';

                foreach ($user->getAds() as $ad){

                    $adsHtml .= 'Description : ' . $ad->getDescription() .
                        '<br /> Joue et heure de départ : ' . $ad->getDateTime() .
                        '<br /> Lieu de départ : ' . $ad->getDeparture() .
                        '<br /> Lieu d\'arrivé : ' . $ad->getDestination() .
                        '<br /> Nombre de siège(s) disponible(s) : ' . $ad->getAvailableSeats() .
                        '<br /> Prix : ' . $ad->getPrice() .
                        ' €<hr />';
                }
            }


            $html .= '
            <div class="info">
                <p class="id">#' . $user->getId() . '</p>
                <p class="features">Prénom : ' . $user->getFirstName() . '</p>
                <p class="features">Nom : ' . $user->getLastName() . '</p>
                <p class="features">Email : ' . $user->getEmail() . '</p>
                <p class="features">Date de naissance : ' . $user->getBirthday()->format('d-m-Y') . '</p>
                <p class="features"><strong>Voiture(s) : </strong> ' . $carsHtml . '</p>
                <p class="features"><strong>Réservation(s) : </strong> ' . $carsHtml . '</p>
                <p class="features"><strong>Annonce(s) : </strong> ' . $adsHtml . '</p>
            </div>';
        }
        var_dump($carsHtml);
        return $html;
    }

    /**
     * Update the user.
     */
    public function updateUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (!empty($_POST['id']) &&
                !empty($_POST['first_name']) &&
                !empty($_POST['last_name']) &&
                !empty($_POST['email']) &&
                !empty($_POST['birthday'])) {
                // Update the user :
                $usersService = new UsersService();
                $isOk = $usersService->setUser(
                    $_POST['id'],
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['email'],
                    $_POST['birthday']
                );
                if ($isOk) {
                    $html = 'Utilisateur mis à jour avec succès.';
                } else {
                    $html = 'Erreur lors de la mise à jour de l\'utilisateur.';
                }
            } else {
                $html = 'Erreur : Il faut remplir tous les champs';
            }
        }

        return $html;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (!empty($_POST['id'])) {
                // Delete the user :
                $usersService = new UsersService();
                $isOk = $usersService->deleteUser($_POST['id']);
                if ($isOk) {
                    $html = 'Utilisateur supprimé avec succès.';
                } else {
                    $html = 'Erreur lors de la supression de l\'utilisateur.';
                }
            } else {
                $html = 'Erreur : Aucun identifiant sélectionné';
            }
        }

        return $html;
    }
}