<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\DateTrait;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Spending
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table(name="despesa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpendingRepository")
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
     *
     * Methods
     *
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
     * @return Spending
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
     * @return Spending
     */
    public function setSpendingCategory($spendingCategory)
    {
        $this->spendingCategory = $spendingCategory;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->amount ? $this->getAmount().' '.$this->getSpendingCategory() : '---';
    }
}
