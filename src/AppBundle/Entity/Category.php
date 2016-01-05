<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\SlugTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category extends Base
{
    use TitleTrait;
    use SlugTrait;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="categories")
     */
    private $posts;

    /**
     *
     * Methods
     *
     */

    /**
     * Category constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Set posts
     *
     * @param ArrayCollection $posts
     *
     * @return Category
     */
    public function setPosts(ArrayCollection $posts)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * Get posts
     *
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add post
     *
     * @param Post $post
     *
     * @return Category
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param Post $post
     *
     * @return Category
     */
    public function removePost(Post $post)
    {
        $this->posts->removeElement($post);

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString() {

        return $this->title ? $this->getTitle() : '---';
    }
}
