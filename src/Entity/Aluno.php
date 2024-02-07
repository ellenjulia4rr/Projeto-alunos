<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\PersistentCollection;
use App\Repository\AlunoRepository;

#[ORM\Entity(AlunoRepository::class)]
#[ORM\Table(name: 'alunos')]
class Aluno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private \DateTime $birthDate;

    #[ORM\Column(length:20)]
    private string $gender;

    #[ORM\Column(length:15)]
    private string $phone;

    #[ORM\Column(length:255)]
    private string $email;

    #[ORM\Column]
    private \DateTime $registrationDate;

    #[ManyToMany(targetEntity: Curso::class, inversedBy: 'alunos')]
    #[JoinTable(name: 'alunos_cursos')]
    private ArrayCollection | PersistentCollection |null $cursos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Aluno
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Aluno
    {
        $this->name = $name;
        return $this;
    }

    public function getBirthDate(): \DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTime $birthDate): Aluno
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getGenderName(): string
    {
        switch ($this->gender) {
            case 'FEMININO':
                return 'Feminino';
            case 'MASCULINO':
                return 'Masculino';
            default:
                return 'Outro';
        }
    }

    public function setGender(string $gender): Aluno
    {
        $this->gender = $gender;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): Aluno
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Aluno
    {
        $this->email = $email;
        return $this;
    }

    public function getRegistrationDate(): \DateTime
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTime $registrationDate): Aluno
    {
        $this->registrationDate = $registrationDate;
        return $this;
    }

    public function getCursos(): ArrayCollection | PersistentCollection | null
    {
        return $this->cursos;
    }

    public function setCursos(ArrayCollection | PersistentCollection | null $cursos): Aluno
    {
        $this->cursos = $cursos;
        return $this;
    }
}