<?php

namespace App\Entity;
use App\Controller\MeController;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert; // Contraintes de validation
use Symfony\Component\Serializer\Annotation\Groups; // Pour la serialization et choisir les données

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(
    'email',
    message: 'L\'adresse {{ value }} est déjà utilisé' // A enlever si site en anglais
)]
#[ApiResource(
    collectionOperations: [
        'me' => [
            'pagination_enabled' => false,
            'path' => '/me',
            'method' => 'get',
            'controller' => MeController::class,
            'read' => false,
        ]
    ],
erations:[
        'get' => [
            'controller' => NotFoundAction::class,
            'openapi_context' => ['summary' => 'hidden'],
            'read' => false,
            'output' => false,
        ]
    ],
    normalizationContext: ['groups' => ['read:User']]
    // normalizationContext: ['groups' => ['read:User']]
    )]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(['read:User'])]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide.', // A enlever si site en anglais
    )]
    private $email;

    #[Groups(['read:User'])]
    #[ORM\Column(type: 'json', nullable:true)]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    #[Assert\Regex(
        '/^\w{8,}$/',
        message: "Le mot de passe de faire au minimum 8 caractères et ne contenir que des chiffres et des lettres (_ et - autorisé)"
    )]//REGEX du mot de passe
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:User'])]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:User'])]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    #[Groups(['read:User'])]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    #[Groups(['read:User'])]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    #[Groups(['read:User'])]
    private $avatar;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    #[Groups(['read:User'])]
    private $year_of_experience;

    #[ORM\ManyToOne(targetEntity: Cities::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['read:User'])]
    private $city;

    #[ORM\ManyToOne(targetEntity: Profession::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['read:User'])]
    private $profession;

    #[ORM\ManyToOne(targetEntity: Diplomas::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['read:User'])]
    private $diploma;

    public function getId(): ?int
    {
        return $this->id;
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
