<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DiplomasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups; // Pour la serialization et choisir les données
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiplomasRepository::class)]
#[ApiResource]
class Diplomas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['item'])] 
    private $name;

    #[ORM\OneToMany(mappedBy: 'diploma', targetEntity: Offers::class)]
    private $offers;

    #[ORM\OneToMany(mappedBy: 'diploma', targetEntity: Juniors::class)]
    private $juniors;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->juniors = new ArrayCollection();
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
     * @return Collection|Offers[]
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offers $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setDiploma($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getDiploma() === $this) {
                $offer->setDiploma(null);
            }
        }

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
            $junior->setDiploma($this);
        }

        return $this;
    }

    public function removeJunior(Juniors $junior): self
    {
        if ($this->juniors->removeElement($junior)) {
            // set the owning side to null (unless already changed)
            if ($junior->getDiploma() === $this) {
                $junior->setDiploma(null);
            }
        }

        return $this;
    }
}
