<?php

namespace App\Entities;

class Carpoolad
{
    private $id;
    private $carid;
    private $description;
    private $dateandtime;
    private $departurelocation;
    private $destination;
    private $availableseats ;

    public function getId() : string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this ->id = $id;
    }

    public function getCarid() : string
    {
        return $this->carid;
    }

    public function setCarid(string $carid): void
    {
        $this->carid = $carid;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDateandtime() : string
    {
        return $this->dateandtime;
    }

    public function setDateandtime(string $dateandtime): void
    {
        $this->dateandtime = $dateandtime;
    }

    public function getDeparturelocation() : string
    {
        return $this->departurelocation;
    }

    public function setDeparturelocation(string $departurelocation): void
    {
        $this->departurelocation = $departurelocation;
    }

    public function getDestination() : string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): void
    {
        $this->destination = $destination ;
    }


    public function getAvailableseats() : string
    {
        return $this->availableseats;
    }

    public function setAvailableseats(string $availableseats): void
    {
        $this->availableseats = $availableseats ;
    }

}
