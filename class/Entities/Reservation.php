<?php

namespace App\Entities;

class Reservation
{
    private $id;
    private $adid;
    private $userid;
    private $reservedSeats;

    public function getId() : string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this ->id = $id;
    }

    public function getAdid() : string
    {
        return $this->adid;
    }

    public function setAdid(string $adid): void
    {
        $this->adid = $adid;
    }

    public function getUserid() : string
    {
        return $this->userid;
    }

    public function setUserid(string $userid): void
    {
        $this->userid = $userid;
    }

    public function getReservedSeats() : string
    {
        return $this->reservedSeats;
    }

    public function setReservedSeats(string $reservedSeats): void
    {
        $this->reservedSeats = $reservedSeats;
    }
}