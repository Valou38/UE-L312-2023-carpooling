<?php

namespace App\Controllers;

use App\Services\AdsService;
use App\Services\UsersService;
use App\Services\DataBaseService;
use App\Services\ReservationsService;

class ReservationsController
{

    /**
     * Return the html for the create action.
     */
    public function createReservation(): string
    {
        $html = '';

        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If the form has been submitted and not empty:
            if (!empty($_POST['ad_id']) &&
                !empty($_POST['user_id']) &&
                !empty($_POST['reserved_seats'])){

                // Clean and validate the inputs
                $adId = intval($_POST['ad_id']);
                $userId = intval($_POST['user_id']);
                $reservedSeats = intval($_POST['reserved_seats']);

                // Get ads
                $adsService = new AdsService();
                $ads = $adsService->getAds();

                $reservationService = new ReservationsService();

                $usersService = new UsersService();

                // Find ad by his ID and get the unit price
                $unitPriceAd = 0;
                var_dump($ads);
                var_dump($adId);
                foreach($ads as $ad){
                    if (intval($ad->getId()) === $adId){
                        $unitPriceAd = $ad->getPrice();
                        break;
                    }
                }

                var_dump($reservedSeats, $unitPriceAd);

                // Calculate the total price
                $totalPrice = $reservedSeats * $unitPriceAd;

                echo 'Prix total : ' . $totalPrice;

                // Check if the reserved seats do not exceed the available seats
                $ad = $reservationService->getAdById($adId);
                if ($ad['available_seats'] >= $reservedSeats) {

                    // Process reservation creation:
                    $reservationId = $reservationService->setReservation(
                        null,
                        $reservedSeats,
                        $totalPrice
                    );

                    var_dump($reservationId);

                    // Create the reservations relations :

                    $adReservation = $reservationService->setAdReservation($adId, $reservationId);
                    $userReservation = $usersService->setUserReservation($userId, $reservationId);

                    var_dump($adReservation);

                    if ($reservationId && $adReservation && $userReservation) {
                        $html = '<div class="form-container"><p>Réservation créée avec succès. Le prix total est de ' .$totalPrice. ' $</p></div>';
                    } else {
                        $html = '<div class="form-container"><p>Erreur lors de la création de la réservation.</p></div>';
                    }
                } else {
                    $html = '<div class="form-container"><p>Erreur : Le nombre de sièges réservés ne peut pas dépasser le nombre de sièges disponibles.</p></div>';
                }
            } else {
                $html = '<div class="form-container"><p>Erreur : Tous les champs doivent être remplis.</p></div>';
            }
        }

        return $html;
    }

    /**
     * Fetch available ad IDs from the database.
     */
    public function getAds(): array
    {
        $dataBaseService = new DataBaseService();
        return $dataBaseService->getAds();
    }

    /**
     * Fetch available user IDs from the database.
     */
    public function getUsers(): array
    {
        $dataBaseService = new DataBaseService();
        return $dataBaseService->getUsers();
    }

    /**
     * Return the html for the read action.
     */
    public function getReservations(): string
    {
        $html = '';

        // Get all reservations :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        // Get html :
        foreach ($reservations as $reservation) {
            $html .= '
            <div class="info">
                <p class="id">#' . $reservation->getId() . '</p>
                <p class="features">Sièges réservées : ' . $reservation->getReservedSeats() . '</p>
                <p class="features">Prix total : ' . $reservation->getTotalPrice() . ' €</p>
            </div>';
        }

        return $html;
    }

    /**
     * Update the reservation.
     */
    public function updateReservation(): string
    {
        $html = '';

        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If the form has been submitted and not empty:
            if (!empty($_POST['id']) &&
                !empty($_POST['ad_id']) &&
                !empty($_POST['user_id']) &&
                !empty($_POST['reserved_seats'])) {

                // Clean and validate the inputs
                $id = intval($_POST['id']);
                $adId = intval($_POST['ad_id']);
                $userId = intval($_POST['user_id']);
                $reservedSeats = intval($_POST['reserved_seats']);

                // Get ads
                $adsService = new AdsService();
                $ads = $adsService->getAds();

                $reservationService = new ReservationsService();

                // Find ad by his ID and get the unit price
                $unitPriceAd = 0;
                var_dump($ads);
                var_dump($adId);
                foreach($ads as $ad){
                    if (intval($ad->getId()) === $adId){
                        $unitPriceAd = $ad->getPrice();
                        break;
                    }
                }

                var_dump($reservedSeats, $unitPriceAd);

                // Calculate the total price
                $totalPrice = $reservedSeats * $unitPriceAd;

                // Check if the reserved seats do not exceed the available seats
                $ad = $reservationService->getAdById($adId);
                if ($ad['available_seats'] >= $reservedSeats) {
                    // Process reservation creation:
                    $isOk = $reservationService->setReservation(
                        $id,
                        $reservedSeats,
                        $totalPrice
                    );

                    if ($isOk) {
                        $html = '<div class="form-container"><p>Réservation mise à jour avec succès. Le prix total est de ' .$totalPrice. ' $</p></div>';
                    } else {
                        $html = '<div class="form-container"><p>Erreur lors de la mise à jour de la réservation.</p></div>';
                    }
                } else {
                    $html = '<div class="form-container"><p>Erreur : Le nombre de sièges réservés ne peut pas dépasser le nombre de sièges disponibles.</p></div>';
                }
            } else {
                $html = '<div class="form-container"><p>Erreur : Tous les champs doivent être remplis.</p></div>';
            }
        }

        return $html;
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation(): string
    {
        $html = '';

        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            // If fields have been submitted and not empty :
            if (!empty($_POST['id'])) {
                // Clean and validate the inputs
                $id = trim(htmlspecialchars(strip_tags($_POST['id'])));

                // Check if 'id' is a numeric value
                if (is_numeric($id)) {
                    // Check if 'id' is a positive number
                    if ($id >= 0) {
                        // Delete the reservation :
                        $reservationsService = new ReservationsService();
                        $isOk = $reservationsService->deleteReservation($id);
                        if ($isOk) {
                            $html = '<div class="form-container"><p>Réservation supprimé avec succès.</p></div>';
                        } else {
                            $html = '<div class="form-container"><p>Erreur lors de la suppression de la réservation.</p></div>';
                        }
                    } else {
                        $html = '<div class="form-container"><p>Erreur : L\'id doit être un nombre positif.</p></div>';
                    }
                } else {
                    $html = '<div class="form-container"><p>Erreur : L\'id doit être une valeur numérique.</p></div>';
                }
            } else {
                $html = '<div class="form-container"><p>Erreur : Aucun identifiant saisi</p></div>';
            }

        }
        return $html;
    }
}