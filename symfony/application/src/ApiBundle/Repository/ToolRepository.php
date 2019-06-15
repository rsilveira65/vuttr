<?php

namespace ApiBundle\Repository;

use ApiBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;

/**
 * Class ToolRepository
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Repository
 */
class ToolRepository extends EntityRepository
{
    /**
     * @param Tag $tag
     * @return array
     */
    public function findAllByTag(Tag $tag)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder
            ->select('t')
            ->from('ApiBundle:ToolTag', 'tt')
            ->innerJoin('t.ToolTag', 'tt')
            ->where('tt.tag = :tag')
            ->setParameter('tag', $tag);

        return $queryBuilder->getQuery()->getResult();
    }

}