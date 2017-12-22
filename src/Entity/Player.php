<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(type="string", name="link")
     */
    private $link;

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
}
