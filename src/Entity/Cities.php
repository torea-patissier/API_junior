<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups; // Pour la serialization et choisir les données
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitiesRepository::class)]
#[ApiResource]
class Cities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['item'])] 
    private $name; 

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Companies::class)]
    private $companies;

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Offers::class)]
    private $offers;

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Juniors::class)]

    private $juniors;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
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
     * @return Collection|Companies[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Companies $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setCity($this);
        }

        return $this;
    }

    public function removeCompany(Companies $company): self
    {
        if ($this->companies->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getCity() === $this) {
                $company->setCity(null);
            }
        }

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
            $offer->setCity($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getCity() === $this) {
                $offer->setCity(null);
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
            $junior->setCity($this);
        }

        return $this;
    }

    public function removeJunior(Juniors $junior): self
    {
        if ($this->juniors->removeElement($junior)) {
            // set the owning side to null (unless already changed)
            if ($junior->getCity() === $this) {
                $junior->setCity(null);
            }
        }

        return $this;
    }
}
