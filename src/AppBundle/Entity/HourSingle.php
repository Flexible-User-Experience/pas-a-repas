<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\DateTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * HourSingle Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table(name="hora_particular")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HourSingleRepository")
 */
class HourSingle extends Base
{
    use DateTrait;

    /**
     * @var float
     *
     * @ORM\Column(type="float", name="quantitat")
     */
    private $amount;


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
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="hoursingles")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return HourSingle
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

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

     /**
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->price ? $this->getPrice().' '.$this->getCustomer() : '---';
    }

}
