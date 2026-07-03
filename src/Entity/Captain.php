<?php

namespace App\Entity;

use App\Repository\CaptainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CaptainRepository::class)]
class Captain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Starship>
     */
    #[ORM\OneToMany(targetEntity: Starship::class, mappedBy: 'captain')]
    private Collection $starships;

    public function __construct()
    {
        $this->starships = new ArrayCollection();
    }

    #[Groups(['starship:read','captain:read'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['starship:read','captain:read'])]
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Starship>
     */
    public function getStarships(): Collection
    {
        return $this->starships;
    }

    public function addStarship(Starship $starship): static
    {
        if (!$this->starships->contains($starship)) {
            $this->starships->add($starship);
            $starship->setCaptain($this);
        }

        return $this;
    }

    public function removeStarship(Starship $starship): static
    {
        if ($this->starships->removeElement($starship)) {
            // set the owning side to null (unless already changed)
            if ($starship->getCaptain() === $this) {
                $starship->setCaptain(null);
            }
        }

        return $this;
    }
}