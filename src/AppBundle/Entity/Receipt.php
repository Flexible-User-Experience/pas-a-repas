<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\DateTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Receipt Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table(name="rebut")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReceiptRepository")
 */
class Receipt extends Base
{
    use DateTrait;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", name="fecha_pago", nullable=true)
     */
    private $payDate;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="tipo")
     */
    private $type;


    /**
     * @var float
     *
     * @ORM\Column(type="float", name="import")
     */
    private $amount;

    /**
     * @var int
     *
     * @ORM\Column(type="boolean", name="cobrat", nullable=true)
     */
    private $collected;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="receipts")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $customer;


     /**
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->amount ? $this->getAmount().' '.$this->getCustomer() : '---';
    }

    /**
     * @return \DateTime
     */
    public function getPayDate()
    {
        return $this->payDate;
    }

    /**
     * @param \DateTime $payDate
     * @return Receipt
     */
    public function setPayDate($payDate)
    {
        $this->payDate = $payDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Receipt
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Receipt
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
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
     * @return Receipt
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return int
     */
    public function getCollected()
    {
        return $this->collected;
    }

    /**
     * @param int $collected
     * @return Receipt
     */
    public function setCollected($collected)
    {
        $this->collected = $collected;
        return $this;
    }

}
