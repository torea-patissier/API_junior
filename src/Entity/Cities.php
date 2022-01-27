<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups; // Pour la serialization et choisir les données
use Doctrine\ORM\Mapping as ORM;
use Proxies\__CG__\App\Entity\User;

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

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Offers::class)]
    private $offers;


    #[ORM\OneToMany(mappedBy: 'city', targetEntity: User::class)]
    private $users;

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Entreprises::class)]
    private $entreprises;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCity($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCity() === $this) {
                $user->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entreprises[]
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprises $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
            $entreprise->setCity($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprises $entreprise): self
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getCity() === $this) {
                $entreprise->setCity(null);
            }
        }

        return $this;
    }
}
