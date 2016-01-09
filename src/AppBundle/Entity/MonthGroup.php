<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\DateTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * MonthGroup Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table(name="mes_en_grup")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MonthGroupRepository")
 */
class MonthGroup extends Base
{
    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return MonthGroup
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isInvoiced()
    {
        return $this->invoiced;
    }

    /**
     * @param boolean $invoiced
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
     * @return MonthGroup
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }
    use DateTrait;

    /**
     * @var float
     *
     * @ORM\Column(type="float", name="preu")
     */
    private $price;

    /**
     * @var boolean
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
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->price ? $this->getPrice().' '.$this->getCustomer() : '---';
    }


}
