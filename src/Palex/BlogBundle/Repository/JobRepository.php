<?php

namespace Palex\BlogBundle\Repository;

/**
 * JobRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class JobRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllJobs()
    {
        $allJobs = $this->createQueryBuilder('j')
            ->select('j.id, j.name, j.description, c.name as category_name')
            ->leftJoin('j.category', 'c')
            ->orderBy('j.name', 'ASC')
            ->getQuery()
            ->getResult();
        return $allJobs;
    }

    public function findJob($id)
    {
        $job = $this->createQueryBuilder('j')
            ->select('j.id, j.name, j.description')
            ->leftJoin('j.category', 'c')
            ->orderBy('j.name', 'ASC')
            ->getQuery()
            ->getResult();
        return $job;
    }
}
