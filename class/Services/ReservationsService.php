<?php

namespace App\Services;

use App\Entities\Reservation;
use DateTime;
class ReservationsService
{
    /**
     * Create or update a reservation.
     */
    public function setReservation(?string $id, string $adid, string $userid, string $dateandtime, string $reservedseats): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $dateandtime = new DateTime($dateandtime);
        if (empty($id)) {
            $isOk = $dataBaseService->createReservation($adid, $userid, $dateandtime, $reservedseats);
        } else {
            $isOk = $dataBaseService->updateReservation($id, $adid, $userid, $dateandtime, $reservedseats);
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
                $dateandtime = new DateTime($reservationDTO['dateandtime']);
                if ($dateandtime !== false) {
                    $reservation->setDate($dateandtime);
                }
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