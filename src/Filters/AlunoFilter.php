<?php

namespace App\Filters;

class AlunoFilter
{
    private ?int $code = null;
    private ?string $name = null;
    private ?\DateTime $birthDate = null;
    private ?string $gender = null;
    private ?string $phone = null;
    private ?string $email = null;
    private ?\DateTime $creationDate = null;

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
}