<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
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
     * @return array
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
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateWithJoin()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p, c')
            ->join('p.categories', 'c')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return array
     */
    public function getAllEnabledSortedByPublishedDateWithJoinUntilNow()
    {
        $now = new \DateTime();
        $query = $this->createQueryBuilder('p')
            ->select('p, c')
            ->join('p.categories', 'c')
            ->where('p.enabled = :enabled')
            ->andWhere('p.publishedAt <= :published')
            ->setParameter('enabled', true)
            ->setParameter('published', $now->format('Y-m-d'))
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param Category $category
     *
     * @return array
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

    /**
     * @param Category $category
     *
     * @return array
     */
    public function getPostsByCategoryEnabledSortedByPublishedDateWithJoin(Category $category)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p, c')
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

    /**
     * @param Category $category
     *
     * @return array
     */
    public function getPostsByCategoryEnabledSortedByPublishedDateWithJoinUntilNow(Category $category)
    {
        $now = new \DateTime();
        $query = $this->createQueryBuilder('p')
            ->select('p, c')
            ->join('p.categories', 'c')
            ->where('p.enabled = :enabled')
            ->andWhere('c.id = :cid')
            ->andWhere('p.publishedAt <= :published')
            ->setParameter('enabled', true)
            ->setParameter('published', $now->format('Y-m-d'))
            ->setParameter('cid', $category->getId())
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}
