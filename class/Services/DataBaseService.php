<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = 'password';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /******************************************
      Create an user
     ****************************************/

    public function createUser(string $firstName, string $lastName, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (first_name, last_name, email, birthday) VALUES (:first_name, :last_name, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstName, string $lastName, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /******************************
        Create a car
     *****************************/

    public function createCar(string $brand, string $model, string $year, string $mileage, string $color, string $nbrSlots): bool
    {
        $isOk = false;

        $data = [
            'brand' => $brand,
            'model' => $model,
            'year' => $year,
            'mileage' => $mileage,
            'color' => $color,
            'nbr_slots' => $nbrSlots,
        ];
        $sql = 'INSERT INTO cars (brand, model, year, mileage, color, nbr_slots) VALUES (:brand, :model, :year, :mileage, :color, :nbr_slots)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    /**
     * Update a car.
     */
    public function updateCar(string $id, string $brand, string $model, string $year, string $mileage, string $color, string $nbrSlots): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'year' => $year,
            'mileage' => $mileage,
            'color' => $color,
            'nbr_slots' => $nbrSlots,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, year = :year, mileage = :mileage, color = :color, nbr_slots = :nbr_slots WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM cars WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }


    /***********************************
      Create a carpool ad
     **********************************/

    public function createAd(string $description, datetime $dateTime, string $departure, string $destination, int $availableSeats, string $price): bool
    {
        $isOk = false;

        $data = [
            'description' => $description,
            'date_time' => $dateTime->format('Y-m-d H:i:s'),
            'departure' => $departure,
            'destination' => $destination,
            'available_seats' => $availableSeats,
            'price' => $price,
        ];
        $sql = 'INSERT INTO ads (description, date_time, departure, destination, available_seats, price) VALUES (:description, :date_time, :departure, :destination, :available_seats, :price)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all ads.
     */
    public function getAds(): array
    {
        $ads = [];

        $sql = 'SELECT * FROM ads';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $ads = $results;
        }

        return $ads;
    }

    /**
     * Return an ad by id.
     */
    public function getAdById($id): array
    {
        $ad = [];

        $sql = 'SELECT * FROM ads WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $ad = $results[0];
        }

        return $ad;
    }

    /**
     * Update an ad.
     */
    public function updateAd(?string $id, string $description, DateTime $dateTime, string $departure, string $destination, int $availableSeats, $price): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'description' => $description,
            'date_time' => $dateTime->format('Y-m-d H:i:s'),
            'departure' => $departure,
            'destination' => $destination,
            'available_seats' => $availableSeats,
            'price' => $price
        ];

        $sql = 'UPDATE ads SET description = :description, date_time = :date_time, departure = :departure, destination = :destination, available_seats = :available_seats, price = :price WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }


    /**
     * Delete an ad.
     */
    public function deleteAd(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM ads WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /******************************************
    Create a reservation
     ****************************************/

    public function createReservation(string $reservedSeats, string $totalPrice): bool
    {
        $isOk = false;

        $data = [
            'reserved_seats' => $reservedSeats,
            'total_price' => $totalPrice
        ];
        $sql = 'INSERT INTO reservations (reserved_seats, total_price) VALUES (:reserved_seats, :total_price)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $sql = 'SELECT * FROM reservations';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $reservations = $results;
        }

        return $reservations;
    }

    /**
     * Update a reservation.
     */
    public function updateReservation(string $id, string $reservedSeats, string $totalPrice): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'reserved_seats' => $reservedSeats,
            'total_price' => $totalPrice
        ];
        $sql = 'UPDATE reservations SET reserved_seats = :reserved_seats, total_price = :total_price WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM reservations WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }




        
    /*****************************************************************
     * RELATIONS BETWEEN TABLES
     *********************************/


    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    public function setUserAd(string $userId, string $adId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'adId' => $adId,
        ];
        $sql = 'INSERT INTO users_ads (user_id, ad_id) VALUES (:userId, :adId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    public function setUserReservation(string $userId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO users_reservations (user_id, reservation_id) VALUES (:userId, :reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    public function setAdReservation(string $adId, string $reservationId): bool
    {
        $isOk = false;

        echo "Before execution";
        var_dump($adId, $reservationId);

        $data = [
            'adId' => $adId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO ads_reservations (ad_id, reservation_id) VALUES (:adId, :reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        echo "After execution";
        var_dump($isOk);

        return $isOk;
    }

    public function setCarAd(string $carId, string $adId): bool
    {
        $isOk = false;

        $data = [
            'carId' => $carId ,
            'adId' => $adId,
        ];
        $sql = 'INSERT INTO cars_ads (car_id, ad_id) VALUES (:carId, :adId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }



    /**
     * Get
     */

    public function getUsersCars(string $userId): array
    {
        $usersCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT cars.*
            FROM cars, users_cars
            WHERE users_cars.car_id = cars.id
            AND users_cars.user_id = :userId' ;
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $usersCars = $results;
        }

        return $usersCars;
    }

    public function getUsersAds(string $userId): array
    {
        $usersAds = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
             SELECT ads.*
            FROM ads, users_ads
            WHERE users_ads.ad_id = ads.id
            AND users_ads.user_id = :userId' ;
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $usersAds = $results;
        }

        return $usersAds;
    }

    public function getUsersReservations(string $userId): array
    {
        $usersReservations = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
             SELECT reservations.*
            FROM reservations, users_reservations
            WHERE users_reservations.reservation_id = reservations.id
            AND users_reservations.user_id = :userId' ;
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $usersReservations = $results;
        }

        return $usersReservations ;
    }

    public function getAdReservations(string $adId): array
    {
        $adsReservations = [];

        $data = [
            'adId' => $adId,
        ];
        $sql = '
            SELECT reservations.*
            FROM reservations, ads_reservations
            WHERE ads_reservations.reservation_id = reservations.id
            AND ads_reservations.ad_id = :adId' ;
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $adsReservations = $results;
        }

        return $adsReservations ;
    }

    public function getCarsAds(string $carId): array
    {
        $carsAds = [];

        $data = [
            'carId' => $carId,
        ];
        $sql = '
            SELECT ads.*
            FROM ads, cars_ads
            WHERE cars_ads.ad_id = ads.id
            AND cars_ads.car_id = :carId' ;
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $carsAds = $results;
        }

        return $carsAds;
    }
}
