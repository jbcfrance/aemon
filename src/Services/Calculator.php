<?php

namespace App\Services;


use App\Entity\Army;
use App\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class Calculator
 *
 * @package App\Services
 */
class Calculator
{
    /**
     * @var array $statsToCompile
     */
    private $statsToCompile = ['defense', 'attack', 'power', 'health', 'quantity'];

    /**
     * @var Player $player
     */
    private $player = null;

    /**
     * @var array $calculatedArmy
     */
    private $calculatedArmy = [];


    /**
     * Calculator constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        // Search all the units types
        $unitTypes = $entityManager->getRepository('App:UnitType')->findAll();

        if (is_null($unitTypes)) {
            throw new Exception('No unit types found in the database.');
        }

        // Initialize the calculatedArmy array
        $this->calculatedArmy = [
            'totalQuantity' => 0,
            'totalDefense' => 0,
            'totalAttack' => 0,
            'totalPower' => 0,
            'totalHealth' => 0
        ];

        foreach ( $this->statsToCompile as $stats) {


            // Initialize the calculatedArmy array with the unitTypes
            foreach ($unitTypes as $unitType) {
                $this->calculatedArmy[$unitType->getName()][$stats] = 0;
            }
        }

    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return array
     */
    public function getCalculatedArmy(): array
    {
        return $this->calculatedArmy;
    }

    /**
     * This method execute all the compilation work
     *
     * @throws Exception
     *
     * @return boolean
     */
    public function compilation()
    {
        $troops = $this->player->getArmies();

        if (empty($troops)) {
           throw new Exception('No Army data found for the player : '.$this->player->getName());
        }


        // Each Troop data is compiled
        foreach ($troops as $troop) {
            foreach ($this->statsToCompile as $stats) {
                $this->compileStatistic($troop, $stats);
            }
        }

        // If nothing has stopped the compilation, we returning true
        return true;
    }

    /**
     * Compiling a statistic for the army
     *
     * @param Army   $army
     * @param string $stats
     *
     * @return boolean
     */
    private function compileStatistic(Army $army, string $stats)
    {

        // Getting the unit's type
        $unitType = $army->getUnit()->getType();

        //Initialize if necessary
        if (!isset($this->calculatedArmy[$unitType->getName()][$stats])) {
            $this->calculatedArmy[$unitType->getName()][$stats] = 0;
        }

        $statsMethod = 'calculate'.ucfirst($stats);

        // We check if the calcul method exists and we throw an exception otherwise
        if (!method_exists($this,$statsMethod)) {
            throw new Exception('Unknown statistic : '.$stats);
        }

        // Finally adding the quantity to the counter
        $this->calculatedArmy[$unitType->getName()][$stats] += $this->{$statsMethod}($army);
        $this->calculatedArmy['total'.ucfirst($stats)] += $this->{$statsMethod}($army);

        return true;

    }

    /**
     * @param Army $army
     *
     * @return bool|int
     */
    private function calculateQuantity(Army $army) {
        if (is_null($army)) {
            return false;
        }

        return $army->getQuantity();
    }

    /**
     * @param Army $army
     *
     * @return bool|float|int
     */
    private function calculateDefense(Army $army) {

        if (is_null($army)) {
            return false;
        }

        return ($army->getQuantity() * $army->getUnit()->getDefense());

    }

    /**
     * @param Army $army
     *
     * @return bool|float|int
     */
    private function calculateAttack(Army $army) {

        if (is_null($army)) {
            return false;
        }

        return ($army->getQuantity() * $army->getUnit()->getAttack());

    }

    /**
     * @param Army $army
     *
     * @return bool|float|int
     */
    private function calculatePower(Army $army) {

        if (is_null($army)) {
            return false;
        }

        return ($army->getQuantity() * $army->getUnit()->getPower());

    }

    /**
     * @param Army $army
     *
     * @return bool|float|int
     */
    private function calculateHealth(Army $army) {

        if (is_null($army)) {
            return false;
        }

        return ($army->getQuantity() * $army->getUnit()->getHealth());

    }

}