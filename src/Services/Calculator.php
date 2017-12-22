<?php

namespace App\Services;


use App\Entity\Player;

class Calculator
{
    /**
     * @var Player $player
     */
    private $player = null;

    public function __construct()
    {

    }

    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }
}