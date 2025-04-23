<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $alt_text = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?RoomType $roomType = null;

    #[ORM\Column]
    private ?bool $is_main = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getAltText(): ?string
    {
        return $this->alt_text;
    }

    public function setAltText(string $alt_text): static
    {
        $this->alt_text = $alt_text;

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

    public function isMain(): ?bool
    {
        return $this->is_main;
    }

    public function setIsMain(bool $is_main): static
    {
        $this->is_main = $is_main;

        return $this;
    }
}
