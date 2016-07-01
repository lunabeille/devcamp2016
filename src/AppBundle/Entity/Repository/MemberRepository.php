<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use AppBundle\Entity\Member;

class MemberRepository extends EntityRepository
{
    public function findMemberById($id)
    {
        $queryBuilder = $this
            ->createQueryBuilder('m')
            ->innerJoin('m.profile', 'p')
            ->where('m.id = :id ')
            ->setParameter('id', $id)
            //le news du leftjoin
            ->addSelect('p')
        ;

        return $queryBuilder->getQuery()->getSingleResult();
    }

    public function getMembersByNameOrder()
    {
        $queryBuilder = $this
            ->createQueryBuilder('m')
            ->orderBy('m.username')
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}