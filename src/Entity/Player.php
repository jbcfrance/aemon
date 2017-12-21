<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Army", mappedBy="player", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $armies;

    /**
     * Unit constructor.
     *
     */
    public function __construct()
    {
        $this->armies = new ArrayCollection();
    }



    public function getArmies()
    {
        return $this->armies->toArray();
    }

    public function addArmy(Army $army)
    {
        if (!$this->armies->contains($army)) {
            $this->armies->add($army);
            $army->setArmy($this);
        }

        return $this;
    }

    public function removeArmy(Army $army)
    {
        if ($this->armies->contains($army)) {
            $this->armies->removeElement($army);
            $army->setArmy(null);
        }

        return $this;
    }

    public function getUnits()
    {
        return array_map(
            function ($army) {
                return $army->getUnits();
            },
            $this->armies->toArray()
        );
    }
}
