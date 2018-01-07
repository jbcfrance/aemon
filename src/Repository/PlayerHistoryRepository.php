<?php

namespace App\Repository;

use App\Entity\Player;
use App\Entity\PlayerHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PlayerHistoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlayerHistory::class);
    }


    /**
     * Getting the last history entry for the player
     * @param Player $player
     *
     * @return null|object
     */
    public function getLastPlayerHistory(Player $player)
    {
        return $this->findOneBy([
            'player' => $player
        ],
            ['date'=>'DESC']);
    }

    /**
     * Getting the history from 7 days ago
     * @param Player $player
     *
     * @return array
     */
    public function getLastWeek(Player $player)
    {
        $now = new \DateTime();

        $query = $this->_em->createQuery("
        SELECT ph
        FROM App\Entity\PlayerHistory ph
        WHERE ph.player = :player_id
        AND ph.date < :date
        ORDER BY ph.date DESC
        ");

        $query->setParameter('player_id' , $player->getId());
        $query->setParameter('date' , $now->modify('-7 days'));
        $query->setMaxResults(1);

        return $query->getArrayResult();
    }

    /**
     * Getting the history from 1 month ago
     * @param Player $player
     *
     * @return array
     */
    public function getLastMonth(Player $player)
    {
        $now = new \DateTime();

        $query = $this->_em->createQuery("
        SELECT ph
        FROM App\Entity\PlayerHistory ph
        WHERE ph.player = :player_id
        AND ph.date < :date
        ORDER BY ph.date DESC
        ");

        $query->setParameter('player_id' , $player->getId());
        $query->setParameter('date' , $now->modify('-1 month'));
        $query->setMaxResults(1);

        return $query->getArrayResult();
    }
}
