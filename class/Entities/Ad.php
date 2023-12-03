<?php

namespace App\Entities;

class Ad
{
    private $id;
    private $description;
    private $dateTime;
    private $departure;
    private $destination;
    private $availableSeats ;
    private $price;
    private $userCar;

    public function getId() : string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this ->id = $id;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDateTime() : string
    {
        return $this->dateTime;
    }

    public function setDateTime(string $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function getDeparture() : string
    {
        return $this->departure;
    }

    public function setDeparture(string $departure): void
    {
        $this->departure = $departure;
    }

    public function getDestination() : string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): void
    {
        $this->destination = $destination ;
    }


    public function getAvailableSeats() : string
    {
        return $this->availableSeats;
    }

    public function setAvailableSeats(string $availableSeats): void
    {
        $this->availableSeats = $availableSeats ;
    }

    public function getPrice() : string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price ;
    }

    /**** AdReservations relation */

    public function setReservation(array $reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }

    public function getReservations(): ?array
    {
        return $this->reservations;
    }

    public function setUserCar(array $reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }

    public function getUsersCars(): ?array
    {
        return $this->reservations;
    }
}
