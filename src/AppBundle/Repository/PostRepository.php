<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class PostRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
class PostRepository extends EntityRepository
{
    /**
     * @return ArrayCollection
     */
    public function getAllEnabledSortedByPublishedDate()
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param Category $category
     * @return ArrayCollection
     */
    public function getPostsByCategoryEnabledSortedByPublishedDate(Category $category)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.categories', 'c')
            ->where('p.enabled = :enabled')
            ->andWhere('c.id = :cid')
            ->setParameter('enabled', true)
            ->setParameter('cid', $category->getId())
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}
