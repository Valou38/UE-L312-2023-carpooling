<?php

namespace App\Services;

use App\Entities\Reservation;
class ReservationsService
{
    /**
     * Create or update a reservation.
     */
    public function setReservation(?string $id, string $adid, string $userid, string $reservedseats): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createReservation($adid, $userid, $reservedseats);
        } else {
            $isOk = $dataBaseService->updateReservation($id, $adid, $userid, $reservedseats);
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
                $reservation->setAdid($reservationDTO['adid']);
                $reservation->setUserid($reservationDTO['userid']);
                $reservation->setReservedseats($reservationDTO['reservedseats']);
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