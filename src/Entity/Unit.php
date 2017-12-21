<?php

namespace App\Entity;

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
     * @ORM\Column(name="pouvoir",type="decimal", precision=10, scale=2)
     */
    private $pouvoir;

    /**
     * @ORM\Column(name="attaque",type="integer")
     */
    private $attaque;

    /**
     * @ORM\Column(name="defense",type="integer")
     */
    private $defense;

    /**
     * @ORM\Column(name="sante",type="integer")
     */
    private $sante;

    /**
     * @ORM\Column(name="vitesse",type="integer")
     */
    private $vitesse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitType", cascade={"persist"})
     * @ORM\JoinColumn(name="unit_type", referencedColumnName="id")
     */
    private $type;

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
    public function getPouvoir()
    {
        return $this->pouvoir;
    }

    /**
     */
    public function setPouvoir( $pouvoir)
    {
        $this->pouvoir = $pouvoir;
    }

    /**
     */
    public function getAttaque()
    {
        return $this->attaque;
    }

    /**
     */
    public function setAttaque( $attaque)
    {
        $this->attaque = $attaque;
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
    public function getSante()
    {
        return $this->sante;
    }

    /**
     * @param integer $sante
     */
    public function setSante($sante)
    {
        $this->sante = $sante;
    }

    /**
     * @return integer
     */
    public function getVitesse()
    {
        return $this->vitesse;
    }

    /**
     * @param integer $vitesse
     */
    public function setVitesse($vitesse)
    {
        $this->vitesse = $vitesse;
    }



}
