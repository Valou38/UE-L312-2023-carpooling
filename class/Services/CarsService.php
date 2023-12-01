<?php

namespace App\Services;

use App\Entities\Car;

class CarsService
{

    /**
     * Create or update a car
     */
    public function setCar(?string $id, string $brand, string $model, string $year, string $mileage, string $color, string $nbrSlots): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();

        if (empty($id)){
            $isOk = $dataBaseService-> createCar($brand, $model, $year, $mileage, $color, $nbrSlots);
        } else {
            $isOk = $dataBaseService-> updateCar($id, $brand, $model, $year, $mileage, $color, $nbrSlots);
        }

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $dataBaseService = new DataBaseService();
        $carsDTO = $dataBaseService->getCars();

        if (!empty($carsDTO)){
            foreach ($carsDTO as $carDTO){
                $car = new Car();
                $car->setId($carDTO['id']);
                $car->setBrand($carDTO['brand']);
                $car->setModel($carDTO['model']);
                $car->setYear($carDTO['year']);
                $car->setMileage($carDTO['mileage']);
                $car->setColor($carDTO['color']);
                $car->setNbrSlots($carDTO['nbr_slots']);

                // Get ads of this car :
                $ads = $this->getCarsAds($carDTO['id']);
                $car->setAd($ads);

                $cars[] = $car;
            }
        }

        return $cars;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCar($id);

        return $isOk;
    }


    /********
     **RELATIONS
     **/


    public function setCarAd(string $carId, string $adId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setCarAd($carId, $adId);

        return $isOk;
    }

    public function getCarsAds(string $carId): array
    {
        $carsAds = [];
        $dataBaseService = new DataBaseService();

        // Get relation cars and ads :
        $carsAdsDTO = $dataBaseService->getCarsAds($carId);
        if (!empty($carsAdsDTO)) {
            foreach ($carsAdsDTO as $carAdDTO) {
                $ad = new Ad();
                $ad->setId($carAdDTO['id']);
                $ad->setDescription($carAdDTO['description']);
                $ad->setDateTime($carAdDTO['dateTime']);
                $ad->setDeparture($carAdDTO['departure']);
                $ad->setDestination($carAdDTO['destination']);
                $ad->setAvailableSeats($carAdDTO['availableSeats']);
                $ad->setPrice($carAdDTO['price']);
                $carsAds[] = $ad;
            }
        }

        return $carsAds;
    }


}
