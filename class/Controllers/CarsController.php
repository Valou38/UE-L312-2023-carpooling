<?php

namespace App\Controllers;

use App\Services\CarsService;

class CarsController
{
    /**
     * Return the html for the create action.
     */
    public function createCar(): string
    {
        $html = '';

        // Get the current year
        $currentYear = date('Y');

        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If the form have been submitted and not empty :
            if (!empty($_POST['user_id']) &&
                !empty($_POST['brand']) &&
                !empty($_POST['model']) &&
                !empty($_POST['year']) &&
                !empty($_POST['mileage']) &&
                !empty($_POST['color']) &&
                !empty($_POST['nbr_slots'])) {
                // Clean and validate the inputs
                $userId = trim(htmlspecialchars(strip_tags($_POST['user_id'])));
                $brand = trim(htmlspecialchars(strip_tags($_POST['brand'])));
                $model = trim(htmlspecialchars(strip_tags($_POST['model'])));
                $year = trim(htmlspecialchars(strip_tags($_POST['year'])));
                $mileage = trim(htmlspecialchars(strip_tags($_POST['mileage'])));
                $color = trim(htmlspecialchars(strip_tags($_POST['color'])));
                $nbrSlots = trim(htmlspecialchars(strip_tags($_POST['nbr_slots'])));

                // Check if 'year' is a numeric value
                if (is_numeric($year)) {
                    // Check if 'year' is a valid year
                    if ($year >= 1886 && $year <= $currentYear) {
                        // Check if 'mileage', 'userId' and 'nbrSlots' are numeric values
                        if (is_numeric($mileage) && is_numeric($nbrSlots) && is_numeric($userId)) {
                            // Check if 'mileage', 'userId' and 'nbrSlots' positive numbers
                            if ($mileage >= 0 && $nbrSlots >= 0 && $userId >= 0) {
                                // Create the car :
                                $carsService = new CarsService();
                                $carId = $carsService->setCar(
                                    null,
                                    $brand,
                                    $model,
                                    $year,
                                    $mileage,
                                    $color,
                                    $nbrSlots
                                );

                                // Create the user cars relations :

                                $userCar = $carsService->setUserCar($userId, $carId);

                                var_dump($userCar);

                                if ($carId && $userCar) {
                                    $html = 'Véhicule créé avec succès.';
                                } else {
                                    $html = 'Erreur lors de la création du véhicule.';
                                }
                            } else {
                                $html = 'Erreur : Le kilométrage et le nombre de places doivent être un nombre positif.';
                            }
                        } else {
                            $html = 'Erreur : Le kilométrage et le nombre de places doivent être une valeur numérique.';
                        }
                    } else {
                        $html = 'Erreur : L\'année doit être une valeur numérique à quatre chiffres entre 1886 et ' . $currentYear . '.';
                    }
                } else {
                    $html = 'Erreur : L\'année doit être une valeur numérique.';
                }
            } else {
                $html = 'Erreur : Tous les champs doivent être remplis.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '';

        // Get all cars:
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html:
        foreach ($cars as $car) {
            $adsHtml = '';
            if (!empty($car->getAds())){

                $adsHtml .= '<br />';

                foreach ($car->getAds() as $ad){
                    $adsHtml .= 'Description : ' . $ad->getDescription() .
                        '<br /> Jour et heure de départ : ' . $ad->getDateTime() .
                        '<br /> Lieu de départ : ' . $ad->getDeparture() .
                        '<br /> Lieu d\'arrivé : ' . $ad->getDestination() .
                        '<br /> Nombre de siège(s) disponible(s) : ' . $ad->getAvailableSeats() .
                        '<br /> Prix : ' . $ad->getPrice() .
                        ' €<hr />';
                }
            }

            $html .= '
            <div class="info">
                <p class="id">#' . $car->getId() . '</p>
                <p class="features">Marque : ' . $car->getBrand() . '</p>
                <p class="features">Modèle : ' . $car->getModel() . '</p>
                <p class="features">Année : ' . $car->getYear() . '</p>
                <p class="features">Kilométrage : ' . $car->getMileage() . '</p>
                <p class="features">Couleur : ' . $car->getColor() . '</p>
                <p class="features">Nombre de places : ' . $car->getNbrSlots() . '</p>
                <p class="features"><strong>Annonce(s)</strong> : ' . $adsHtml . '</p>
            </div>';
        }

        return $html;
    }


    /**
     * Update the car.
     */
    public function updateCar(): string
    {
        $html = '';

        // Get the current year
        $currentYear = date('Y');

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['year']) &&
            isset($_POST['mileage']) &&
            isset($_POST['color']) &&
            isset($_POST['nbr_slots'])) {
            // Clean and validate the inputs
            $id = trim(htmlspecialchars(strip_tags($_POST['id'])));
            $brand = trim(htmlspecialchars(strip_tags($_POST['brand'])));
            $model = trim(htmlspecialchars(strip_tags($_POST['model'])));
            $year = trim(htmlspecialchars(strip_tags($_POST['year'])));
            $mileage = trim(htmlspecialchars(strip_tags($_POST['mileage'])));
            $color = trim(htmlspecialchars(strip_tags($_POST['color'])));
            $nbrSlots = trim(htmlspecialchars(strip_tags($_POST['nbr_slots'])));

            // Check if all fields are not empty
            if (!empty($id) &&
                !empty($brand) &&
                !empty($model) &&
                !empty($year) &&
                !empty($mileage) &&
                !empty($color) &&
                !empty($nbrSlots)) {
                // Check if 'year' is a numeric value
                if (is_numeric($year)) {
                    // Check if 'year' is a valid year
                    if ($year >= 1886 && $year <= $currentYear) {
                        // Check if 'mileage' and 'nbrSlots' are numeric values
                        if (is_numeric($mileage) && is_numeric($nbrSlots)) {
                            // Check if 'mileage' and 'nbrSlots' are positive numbers
                            if ($mileage >= 0 && $nbrSlots >= 0) {
                                // Update the car :
                                $carsService = new CarsService();
                                $isOk = $carsService->setCar(
                                    $id,
                                    $brand,
                                    $model,
                                    $year,
                                    $mileage,
                                    $color,
                                    $nbrSlots
                                );
                                if ($isOk) {
                                    $html = 'Véhicule mis à jour avec succès.';
                                } else {
                                    $html = 'Erreur lors de la mise à jour du véhicule.';
                                }
                            } else {
                                $html = 'Erreur : Le kilométrage doit être un nombre positif.';
                            }
                        } else {
                            $html = 'Erreur : Le kilométrage doit être une valeur numérique.';
                        }
                    } else {
                        $html = 'Erreur : L\'année doit être une valeur numérique à quatre chiffres entre 1886 et ' . $currentYear . '.';
                    }
                } else {
                    $html = 'Erreur : L\'année doit être une valeur numérique.';
                }
            } else {
                $html = 'Erreur : Tous les champs doivent être remplis.';
            }
        }

        return $html;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(): string
    {
        $html = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If the form have been submitted and not empty :
            if (!empty($_POST['id'])) {
                // Clean and validate the inputs
                $id = trim(htmlspecialchars(strip_tags($_POST['id'])));

                // Check if 'id' is a numeric value
                if (is_numeric($id)) {
                    // Check if 'id' is a positive number
                    if ($id >= 0) {
                        // Delete the car :
                        $carsService = new CarsService();
                        $isOk = $carsService->deleteCar($id);
                        if ($isOk) {
                            $html = 'Véhicule supprimé avec succès.';
                        } else {
                            $html = 'Erreur lors de la suppression du véhicule.';
                        }
                    } else {
                        $html = 'Erreur : L\'id doit être un nombre positif.';
                    }
                } else {
                    $html = 'Erreur : L\'id doit être une valeur numérique.';
                }
            } else {
                $html= 'Erreur : aucun identifiant saisi';
            }
        }

        return $html;
    }

}