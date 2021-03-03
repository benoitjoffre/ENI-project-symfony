<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idCampus;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="campus")
     */
    private $campus;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="campusNom")
     */
    private $users;

    public function __construct()
    {
        $this->campus = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCampus(): ?int
    {
        return $this->idCampus;
    }

    public function setIdCampus(int $idCampus): self
    {
        $this->idCampus = $idCampus;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getCampus(): Collection
    {
        return $this->campus;
    }

    public function addCampus(User $campus): self
    {
        if (!$this->campus->contains($campus)) {
            $this->campus[] = $campus;
            $campus->setCampus($this);
        }

        return $this;
    }

    public function removeCampus(User $campus): self
    {
        if ($this->campus->removeElement($campus)) {
            // set the owning side to null (unless already changed)
            if ($campus->getCampus() === $this) {
                $campus->setCampus(null);
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
            $user->setCampusNom($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCampusNom() === $this) {
                $user->setCampusNom(null);
            }
        }

        return $this;
    }
}
