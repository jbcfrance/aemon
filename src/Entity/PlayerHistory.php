<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerHistoryRepository")
 */
class PlayerHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="playerHistory")
     */
    protected $player;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", name="date")
     */
    protected $date;
    /**
     * @var int
     * @ORM\Column(type="decimal", precision=10, scale=2,  name="total_attack")
     */
    protected $totalAttack = 0;

    /**
     * @var int
     * @ORM\Column(type="decimal", precision=10, scale=2, name="total_defense")
     */
    protected $totalDefense = 0;

    /**
     * @var int
     * @ORM\Column(type="decimal", precision=10, scale=2, name="total_health")
     */
    protected $totalHealth = 0;

    /**
     * @var int
     * @ORM\Column(type="decimal", precision=10, scale=2, name="total_power")
     */
    protected $totalPower = 0;



    /**
     * @var int
     * @ORM\Column(type="decimal", precision=10, scale=2, name="total_quantity")
     */
    protected $totalQuantity = 0;

    /**
     * PlayerHistory constructor.
     *
     */
    public function __construct()
    {
        $this->date = new DateTime();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player): void
    {
        $this->player = $player;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
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
    public function getTotalHealth(): int
    {
        return $this->totalHealth;
    }

    /**
     * @param int $totalHealth
     */
    public function setTotalHealth(int $totalHealth): void
    {
        $this->totalHealth = $totalHealth;
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
    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }

    /**
     * @param int $totalQuantity
     */
    public function setTotalQuantity(int $totalQuantity): void
    {
        $this->totalQuantity = $totalQuantity;
    }





}
