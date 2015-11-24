<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function getAllEnabledSortedByPublishedDate()
    {
        $em = $this->getEntityManager();

        return $em->createQueryBuilder('p')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.publishedDate', 'DESC')
            ->getQuery()->getResult();
    }
}
