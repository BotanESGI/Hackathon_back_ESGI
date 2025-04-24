<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SwipesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_HOTELIER') or is_granted('ROLE_USER')"
)]
#[ORM\Entity(repositoryClass: SwipesRepository::class)]
class Swipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'swipes')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $action = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
