<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OffersRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter; // Filtre
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Elasticsearch\DataProvider\Filter\TermFilter; // Filtre de termes
use ApiPlatform\Core\Bridge\Elasticsearch\DataProvider\Filter\OrderFilter;

#[ORM\Entity(repositoryClass: OffersRepository::class)]
#[ApiResource(
    paginationItemsPerPage: 10 // Pagination, items par page
)]
// #[ApiFilter(OrderFilter::class, properties: ['id' => 'ASC', 'description' => 'DESC'])]
#[ApiFilter(SearchFilter::class, properties: ['city' => 'exact', 'diploma' => 'exact'])]
class Offers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $jobs;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'date')]
    private $publication_date;

    #[ORM\Column(type: 'date')]
    private $expiration_date;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $type_of_contract;

    #[ORM\Column(type: 'string', length: 255)]
    private $type_of_work;

    #[ORM\ManyToOne(targetEntity: Companies::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'cascade')] // DELETE ON CASCADE
    private $company;

    #[ORM\ManyToOne(targetEntity: Cities::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private $city;

    #[ORM\ManyToOne(targetEntity: Diplomas::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private $diploma;

    public function __construct() {

        $this->publication_date = new \DateTime();
        $this->expiration_date = new \Datetime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobs(): ?string
    {
        return $this->jobs;
    }

    public function setJobs(string $jobs): self
    {
        $this->jobs = $jobs;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(\DateTimeInterface $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(\DateTimeInterface $expiration_date): self
    {
        $this->expiration_date = $expiration_date;

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

    public function getTypeOfContract(): ?string
    {
        return $this->type_of_contract;
    }

    public function setTypeOfContract(string $type_of_contract): self
    {
        $this->type_of_contract = $type_of_contract;

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

    public function getCompany(): ?Companies
    {
        return $this->company;
    }

    public function setCompany(?Companies $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCity(): ?Cities
    {
        return $this->city;
    }

    public function setCity(?Cities $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDiploma(): ?Diplomas
    {
        return $this->diploma;
    }

    public function setDiploma(?Diplomas $diploma): self
    {
        $this->diploma = $diploma;

        return $this;
    }
}
