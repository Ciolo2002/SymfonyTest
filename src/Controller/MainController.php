<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repositories\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function index(StarshipRepository $starshipRepository): Response
    {

        $ships=$starshipRepository->all();
        return $this->render('main/index.html.twig', compact('ships'));
    }
}