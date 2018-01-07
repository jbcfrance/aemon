<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUserPlayerId()
    {
        $query = $this->_em->createQuery('
            SELECT u,p
            FROM App\Entity\User u
            JOIN u.player p
        ');

        $return = [];

        foreach($query->getResult() as $res) {
            $return[] = $res->getPlayer()->getId();
        }


        return $return;
    }

}
