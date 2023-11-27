<?php

namespace App\Entities;

class Reservation
{
    private $id;
    private $adid;
    private $userid;
    private $reservedseats;

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

    public function getReservedseats() : string
    {
        return $this->reservedseats;
    }

    public function setReservedseats(string $reservedseats): void
    {
        $this->reservedseats = $reservedseats;
    }
}