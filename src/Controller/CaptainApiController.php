<?php

namespace App\Controller;

use App\Entity\Captain;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/captains')]
class CaptainApiController extends AbstractController
{
    #[Route('', name: 'api_captain_create', methods: ['POST'])]
    public function create(
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ): Response {
        $captain = new Captain();
        $captain->setName('Jean-Luc Picard');

        $entityManager->persist($captain);
        $entityManager->flush();

        $logger->info(sprintf(
            'Captain created with id %d',
            $captain->getId()
        ));

        return $this->json($captain, Response::HTTP_CREATED);
    }
}