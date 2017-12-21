<?php

namespace App\Repository;

use App\Entity\Unit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UnitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Unit::class);
    }


    public function getAllUnitsByType()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.level', 'DESC');
        $result = $qb->getQuery()->getResult();

        $return = [];

        foreach ($result as $unit) {
            if(!isset($return[$unit->getLevel()])) {
                $return[$unit->getLevel()] = [];
            }
            $return[$unit->getLevel()][$unit->getType()->getName()] = $unit;
        }


        return $return;
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('u')
            ->where('u.something = :value')->setParameter('value', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
