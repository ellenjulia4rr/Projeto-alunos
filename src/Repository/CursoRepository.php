<?php

namespace App\Repository;

use App\Entity\Curso;
use App\Filters\CursoFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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

    public function getCursosByFilter(CursoFilter $filter): array
    {
        $qb = $this->getQueryBuilderByFilter($filter);

        return $qb->getQuery()->getResult();
    }

    public function countTotalCursos(): int
    {
        return $this->createQueryBuilder('cursos')
            ->select('COUNT(cursos.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function getCountCursosByFilter(CursoFilter $filter) :array
    {
        $qb = $this->getQueryBuilderByFilter($filter);
        $qb
            ->select('count(distinct cursos.id) as qtde')
        ;
        return $qb->getQuery()->getResult();
    }

    public function findCursosMaisRealizados()
    {
        return $this->createQueryBuilder('cursos')
            ->select('cursos, COUNT(alunos.id) as alunosCount')
            ->leftJoin('cursos.alunos', 'alunos')
            ->groupBy('cursos.id')
            ->having('alunosCount >= 2')
            ->orderBy('alunosCount', 'DESC')
            ->setMaxResults(15)
            ->getQuery()->getResult();
    }

    private function getQueryBuilderByFilter(CursoFilter $filter): QueryBuilder
    {
        $qb = $this->createQueryBuilder('cursos');

        if ($filter->getName())
            $qb
                ->andWhere($qb->expr()->orX(
                    'cursos.courseName LIKE :cN',
                    'cursos.id LIKE :cN'
                ))
                ->setParameter('cN', "%{$filter->getName()}%");

        if ($filter->getModality())
            $qb
                ->andWhere('cursos.modality LIKE :cM')
                ->setParameter('cM', "%{$filter->getModality()}%");

        if ($filter->getCode())
            $qb
                ->andWhere('cursos.id = :cC')
                ->setParameter('cC', $filter->getCode());

        if ($filter->getWorkload())
            $qb
                ->andWhere('cursos.workload = :cW')
                ->setParameter('cW', $filter->getWorkload());

        if ($filter->getAlunos() and count($filter->getAlunos()))
            $qb
                ->join('cursos.alunos', 'alunos')
                ->andWhere('alunos.id IN (:aI)')
                ->setParameter('aI', $filter->getAlunos()->toArray());

        return $qb;
    }
}
