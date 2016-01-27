<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Schedule
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Table(name="parte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScheduleRepository")
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
     *
     * Methods
     *
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
     * @return Schedule
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set Hours
     *
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
     * Get Hours
     *
     * @return float
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Get Date
     *
     * @return string
     */
    public function getDateString()
    {
        return $this->getDate()->format('d/m/Y');
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->date ? $this->getDateString() . ' · ' . $this->getHours() : '---';
    }
}
