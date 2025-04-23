<?php

namespace App\Entity;

use App\Repository\HotelRepository;
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

    #[ORM\Column(type: "float")]
    private ?float $priceBase = null;

    #[ORM\Column(type: "float")]
    private ?float $minPrice = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(type: "float")]
    private ?float $lat = null;

    #[ORM\Column(type: "float")]
    private ?float $lng = null;

    #[ORM\ManyToOne(inversedBy: 'hotels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

}
