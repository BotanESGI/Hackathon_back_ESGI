<?php

namespace App\Entity;

use App\Repository\RoomTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomTypeRepository::class)]
class RoomType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'roomTypes')]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(inversedBy: 'roomTypes')]
    private ?RoomCategory $category = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $surface = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'roomType')]
    private Collection $images;

    /**
     * @var Collection<int, Bookings>
     */
    #[ORM\OneToMany(targetEntity: Bookings::class, mappedBy: 'roomType')]
    private Collection $bookings;

    /**
     * @var Collection<int, Negotiations>
     */
    #[ORM\OneToMany(targetEntity: Negotiations::class, mappedBy: 'roomType')]
    private Collection $negotiations;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->negotiations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategory(): ?RoomCategory
    {
        return $this->category;
    }

    public function setCategory(?RoomCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): static
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setRoomType($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getRoomType() === $this) {
                $image->setRoomType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bookings>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Bookings $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setRoomType($this);
        }

        return $this;
    }

    public function removeBooking(Bookings $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getRoomType() === $this) {
                $booking->setRoomType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Negotiations>
     */
    public function getNegotiations(): Collection
    {
        return $this->negotiations;
    }

    public function addNegotiation(Negotiations $negotiation): static
    {
        if (!$this->negotiations->contains($negotiation)) {
            $this->negotiations->add($negotiation);
            $negotiation->setRoomType($this);
        }

        return $this;
    }

    public function removeNegotiation(Negotiations $negotiation): static
    {
        if ($this->negotiations->removeElement($negotiation)) {
            // set the owning side to null (unless already changed)
            if ($negotiation->getRoomType() === $this) {
                $negotiation->setRoomType(null);
            }
        }

        return $this;
    }
}
