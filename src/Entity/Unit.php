<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnitRepository")
 */
class Unit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @ORM\Column(name="power",type="decimal", precision=10, scale=2)
     */
    private $power;

    /**
     * @ORM\Column(name="attack",type="integer")
     */
    private $attack;

    /**
     * @ORM\Column(name="defense",type="integer")
     */
    private $defense;

    /**
     * @ORM\Column(name="health",type="integer")
     */
    private $health;

    /**
     * @ORM\Column(name="speed",type="integer")
     */
    private $speed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitType", cascade={"persist"})
     * @ORM\JoinColumn(name="unit_type", referencedColumnName="id")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Army", mappedBy="unit", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $armies;


    public function __construct()
    {
        $this->armies = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     */
    public function setLevel( $level)
    {
        $this->level = $level;
    }

    /**
     *
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     */
    public function setPower( $power)
    {
        $this->power = $power;
    }

    /**
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     */
    public function setAttack( $attack)
    {
        $this->attack = $attack;
    }

    /**
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    /**
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param UnitType $type
     */
    public function setType(UnitType $type)
    {
        $this->type = $type;
    }

    /**
     * @return integer
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param integer $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @return integer
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param integer $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    public function getArmies()
    {
        return $this->armies->toArray();
    }

    public function addArmy(Army $army)
    {
        if (!$this->armies->contains($army)) {
            $this->armies->add($army);
        }

        return $this;
    }

    public function removeArmy(Army $army)
    {
        if ($this->armies->contains($army)) {
            $this->armies->removeElement($army);
        }

        return $this;
    }

    public function getPlayer()
    {
        return array_map(
            function ($army) {
                return $army->getPlayer();
            },
            $this->armies->toArray()
        );
    }

}
