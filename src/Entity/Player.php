<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="link")
     */
    private $link;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Army", mappedBy="player", cascade={"persist", "remove"}, orphanRemoval=TRUE, fetch="EAGER")
     */
    protected $armies;

    /**
     * @ORM\Column(type="datetime", name="created")
     */
    protected $created;

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
     * @ORM\OneToMany(targetEntity="App\Entity\PlayerHistory", mappedBy="player")
     */
    private $playerHistory;


    /**
     * Unit constructor.
     *
     */
    public function __construct()
    {
        $this->armies = new ArrayCollection();
        $this->created = new DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * @return array
     */
    public function getArmies()
    {
        return $this->armies->toArray();
    }

    /**
     * @param Army $army
     *
     * @return $this
     */
    public function addArmy(Army $army)
    {
        if (!$this->armies->contains($army)) {
            $this->armies->add($army);
        }

        return $this;
    }

    /**
     * @param Army $army
     *
     * @return $this
     */
    public function removeArmy(Army $army)
    {
        if ($this->armies->contains($army)) {
            $this->armies->removeElement($army);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getUnits()
    {
        return array_map(
            function ($army) {
                return $army->getUnits();
            },
            $this->armies->toArray()
        );
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
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
