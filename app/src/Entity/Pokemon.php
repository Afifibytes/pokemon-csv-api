<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;
use PokemonTypes;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $serial;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $type1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type2;

    #[ORM\Column(type: 'integer')]
    private $total;

    #[ORM\Column(type: 'integer')]
    private $hp;

    #[ORM\Column(type: 'integer')]
    private $attack;

    #[ORM\Column(type: 'integer')]
    private $defense;

    #[ORM\Column(type: 'integer')]
    private $spAtk;

    #[ORM\Column(type: 'integer')]
    private $spDef;

    #[ORM\Column(type: 'integer')]
    private $speed;

    #[ORM\Column(type: 'integer')]
    private $generation;

    #[ORM\Column(type: 'boolean')]
    private $legendary;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerial(): ?int
    {
        return $this->serial;
    }

    public function setSerial(int $serial): self
    {
        $this->serial = $serial;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType1(): ?string
    {
        return $this->type1;
    }

    public function setType1(string $type1): self
    {
        $this->type1 = $type1;

        return $this;
    }

    public function getType2(): ?string
    {
        return $this->type2;
    }

    public function setType2(?string $type2): self
    {
        $this->type2 = $type2;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getHP(): ?int
    {
        return $this->hp;
    }

    public function setHP(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getSpAtk(): ?int
    {
        return $this->spAtk;
    }

    public function setSpAtk(int $spAtk): self
    {
        $this->spAtk = $spAtk;

        return $this;
    }

    public function getSpDef(): ?int
    {
        return $this->spDef;
    }

    public function setSpDef(int $spDef): self
    {
        $this->spDef = $spDef;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(int $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function isLegendary(): ?bool
    {
        return $this->legendary;
    }

    public function setLegendary(bool $legendary): self
    {
        $this->legendary = $legendary;

        return $this;
    }

    public function isGhost(): bool
    {
        if ($this->type1 === PokemonTypes::GHOST || $this->type2 === PokemonTypes::GHOST) {
            return true;
        }

        return false;
    }

    public function isFlying(): bool
    {
        if ($this->type1 === PokemonTypes::FLYING || $this->type2 === PokemonTypes::FLYING) {
            return true;
        }

        return false;
    }

    public function isSteel(): bool
    {
        if ($this->type1 === PokemonTypes::STEEL || $this->type2 === PokemonTypes::STEEL) {
            return true;
        }

        return false;
    }

    public function isBug(): bool
    {
        if ($this->type1 === PokemonTypes::BUG || $this->type2 === PokemonTypes::BUG) {
            return true;
        }

        return false;
    }
}
