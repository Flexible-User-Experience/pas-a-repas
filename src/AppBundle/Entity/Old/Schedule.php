<?php

namespace AppBundle\Entity\Old;

use AppBundle\Entity\Base;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Schedule.
 *
 * @category Entity
 *
 * @ORM\Table(name="parte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Old\ScheduleRepository")
 * @UniqueEntity("date")
 */
class Schedule extends Base
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", name="fecha", nullable=true, unique=true)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="hores", type="float", nullable=true)
     */
    private $hours = 0;

    /**
     * Methods.
     */

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param float $hours
     *
     * @return $this
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * @return float
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @return string
     */
    public function getDateString()
    {
        return $this->getDate()->format('d/m/Y');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->date ? $this->getDateString().' · '.$this->getHours() : '---';
    }
}
