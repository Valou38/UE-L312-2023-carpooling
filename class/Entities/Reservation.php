<?php

namespace App\Entities;

class Reservation
{
    private $id;
    private $reservedSeats;
    private $totalPrice;

    public function getId() : string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this ->id = $id;
    }

    public function getAdId() : string
    {
        return $this->adId;
    }

    public function setAdId(string $adId): void
    {
        $this->adId = $adId;
    }

    public function getUserId() : string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getReservedSeats() : string
    {
        return $this->reservedSeats;
    }

    public function setReservedSeats(string $reservedSeats): void
    {
        $this->reservedSeats = $reservedSeats;
    }

    public function getTotalPrice() : string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }
}
