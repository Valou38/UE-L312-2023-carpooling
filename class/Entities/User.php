<?php

namespace App\Entities;

use DateTime;

class User
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $birthday;
    private $cars ;
    private $ads ;
    private $reservations ;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }


/***********************************************

    UserCar relation */


    public function setCar(array $cars)
    {
        $this->cars = $cars;

        return $this;
    }

    public function getCars(): ?array
    {
        return $this->cars;
    }


/**** UserAd relation */

    public function setAd(array $ads)
    {
        $this->ads = $ads;

        return $this;
    }

    public function getAds(): ?array
    {
        return $this->ads;
    }


    /**** UserAd relation */

    public function setReservation(array $reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }

    public function getReservations(): ?array
    {
        return $this->reservations;
    }




    /*************************************************/

}
