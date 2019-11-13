<?php

namespace AppBundle\Repository\Old;

use Doctrine\ORM\EntityRepository;

/**
 * Class ReceiptRepository
 *
 * @category Repository
 */
class ReceiptRepository extends EntityRepository
{
    /**
     * @return int
     */
    public function getReceiptCollectedAmount()
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.collected = :collected')
            ->setParameter('collected', true)
            ->getQuery();

        return count($query->getResult());
    }

    /**
     * @return int
     */
    public function getReceiptNotCollectedAmount()
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.collected = :collected')
            ->setParameter('collected', false)
            ->getQuery();

        return count($query->getResult());
    }

    /**
     * @return float
     */
    public function getReceiptImportAmount()
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.collected = :collected')
            ->setParameter('collected', false)
            ->getQuery();

        return count($query->getResult());
    }
}
