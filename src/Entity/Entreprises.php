<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\EntreprisesController;
use App\Controller\MeController;
use App\Controller\RegisterController;
use App\Repository\EntreprisesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert; // Contraintes de validation
use Vich\UploaderBundle\Mapping\Annotation as Vich;
// use Vich\UploaderBundle as Vich;

/**
 * @Vich\Uploadable
 */

#[ORM\Entity(repositoryClass: EntreprisesRepository::class)]
#[UniqueEntity(
    'email',
    message: 'L\'adresse {{ value }} est déjà utilisé' // A enlever si site en anglais
)]
#[ApiResource(
    // security: 'is_granted("ROLE_ENTREPRISE")',
    collectionOperations: ['me' => [
        'pagination_enabled' => false,
        'path' => '/my', 
        'method' => 'get',
        'controller' => MeController::class,
        'read' => false,
        // 'openapi_context' => [
        //     'security' => [['bearerAuth' => []]]
        // ],
        'security' => 'is_granted("ROLE_ENTREPRISE")'
        ], 
        'register' => [
            'pagination_enabled' => false,
            'path' => '/register_company', 
            'method' => 'post',
            'controller' => RegisterController::class,
            'validation_groups' => ['register'],
            'read' => false
        ], 'get' => [
            'security' => 'is_granted("ROLE_USER")',
            // 'openapi_context' => ['summary' => 'All entreprises.'],

        ]

        
    ],
    itemOperations: [
        // 'get' => [
        //     'controller' => NotFoundAction::class,
        //     'openapi_context' => ['summary' => 'Retrieves a Offers resource.'],
        //     'read' => false,
        //     'output' => false
        // ],
        'put' => [
            'method' => 'POST',
            'controller' => EntreprisesController::class,
            'deserialize' => false,
            // 'validation_groups' => ['user:update:validate', 'user:update:validate-password'],
            'denormalization_context' => ['groups' => ['entreprises:update']],
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
                                    // 'email' => [
                                    //     'type' => 'string',
                                    // ],
                                    'name' => [
                                        'type' => 'string',
                                    ],
                                    'description' => [
                                        'type' => 'string',
                                    ],
                                    'address' => [
                                        'type' => 'string',
                                    ],
                                    'city' => [
                                        'type' => 'string',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], 'get','patch', 'delete'
        
        
    ],
    normalizationContext: ['groups' => ['item']])]
class Entreprises implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["item"])]
    private $id;

/**
     * @Vich\UploadableField(mapping="entreprises_picture", fileNameProperty="photoFile")
     * @var File
     */
    #[Assert\File(mimeTypes: ["image/png", "image/jpeg"], maxSize: '50M')]
    #[Groups(["item"])]
    private $photoFile;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[Groups(["item"])]
    private $JwtToken;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(["item"])]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide.', // A enlever si site en anglais
    )]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    #[Assert\Regex(
        '/^\w{8,}$/',
        message: "Le mot de passe de faire au minimum 8 caractères et ne contenir que des chiffres et des lettres (_ et - autorisé)",
        groups:["register"]
    )]//REGEX du mot de passe
    private $password;

    #[ORM\ManyToOne(targetEntity: Cities::class, inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["item"])]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["item"])]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["item"])]
    private $avatar;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["item"])]
    private $address;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Offers::class, orphanRemoval: true)]
    #[Groups(["item"])]
    private $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJwtToken(): ?string
    {
        return $this->JwtToken;
    }

    public function setJwtToken(string $jwt): self
    {
        $this->JwtToken = $jwt;

        return $this;
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ENTREPRISE';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

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
            $offer->setEntreprise($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getEntreprise() === $this) {
                $offer->setEntreprise(null);
            }
        }

        return $this;
    }
}
