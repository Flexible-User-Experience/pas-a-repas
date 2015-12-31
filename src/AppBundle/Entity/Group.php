<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;

/**
 * Class Group
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupRepository")
 * @ORM\Table(name="admin_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @var integer
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
}
