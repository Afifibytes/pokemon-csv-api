<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Type1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Type2;

    #[ORM\Column(type: 'integer')]
    private $Total;

    #[ORM\Column(type: 'integer')]
    private $HP;

    #[ORM\Column(type: 'integer')]
    private $Attack;

    #[ORM\Column(type: 'integer')]
    private $Defense;

    #[ORM\Column(type: 'integer')]
    private $SpAtk;

    #[ORM\Column(type: 'integer')]
    private $SpDef;

    #[ORM\Column(type: 'integer')]
    private $Speed;

    #[ORM\Column(type: 'integer')]
    private $Generation;

    #[ORM\Column(type: 'boolean')]
    private $Legendary;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getType1(): ?string
    {
        return $this->Type1;
    }

    public function setType1(string $Type1): self
    {
        $this->Type1 = $Type1;

        return $this;
    }

    public function getType2(): ?string
    {
        return $this->Type2;
    }

    public function setType2(?string $Type2): self
    {
        $this->Type2 = $Type2;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->Total;
    }

    public function setTotal(int $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getHP(): ?int
    {
        return $this->HP;
    }

    public function setHP(int $HP): self
    {
        $this->HP = $HP;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->Attack;
    }

    public function setAttack(int $Attack): self
    {
        $this->Attack = $Attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->Defense;
    }

    public function setDefense(int $Defense): self
    {
        $this->Defense = $Defense;

        return $this;
    }

    public function getSpAtk(): ?int
    {
        return $this->SpAtk;
    }

    public function setSpAtk(int $SpAtk): self
    {
        $this->SpAtk = $SpAtk;

        return $this;
    }

    public function getSpDef(): ?int
    {
        return $this->SpDef;
    }

    public function setSpDef(int $SpDef): self
    {
        $this->SpDef = $SpDef;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->Speed;
    }

    public function setSpeed(int $Speed): self
    {
        $this->Speed = $Speed;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->Generation;
    }

    public function setGeneration(int $Generation): self
    {
        $this->Generation = $Generation;

        return $this;
    }

    public function isLegendary(): ?bool
    {
        return $this->Legendary;
    }

    public function setLegendary(bool $Legendary): self
    {
        $this->Legendary = $Legendary;

        return $this;
    }
}
