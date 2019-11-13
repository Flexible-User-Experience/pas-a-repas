<?php

namespace AppBundle\Repository\Old;

use Doctrine\ORM\EntityRepository;

/**
 * Class ScheduleRepository
 *
 * @category Repository
 */
class ScheduleRepository extends EntityRepository
{
    /**
     * @return int
     */
    public function getHoursMonthAmount()
    {
        $query = $this->createQueryBuilder('s')
            ->where('s.hours = :hours')
            ->setParameter('hours', true)
            ->getQuery();

        return count($query->getResult());
    }
}
