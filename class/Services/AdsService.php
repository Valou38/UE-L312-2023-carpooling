<?php

namespace App\Services;

use App\Entities\Ad;
use DateTime;

class AdsService
{

    /**
     * Create or update an ad
     */
    public function setAd(?string $id, string $description, DateTime $dateTime, string $departure, string $destination, string $availableSeats, string $price): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();

        if (empty($id)){
            $isOk = $dataBaseService->createAd($description,$dateTime, $departure, $destination, $availableSeats, $price);
        } else {
            $isOk = $dataBaseService-> updateAd($id, $description,$dateTime, $departure, $destination, $availableSeats, $price);
        }

        return $isOk;
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
                $ad = new Ad();
                $ad->setId($adDTO['id']);
                $ad->setDescription($adDTO['description']);
                $ad->setDateTime($adDTO['date_time']);
                $ad->setDeparture($adDTO['departure']);
                $ad->setDestination($adDTO['destination']);
                $ad->setAvailableSeats($adDTO['available_seats']);
                $ad->setPrice($adDTO['price']);

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
}
