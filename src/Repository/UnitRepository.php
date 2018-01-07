<?php

namespace App\Repository;

use App\Entity\Army;
use App\Entity\Player;
use App\Entity\Unit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UnitRepository extends ServiceEntityRepository
{
    /**
     * UnitRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Unit::class);
    }


    /**
     * Getting all the units regrouped by type
     * @return array
     */
    public function getAllUnitsByType()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.level', 'DESC')
            ->addOrderBy('u.type' , 'ASC');
        $result = $qb->getQuery()->getResult();

        $return = [];

        foreach ($result as $unit) {
            if(!isset($return[$unit->getLevel()])) {
                $return[$unit->getLevel()] = [];
            }
            $return[$unit->getLevel()][$unit->getType()->getId()] = $unit;
        }


        return $return;
    }

    /**
     * Building an array of quantity with the unit.id in key
     * @param Player $player
     *
     * @return array
     */
    public function getArmyQuantityByUnit(Player $player)
    {
        //Initialize
        $returnArray = [];

        foreach ($player->getArmies() as $army) {
            $returnArray[$army->getUnit()->getId()] = $army->getQuantity();
        }

        return $returnArray;
    }

}
