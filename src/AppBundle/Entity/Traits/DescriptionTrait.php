<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description trait.
 *
 * @category Trait
 */
trait DescriptionTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="text", length=4000)
     */
    private $description;

    /**
     * Methods.
     */

    /**
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
