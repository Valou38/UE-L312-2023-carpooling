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
            if (!empty($_POST['brand']) &&
                !empty($_POST['model']) &&
                !empty($_POST['year']) &&
                !empty($_POST['mileage'])) {
                // Clean and validate the inputs
                $brand = trim(htmlspecialchars(strip_tags($_POST['brand'])));
                $model = trim(htmlspecialchars(strip_tags($_POST['model'])));
                $year = trim(htmlspecialchars(strip_tags($_POST['year'])));
                $mileage = trim(htmlspecialchars(strip_tags($_POST['mileage'])));

                // Check if 'year' is a numeric value
                if (is_numeric($year)) {
                    // Check if 'year' is a valid year
                    if ($year >= 1886 && $year <= $currentYear) {
                        // Check if 'mileage' is a numeric value
                        if (is_numeric($mileage)) {
                            // Check if 'mileage' is a positive number
                            if ($mileage >= 0) {
                                // Create the car :
                                $carsService = new CarsService();
                                $isOk = $carsService->setCar(
                                    null,
                                    $brand,
                                    $model,
                                    $year,
                                    $mileage
                                );
                                if ($isOk) {
                                    $html = 'Véhicule créé avec succès.';
                                } else {
                                    $html = 'Erreur lors de la création du véhicule.';
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
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '';

        // Get all cars :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) {
            $html .=
                '#' . $car->getId() . ' ' .
                $car->getBrand() . ' ' .
                $car->getModel() . ' ' .
                $car->getYear() . ' ' .
                $car->getMileage(). '</br>';
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
            isset($_POST['mileage'])) {
            // Clean and validate the inputs
            $id = trim(htmlspecialchars(strip_tags($_POST['id'])));
            $brand = trim(htmlspecialchars(strip_tags($_POST['brand'])));
            $model = trim(htmlspecialchars(strip_tags($_POST['model'])));
            $year = trim(htmlspecialchars(strip_tags($_POST['year'])));
            $mileage = trim(htmlspecialchars(strip_tags($_POST['mileage'])));

            // Check if all fields are not empty
            if (!empty($id) && !empty($brand) && !empty($model) && !empty($year) && !empty($mileage)) {
                // Check if 'year' is a numeric value
                if (is_numeric($year)) {
                    // Check if 'year' is a valid year
                    if ($year >= 1886 && $year <= $currentYear) {
                        // Check if 'mileage' is a numeric value
                        if (is_numeric($mileage)) {
                            // Check if 'mileage' is a positive number
                            if ($mileage >= 0) {
                                // Update the car :
                                $carsService = new CarsService();
                                $isOk = $carsService->setCar(
                                    $id,
                                    $brand,
                                    $model,
                                    $year,
                                    $mileage
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
        }

        return $html;
    }

}