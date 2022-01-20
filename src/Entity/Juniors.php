<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\JuniorsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; // Pour la serialization et choisir les données
use Symfony\Component\Validator\Constraints as Assert; // Contraintes de validation
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity; // Email unique
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // PWD HASH
#[ORM\Entity(repositoryClass: JuniorsRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['item']])]
#[UniqueEntity(
    'email',
    message: 'L\'adresse {{ value }} est déjà utilisé' // A enlever si site en anglais
)]
class Juniors implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide.', // A enlever si site en anglais
    )]
    private $email;
    
    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])] 
    private $firstname; 

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])] 
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])] 
    private $telephone;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])] 
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])] 
    private $avatar;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])] 
    private $year_of_experience;

    #[ORM\ManyToOne(targetEntity: Cities::class, inversedBy: 'juniors')]
    #[ORM\JoinColumn(nullable: false)]
    // #[Groups(['item'])]
    private $city;

    #[ORM\ManyToOne(targetEntity: Profession::class, inversedBy: 'juniors')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['item'])]
    private $profession;

    #[ORM\ManyToOne(targetEntity: Diplomas::class, inversedBy: 'juniors')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['item'])] 
    private $diploma;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Regex('/^\w{8,}$/')]//REGEX du mot de passe
    private $password;

    private $roles = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;


    public function getId(): ?int
    {
        return $this->id;
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

      /**
     * The public representation of the user (e.g. a username, an email address, etc.)
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

}
