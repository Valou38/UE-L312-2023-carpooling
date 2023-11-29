<?php

namespace App\Entities;

class Car
{
 private $id;
 private $brand;
 private $model;
 private $year;
 private $mileage;
 private $color;
 private $nbrSlots;

    public function getId() : string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this ->id = $id;
    }

    public function getBrand() : string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel() : string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getYear() : string
    {
        return $this->year;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function getMileage() : string
    {
        return $this->mileage;
    }

    public function setMileage(string $mileage): void
    {
        $this->mileage = $mileage;
    }

    public function getColor() : string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getNbrSlots() : string
    {
        return $this->nbrSlots;
    }

    public function setNbrSlots(string $nbrSlots): void
    {
        $this->nbrSlots = $nbrSlots;
    }
}