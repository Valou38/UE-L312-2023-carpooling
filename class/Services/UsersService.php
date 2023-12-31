<?php

namespace App\Services;

use App\Entities\Reservation;
use App\Entities\User;
use App\Entities\Car;
use App\Entities\Ad;
use DateTime;

class UsersService
{
    /**
     * Create or update an user.
     */
    public function setUser(?string $id, string $firstName, string $lastName, string $email, string $birthday): bool
    {
        $userId = '';

        $dataBaseService = new DataBaseService();
        $birthdayDateTime = new DateTime($birthday);
        if (empty($id)) {
            $userId = $dataBaseService->createUser($firstName, $lastName, $email, $birthdayDateTime);
        } else {
            $dataBaseService->updateUser($id, $firstName, $lastName, $email, $birthdayDateTime);
            $userId = $id;
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $dataBaseService = new DataBaseService();
        $usersDTO = $dataBaseService->getUsers();
        if (!empty($usersDTO)) {
            foreach ($usersDTO as $userDTO) {
                $user = new User();
                $user->setId($userDTO['id']);
                $user->setFirstName($userDTO['first_name']);
                $user->setLastName($userDTO['last_name']);
                $user->setEmail($userDTO['email']);
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) {
                    $user->setBirthday($date);
                }

                // Get cars, ads and reservations of this user :

                $cars = $this->getUserCars($userDTO['id']);
                $user->setCar($cars);

                $ads = $this->getUsersAds($userDTO['id']);
                $user->setAd($ads);

                $reservations = $this->getUsersReservations($userDTO['id']);
                $user->setReservation($reservations);

                $users[] = $user;
            }
        }

        return $users;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteUser($id);

        return $isOk;
    }


    /****************************************************************************
     * *************************************************************************
     * **************************************************************************
     */

    /**
     * Create relation between an user and an ad.
     */
    public function setUserAd(string $userId, string $adId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserAd($userId, $adId);

        return $isOk;
    }

    /**
     * Create relation between an user and a reservation.
     */
    public function setUserReservation(string $userId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserReservation($userId, $reservationId);

        return $isOk;
    }

    /**
     * Get Ad of given user id.
     */

    public function getUsersAds(string $userId): array
    {
        $usersAds = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and ads :
        $usersAdsDTO = $dataBaseService->getUsersAds($userId);
        if (!empty($usersAdsDTO)) {
            foreach ($usersAdsDTO as $userAdDTO) {
                $ad = new Ad();
                $ad->setId($userAdDTO['id']);
                $ad->setDescription($userAdDTO['description']);
                $ad->setDateTime($userAdDTO['date_time']);
                $ad->setDeparture($userAdDTO['departure']);
                $ad->setDestination($userAdDTO['destination']);
                $ad->setAvailableSeats($userAdDTO['available_seats']);
                $ad->setPrice($userAdDTO['price']);
                $usersAds[] = $ad;
            }
        }

        return $usersAds;
    }


    /**
     * Get Reservation of given user id.
     */

    public function getUsersReservations(string $userId): array
    {
        $userReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation reservations and users :
        $usersReservationsDTO = $dataBaseService->getUsersReservations($userId);
        if (!empty($usersReservationsDTO)) {
            foreach ($usersReservationsDTO as $userReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($userReservationDTO['id']);
                $reservation->setReservedSeats($userReservationDTO['reserved_seats']);
                $reservation->setTotalPrice($userReservationDTO['total_price']);

                $userReservations[] = $reservation;
            }
        }

        return $userReservations;
    }

    /**
     * Get Cars of given user id.
     */

    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation cars and users :
        $usersCarsDTO = $dataBaseService->getUsersCars($userId);
        if (!empty($usersCarsDTO)) {
            foreach ($usersCarsDTO as $userCarDTO) {
                $car = new Car();
                $car->setBrand($userCarDTO['brand']);
                $car->setModel($userCarDTO['model']);
                $car->setYear($userCarDTO['year']);
                $car->setMileage($userCarDTO['mileage']);
                $car->setColor($userCarDTO['color']);
                $car->setNbrSlots($userCarDTO['nbr_slots']);

                $userCars[] = $car;
            }
        }

        return $userCars;
    }
}