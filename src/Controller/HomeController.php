<?php
namespace App\Controller;

use App\Repository\TagRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{

    #[Route('/home', name: 'home_page')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
        ]);
    }
}
