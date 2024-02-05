<?php

namespace App\Filters;

class CursoFilter
{
    private ?int $code = null;
    private ?int $workload = null;
    private ?string $name = null;
    private ?string $modality = null;

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

}