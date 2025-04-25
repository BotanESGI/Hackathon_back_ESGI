<?php

namespace App\Controller;

use App\Service\MeilisearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HotelSearchController extends AbstractController
{
    private MeilisearchService $meilisearchService;

    public function __construct(MeilisearchService $meilisearchService)
    {
        $this->meilisearchService = $meilisearchService;
    }

    #[Route('/api/hotels/search', name: 'api_hotels_search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        $query = $request->query->get('q', '');
        $stars = $request->query->get('stars');
        $location = $request->query->get('location');

        $filters = [];
        if ($stars) {
            $filters[] = "stars = $stars";
        }
        if ($location) {
            $filters[] = "location = '$location'";
        }

        $results = $this->meilisearchService->searchHotels($query, $filters);

        return $this->json([
            'results' => $results
        ]);
    }
} 