<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Starship;
use App\Form\StarshipType;
use App\Repositories\StarshipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(StarshipRepository $starshipRepository): Response
    {
        $ships=$starshipRepository->findAll();
        return $this->render('main/index.html.twig', compact('ships'));
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function starShipForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        $starship = new Starship();
        $form = $this->createForm(StarshipType::class, $starship);

        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($starship);
                $entityManager->flush();
                return $this->redirectToRoute('index');
            }
        }

        return $this->render('ship/starShipForm.html.twig', ['form' => $form->createView()]);
    }
}