<?php

namespace App\Entity;

use App\Enum\StarshipStatus;
use App\Repository\StarshipRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StarshipRepository::class)]
class Starship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Name should not be blank')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $class = null;



    #[ORM\Column(enumType: StarshipStatus::class)]
    private ?StarshipStatus $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $arrivedAt = null;

    #[ORM\ManyToOne(inversedBy: 'starships')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Captain $captain = null;

    #[Groups(['starship:read'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['starship:read'])]
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    #[Groups(['starship:read'])]
    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): static
    {
        $this->class = $class;

        return $this;
    }

    #[Groups(['starship:read'])]
    public function getStatus(): ?StarshipStatus
    {
        return $this->status;
    }

    public function setStatus(StarshipStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    #[Groups(['starship:read'])]
    public function getArrivedAt(): ?\DateTimeImmutable
    {
        return $this->arrivedAt;
    }

    public function setArrivedAt(\DateTimeImmutable $arrivedAt): static
    {
        $this->arrivedAt = $arrivedAt;

        return $this;
    }

    #[Groups(['starship:read'])]
    public function getCaptain(): ?Captain
    {
        return $this->captain;
    }

    public function setCaptain(?Captain $captain): static
    {
        $this->captain = $captain;

        return $this;
    }
}