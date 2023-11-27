<?php

namespace App\Services;

use App\Entities\Carpoolad;
use DateTime;

class CarpooladService
{

    /**
     * Create or update an ad
     */
    public function setCarpoolad(?string $id, string $carid, string $description, DateTime $dateandtime, string $departurelocation, string $destination, string $availableseats): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();

        if (empty($id)){
            $isOk = $dataBaseService->createCarpoolad($carid, $description,$dateandtime, $departurelocation, $destination, $availableseats);
        } else {
            $isOk = $dataBaseService-> updateCarpoolad($id, $carid, $description,$dateandtime, $departurelocation, $destination, $availableseats);
        }

        return $isOk;
    }

    /**
     * Return all ads.
     */
    public function getCarpoolad(): array
    {
        $carpoolad = [];

        $dataBaseService = new DataBaseService();
        $carpooladDTO = $dataBaseService->getCarpoolad();

        if (!empty($carpooladDTO)){
            foreach ($carpooladDTO as $carpoolDTO){
                $carpool = new Carpoolad();
                $carpool->setId($carpoolDTO['id']);
                $carpool->setCarid($carpoolDTO['carid']);
                $carpool->setDescription($carpoolDTO['description']);
                $carpool->setDateandtime($carpoolDTO['dateandtime']);
                $carpool->setDeparturelocation($carpoolDTO['departurelocation']);
                $carpool->setDestination($carpoolDTO['destination']);
                $carpool->setAvailableseats($carpoolDTO['availableseats']);


                $carpoolad[] = $carpool;
            }
        }

        return $carpoolad;
    }

    /**
     * Delete an ad.
     */
    public function deleteCarpoolad(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCarpoolad($id);

        return $isOk;
    }
}
