<?php

namespace App\Controllers;

use App\Services\AdsService;

use Cassandra\Date;
use DateTime;

class AdsController
{
    /**
     * Return the html for the create action.
     */
    public function createAd(): string
    {
        $html = '';

        // Get the current year
        $currentTime = new DateTime() ;

        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If the form has been submitted and not empty :
            if (!empty($_POST['car_id']) &&
                !empty($_POST['description']) &&
                !empty($_POST['date_time']) &&
                !empty($_POST['departure']) &&
                !empty($_POST['destination']) &&
                !empty($_POST['available_seats']) &&
                !empty($_POST['price'])) {

                // Clean and validate the inputs
                $carId = trim(htmlspecialchars(strip_tags($_POST['car_id'])));
                $description = trim(htmlspecialchars(strip_tags($_POST['description'])));
                $dateTime = new DateTime(trim(htmlspecialchars(strip_tags($_POST['date_time']))));
                $departure = trim(htmlspecialchars(strip_tags($_POST['departure'])));
                $destination = trim(htmlspecialchars(strip_tags($_POST['destination'])));
                $availableSeats = trim(htmlspecialchars(strip_tags($_POST['available_seats'])));
                $price = trim(htmlspecialchars(strip_tags($_POST['price'])));


                // Check if the ad date is after today's date
                if ($dateTime > $currentTime) {

                    if (is_numeric($availableSeats) && is_numeric($price)){

                        if ($availableSeats >= 0 && $price >= 0){

                            // Create the ad :
                            $adsService = new AdsService();
                            $isOk = $adsService->setAd(
                                null,
                                $description,
                                $dateTime,
                                $departure,
                                $destination,
                                $availableSeats,
                                $price
                            );

                            if ($isOk) {
                                $html = "L'annonce a été créée avec succès.";

                            } else {
                                $html = "Erreur lors de la création de l'annonce. ";
                            }

                        } else {
                            $html = 'Erreur : Le nombre de sièges disponibles et le prix doivent être un nombre positif.';
                        }

                    } else {
                        $html = 'Erreur : Le nombre de sièges disponibles et le prix doivent être une valeur numérique.';
                    }

                } else {
                    $html = "Erreur : La date doit se situer dans le futur";
                }

            } else {
                $html = "Erreur : Merci de remplir tous les champs ";
            }

        }
        return $html;
    }



    /**
     * Return the html for the read action.
     */
    public
    function getAds(): string
    {
        $html = '';

        // Get all cars :
        $adsService = new AdsService();
        $ads = $adsService->getAds();

        // Get html :
        foreach ($ads as $ad) {
            $reservationsHtml = '';
            if (!empty($ad->getReservations())){

                $reservationsHtml .= '<br />';

                foreach ($ad->getReservations() as $reservation){
                    $reservationsHtml .= $reservation->getReservedSeats() . ' place(s) réservée(s) ' . $reservation->getTotalPrice() . ' €<br />';
                }
            }
            $html .= '
            <div class="info">
                <p class="id">#' . $ad->getId() . '</p>
                <p class="features">Description : ' . $ad->getDescription() . '</p>
                <p class="features">Date et heure : ' . $ad->getDateTime() . '</p>
                <p class="features">Départ : ' . $ad->getDeparture() . '</p>
                <p class="features">Destination : ' . $ad->getDestination() . '</p>
                <p class="features">Nombre de place(s) disponible : ' . $ad->getAvailableSeats() . '</p>
                <p class="features"><strong>Prix</strong> : ' . $ad->getPrice() . ' €</p>
                <p class="features"><strong>Réservée(s)</strong> : ' . $reservationsHtml . '</p>
            </div>';
        }

        return $html;
    }

    /**
     * Update the ad.
     */
    public function updateAd(): string
    {
        $html = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            var_dump($_POST);
            // If the form have been submitted :
            if (!empty($_POST['id']) &&
                !empty($_POST['car_id']) &&
                !empty($_POST['description']) &&
                !empty($_POST['date_time']) &&
                !empty($_POST['departure']) &&
                !empty($_POST['destination']) &&
                !empty($_POST['available_seats']) &&
                !empty($_POST['price'])){

                // Clean and validate the inputs
                $id = trim(htmlspecialchars(strip_tags($_POST['id'])));
                $carId = trim(htmlspecialchars(strip_tags($_POST['car_id'])));
                $description = trim(htmlspecialchars(strip_tags($_POST['description'])));
                $dateTime = new DateTime(trim(htmlspecialchars(strip_tags($_POST['date_time']))));
                $departure = trim(htmlspecialchars(strip_tags($_POST['departure'])));
                $destination = trim(htmlspecialchars(strip_tags($_POST['destination'])));
                $availableSeats = trim(htmlspecialchars(strip_tags($_POST['available_seats'])));
                $price = trim(htmlspecialchars(strip_tags($_POST['price'])));

                    $currentTime = new DateTime();

                    // Check if the ad date is after today's date
                    if ($dateTime > $currentTime) {

                        if (is_numeric($availableSeats) && is_numeric($price)){

                            if ($availableSeats >= 0 && $price >= 0){

                                // Update the ad :
                                $adsService = new AdsService();

                                $isOk = $adsService->setAd(
                                    $id,
                                    $description,
                                    $dateTime,
                                    $departure,
                                    $destination,
                                    $availableSeats,
                                    $price
                                );

                                if ($isOk) {
                                    $html = "L'annonce a été mise à jour avec succès.";
                                } else {
                                    $html = "Erreur lors de la création de l'annonce. ";
                                }

                            } else {
                                $html = 'Erreur : Le nombre de sièges disponibles et le prix doivent être un nombre positif.';
                            }

                        } else {
                            $html = 'Erreur : Le nombre de sièges disponibles et le prix doivent être une valeur numérique.';
                        }

                    } else {
                        $html = "Erreur : La date doit se situer dans le futur";
                    }

            } else {
                $html = "Erreur : Remplissez tous les champs";
            }
        }

        return $html;
    }

    /**
     * Delete an ad
     */
    public function deleteAd(): string
    {
        $html = '';

        // If the form have been submitted and not empty :
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (!empty($_POST['id'])) {
                // Clean and validate the inputs
                $id = trim(htmlspecialchars(strip_tags($_POST['id'])));

                // Check if 'id' is a numeric value
                if (is_numeric($id)) {
                    // Check if 'id' is a positive number
                    if ($id >= 0) {
                        // Delete the ad :
                        $adsService = new AdsService();
                        $isOk = $adsService->deleteAd($id);
                        if ($isOk) {
                            $html = 'Annonce supprimée avec succès.';
                        } else {
                            $html = "Erreur lors de la suppression de l'annonce.";
                        }
                    } else {
                        $html = 'Erreur : L\'id doit être un nombre positif.';
                    }
                } else {
                    $html = 'Erreur : L\'id doit être une valeur numérique.';
                }
            } else {
                $html = "Erreur : Saisissez un identifiant";
            }
        }

        return $html;
    }

}
