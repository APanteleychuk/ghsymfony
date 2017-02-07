<?php

namespace Palex\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
    public function findComments($postId)
    {
        $query = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.post = :post_id')
            ->orderBy('c.createdAt')
            ->setParameter('post_id', $postId);

        return $query->getQuery()->getResult();
    }
}
