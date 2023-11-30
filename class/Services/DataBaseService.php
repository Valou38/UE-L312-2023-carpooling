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

    public function createAd(int $carId, string $description, datetime $dateTime, string $departure, string $destination, int $availableSeats, string $price): bool
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
        $sql = 'DELETE FROM ads WHERE id = :id;';
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
    public function updateReservation(string $id, string $adId, string $userId, string $reservedSeats, string $totalPrice): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'ad_id' => $adId,
            'user_id' => $userId,
            'reserved_seats' => $reservedSeats,
            'total_price' => $totalPrice
        ];
        $sql = 'UPDATE reservations SET ad_id = :adid, user_id = :userid, reserved_seats = :reserved_seats, total_price = :total_price WHERE id = :id;';
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
}
