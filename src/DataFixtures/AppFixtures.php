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
use App\Entity\Payment;
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

        // Additional hotels
        $hotels = [
            [
                'name' => 'Grand Plaza',
                'location' => 'Paris',
                'description' => 'Luxury hotel in the heart of Paris.',
                'lat' => 48.8566,
                'lng' => 2.3522,
                'stars' => 5
            ],
            [
                'name' => 'Mountain Retreat',
                'location' => 'Chamonix',
                'description' => 'Cozy hotel with mountain views.',
                'lat' => 45.9237,
                'lng' => 6.8694,
                'stars' => 4
            ],
            [
                'name' => 'Riviera Palace',
                'location' => 'Cannes',
                'description' => 'Elegant hotel on the French Riviera.',
                'lat' => 43.5528,
                'lng' => 7.0174,
                'stars' => 5
            ],
            [
                'name' => 'Alpine Lodge',
                'location' => 'Courchevel',
                'description' => 'Ski-in/ski-out luxury resort.',
                'lat' => 45.4154,
                'lng' => 6.6347,
                'stars' => 5
            ],
            [
                'name' => 'Harbor View',
                'location' => 'Marseille',
                'description' => 'Modern hotel overlooking the old port.',
                'lat' => 43.2965,
                'lng' => 5.3698,
                'stars' => 4
            ],
            [
                'name' => 'Vineyard Estate',
                'location' => 'Bordeaux',
                'description' => 'Charming hotel surrounded by vineyards.',
                'lat' => 44.8378,
                'lng' => -0.5792,
                'stars' => 4
            ],
            [
                'name' => 'Castle Hotel',
                'location' => 'Loire Valley',
                'description' => 'Historic castle turned luxury hotel.',
                'lat' => 47.3591,
                'lng' => 0.6990,
                'stars' => 5
            ],
            [
                'name' => 'Seaside Resort',
                'location' => 'Saint-Tropez',
                'description' => 'Exclusive beachfront resort.',
                'lat' => 43.2692,
                'lng' => 6.6389,
                'stars' => 5
            ],
            [
                'name' => 'Urban Oasis',
                'location' => 'Lyon',
                'description' => 'Contemporary hotel in the city center.',
                'lat' => 45.7640,
                'lng' => 4.8357,
                'stars' => 4
            ],
            [
                'name' => 'Alpine Chalet',
                'location' => 'Megève',
                'description' => 'Traditional mountain chalet with modern amenities.',
                'lat' => 45.8569,
                'lng' => 6.6177,
                'stars' => 4
            ],
            [
                'name' => 'Mediterranean Villa',
                'location' => 'Antibes',
                'description' => 'Luxury villa with private beach access.',
                'lat' => 43.5808,
                'lng' => 7.1251,
                'stars' => 5
            ],
            [
                'name' => 'Historic Inn',
                'location' => 'Avignon',
                'description' => 'Charming hotel in a historic building.',
                'lat' => 43.9493,
                'lng' => 4.8055,
                'stars' => 4
            ],
            [
                'name' => 'Golf Resort',
                'location' => 'Deauville',
                'description' => 'Luxury resort with championship golf course.',
                'lat' => 49.3573,
                'lng' => 0.0700,
                'stars' => 5
            ],
            [
                'name' => 'Spa Retreat',
                'location' => 'Évian-les-Bains',
                'description' => 'Wellness-focused hotel with thermal spa.',
                'lat' => 46.4017,
                'lng' => 6.5877,
                'stars' => 5
            ],
            [
                'name' => 'Boutique Hotel',
                'location' => 'Aix-en-Provence',
                'description' => 'Designer hotel in the heart of Provence.',
                'lat' => 43.5297,
                'lng' => 5.4474,
                'stars' => 4
            ],
            [
                'name' => 'Lakeside Lodge',
                'location' => 'Annecy',
                'description' => 'Charming hotel on the shores of Lake Annecy.',
                'lat' => 45.8992,
                'lng' => 6.1294,
                'stars' => 4
            ],
            [
                'name' => 'Wine Country Inn',
                'location' => 'Beaune',
                'description' => 'Cozy hotel in the heart of Burgundy wine country.',
                'lat' => 47.0241,
                'lng' => 4.8386,
                'stars' => 4
            ],
            [
                'name' => 'Seaside Palace',
                'location' => 'Biarritz',
                'description' => 'Grand hotel with Atlantic Ocean views.',
                'lat' => 43.4832,
                'lng' => -1.5586,
                'stars' => 5
            ],
            [
                'name' => 'Mountain View',
                'location' => 'Grenoble',
                'description' => 'Hotel with stunning views of the French Alps.',
                'lat' => 45.1885,
                'lng' => 5.7245,
                'stars' => 4
            ],
            [
                'name' => 'Riverside Hotel',
                'location' => 'Strasbourg',
                'description' => 'Elegant hotel on the banks of the Rhine.',
                'lat' => 48.5734,
                'lng' => 7.7521,
                'stars' => 4
            ]
        ];

        foreach ($hotels as $hotelData) {
            $newHotel = new Hotel();
            $newHotel->setOwner($owner);
            $newHotel->setName($hotelData['name']);
            $newHotel->setLocation($hotelData['location']);
            $newHotel->setDescription($hotelData['description']);
            $newHotel->setLat($hotelData['lat']);
            $newHotel->setLng($hotelData['lng']);
            $newHotel->setStars($hotelData['stars']);
            $manager->persist($newHotel);

            // Create room categories for this hotel
            $categories = [
                [
                    'name' => 'Standard',
                    'description' => 'Comfortable standard rooms'
                ],
                [
                    'name' => 'Deluxe',
                    'description' => 'Spacious deluxe rooms'
                ],
                [
                    'name' => 'Suite',
                    'description' => 'Luxurious suite rooms'
                ]
            ];

            foreach ($categories as $categoryData) {
                $category = new RoomCategory();
                $category->setName($categoryData['name']);
                $category->setDescription($categoryData['description']);
                $manager->persist($category);

                // Create room types for each category
                $roomTypes = [
                    [
                        'description' => 'Standard room with basic amenities',
                        'capacity' => 2,
                        'price' => rand(100, 200),
                        'surface' => rand(20, 30)
                    ],
                    [
                        'description' => 'Deluxe room with premium amenities',
                        'capacity' => 2,
                        'price' => rand(200, 300),
                        'surface' => rand(30, 40)
                    ],
                    [
                        'description' => 'Luxury suite with all amenities',
                        'capacity' => 4,
                        'price' => rand(300, 500),
                        'surface' => rand(40, 60)
                    ]
                ];

                foreach ($roomTypes as $roomTypeData) {
                    $roomType = new RoomType();
                    $roomType->setHotel($newHotel);
                    $roomType->setCategory($category);
                    $roomType->setDescription($roomTypeData['description']);
                    $roomType->setCapacity($roomTypeData['capacity']);
                    $roomType->setPrice($roomTypeData['price']);
                    $roomType->setSurface($roomTypeData['surface']);
                    $manager->persist($roomType);

                    // Create images for each room type
                    $image = new Image();
                    $image->setHotel($newHotel);
                    $image->setRoomType($roomType);
                    $image->setUrl('https://example.com/hotels/' . strtolower(str_replace(' ', '-', $newHotel->getName())) . '/room-' . $roomType->getId() . '.jpg');
                    $image->setAltText($roomType->getDescription());
                    $image->setIsMain(true);
                    $manager->persist($image);
                }
            }
        }

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


        // Payment
        $payment = new Payment();
        $payment->setBooking($booking);
        $payment->setUser($user);
        $payment->setAmount($booking->getPrice());
        $payment->setPaymentMethod('carte');
        $payment->setStatus('completed');
        $payment->setTransactionId('TXN-' . uniqid());
        $payment->setPaidAt(new \DateTimeImmutable('2025-04-15 10:30:00'));
        $manager->persist($payment);

        $manager->flush();


        $manager->flush();
    }
}
