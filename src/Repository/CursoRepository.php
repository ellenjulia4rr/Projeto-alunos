<?php

namespace App\Repository;

use App\Entity\Curso;
use App\Filters\CursoFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Curso|null find($id, $lockMode = null, $lockVersion = null)
 * @method Curso|null findOneBy(array $criteria, array $orderBy = null)
 * @method Curso[] findAll()
 * @method Curso[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Curso::class);
    }

    public function getCursosByFilter(CursoFilter $filter) : array
    {
        $qb = $this->createQueryBuilder('cursos');

        if($filter->getName())
            $qb
                ->andWhere('cursos.courseName LIKE :cN' )
                ->setParameter('cN', "%{$filter->getName()}%")
            ;

        if($filter->getModality())
            $qb
                ->andWhere('cursos.modality LIKE :cM')
                ->setParameter('cM', "%{$filter->getModality()}%")
            ;

        if($filter->getCode())
            $qb
                ->andWhere('cursos.id = :cC')
                ->setParameter('cC', $filter->getCode())
            ;

        if($filter->getWorkload())
            $qb
                ->andWhere('cursos.workload = :cW')
                ->setParameter('cW', $filter->getWorkload())
            ;

        return $qb->getQuery()->getResult();
    }
}
