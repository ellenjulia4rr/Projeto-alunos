<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\PersistentCollection;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
#[ORM\Table(name: 'cursos')]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private string $courseName;

    #[ORM\Column]
    private int $workload;

    #[ORM\Column(length:20)]
    private string $modality;

    #[ManyToMany(targetEntity: Aluno::class, inversedBy: 'cursos')]
    #[JoinTable(name: 'alunos_cursos')]
    private ArrayCollection | PersistentCollection | null $alunos;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Curso
    {
        $this->id = $id;
        return $this;
    }

    public function getCourseName(): string
    {
        return $this->courseName;
    }

    public function setCourseName(string $courseName): Curso
    {
        $this->courseName = $courseName;
        return $this;
    }

    public function getWorkload(): int
    {
        return $this->workload;
    }

    public function setWorkload(int $workload): Curso
    {
        $this->workload = $workload;
        return $this;
    }

    public function getModality(): string
    {
        return $this->modality;
    }

    public function getModalityName(): string
    {
        switch ($this->modality) {
            case 'PRESENCIAL':
                return 'Presencial';
            default:
                return 'Online';
        }
    }

    public function setModality(string $modality): Curso
    {
        $this->modality = $modality;
        return $this;
    }

    public function getAlunos(): ArrayCollection | PersistentCollection | null
    {
        return $this->alunos;
    }

    public function setAlunos(ArrayCollection | PersistentCollection | null $alunos): Curso
    {
        $this->alunos = $alunos;
        return $this;
    }
}