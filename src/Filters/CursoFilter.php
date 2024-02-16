<?php

namespace App\Filters;

use Doctrine\Common\Collections\ArrayCollection;

class CursoFilter
{
    private ?int $code = null;
    private ?int $workload = null;
    private ?string $name = null;
    private ?string $modality = null;
    private ?ArrayCollection $alunos = null;

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): CursoFilter
    {
        $this->code = $code;
        return $this;
    }

    public function getWorkload(): ?int
    {
        return $this->workload;
    }

    public function setWorkload(?int $workload): CursoFilter
    {
        $this->workload = $workload;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): CursoFilter
    {
        $this->name = $name;
        return $this;
    }

    public function getModality(): ?string
    {
        return $this->modality;
    }

    public function setModality(?string $modality): CursoFilter
    {
        $this->modality = $modality;
        return $this;
    }

    public function getAlunos(): ?ArrayCollection
    {
        return $this->alunos;
    }

    public function setAlunos(?ArrayCollection $alunos): CursoFilter
    {
        $this->alunos = $alunos;
        return $this;
    }

}