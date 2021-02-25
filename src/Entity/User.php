<?php

namespace App\Entity;

use App\Repository\UserRepository;
<<<<<<< HEAD
=======
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass=UserRepository::class)
<<<<<<< HEAD
=======
 * @ORM\Table(name="`user`")
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
 */
class User implements UserInterface
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
<<<<<<< HEAD
    private $username;
=======
    private $login;
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $roles;

    /**
<<<<<<< HEAD
=======
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="organizer")
     */
    private $sortiesOrganisees;

    public function __construct()
    {
        $this->sortiesOrganisees = new ArrayCollection();
    }

    /**
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
=======
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
<<<<<<< HEAD
    public function setPassword($password)
=======
    public function setPassword($password): void
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
<<<<<<< HEAD
        return [$this->roles];
=======
        return $this->roles;
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
    }

    /**
     * @param mixed $roles
     */
<<<<<<< HEAD
    public function setRoles($roles)
=======
    public function setRoles($roles): void
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
    {
        $this->roles = $roles;
    }


    public function getSalt()
    {return null;}

<<<<<<< HEAD
=======
    public function getUsername()
    {
        return $this->login;
    }
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e

    public function eraseCredentials()
    {
    }
<<<<<<< HEAD
=======

    /**
     * @return Collection|Sortie[]
     */
    public function getSortiesOrganisees(): Collection
    {
        return $this->sortiesOrganisees;
    }

    public function addSortiesOrganisee(Sortie $sortiesOrganisee): self
    {
        if (!$this->sortiesOrganisees->contains($sortiesOrganisee)) {
            $this->sortiesOrganisees[] = $sortiesOrganisee;
            $sortiesOrganisee->setOrganisateur($this);
        }

        return $this;
    }

    public function removeSortiesOrganisee(Sortie $sortiesOrganisee): self
    {
        if ($this->sortiesOrganisees->removeElement($sortiesOrganisee)) {
            // set the owning side to null (unless already changed)
            if ($sortiesOrganisee->getOrganisateur() === $this) {
                $sortiesOrganisee->setOrganisateur(null);
            }
        }

        return $this;
    }
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
}
