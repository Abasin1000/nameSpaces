<?php

namespace App;

class Game
{
    public Spaceship $player;
    public Spaceship $enemy;
    public array $playerPosition = ['x' => 0, 'y' => 0];

    public function __construct()
    {
        $this->player = new Spaceship();
        $this->enemy = new Spaceship();
    }

    public function playerShoot()
    {
        $damage = $this->player->shoot();
        $this->enemy->hit($damage);
    }

    public function playerMove()
    {
        $this->player->move();
        $this->playerPosition['x'] += 10;
    }
}
