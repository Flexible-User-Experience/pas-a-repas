<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phone Entity Class.
 *
 * @category Entity
 *
 * @ORM\Table(name="telefon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhoneRepository")
 */
class Phone extends Base
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="ordre", nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="tipo")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="numero")
     */
    private $number;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="phones")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * Methods.
     */

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

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
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

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
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->number ? $this->getNumber().' '.$this->getCustomer() : '---';
    }
}
