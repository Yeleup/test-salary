<?php

namespace App\Entity;

use App\Repository\SalaryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaryRepository::class)]
class Salary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $salaryInHand;

    #[ORM\Column(type: 'float')]
    private $opv;

    #[ORM\Column(type: 'float')]
    private $vosms;

    #[ORM\Column(type: 'float')]
    private $osms;

    #[ORM\Column(type: 'float')]
    private $so;

    #[ORM\Column(type: 'float')]
    private $adjustment;

    #[ORM\Column(type: 'float')]
    private $ipn;

    #[ORM\OneToOne(targetEntity: Calculate::class, cascade: ['persist', 'remove'])]
    private $calculate;

    public function getSalaryInHand(): ?float
    {
        return $this->salaryInHand;
    }

    public function setSalaryInHand(float $salaryInHand): self
    {
        $this->salaryInHand = $salaryInHand;

        return $this;
    }

    public function getOpv(): ?float
    {
        return $this->opv;
    }

    public function setOpv(float $opv): self
    {
        $this->opv = $opv;

        return $this;
    }

    public function getVosms(): ?float
    {
        return $this->vosms;
    }

    public function setVosms(float $vosms): self
    {
        $this->vosms = $vosms;

        return $this;
    }

    public function getOsms(): ?float
    {
        return $this->osms;
    }

    public function setOsms(float $osms): self
    {
        $this->osms = $osms;

        return $this;
    }

    public function getSo(): ?float
    {
        return $this->so;
    }

    public function setSo(float $so): self
    {
        $this->so = $so;

        return $this;
    }

    public function getAdjustment(): ?float
    {
        return $this->adjustment;
    }

    public function setAdjustment(float $adjustment): self
    {
        $this->adjustment = $adjustment;

        return $this;
    }

    public function getIpn(): ?float
    {
        return $this->ipn;
    }

    public function setIpn(float $ipn): self
    {
        $this->ipn = $ipn;

        return $this;
    }

    public function getCalculate(): ?Calculate
    {
        return $this->calculate;
    }

    public function setCalculate(?Calculate $calculate): self
    {
        $this->calculate = $calculate;

        return $this;
    }
}
