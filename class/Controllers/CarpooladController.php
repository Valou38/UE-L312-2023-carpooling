<?php

namespace App\Controllers;

use App\Services\CarpooladService;

class CarpooladController
{
    /**
     * Return the html for the create action.
     */
    public function createCarpoolad(): string
    {
        $html = '';

        // Get the current year
        $currentTime = date("Y-m-d H:i:s");

        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If the form has been submitted and not empty :
            if (!empty($_POST['carid']) &&
                !empty($_POST['description']) &&
                !empty($_POST['dateandtime']) &&
                !empty($_POST['departurelocation']) &&
                !empty($_POST['destination']) &&
                !empty($_POST['availableseats'])) {

                // Clean and validate the inputs
                $id =  trim(htmlspecialchars(strip_tags($_POST['id'])));
                $carid = trim(htmlspecialchars(strip_tags($_POST['carid'])));
                $description = trim(htmlspecialchars(strip_tags($_POST['description'])));
                $dateandtime = trim(htmlspecialchars(strip_tags($_POST['dateandtime'])));
                $departurelocation = trim(htmlspecialchars(strip_tags($_POST['departurelocation'])));
                $destination = trim(htmlspecialchars(strip_tags($_POST['destination'])));
                $availableseats = trim(htmlspecialchars(strip_tags($_POST['availableseats'])));


                // Check if 'availableseats' is a valid number
                if ($availableseats >= 0) {
                    // Check if the ad date is after today's date
                    if ($dateandtime > $currentTime) {

                        // Create the ad :
                        $carpooladService = new CarpooladService();
                        $isOk = $carpooladService->setCarpoolad(
                            null,
                            $carid,
                            $description,
                            $dateandtime,
                            $departurelocation,
                            $destination,
                            $availableseats
                        );
                        if ($isOk) {
                            $html = "L'annonce a été créée avec succès.";
                        } else {
                            $html = "Erreur lors de la création de l'annonce. ";
                        }

                    } else {
                        $html = "Erreur : La date doit se situer dans le futur";
                    }
                } else {
                    $html = 'Erreur : La quantité de sièges disponibles doit être un chiffre positif';
                }

            }

        }
            return $html;
    }


        /**
         * Return the html for the read action.
         */
        public
        function getCarpoolad(): string
        {
            $html = '';

            // Get all cars :
            $carpooladService = new CarpooladService();
            $carpoolad = $carpooladService->getCarpoolad();

            // Get html :
            foreach ($carpoolad as $carpool) {
                $html .=
                    '#' . $carpool->getId() . ' ' .
                    $carpool->getCarid() . ' ' .
                    $carpool->getDescription() . ' ' .
                    $carpool->getDateandtime() . ' ' .
                    $carpool->getDeparturelocation() . ' ' .
                    $carpool->getDestination() . ' ' .
                    $carpool->getAvailableseats() . '</br>';
            }

            return $html;
        }

        /**
         * Update the ad.
         */
        public
        function updateCarpoolad(): string
        {
            $html = '';

            // Get the current year
            $currentTime = date("Y-m-d H:i:s");

            // If the form have been submitted :
            if (!isset($_POST['id']) &&
                !isset($_POST['carid']) &&
                !isset($_POST['description']) &&
                !isset($_POST['dateandtime']) &&
                !isset($_POST['departurelocation']) &&
                !isset($_POST['destination']) &&
                !isset($_POST['availableseats'])) {

                // Clean and validate the inputs
                // Clean and validate the inputs
                $id =  trim(htmlspecialchars(strip_tags($_POST['id'])));
                $carid = trim(htmlspecialchars(strip_tags($_POST['carid'])));
                $description = trim(htmlspecialchars(strip_tags($_POST['description'])));
                $dateandtime = trim(htmlspecialchars(strip_tags($_POST['dateandtime'])));
                $departurelocation = trim(htmlspecialchars(strip_tags($_POST['departurelocation'])));
                $destination = trim(htmlspecialchars(strip_tags($_POST['destination'])));
                $availableseats = trim(htmlspecialchars(strip_tags($_POST['availableseats'])));

                // Check if all fields are not empty
                if (!empty($id) && !empty($carid) && !empty($description) && !empty($dateandtime) && !empty($departurelocation) && !empty($destination) && !empty($availableseats)) {
                    // Check if 'year' is a numeric value
                    if ($availableseats >= 0) {
                        // Check if the ad date is after today's date
                        if ($dateandtime > $currentTime) {

                            // Update the ad :
                            $carpooladService = new CarpooladService();
                            $isOk = $carpooladService->setCarpoolad(
                                null,
                                $carid,
                                $description,
                                $dateandtime,
                                $departurelocation,
                                $destination,
                                $availableseats
                            );
                            if ($isOk) {
                                $html = "L'annonce a été créée avec succès.";
                            } else {
                                $html = "Erreur lors de la création de l'annonce. ";
                            }

                        } else {
                            $html = "Erreur : La date doit se situer dans le futur";
                        }
                    } else {
                        $html = 'Erreur : La quantité de sièges disponibles doit être un chiffre positif';
                    }

                }

            }
            return $html;
        }

        /**
         * Delete an ad
         */
        public
        function deleteCar(): string
        {
            $html = '';

            // If the form have been submitted and not empty :
            if (!empty($_POST['id'])) {
                // Clean and validate the inputs
                $id = trim(htmlspecialchars(strip_tags($_POST['id'])));

                // Check if 'id' is a numeric value
                if (is_numeric($id)) {
                    // Check if 'id' is a positive number
                    if ($id >= 0) {
                        // Delete the ad :
                        $carpooladService = new CarpooladService();
                        $isOk = $carpooladService->deleteCarpoolad($id);
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
            }

            return $html;
        }

    }
