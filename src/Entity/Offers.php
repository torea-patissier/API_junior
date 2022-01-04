<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OffersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OffersRepository::class)
 */
class Offers
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
    private $jod_offer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_offer;

    /**
     * @ORM\Column(type="date")
     */
    private $data_of_publication;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contract_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_of_work;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="date")
     */
    private $expiring_data;

    /**
     * @ORM\ManyToOne(targetEntity=Enterprises::class, inversedBy="offers")
     */
    private $Enterprises;

    /**
     * @ORM\ManyToOne(targetEntity=Cities::class, inversedBy="offers")
     */
    private $Cities;

    /**
     * @ORM\ManyToOne(targetEntity=Diplomer::class, inversedBy="offers")
     */
    private $Diplomer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJodOffer(): ?string
    {
        return $this->jod_offer;
    }

    public function setJodOffer(string $jod_offer): self
    {
        $this->jod_offer = $jod_offer;

        return $this;
    }

    public function getDescriptionOffer(): ?string
    {
        return $this->description_offer;
    }

    public function setDescriptionOffer(string $description_offer): self
    {
        $this->description_offer = $description_offer;

        return $this;
    }

    public function getDataOfPublication(): ?\DateTimeInterface
    {
        return $this->data_of_publication;
    }

    public function setDataOfPublication(\DateTimeInterface $data_of_publication): self
    {
        $this->data_of_publication = $data_of_publication;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->contract_type;
    }

    public function setContractType(string $contract_type): self
    {
        $this->contract_type = $contract_type;

        return $this;
    }

    public function getTypeOfWork(): ?string
    {
        return $this->type_of_work;
    }

    public function setTypeOfWork(string $type_of_work): self
    {
        $this->type_of_work = $type_of_work;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getExpiringData(): ?\DateTimeInterface
    {
        return $this->expiring_data;
    }

    public function setExpiringData(\DateTimeInterface $expiring_data): self
    {
        $this->expiring_data = $expiring_data;

        return $this;
    }

    public function getEnterprises(): ?Enterprises
    {
        return $this->Enterprises;
    }

    public function setEnterprises(?Enterprises $Enterprises): self
    {
        $this->Enterprises = $Enterprises;

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

    public function getDiplomer(): ?Diplomer
    {
        return $this->Diplomer;
    }

    public function setDiplomer(?Diplomer $Diplomer): self
    {
        $this->Diplomer = $Diplomer;

        return $this;
    }
}
