<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EnterprisesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EnterprisesRepository::class)
 */
class Enterprises
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_enterprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avater_enterprise;

    /**
     * @ORM\OneToMany(targetEntity=Offers::class, mappedBy="Enterprises")
     */
    private $offers;

    /**
     * @ORM\ManyToOne(targetEntity=Cities::class, inversedBy="enterprises")
     */
    private $Cities;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
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

    public function getDescriptionEnterprise(): ?string
    {
        return $this->description_enterprise;
    }

    public function setDescriptionEnterprise(string $description_enterprise): self
    {
        $this->description_enterprise = $description_enterprise;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAvaterEnterprise(): ?string
    {
        return $this->avater_enterprise;
    }

    public function setAvaterEnterprise(string $avater_enterprise): self
    {
        $this->avater_enterprise = $avater_enterprise;

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
            $offer->setEnterprises($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getEnterprises() === $this) {
                $offer->setEnterprises(null);
            }
        }

        return $this;
    }

    public function getCities(): ?Cities
    {
        return $this->Cities;
    }

    public function setCities(?Cities $Cities): self
    {
        $this->Cities = $Cities;

        return $this;
    }
}
