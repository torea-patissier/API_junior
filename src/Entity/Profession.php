<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups; // Pour la serialization et choisir les données
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionRepository::class)]
#[ApiResource]
class Profession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['item'])] 
    private $name;

    #[ORM\OneToMany(mappedBy: 'profession', targetEntity: Juniors::class)]
    private $juniors;

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
     * @return Collection|Juniors[]
     */
    public function getJuniors(): Collection
    {
        return $this->juniors;
    }

    public function addJunior(Juniors $junior): self
    {
        if (!$this->juniors->contains($junior)) {
            $this->juniors[] = $junior;
            $junior->setProfession($this);
        }

        return $this;
    }

    public function removeJunior(Juniors $junior): self
    {
        if ($this->juniors->removeElement($junior)) {
            // set the owning side to null (unless already changed)
            if ($junior->getProfession() === $this) {
                $junior->setProfession(null);
            }
        }

        return $this;
    }
}
