<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getAllEnabledSortedByTitle()
    {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder('c')
            ->where('c.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('c.title', 'DESC')
            ->getQuery();

        return $query->getResult();
    }
}
