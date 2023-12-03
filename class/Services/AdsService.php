<?php

namespace App\Services;

use App\Entities\Ad;
use App\Entities\Reservation;

use DateTime;

class AdsService
{

    /**
     * Create or update an ad
     */
    public function setAd(?string $id, string $description, DateTime $dateTime, string $departure, string $destination, string $availableSeats, string $price): string
    {
        $adId = '';

        $dataBaseService = new DataBaseService();

        if (empty($id)){
            $adId = $dataBaseService->createAd($description,$dateTime, $departure, $destination, $availableSeats, $price);
        } else {
            $dataBaseService-> updateAd($id, $description,$dateTime, $departure, $destination, $availableSeats, $price);
            $adId = $id;
        }

        return $adId;
    }

    /**
     * Return all ads.
     */
    public function getAds(): array
    {
        $ads = [];

        $dataBaseService = new DataBaseService();
        $adsDTO = $dataBaseService->getAds();

        if (!empty($adsDTO)){
            foreach ($adsDTO as $adDTO){
                // Get ad :
                $ad = new Ad();
                $ad->setId($adDTO['id']);
                $ad->setDescription($adDTO['description']);
                $ad->setDateTime($adDTO['date_time']);
                $ad->setDeparture($adDTO['departure']);
                $ad->setDestination($adDTO['destination']);
                $ad->setAvailableSeats($adDTO['available_seats']);
                $ad->setPrice($adDTO['price']);

                // Get reservations of this ad :

                $reservations = $this->getAdReservations($adDTO['id']);
                $ad->setReservation($reservations);

                $ads[] = $ad;

            }
        }

        return $ads;
    }

    /**
     * Delete an ad.
     */
    public function deleteAd(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAd($id);

        return $isOk;
    }

    /********
     **RELATIONS
     **/

    /**
     * Get Reservation of given ad id.
     */

    public function getAdReservations(string $adId): array
    {
        $adReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation reservations and ads :
        $adsReservationsDTO = $dataBaseService->getAdReservations($adId);
        if (!empty($adsReservationsDTO)) {
            foreach ($adsReservationsDTO as $adReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($adReservationDTO['id']);
                $reservation->setReservedSeats($adReservationDTO['reserved_seats']);
                $reservation->setTotalPrice($adReservationDTO['total_price']);

                $adReservations[] = $reservation;
            }
        }

        return $adReservations;
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
     * Create relation between an ad and user.
     */
    public function setUserAd(string $userId, string $adId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserAd($userId, $adId);

        return $isOk;
    }

    /**
     * Create relation between an ad and car.
     */
    public function setCarAd(string $carId, string $adId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setCarAd($carId, $adId);

        return $isOk;
    }
}
