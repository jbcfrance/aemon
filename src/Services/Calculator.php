<?php

namespace App\Services;


use App\Entity\Player;

class Calculator
{
    /**
     * @var Player $player
     */
    private $player = null;

    private $totalAttack = 0;

    private $totalDefense = 0;

    private $totalPower = 0;

    private $totalTroup = 0;


    public function __construct()
    {

    }

    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return int
     */
    public function getTotalAttack(): int
    {
        return $this->totalAttack;
    }

    /**
     * @param int $totalAttack
     */
    public function setTotalAttack(int $totalAttack): void
    {
        $this->totalAttack = $totalAttack;
    }

    /**
     * @return int
     */
    public function getTotalDefense(): int
    {
        return $this->totalDefense;
    }

    /**
     * @param int $totalDefense
     */
    public function setTotalDefense(int $totalDefense): void
    {
        $this->totalDefense = $totalDefense;
    }

    /**
     * @return int
     */
    public function getTotalPower(): int
    {
        return $this->totalPower;
    }

    /**
     * @param int $totalPower
     */
    public function setTotalPower(int $totalPower): void
    {
        $this->totalPower = $totalPower;
    }

    /**
     * @return int
     */
    public function getTotalTroup(): int
    {
        return $this->totalTroup;
    }

    /**
     * @param int $totalTroup
     */
    public function setTotalTroup(int $totalTroup): void
    {
        $this->totalTroup = $totalTroup;
    }



    public function compilation()
    {
        $troops = $this->player->getArmies();

        foreach ($troops as $troop) {
            $this->totalTroup += $troop->getQuantity();
            $this->totalAttack += ($troop->getQuantity() * $troop->getUnit()->getAttack());
            $this->totalDefense += ($troop->getQuantity() * $troop->getUnit()->getDefense());
            $this->totalPower += ($troop->getQuantity() * $troop->getUnit()->getPower());
        }

    }

}