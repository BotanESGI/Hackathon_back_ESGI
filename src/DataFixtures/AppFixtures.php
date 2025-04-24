<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Hotel;
use App\Entity\RoomCategory;
use App\Entity\RoomType;
use App\Entity\Bookings;
use App\Entity\Negotiations;
use App\Entity\Image;
use App\Entity\Swipes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $createdAt = new \DateTimeImmutable();

        // User
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt($createdAt);
        $user->setLevel('standard');

        $hashedPassword = $this->hasher->hashPassword($user, 'Password123!');
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        // Owner
        $owner = new User();
        $owner->setEmail('owner@example.com');
        $owner->setRoles(['ROLE_OWNER']);
        $owner->setCreatedAt($createdAt);
        $owner->setLevel('premium');

        $hashedOwnerPassword = $this->hasher->hashPassword($owner, 'Owner123!');
        $owner->setPassword($hashedOwnerPassword);
        $manager->persist($owner);

        $owner = new User();
        $owner->setEmail('owner@example2.com');
        $owner->setRoles(['ROLE_OWNER']);
        $owner->setCreatedAt($createdAt);
        $owner->setLevel('premium');

        $hashedOwnerPassword = $this->hasher->hashPassword($owner, 'Owner123!');
        $owner->setPassword($hashedOwnerPassword);
        $manager->persist($owner);

        $owner = new User();
        $owner->setEmail('owner@example3.com');
        $owner->setRoles(['ROLE_OWNER']);
        $owner->setCreatedAt($createdAt);
        $owner->setLevel('premium');

        $hashedOwnerPassword = $this->hasher->hashPassword($owner, 'Owner123!');
        $owner->setPassword($hashedOwnerPassword);
        $manager->persist($owner);

        // Hotel
        $hotel = new Hotel();
        $hotel->setOwner($owner);
        $hotel->setName('Ocean View Hotel');
        $hotel->setLocation('Nice');
        $hotel->setDescription('Hotel with a stunning ocean view.');
        $hotel->setLat(43.7102);
        $hotel->setLng(7.2620);
        $hotel->setStars(5);
        $manager->persist($hotel);

        // Room Category
        $category = new RoomCategory();
        $category->setName('Suite');
        $category->setDescription('Luxurious suite rooms');
        $manager->persist($category);

        // Room Type
        $roomType = new RoomType();
        $roomType->setHotel($hotel);
        $roomType->setCategory($category);
        $roomType->setDescription('Spacious room with sea view');
        $roomType->setCapacity(2);
        $roomType->setPrice(300.00);
        $roomType->setSurface(40.0);
        $manager->persist($roomType);

        // Image
        $image = new Image();
        $image->setHotel($hotel);
        $image->setRoomType($roomType);
        $image->setUrl('https://example.com/image.jpg');
        $image->setAltText('Sea view room');
        $image->setIsMain(true);
        $manager->persist($image);

        // Booking
        $booking = new Bookings();
        $booking->setUser($user);
        $booking->setHotel($hotel);
        $booking->setRoomType($roomType);
        $booking->setPrice(300.00);
        $booking->setDateFrom(new \DateTime('2025-05-10'));
        $booking->setDateTo(new \DateTime('2025-05-15'));
        $booking->setStatus('confirmed');
        $booking->setCreatedAt($createdAt);
        $manager->persist($booking);

        // Negotiation
        $negotiation = new Negotiations();
        $negotiation->setUser($user);
        $negotiation->setHotel($hotel);
        $negotiation->setRoomType($roomType);
        $negotiation->setProposedPrice(250.00);
        $negotiation->setCounterOffer(270.00);
        $negotiation->setStatus('pending');
        $negotiation->setCreatedAt($createdAt);
        $manager->persist($negotiation);

        // Swipe
        $swipe = new Swipes();
        $swipe->setUser($user);
        $swipe->setAction('like');
        $swipe->setCreatedAt($createdAt);
        $manager->persist($swipe);

        $manager->flush();
    }
}
