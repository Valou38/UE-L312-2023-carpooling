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
    const MYSQL_PASSWORD = '';

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

    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
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
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
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

    public function createCar(string $brand, string $model, string $year, string $mileage): bool
    {
        $isOk = false;

        $data = [
            'brand' => $brand,
            'model' => $model,
            'year' => $year,
            'mileage' => $mileage,
        ];
        $sql = 'INSERT INTO cars (brand, model, year, mileage) VALUES (:brand, :model, :year, :mileage)';
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
    public function updateCar(string $id, string $brand, string $model, string $year, string $mileage): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'year' => $year,
            'mileage' => $mileage,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, year = :year, mileage = :mileage WHERE id = :id;';
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

    public function createCarpoolad(int $carid, string $description, datetime $dateandtime, string $departurelocation, string $destination, int $availableseats): bool
    {
        $isOk = false;

        $data = [
            'carid' => $carid,
            'description' => $description,
            'dateandtime' => $dateandtime,
            'departurelocation' => $departurelocation,
            'destination' => $destination,
            'availableseats' => $availableseats
        ];
        $sql = 'INSERT INTO cars (carid, description, dateandtime, departurelocation, destination, availableseats) VALUES (:carid, :description, :dateandtime, :departurelocation, :destination, :availableseats)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all ads.
     */
    public function getCarpoolad(): array
    {
        $carpoolad = [];

        $sql = 'SELECT * FROM carpoolad';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $carpoolad = $results;
        }

        return $carpoolad;
    }

    /**
     * Return an ad by id.
     */
    public function getCarpooladById($id): array
    {
        $carpoolad = [];

        $sql = 'SELECT * FROM carpoolad WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $carpoolad = $results[0];
        }

        return $carpoolad;
    }

    /**
     * Update an ad.
     */
    public function updateCarpoolad(int $carid, string $description, datetime $dateandtime, string $departurelocation, string $destination, int $availableseats): bool
    {
        $isOk = false;

        $data = [
            'carid' => $carid,
            'description' => $description,
            'dateandtime' => $dateandtime,
            'departurelocation' => $departurelocation,
            'destination' => $destination,
            'availableseats' => $availableseats
        ];


        $sql = 'UPDATE carpoolad SET carid = :carid, description = :description, dateandtime = :dateandtime, departurelocation = :departurelocation, detination = :destination, avalableseats = :availableseats WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an ad.
     */
    public function deleteCarpoolad(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM carpoolad WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /******************************************
    Create a reservation
     ****************************************/

    public function createReservation(string $adid, string $userid, string $reservedseats): bool
    {
        $isOk = false;

        $data = [
            'adid' => $adid,
            'userid' => $userid,
            'reservedseats' => $reservedseats,
        ];
        $sql = 'INSERT INTO reservation (adid, userid, reservedseats) VALUES (:adid, :userid, :reservedseats)';
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

        $sql = 'SELECT * FROM reservation';
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
    public function updateReservation(string $id, string $adid, string $userid, string $reservedseats): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'adid' => $adid,
            'userid' => $userid,
            'reservedseats' => $reservedseats,
        ];
        $sql = 'UPDATE reservation SET adid = :adid, userid = :userid, reservedseats = :reservedseats WHERE id = :id;';
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
        $sql = 'DELETE FROM reservation WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }
}