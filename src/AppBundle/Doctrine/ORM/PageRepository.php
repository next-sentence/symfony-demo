<?php

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity\Page;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{
    /**
     * @param $permalink
     * @return Page
     */
    public function findForDetails($permalink)
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->leftJoin('o.blocks', 'blocks')
            ->addSelect('blocks')
            ->andWhere($queryBuilder->expr()->eq('o.permalink', ':permalink'))
            ->setParameter('permalink', $permalink)
        ;

        $result = $queryBuilder
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return $result;
    }
}