<?php

namespace App\Repository;

use App\Entity\Aluno;
use App\Filters\AlunoFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AlunoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aluno::class);
    }

    public function getAlunosByFilter(AlunoFilter $filter) :array
    {
        $qb = $this->createQueryBuilder('alunos');

        if($filter->getName())
            $qb
                ->andWhere('alunos.name LIKE :aN')
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
                ->andWhere('alunos.registrationDate = :aR')
                ->setParameter('aR', $filter->getCreationDate() )
            ;

        return $qb->getQuery()->getResult();
    }
}