<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\DateTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Schedule
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Table(name="parte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScheduleRepository")
 */
class Schedule extends Base
{
    use DateTrait;

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
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->date ? $this->getDateString() . ' · ' . $this->getHours() : '---';
    }
}
