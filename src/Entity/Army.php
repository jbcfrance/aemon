<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArmyRepository")
 */
class Army
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="armies")
     * @ORM\JoinColumn(name="army_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $player;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unit", inversedBy="armies")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $unit;

    /**
     * @ORM\Column(type="integer", name="quantity")
     */
    private $quantity;

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

    public function getPlayer()
    {
        return $this->player;
    }

    public function setPlayer(Player $player = null)
    {
        $this->player = $player;
        return $this;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function setUnit(Unit $unit = null)
    {
        $this->unit = $unit;
        return $this;
    }
}
