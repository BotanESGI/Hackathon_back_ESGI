<?php

namespace App\Entity;

use App\Repository\NegotiationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NegotiationsRepository::class)]
class Negotiations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'negotiations')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'negotiations')]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(inversedBy: 'negotiations')]
    private ?RoomType $roomType = null;

    #[ORM\Column]
    private ?float $proposed_price = null;

    #[ORM\Column(nullable: true)]
    private ?float $counter_offer = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

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

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): static
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getRoomType(): ?RoomType
    {
        return $this->roomType;
    }

    public function setRoomType(?RoomType $roomType): static
    {
        $this->roomType = $roomType;

        return $this;
    }

    public function getProposedPrice(): ?float
    {
        return $this->proposed_price;
    }

    public function setProposedPrice(float $proposed_price): static
    {
        $this->proposed_price = $proposed_price;

        return $this;
    }

    public function getCounterOffer(): ?float
    {
        return $this->counter_offer;
    }

    public function setCounterOffer(?float $counter_offer): static
    {
        $this->counter_offer = $counter_offer;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
