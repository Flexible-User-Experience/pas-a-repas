<?php

namespace AppBundle\Repository\Old;

use Doctrine\ORM\EntityRepository;

/**
 * Class SpendingRepository
 *
 * @category Repository
 */
class SpendingRepository extends EntityRepository
{
    /**
     * @return int
     */
    public function getSpendingImportsAmount()
    {
        $query = $this->createQueryBuilder('s')
            ->select('sum(s.amount)')
            ->where('s.amount = :amount')
            ->setParameter('amount', false)
            ->getQuery();

        return count($query->getSingleResult());
    }
}
