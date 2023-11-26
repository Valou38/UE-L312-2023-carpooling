<?php

namespace App\Controllers;

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
            if (!empty($_POST['adid']) &&
                !empty($_POST['userid']) &&
                !empty($_POST['dateandtime']) &&
                !empty($_POST['reservedseats'])) {

                // Clean and validate the inputs
                $adid = intval($_POST['adid']);
                $userid = intval($_POST['userid']);
                $dateandtime = trim(htmlspecialchars(strip_tags($_POST['dateandtime'])));
                $reservedSeats = intval($_POST['reservedseats']);

                // Check if the date is at least equal to the current date
                if (strtotime($dateandtime) < strtotime(date('Y-m-d'))) {
                    $html = 'Erreur : La date ne peut pas être antérieure à aujourd\'hui.';
                    return $html;
                }

                // Process reservation creation:
                $reservationService = new ReservationsService();
                $isOk = $reservationService->setReservation(
                    null,
                    $adid,
                    $userid,
                    $dateandtime,
                    $reservedSeats
                );

                if ($isOk) {
                    $html = 'Réservation créée avec succès.';
                } else {
                    $html = 'Erreur lors de la création de la réservation.';
                }
            } else {
                $html = 'Erreur : Tous les champs doivent être remplis.';
            }
        }

        return $html;
    }

    /**
     * Fetch available ad IDs from the database.
     */
    public function getCarpoolad(): array
    {
        $dataBaseService = new DataBaseService();
        return $dataBaseService->getCarpoolad();
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
            $html .=
                '#' . $reservation->getId() . ' ' .
                $reservation->getAdid() . ' ' .
                $reservation->getUserid() . ' ' .
                $reservation->getDateandtime() . ' ' .
                $reservation->getReservedseats(). '</br>';
        }

        return $html;
    }

    /**
     * Update the reservation.
     */
    public function updateReservation(): string
    {
        $html = '';

        // Get the current date
        $currentDate = date('Y-m-d');

        // If the form has been submitted :
        if ($_SERVER["REQUEST_METHOD"] == "POST" &&
            isset($_POST['id']) &&
            isset($_POST['adid']) &&
            isset($_POST['userid']) &&
            isset($_POST['dateandtime']) &&
            isset($_POST['reservedseats'])) {

            // Clean and validate the inputs
            $id = trim(htmlspecialchars(strip_tags($_POST['id'])));
            $adid = trim(htmlspecialchars(strip_tags($_POST['adid'])));
            $userid = trim(htmlspecialchars(strip_tags($_POST['userid'])));
            $date = trim(htmlspecialchars(strip_tags($_POST['dateandtime'])));
            $reservedSeats = trim(htmlspecialchars(strip_tags($_POST['reservedseats'])));

            // Check if all fields are not empty
            if (!empty($id) && !empty($adid) && !empty($userid) && !empty($dateandtime) && !empty($reservedSeats)) {
                // Check if the date is not earlier than the current date
                if (strtotime($dateandtime) >= strtotime($currentDate)) {
                    // Update the reservation:
                    $reservationService = new ReservationsService(); // Assuming you have a ReservationService class
                    $isOk = $reservationService->setReservation()(
                        null,
                        $adid,
                        $userid,
                        $dateandtime,
                        $reservedSeats
                    );
                    if ($isOk) {
                        $html = 'Réservation mise à jour avec succès.';
                    } else {
                        $html = 'Erreur lors de la mise à jour de la réservation.';
                    }
                } else {
                    $html = 'Erreur : La date ne peut pas être antérieure à aujourd\'hui.';
                }
            } else {
                $html = 'Erreur : Tous les champs doivent être remplis.';
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

        // If the form have been submitted and not empty :
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
                        $html = 'Réservation supprimé avec succès.';
                    } else {
                        $html = 'Erreur lors de la suppression de la réservation.';
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