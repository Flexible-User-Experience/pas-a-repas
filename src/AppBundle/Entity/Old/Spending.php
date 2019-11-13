<?php

namespace AppBundle\Entity\Old;

use AppBundle\Entity\Base;
use AppBundle\Entity\Traits\DateTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Spending.
 *
 * @category Entity
 *
 * @ORM\Table(name="despesa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Old\SpendingRepository")
 */
class Spending extends Base
{
    use DateTrait;

    /**
     * @var float
     *
     * @ORM\Column(type="float", name="quantitat", nullable=false)
     */
    private $amount;

    /**
     * @var SpendingCategory
     *
     * @ORM\ManyToOne(targetEntity="SpendingCategory", inversedBy="spendings")
     */
    private $spendingCategory;

    /**
     * Methods.
     */

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return SpendingCategory
     */
    public function getSpendingCategory()
    {
        return $this->spendingCategory;
    }

    /**
     * @param SpendingCategory $spendingCategory
     *
     * @return $this
     */
    public function setSpendingCategory($spendingCategory)
    {
        $this->spendingCategory = $spendingCategory;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->amount ? $this->getAmount().' '.$this->getSpendingCategory() : '---';
    }
}
