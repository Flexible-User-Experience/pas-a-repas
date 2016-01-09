<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Customer
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
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
     * @Assert\Email(strict = true, checkMX = true, checkHost = true)
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
     * @var boolean
     *
     * @ORM\Column(name="classes_particulars", type="boolean")
     */
    private $singleClasses = false;

    /**
     * @var boolean
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
     * @var boolean
     *
     * @ORM\Column(name="actiu", type="boolean")
     */
    protected $enabled = true;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="customer")
     */
    private $phones;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MonthGroup", mappedBy="customer")
     */
    private $monthgroups;

    /**
     * @return ArrayCollection
     */
    public function getMonthgroups()
    {
        return $this->monthgroups;
    }

    /**
     * @param ArrayCollection $monthgroups
     * @return Customer
     */
    public function setMonthgroups($monthgroups)
    {
        $this->monthgroups = $monthgroups;
        return $this;
    }

    /**
     *
     * Methods
     *
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
     * Set Name
     *
     * @param string $name
     *
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Surname
     *
     * @param string $surname
     *
     * @return Customer
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get Surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set Father
     *
     * @param string $father
     *
     * @return Customer
     */
    public function setFather($father)
    {
        $this->father = $father;

        return $this;
    }

    /**
     * Get Father
     *
     * @return string
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * Set Mother
     *
     * @param string $mother
     *
     * @return Customer
     */
    public function setMother($mother)
    {
        $this->mother = $mother;

        return $this;
    }

    /**
     * Get Mother
     *
     * @return string
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * Set Address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get Address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set City
     *
     * @param string $city
     *
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get City
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set PostalCode
     *
     * @param string $postalCode
     *
     * @return Customer
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get PostalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set Course
     *
     * @param string $course
     *
     * @return Customer
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get Course
     *
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set School
     *
     * @param string $school
     *
     * @return Customer
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get School
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set Email
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set PriceHourSingle
     *
     * @param float $priceHourSingle
     *
     * @return Customer
     */
    public function setPriceHourSingle($priceHourSingle)
    {
        $this->priceHourSingle = $priceHourSingle;

        return $this;
    }

    /**
     * Get PriceHourSingle
     *
     * @return float
     */
    public function getPriceHourSingle()
    {
        return $this->priceHourSingle;
    }

    /**
     * Set PriceHourGroup
     *
     * @param float $priceHourGroup
     *
     * @return Customer
     */
    public function setPriceHourGroup($priceHourGroup)
    {
        $this->priceHourGroup = $priceHourGroup;

        return $this;
    }

    /**
     * Get PriceHourGroup
     *
     * @return float
     */
    public function getPriceHourGroup()
    {
        return $this->priceHourGroup;
    }

    /**
     * Set SingleClasses
     *
     * @param boolean $singleClasses
     *
     * @return Customer
     */
    public function setSingleClasses($singleClasses)
    {
        $this->singleClasses = $singleClasses;

        return $this;
    }

    /**
     * Get SingleClasses
     *
     * @return boolean
     */
    public function getSingleClasses()
    {
        return $this->singleClasses;
    }

    /**
     * Set GroupClasses
     *
     * @param boolean $groupClasses
     *
     * @return Customer
     */
    public function setGroupClasses($groupClasses)
    {
        $this->groupClasses = $groupClasses;

        return $this;
    }

    /**
     * Get GroupClasses
     *
     * @return boolean
     */
    public function getGroupClasses()
    {
        return $this->groupClasses;
    }

    /**
     * Set Annotations
     *
     * @param string $annotations
     *
     * @return Customer
     */
    public function setAnnotations($annotations)
    {
        $this->annotations = $annotations;

        return $this;
    }

    /**
     * Get Annotations
     *
     * @return string
     */
    public function getAnnotations()
    {
        return $this->annotations;
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
     * @return Customer
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
        return $this;
    }

    public function addPhone(Phone $phone)
    {
        $this->phones->add($phone);
    }

    public function removePhone(Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    public function addMonthGroup(MonthGroup $monthGroup)
    {
        $this->monthgroups->add($monthGroup);
    }

    public function removeMonthGroup(MonthGroup $monthGroup)
    {
        $this->monthgroups->removeElement($monthGroup);
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->name ? $this->getName() . ' ' . $this->getSurname() : '---';
    }
}
