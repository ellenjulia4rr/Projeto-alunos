<?php

namespace App\Repository;

use App\Entity\Aluno;
use App\Filters\AlunoFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class AlunoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aluno::class);
    }

    public function getAlunosByFilter(AlunoFilter $filter) :Query
    {
        $qb = $this->getQueryBuilderByFilter($filter);

        return $qb->getQuery();
    }

    public function getCountAlunosByFilter(AlunoFilter $filter) :array
    {
        $qb = $this->getQueryBuilderByFilter($filter);
        $qb
            ->select("count(distinct alunos.id) as qtde")
        ;

        return $qb->getQuery()->getResult();
    }

    public function countTotalAlunos(): int
    {
        return $this->createQueryBuilder('alunos')
            ->select('COUNT(alunos.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    private function getQueryBuilderByFilter(AlunoFilter $filter): QueryBuilder
    {
        $qb = $this->createQueryBuilder('alunos');

        if($filter->getName())
            $qb
                ->andWhere(
                    'alunos.name LIKE :aN')
                ->setParameter('aN', "%{$filter->getName()}%")
            ;

        if($filter->getCode())
            $qb
                ->andWhere('alunos.id = :aI')
                ->setParameter('aI', $filter->getCode())
            ;

        if($filter->getBirthDate())
            $qb
                ->andWhere('alunos.birthDate = :aBD')
                ->setParameter('aBD', $filter->getBirthDate())
            ;

        if($filter->getGender())
            $qb
                ->andWhere('alunos.gender LIKE :aG')
                ->setParameter('aG', "%{$filter->getGender()}%")
            ;

        if($filter->getPhone())
            $qb
                ->andWhere('alunos.phone LIKE :aP')
                ->setParameter('aP', "%{$filter->getPhone()}%")
            ;

        if($filter->getEmail())
            $qb
                ->andWhere('alunos.email LIKE :aE')
                ->setParameter('aE', "%{$filter->getEmail()}%")
            ;

        if($filter->getCreationDate())
            $qb
                ->andWhere('alunos.registrationDate LIKE :aR')
                ->setParameter('aR', $filter->getCreationDate()->format('Y-m-d').'%')
            ;
        if($filter->getCursos() and count($filter->getCursos()))
            $qb
                ->join('alunos.cursos', 'cursos')
                ->andWhere('cursos.id IN (:aC)')
                ->setParameter('aC', $filter->getCursos()->toArray())
            ;
        return $qb;
    }
}