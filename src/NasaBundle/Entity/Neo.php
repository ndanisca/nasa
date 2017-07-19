<?php

namespace NasaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineExtensions\Query\Mysql\Date;

/**
 * Neo
 *
 * @ORM\Table(name="neo")
 * @ORM\Entity(repositoryClass="NasaBundle\Entity\NeoRepository")
 */
class Neo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="reference", type="integer")
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="speed", type="string")
     */
    private $speed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_hazardous", type="boolean")
     */
    private $isHazardous;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Neo
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     * @return Neo
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return integer 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Neo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return Neo
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsHazardous()
    {
        return $this->isHazardous;
    }

    /**
     * @param boolean $isHazardous
     *
     * @return Neo
     */
    public function setIsHazardous($isHazardous)
    {
        $this->isHazardous = $isHazardous;

        return $this;
    }
}
