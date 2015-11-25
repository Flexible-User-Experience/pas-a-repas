<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getAllEnabledSortedByTitle()
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('c.title', 'DESC')
            ->getQuery();

        return $query->getResult();
    }

    public function getDetailBySlug()
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.title = :slug')
            ->setParameter('slug')
            ->getQuery();

        return $query->getResult();
    }
}
