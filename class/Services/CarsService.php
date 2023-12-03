<?php

namespace App\Services;

use App\Entities\Car;
use App\Entities\Ad;

class CarsService
{

    /**
     * Create or update a car
     */
    public function setCar(?string $id, string $brand, string $model, string $year, string $mileage, string $color, string $nbrSlots): ?string
    {
        $carId = '';

        $dataBaseService = new DataBaseService();

        if (empty($id)){
            $carId = $dataBaseService-> createCar($brand, $model, $year, $mileage, $color, $nbrSlots);
            echo "New Car ID: " . $carId . '<br />';
        } else {
            $dataBaseService-> updateCar($id, $brand, $model, $year, $mileage, $color, $nbrSlots);
            $carId = $id;
            echo "Updated Car ID: " . $carId;
        }

        return $carId;
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

    /**
     * Fetch available user IDs from the database.
     */
    public function getUsers(): array
    {
        $dataBaseService = new DataBaseService();
        return $dataBaseService->getUsers();
    }

    /********
     **RELATIONS
     **/

    /**
     * Create relation between an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserCar($userId, $carId);

        var_dump($isOk);
        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUsersCars(string $userId): array
    {
        $usersCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersCarsDTO = $dataBaseService->getUsersCars($userId);
        if (!empty($usersCarsDTO)) {
            foreach ($usersCarsDTO as $userCarDTO) {
                $car = new Car();
                $car->setId($userCarDTO['id']);
                $car->setBrand($userCarDTO['brand']);
                $car->setModel($userCarDTO['model']);
                $car-> setYear($userCarDTO['year']);
                $car->setMileage($userCarDTO['mileage']) ;
                $car->setColor($userCarDTO['color']);
                $car->setNbrSlots($userCarDTO['nbr_slots']);
                $usersCars[] = $car;
            }
        }

        var_dump($usersCars);
        return $usersCars;
    }


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
                $ad->setDateTime($carAdDTO['date_time']);
                $ad->setDeparture($carAdDTO['departure']);
                $ad->setDestination($carAdDTO['destination']);
                $ad->setAvailableSeats($carAdDTO['available_seats']);
                $ad->setPrice($carAdDTO['price']);
                $carsAds[] = $ad;
            }
        }

        return $carsAds;
    }


}
