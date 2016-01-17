<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Customer;
use Doctrine\ORM\EntityRepository;

/**
 * Class ReceiptRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class ReceiptRepository extends EntityRepository
{
    /**
     * @param Customer $customer
     */
    public function getAmountImports(Customer $customer)
    {
        $query = $this->createQueryBuilder('r')
            ->select('sum(r.import) as total')
            ->where('r.customer = :customer')
            ->setParameter('customer', $customer)
            ->getQuery();

        return $query->getArrayResult()[0]['total'];
    }

}
