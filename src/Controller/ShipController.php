<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repositories\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShipController extends AbstractController
{
    #[Route('/ship/{id<\d+>}', name: 'ship', methods: ['GET'])]
    public function index(StarshipRepository $starshipRepository, int $id): Response
    {
        $ship= $starshipRepository->find($id);
        return $this->render('ship/index.html.twig', compact('ship'));
    }
}