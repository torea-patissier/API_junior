<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups; // Pour la serialization et choisir les données
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionRepository::class)]
#[ApiResource]
class Profession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['item'])] 
    private $name;

    #[ORM\OneToMany(mappedBy: 'profession', targetEntity: Juniors::class)]
    private $juniors;

    #[ORM\OneToMany(mappedBy: 'profession', targetEntity: User::class)]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return Collection|Juniors[]
     */
    public function getJuniors(): Collection
    {
        return $this->juniors;
    }

    public function addJunior(Juniors $junior): self
    {
        if (!$this->juniors->contains($junior)) {
            $this->juniors[] = $junior;
            $junior->setProfession($this);
        }

        return $this;
    }

    public function removeJunior(Juniors $junior): self
    {
        if ($this->juniors->removeElement($junior)) {
            // set the owning side to null (unless already changed)
            if ($junior->getProfession() === $this) {
                $junior->setProfession(null);
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
            $user->setProfession($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfession() === $this) {
                $user->setProfession(null);
            }
        }

        return $this;
    }
}
