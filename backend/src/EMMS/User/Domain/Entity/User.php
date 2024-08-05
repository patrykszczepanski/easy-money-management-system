<?php

declare(strict_types=1);

namespace App\EMMS\User\Domain\Entity;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GA;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Property;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\UuidV4;

#[ORM\Entity]
#[ORM\Table(name: 'admin')]
#[GA\SoftDeleteable(fieldName: 'deletedAt', timeAware: false)]
class User extends AggregateRoot implements UserInterface
{
    #[Property(
        type: 'array',
        items: new OA\Items(
            type: 'array',
            items: new OA\Items(
                type: 'string'
            )
        )
    )]
    #[ORM\Column(type: 'simple_array', nullable: false)]
    protected array $roles = [];

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private UuidV4 $id;

    #[ORM\Column(type: 'string', length: 256, unique: true)]
    private string $email;

    #[ORM\Column(type: 'string', length: 64)]
    private string $firstName;
    #[ORM\Column(type: 'string', length: 128)]
    private string $lastName;

    public function __construct()
    {
        $this->id = new UuidV4();
    }

    public function getId(): UuidV4
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function addRoles(array $roles): self
    {
        $this->roles = array_merge($this->roles, $roles);

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->getId()->toRfc4122();
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
