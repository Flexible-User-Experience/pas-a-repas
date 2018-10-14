<?php

namespace AppBundle\Entity\Old;

use AppBundle\Entity\Base;
use AppBundle\Entity\Traits\DateTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * MonthGroup Entity Class.
 *
 * @category Entity
 *
 * @ORM\Table(name="mes_en_grup")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Old\MonthGroupRepository")
 */
class MonthGroup extends Base
{
    use DateTrait;

    /**
     * @var float
     *
     * @ORM\Column(type="float", name="preu")
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", name="facturat", nullable=true)
     */
    private $invoiced;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="monthgroups")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * Methods.
     */

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return MonthGroup
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return bool
     */
    public function isInvoiced()
    {
        return $this->invoiced;
    }

    /**
     * @param bool $invoiced
     *
     * @return MonthGroup
     */
    public function setInvoiced($invoiced)
    {
        $this->invoiced = $invoiced;

        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     *
     * @return MonthGroup
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->price ? $this->getPrice().' '.$this->getCustomer() : '---';
    }
}
