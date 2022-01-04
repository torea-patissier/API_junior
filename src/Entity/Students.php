<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StudentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StudentsRepository::class)
 */
class Students
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avater;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $experience;

    /**
     * @ORM\ManyToOne(targetEntity=Cities::class, inversedBy="students")
     */
    private $Cities;

    /**
     * @ORM\ManyToOne(targetEntity=Professions::class, inversedBy="students")
     */
    private $Profession;

    /**
     * @ORM\ManyToOne(targetEntity=Diplomer::class, inversedBy="students")
     */
    private $Diplomer;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    public function getAvater(): ?string
    {
        return $this->avater;
    }

    public function setAvater(string $avater): self
    {
        $this->avater = $avater;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        $this->experience = $experience;

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

    public function getProfession(): ?Professions
    {
        return $this->Profession;
    }

    public function setProfession(?Professions $Profession): self
    {
        $this->Profession = $Profession;

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
