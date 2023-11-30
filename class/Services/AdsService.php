<?php

namespace App\Services;

use App\Entities\Ad;
use DateTime;

class AdsService
{

    /**
     * Create or update an ad
     */
    public function setAd(?string $id, string $carId, string $description, DateTime $dateTime, string $departure, string $destination, string $availableSeats, string $price): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();

        if (empty($id)){
            $isOk = $dataBaseService->createAd($carId, $description,$dateTime, $departure, $destination, $availableSeats, $price);
        } else {
            $isOk = $dataBaseService-> updateAd($id, $carId, $description,$dateTime, $departure, $destination, $availableSeats, $price);
        }

        return $isOk;
    }

    /**
     * Return all ads.
     */
    public function getAds(): array
    {
        $ad = [];

        $dataBaseService = new DataBaseService();
        $adsDTO = $dataBaseService->getAds();

        if (!empty($adsDTO)){
            foreach ($adsDTO as $adDTO){
                $adDTO = new Ad();
                $adDTO->setId($adDTO['id']);
                $adDTO->setCarId($adDTO['car_id']);
                $adDTO->setDescription($adDTO['description']);
                $adDTO->setDateTime($adDTO['date_time']);
                $adDTO->setDeparture($adDTO['departure']);
                $adDTO->setDestination($adDTO['destination']);
                $adDTO->setAvailableSeats($adDTO['available_seats']);
                $adDTO->setPrice($adDTO['price']);

                $adsDTO[] = $adDTO;
            }
        }

        return $adsDTO;
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
}
