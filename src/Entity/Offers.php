<?php

namespace App\Entity;

use App\Controller\OffersController;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OffersRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter; // Filtre
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Elasticsearch\DataProvider\Filter\TermFilter; // Filtre de termes
use ApiPlatform\Core\Bridge\Elasticsearch\DataProvider\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert; // Contraintes de validation
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable
 */

#[ORM\Entity(repositoryClass: OffersRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
        'offers' => [
            'pagination_enabled' => false,
            'path' => 'create_offer',
            'method' => 'post',
            'controller' => OffersController::class,
            'read' => false,
            'deserialize' => false,
            // 'validation_groups' => ['user:update:validate', 'user:update:validate-password'],
            // 'denormalization_context' => ['groups' => ['offers:update']],
            'openapi_context' => [
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'photoFile' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                    'jobs' => [
                                        'type' => 'string',
                                    ],
                                    'description' => [
                                        'type' => 'string',
                                    ],
                                    'type_of_contract' => [
                                        'type' => 'string',
                                    ],
                                    'type_of_work' => [
                                        'type' => 'string',
                                    ],

                                    // Si Récupération de l'ID des entités liées

                                    // 'cites' => [
                                    //     'type' => 'string',
                                    // ],
                                    // 'diplomas' => [
                                    //     'type' => 'string',
                                    // ],
                                    

                                    // Si Création de nouvelles entrées en BDD

                                    'city' => [
                                        'type' => 'string',
                                    ],
                                    'diploma' => [
                                        'type' => 'string',
                                    ],
                                    
                                    'entreprises' => [
                                        'type' => 'string',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['item:offers']]
        ],
        // 'put' => [
        //     'method' => 'POST',
        //     'controller' => OffersController::class,
        //     'deserialize' => false,
        //     // 'validation_groups' => ['user:update:validate', 'user:update:validate-password'],
        //     'denormalization_context' => ['groups' => ['offers:update']],
        //     'openapi_context' => [
        //         'requestBody' => [
        //             'content' => [
        //                 'multipart/form-data' => [
        //                     'schema' => [
        //                         'type' => 'object',
        //                         'properties' => [
        //                             'photoFile' => [
        //                                 'type' => 'string',
        //                                 'format' => 'binary',
        //                             ],
        //                             'jobs' => [
        //                                 'type' => 'string',
        //                             ],
        //                             'type_of_contract' => [
        //                                 'type' => 'string',
        //                             ],
        //                             'type_of_work' => [
        //                                 'type' => 'string',
        //                             ],
        //                             'city' => [
        //                                 'type' => 'string',
        //                             ],
        //                             'diploma' => [
        //                                 'type' => 'string',
        //                             ],
        //                             'entreprise' => [
        //                                 'type' => 'string',
        //                             ],
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ],
        // ],
        'delete',
        'patch',
        'get'
    ],
    paginationItemsPerPage: 10, 
    normalizationContext: ['groups' => ['item:offers']] // Pagination, items par page
)]
// #[ApiFilter(OrderFilter::class, properties: ['id' => 'ASC', 'description' => 'DESC'])]
#[ApiFilter(SearchFilter::class, properties: ['city' => 'exact', 'diploma' => 'exact'])]
class Offers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["item",'item:offers'])]

    private $id;


    /**
     * @Vich\UploadableField(mapping="offers_picture", fileNameProperty="photoFile")
     * @var File
     */
    #[Assert\File(mimeTypes: ["image/*"], maxSize: '50M')]
    #[Groups(["item",'item:offers'])]
    private $photoFile;


    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item",'item:offers'])]
    private $jobs;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item",'item:offers'])]
    private $description;

    #[ORM\Column(type: 'date')]
    #[Groups(["item",'item:offers'])]
    private $publication_date;

    #[ORM\Column(type: 'date')]
    #[Groups(["item",'item:offers'])]
    private $expiration_date;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item",'item:offers'])]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item",'item:offers'])]
    private $type_of_contract;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item",'item:offers'])]
    private $type_of_work;

    #[ORM\ManyToOne(targetEntity: Cities::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["item",'item:offers'])]
    private $city;

    #[ORM\ManyToOne(targetEntity: Diplomas::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["item",'item:offers'])]
    private $diploma;

    #[ORM\ManyToOne(targetEntity: Entreprises::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'cascade')] // DELETE ON CASCADE
    #[Groups(["item",'item:offers'])]
    private $entreprise;

    public function __construct()
    {

        $this->publication_date = new \DateTime();
        $this->expiration_date = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    public function setPhotoFile($photoFile)
    {
        $this->photoFile = $photoFile;
        if ($photoFile) {
            $this->updatedAt = new \DateTime();
        }
        return $this;
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

    public function getEntreprise(): ?Entreprises
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprises $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
