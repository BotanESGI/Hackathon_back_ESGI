<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $location = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(type: "float")]
    private ?float $lat = null;

    #[ORM\Column(type: "float")]
    private ?float $lng = null;

    #[ORM\Column(type: "integer")]
    #[Assert\Range(
        min: 1,
        max: 5,
        notInRangeMessage: "Le nombre d’étoiles doit être entre {{ min }} et {{ max }}."
    )]
    private ?int $stars = null;

    #[ORM\ManyToOne(inversedBy: 'hotels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\OneToMany(targetEntity: RoomType::class, mappedBy: 'hotel')]
    private Collection $roomTypes;

    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'hotel')]
    private Collection $images;

    #[ORM\OneToMany(targetEntity: Bookings::class, mappedBy: 'hotel')]
    private Collection $bookings;

    #[ORM\OneToMany(targetEntity: Negotiations::class, mappedBy: 'hotel')]
    private Collection $negotiations;

    public function __construct()
    {
        $this->roomTypes = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->negotiations = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }

    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getLocation(): ?string { return $this->location; }

    public function setLocation(string $location): static { $this->location = $location; return $this; }

    public function getDescription(): ?string { return $this->description; }

    public function setDescription(string $description): static { $this->description = $description; return $this; }

    public function getLat(): ?float { return $this->lat; }

    public function setLat(float $lat): static { $this->lat = $lat; return $this; }

    public function getLng(): ?float { return $this->lng; }

    public function setLng(float $lng): static { $this->lng = $lng; return $this; }

    public function getStars(): ?int { return $this->stars; }

    public function setStars(int $stars): static { $this->stars = $stars; return $this; }

    public function getOwner(): ?User { return $this->owner; }

    public function setOwner(?User $owner): static { $this->owner = $owner; return $this; }

    public function getRoomTypes(): Collection { return $this->roomTypes; }

    public function addRoomType(RoomType $roomType): static {
        if (!$this->roomTypes->contains($roomType)) {
            $this->roomTypes->add($roomType);
            $roomType->setHotel($this);
        }
        return $this;
    }

    public function removeRoomType(RoomType $roomType): static {
        if ($this->roomTypes->removeElement($roomType)) {
            if ($roomType->getHotel() === $this) {
                $roomType->setHotel(null);
            }
        }
        return $this;
    }

    public function getImages(): Collection { return $this->images; }

    public function addImage(Image $image): static {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setHotel($this);
        }
        return $this;
    }

    public function removeImage(Image $image): static {
        if ($this->images->removeElement($image)) {
            if ($image->getHotel() === $this) {
                $image->setHotel(null);
            }
        }
        return $this;
    }

    public function getBookings(): Collection { return $this->bookings; }

    public function addBooking(Bookings $booking): static {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setHotel($this);
        }
        return $this;
    }

    public function removeBooking(Bookings $booking): static {
        if ($this->bookings->removeElement($booking)) {
            if ($booking->getHotel() === $this) {
                $booking->setHotel(null);
            }
        }
        return $this;
    }

    public function getNegotiations(): Collection { return $this->negotiations; }

    public function addNegotiation(Negotiations $negotiation): static {
        if (!$this->negotiations->contains($negotiation)) {
            $this->negotiations->add($negotiation);
            $negotiation->setHotel($this);
        }
        return $this;
    }

    public function removeNegotiation(Negotiations $negotiation): static {
        if ($this->negotiations->removeElement($negotiation)) {
            if ($negotiation->getHotel() === $this) {
                $negotiation->setHotel(null);
            }
        }
        return $this;
    }
}