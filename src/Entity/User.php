<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\MeController;
use App\Controller\RegisterController;
use App\Controller\UserController;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert; // Contraintes de validation
use Symfony\Component\Serializer\Annotation\Groups; // Pour la serialization et choisir les données
// use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle as Vich;


/**
 * @Vich\Uploadable
 */

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(
    'email',
    message: 'L\'adresse {{ value }} est déjà utilisé' // A enlever si site en anglais
)]
#[ApiResource(
    // security: 'is_granted("ROLE_USER")',
    collectionOperations: ['me' => [
        'pagination_enabled' => false,
        'path' => '/me', 
        'method' => 'get',
        'controller' => MeController::class,
        'read' => false,
        // 'openapi_context' => [
        //     'security' => [['bearerAuth' => []]]
        // ],
        'security' => 'is_granted("ROLE_USER")'
        ], 
        'register' => [
            'pagination_enabled' => false,
            'path' => '/register_user', 
            'method' => 'post',
            'controller' => RegisterController::class,
            'validation_groups' => ['register'],
            'read' => false
        ], 
        'get' => [
            'security' => 'is_granted("ROLE_ENTREPRISE")',

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
            'controller' => UserController::class,
            'deserialize' => false,
            // 'validation_groups' => ['user:update:validate', 'user:update:validate-password'],
            'denormalization_context' => ['groups' => ['user:update']],
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
                                    'firstname' => [
                                        'type' => 'string',
                                    ],
                                    'lastname' => [
                                        'type' => 'string',
                                    ],
                                    'telephone' => [
                                        'type' => 'string',
                                    ],
                                    'description' => [
                                        'type' => 'string',
                                    ],
                                    'year_of_experience' => [
                                        'type' => 'string',
                                    ],
                                    'diploma' => [
                                        'type' => 'string',
                                    ],
                                    'city' => [
                                        'type' => 'string',
                                    ],
                                    'profession' => [
                                        'type' => 'string',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
         'get', 'patch', 'delete'
    ],
    normalizationContext: ['groups' => ['item']])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["item"])]
    #[ORM\Column(type: 'integer')]
    private $id;

/**
     * @Vich\UploadableField(mapping="user_picture", fileNameProperty="photoFile")
     * @var File
     */
    #[Assert\File(mimeTypes: ["image/png", "image/jpeg"], maxSize: '50M')]
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

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item",'user:update' ])]
    
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item", 'user:update'])]
    
    private $lastname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["item", 'user:update'])]
    
    private $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["item", 'user:update'])]
    
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["item", 'user:update'])]
    
    private $avatar;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["item", 'user:update'])]
    
    private $year_of_experience;

    #[ORM\ManyToOne(targetEntity: Cities::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["item", 'user:update'])]
    
    private $city;

    #[ORM\ManyToOne(targetEntity: Profession::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["item", 'user:update'])]
    
    private $profession;

    #[ORM\ManyToOne(targetEntity: Diplomas::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["item", 'user:update'])]
    
    private $diploma;

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

    public function getUsername(): ?string
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
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }


    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getYearOfExperience(): ?string
    {
        return $this->year_of_experience;
    }

    public function setYearOfExperience(string $year_of_experience): self
    {
        $this->year_of_experience = $year_of_experience;

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

    public function getProfession(): ?Profession
    {
        return $this->profession;
    }

    public function setProfession(?Profession $profession): self
    {
        $this->profession = $profession;

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
