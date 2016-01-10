<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ScheduleRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   David Romaní <david@flux.cat>
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
