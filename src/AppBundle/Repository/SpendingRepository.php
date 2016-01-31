<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Spending;
use Doctrine\ORM\EntityRepository;

/**
 * Class SpendingRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class SpendingRepository extends EntityRepository
{
    /**
     * @param Spending $amount
     */
    public function getAmountImports(Spending $amount)
    {
        $query = $this->createQueryBuilder('s')
            ->select('sum(s.amount) as total')
            ->where('s.spendingCategory = :spendingCategory')
            ->setParameter('amount', $amount)
            ->getQuery();

        return $query->getArrayResult()[0]['total'];
    }
}
