<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;


#[ORM\Entity]
#[ORM\Table(name: 'matriculas')]
class Matricula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: Aluno::class)]
    #[JoinColumn(name: 'aluno_id', referencedColumnName: 'id')]
    private Aluno $aluno;

    #[ORM\Column]
    private \DateTime $startDate;

    #[ORM\Column]
    private \DateTime $endDate;

    #[ORM\Column]
    private int $status = 1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Matricula
    {
        $this->id = $id;
        return $this;
    }

    public function getAluno(): Aluno
    {
        return $this->aluno;
    }

    public function setAluno(Aluno $aluno): Matricula
    {
        $this->aluno = $aluno;
        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): Matricula
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): Matricula
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): Matricula
    {
        $this->status = $status;
        return $this;
    }
}