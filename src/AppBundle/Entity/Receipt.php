<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Traits\DateTrait;

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
     * @ORM\Column(type="date", name="fecha_pago", nullable=true)
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
    private $import;

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
     * @var string
     *
     * @ORM\Column(type="text", length=4000, nullable=true)
     */
    private $description;

    /**
     *
     *
     * Methods
     *
     *
     */

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
    public function setPayDate(\DateTime $payDate)
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
    public function getImport()
    {
        return $this->import;
    }

    /**
     * @param float $import
     * @return Receipt
     */
    public function setImport($import)
    {
        $this->import = $import;

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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->import ? $this->getImport().' '.$this->getCustomer() : '---';
    }
}
