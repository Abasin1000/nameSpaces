<?php

namespace App;

class Spaceship
{
    public bool $isAlive;
    public int $ammo;
    public int $fuel;
    public int $hitPoints;

    public function __construct($ammo = 100, $fuel = 100, $hitPoints = 100)
    {
        $this->ammo = $ammo;
        $this->fuel = $fuel;
        $this->hitPoints = $hitPoints;
        $this->isAlive = true;
    }

    public function shoot(): int
    {
        $shotCost = 5;
        $damage = 10;
        if ($this->ammo >= $shotCost) {
            $this->ammo -= $shotCost;
            return $damage;
        }
        return 0;
    }

    public function hit(int $damage)
    {
        $this->hitPoints -= $damage;
        if ($this->hitPoints <= 0) {
            $this->isAlive = false;
        }
    }

    public function move()
    {
        $fuelUsage = 10;
        if ($this->fuel >= $fuelUsage) {
            $this->fuel -= $fuelUsage;
        }
    }
}
