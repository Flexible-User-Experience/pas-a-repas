<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * SpendingCategory
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table(name="categoria_despesa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpendingCategoryRepository")
 */
class SpendingCategory extends Base
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Spending", mappedBy="spendingCategory")
     */
    private $spendings;

    /**
     *
     * Methods
     *
     */

    /**
     * Category constructor
     */
    public function __construct()
    {
        $this->spendings = new ArrayCollection();
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
     * @return SpendingCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSpendings()
    {
        return $this->spendings;
    }

    /**
     * @param ArrayCollection $spendings
     * @return SpendingCategory
     */
    public function setSpendings($spendings)
    {
        $this->spendings = $spendings;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->getName() == null) {

            return '---';

        } else {

            return $this->getName();
        }
    }
}
