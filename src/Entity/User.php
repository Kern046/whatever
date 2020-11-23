<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Table(name="user__users")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=128, unique=true)
     */
    protected $uuid;
    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    protected $username;
    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;
    /**
     * @ORM\Column(type="array")
     */
    protected $roles;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->roles = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = new ArrayCollection($roles);

        return $this;
    }

    public function addRole(string $role): self
    {
        $this->roles->add($role);

        return $this;
    }

    public function hasRole(string $role): bool
    {
        return $this->roles->contains($role);
    }

    public function removeRole(string $role): self
    {
        $this->roles->removeElement($role);

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles->toArray();
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}