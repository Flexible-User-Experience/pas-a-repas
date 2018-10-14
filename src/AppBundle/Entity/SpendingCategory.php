<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SpendingCategory.
 *
 * @category Entity
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
     * Methods.
     */

    /**
     * SpendingCategory constructor.
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
     *
     * @return $this
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
     *
     * @return $this
     */
    public function setSpendings($spendings)
    {
        $this->spendings = $spendings;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return null == $this->getName() ? '---' : $this->getName();
    }
}
