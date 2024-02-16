<?php

namespace App\Filters;

use App\Entity\Curso;
use Doctrine\Common\Collections\ArrayCollection;

class AlunoFilter
{
    private ?int $code = null;
    private ?string $name = null;
    private ?\DateTime $birthDate = null;
    private ?string $gender = null;
    private ?string $phone = null;
    private ?string $email = null;
    private ?\DateTime $creationDate = null;
    private ?ArrayCollection $cursos = null;
    private $conditions = [];

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): AlunoFilter
    {
        $this->code = $code;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): AlunoFilter
    {
        $this->name = $name;
        return $this;
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTime $birthDate): AlunoFilter
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): AlunoFilter
    {
        $this->gender = $gender;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): AlunoFilter
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): AlunoFilter
    {
        $this->email = $email;
        return $this;
    }

    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTime $creationDate): AlunoFilter
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function getCursos(): ?ArrayCollection
    {
        return $this->cursos;
    }

    public function setCursos(?ArrayCollection $cursos): AlunoFilter
    {
        $this->cursos = $cursos;
        return $this;
    }

    public function getConditions(): array
    {
        return $this->conditions;
    }

    public function setConditions(array $conditions): AlunoFilter
    {
        $this->conditions = $conditions;
        return $this;
    }
}