<?php

namespace App\Service;

use Meilisearch\Client;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hotel;

class MeilisearchService
{
    private Client $client;
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        string $meilisearchHost,
        string $meilisearchKey
    ) {
        $this->client = new Client(
            $meilisearchHost,
            $meilisearchKey
        );
        $this->entityManager = $entityManager;
    }

    public function createHotelIndex(): void
    {
        $index = $this->client->index('hotels');
        
        // Configure searchable attributes
        $index->updateSearchableAttributes([
            'name',
            'location',
            'description'
        ]);

        // Configure filterable attributes
        $index->updateFilterableAttributes([
            'stars',
            'location'
        ]);

        // Configure sortable attributes
        $index->updateSortableAttributes([
            'stars',
            'name'
        ]);
    }

    public function indexHotels(): void
    {
        $hotels = $this->entityManager->getRepository(Hotel::class)->findAll();
        $documents = [];

        foreach ($hotels as $hotel) {
            $documents[] = [
                'id' => $hotel->getId(),
                'name' => $hotel->getName(),
                'location' => $hotel->getLocation(),
                'description' => $hotel->getDescription(),
                'stars' => $hotel->getStars(),
                'lat' => $hotel->getLat(),
                'lng' => $hotel->getLng()
            ];
        }

        $this->client->index('hotels')->addDocuments($documents);
    }

    public function searchHotels(string $query, array $filters = []): array
    {
        $index = $this->client->index('hotels');
        
        $searchParams = [
            'filter' => $filters
        ];

        return $index->search($query, $searchParams)->getHits();
    }
} 