<?php

namespace Palex\BlogBundle\Repository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllCategory()
    {
         $allCategories = $this->createQueryBuilder('c')
            ->select('c.id, c.name, c.description')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();
        return $allCategories;
    }
}
