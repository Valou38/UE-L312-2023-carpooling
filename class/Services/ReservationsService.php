<?php

namespace App\Services;

use App\Entities\Reservation;
class ReservationsService
{
    /**
     * Create or update a reservation.
     */
    public function setReservation(?string $id, string $reservedSeats, string $totalPrice): ?string
    {
        $reservationId = '';
        $dataBaseService = new DataBaseService();

        if (empty($id)) {
            $reservationId = $dataBaseService->createReservation($reservedSeats, $totalPrice);
            echo "New Reservation ID: " . $reservationId . '<br />';
        } else {
            $dataBaseService->updateReservation($id, $reservedSeats, $totalPrice);
            $reservationId = $id;
            echo "Updated Reservation ID: " . $reservationId;
        }

        return $reservationId;
    }



    /**
     * Return all reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $dataBaseService = new DataBaseService();
        $reservationsDTO = $dataBaseService->getReservations();

        if (!empty($reservationsDTO)) {
            foreach ($reservationsDTO as $reservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($reservationDTO['id']);
                $reservation->setReservedSeats($reservationDTO['reserved_seats']);
                $reservation->setTotalPrice($reservationDTO['total_price']);
                $reservations[] = $reservation;
            }
        }

        return $reservations;
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteReservation($id);

        return $isOk;
    }

    /********
     **RELATIONS
     **/

    /**
     * Create relation between an ad and a reservation.
     */
    public function setAdReservation(string $adId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAdReservation($adId, $reservationId);

        return $isOk;
    }
}