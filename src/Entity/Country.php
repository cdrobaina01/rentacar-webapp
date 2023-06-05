<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'country_id', targetEntity: Tourist::class)]
    private Collection $tourists;

    public function __construct()
    {
        $this->tourists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Tourist>
     */
    public function getTourists(): Collection
    {
        return $this->tourists;
    }

    public function addTourist(Tourist $tourist): self
    {
        if (!$this->tourists->contains($tourist)) {
            $this->tourists->add($tourist);
            $tourist->setCountryId($this);
        }

        return $this;
    }

    public function removeTourist(Tourist $tourist): self
    {
        if ($this->tourists->removeElement($tourist)) {
            // set the owning side to null (unless already changed)
            if ($tourist->getCountryId() === $this) {
                $tourist->setCountryId(null);
            }
        }

        return $this;
    }
}
