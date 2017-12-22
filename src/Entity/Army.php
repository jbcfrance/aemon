<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArmyRepository")
 * @ORM\HasLifecycleCallbacks()
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
        if ($this->player !== null) {
            $this->player->removeArmy($this);
        }

        if ($player !== null) {
            $player->addArmy($this);
        }

        $this->player = $player;
        return $this;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function setUnit(Unit $unit = null)
    {
        if ($this->unit !== null) {
            $this->unit->removeArmy($this);
        }

        if ($unit !== null) {
            $unit->addArmy($this);
        }
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @ORM\PreRemove()
     * @param LifecycleEventArgs $args
     */
    public function preRemove(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Army) {
            $army = $args->getEntity();

            $army->setPlayer(null);
            $army->setUnit(null);
        }
    }






}
