<?php

namespace App\Entity;

use App\Repository\CalculateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalculateRepository::class)]
class Calculate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $norm;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $normOfDays;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $workedOfDays;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isTaxDeduction;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isRetired;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $disabledGroup;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $month;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $year;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNorm(): ?float
    {
        return $this->norm;
    }

    public function setNorm(?float $norm): self
    {
        $this->norm = $norm;

        return $this;
    }

    public function getNormOfDays(): ?int
    {
        return $this->normOfDays;
    }

    public function setNormOfDays(?int $normOfDays): self
    {
        $this->normOfDays = $normOfDays;

        return $this;
    }

    public function getWorkedOfDays(): ?int
    {
        return $this->workedOfDays;
    }

    public function setWorkedOfDays(?int $workedOfDays): self
    {
        $this->workedOfDays = $workedOfDays;

        return $this;
    }

    public function isIsTaxDeduction(): ?bool
    {
        return $this->isTaxDeduction;
    }

    public function setIsTaxDeduction(?bool $isTaxDeduction): self
    {
        $this->isTaxDeduction = $isTaxDeduction;

        return $this;
    }

    public function isIsRetired(): ?bool
    {
        return $this->isRetired;
    }

    public function setIsRetired(?bool $isRetired): self
    {
        $this->isRetired = $isRetired;

        return $this;
    }

    public function getDisabledGroup(): ?int
    {
        return $this->disabledGroup;
    }

    public function setDisabledGroup(?int $disabledGroup): self
    {
        $this->disabledGroup = $disabledGroup;

        return $this;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(?int $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }
}
