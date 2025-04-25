<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\OpenApi\Model;
use App\Service\MeilisearchService;
use Symfony\Component\HttpFoundation\Request;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/hotels/search',
            provider: [SearchResult::class, 'provide']
        )
    ]
)]
class SearchResult
{
    public function __construct(
        public array $results = []
    ) {
    }

    public static function provide(Operation $operation, array $uriVariables = [], array $context = []): self
    {
        /** @var Request $request */
        $request = $context['request'];
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

        /** @var MeilisearchService $meilisearchService */
        $meilisearchService = $context['meilisearch_service'];
        $results = $meilisearchService->searchHotels($query, $filters);

        return new self($results);
    }
} 