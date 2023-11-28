<?php

namespace App\Controllers;

use App\Services\DataBaseService;
use App\Services\ReservationsService;

class ReservationsController
{
    /**
     * Return just the carpoolad choice
     */

    public function getCarpooladById($id): array
    {
        $dataBaseService = new DataBaseService();
        return $dataBaseService->getCarpooladById($id);
    }

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
                !empty($_POST['reservedseats'])) {

                // Clean and validate the inputs
                $adid = intval($_POST['adid']);
                $userid = intval($_POST['userid']);
                $reservedSeats = intval($_POST['reservedseats']);

                // Check if the reserved seats do not exceed the available seats
                $ad = $this->getCarpooladById($adid);
                if ($ad['availableseats'] >= $reservedSeats) {
                    // Process reservation creation:
                    $reservationService = new ReservationsService();
                    $isOk = $reservationService->setReservation(
                        null,
                        $adid,
                        $userid,
                        $reservedSeats
                    );

                    if ($isOk) {
                        $html = 'Réservation créée avec succès.';
                    } else {
                        $html = 'Erreur lors de la création de la réservation.';
                    }
                } else {
                    $html = 'Erreur : Le nombre de sièges réservés ne peut pas dépasser le nombre de sièges disponibles.';
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

        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If the form has been submitted and not empty:
            if (!empty($_POST['id']) &&
                !empty($_POST['adid']) &&
                !empty($_POST['userid']) &&
                !empty($_POST['reservedseats'])) {

                // Clean and validate the inputs
                $id = intval($_POST['id']);
                $adid = intval($_POST['adid']);
                $userid = intval($_POST['userid']);
                $reservedSeats = intval($_POST['reservedseats']);

                // Check if the reserved seats do not exceed the available seats
                $ad = $this->getCarpooladById($adid);
                if ($ad['availableseats'] >= $reservedSeats) {
                    // Process reservation creation:
                    $reservationService = new ReservationsService();
                    $isOk = $reservationService->setReservation(
                        $id,
                        $adid,
                        $userid,
                        $reservedSeats
                    );

                    if ($isOk) {
                        $html = 'Réservation mise à jour avec succès.';
                    } else {
                        $html = 'Erreur lors de la mise à jour de la réservation.';
                    }
                } else {
                    $html = 'Erreur : Le nombre de sièges réservés ne peut pas dépasser le nombre de sièges disponibles.';
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
            } else {
                $html = 'Erreur : Aucun identifiant saisi';
            }

        }
        return $html;
    }
}