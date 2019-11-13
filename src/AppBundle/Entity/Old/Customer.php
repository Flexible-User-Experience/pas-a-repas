<?php

namespace AppBundle\Entity\Old;

use AppBundle\Entity\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Customer.
 *
 * @category Entity
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Old\CustomerRepository")
 */
class Customer extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="cognoms", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="pare", type="string", length=255, nullable=true)
     */
    private $father;

    /**
     * @var string
     *
     * @ORM\Column(name="mare", type="string", length=255, nullable=true)
     */
    private $mother;

    /**
     * @var string
     *
     * @ORM\Column(name="adreca", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="poblacio", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="curs", type="string", length=255, nullable=true)
     */
    private $course;

    /**
     * @var string
     *
     * @ORM\Column(name="centre", type="string", length=255, nullable=true)
     */
    private $school;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email(strict=true, checkMX=true, checkHost=true)
     */
    private $email;

    /**
     * @var float
     *
     * @ORM\Column(name="preu_hora_particular", type="float", nullable=true)
     */
    private $priceHourSingle = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="preu_mensual_en_grup", type="float", nullable=true)
     */
    private $priceHourGroup = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="classes_particulars", type="boolean")
     */
    private $singleClasses = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="classes_en_grup", type="boolean")
     */
    private $groupClasses = true;

    /**
     * @var string
     *
     * @ORM\Column(name="anotacions", type="text", length=4000, nullable=true)
     */
    private $annotations;

    /**
     * @var bool
     *
     * @ORM\Column(name="actiu", type="boolean")
     */
    protected $enabled = true;

    /**
     * @var int
     */
    private $totalAmount;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="customer")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $phones;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MonthGroup", mappedBy="customer")
     */
    private $monthgroups;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="HourSingle", mappedBy="customer")
     */
    private $hoursingles;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Receipt", mappedBy="customer")
     */
    private $receipts;

    /**
     * Methods.
     */

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->monthgroups = new ArrayCollection();
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $surname
     *
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $father
     *
     * @return $this
     */
    public function setFather($father)
    {
        $this->father = $father;

        return $this;
    }

    /**
     * @return string
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * @param string $mother
     *
     * @return $this
     */
    public function setMother($mother)
    {
        $this->mother = $mother;

        return $this;
    }

    /**
     * @return string
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $postalCode
     *
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $course
     *
     * @return $this
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param string $school
     *
     * @return $this
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param float $priceHourSingle
     *
     * @return $this
     */
    public function setPriceHourSingle($priceHourSingle)
    {
        $this->priceHourSingle = $priceHourSingle;

        return $this;
    }

    /**
     * @return float
     */
    public function getPriceHourSingle()
    {
        return $this->priceHourSingle;
    }

    /**
     * @param float $priceHourGroup
     *
     * @return $this
     */
    public function setPriceHourGroup($priceHourGroup)
    {
        $this->priceHourGroup = $priceHourGroup;

        return $this;
    }

    /**
     * @return float
     */
    public function getPriceHourGroup()
    {
        return $this->priceHourGroup;
    }

    /**
     * @param bool $singleClasses
     *
     * @return $this
     */
    public function setSingleClasses($singleClasses)
    {
        $this->singleClasses = $singleClasses;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSingleClasses()
    {
        return $this->singleClasses;
    }

    /**
     * @param bool $groupClasses
     *
     * @return $this
     */
    public function setGroupClasses($groupClasses)
    {
        $this->groupClasses = $groupClasses;

        return $this;
    }

    /**
     * @return bool
     */
    public function getGroupClasses()
    {
        return $this->groupClasses;
    }

    /**
     * @param string $annotations
     *
     * @return $this
     */
    public function setAnnotations($annotations)
    {
        $this->annotations = $annotations;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnnotations()
    {
        return $this->annotations;
    }

    /**
     * @return int
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     *
     * @return $this
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param ArrayCollection $phones
     *
     * @return $this
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getMonthgroups()
    {
        return $this->monthgroups;
    }

    /**
     * @param ArrayCollection $monthgroups
     *
     * @return $this
     */
    public function setMonthgroups($monthgroups)
    {
        $this->monthgroups = $monthgroups;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getHoursingles()
    {
        return $this->hoursingles;
    }

    /**
     * @param ArrayCollection $hoursingles
     *
     * @return $this
     */
    public function setHoursingles($hoursingles)
    {
        $this->hoursingles = $hoursingles;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getReceipts()
    {
        return $this->receipts;
    }

    /**
     * @param ArrayCollection $receipts
     *
     * @return $this
     */
    public function setReceipts($receipts)
    {
        $this->receipts = $receipts;

        return $this;
    }

    /**
     * @param Phone $phone
     */
    public function addPhone(Phone $phone)
    {
        $this->phones->add($phone);
    }

    /**
     * @param Phone $phone
     */
    public function removePhone(Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * @param MonthGroup $monthGroup
     */
    public function addMonthGroup(MonthGroup $monthGroup)
    {
        $this->monthgroups->add($monthGroup);
    }

    /**
     * @param MonthGroup $monthGroup
     */
    public function removeMonthGroup(MonthGroup $monthGroup)
    {
        $this->monthgroups->removeElement($monthGroup);
    }

    /**
     * @param HourSingle $hourSingle
     */
    public function addHourSingle(HourSingle $hourSingle)
    {
        $this->hoursingles->add($hourSingle);
    }

    /**
     * @param HourSingle $hourSingle
     */
    public function removeHourSingle(HourSingle $hourSingle)
    {
        $this->hoursingles->removeElement($hourSingle);
    }

    /**
     * @param Receipt $receipt
     */
    public function addReceipt(Receipt $receipt)
    {
        $this->receipts->add($receipt);
    }

    /**
     * @param Receipt $receipt
     */
    public function removeReceipt(Receipt $receipt)
    {
        $this->receipts->removeElement($receipt);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name ? $this->getName().' '.$this->getSurname() : '---';
    }
}
