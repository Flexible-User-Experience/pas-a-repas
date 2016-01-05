<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CategoryRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
 */
class CategoryRepository extends EntityRepository
{
    public function getAllSortedByTitleQB()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.title', 'ASC');
    }

    public function getAllEnabledSortedByTitle()
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('c.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}
