<?php

namespace App\Services;

use App\Entities\Reservation;
class ReservationsService
{
    /**
     * Create or update a reservation.
     */
    public function setReservation(?string $id, string $reservedSeats, string $totalPrice): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createReservation($reservedSeats, $totalPrice);
        } else {
            $isOk = $dataBaseService->updateReservation($id, $reservedSeats, $totalPrice);
        }

        return $isOk;
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
}