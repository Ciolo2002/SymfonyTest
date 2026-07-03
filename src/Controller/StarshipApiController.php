<?php

namespace App\Controller;

use App\Model\Starship;
use App\Repositories\StarshipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/starships')]
class StarshipApiController extends AbstractController
{

    #[Route('/', name: 'api_starships' , methods: ['GET'])]
    public function getAll(StarshipRepository $starshipRepository):Response
    {
        return $this->json($starshipRepository->findAll(),Response::HTTP_OK,[],['groups' => ['starship:read']]);
    }

    #[Route('/{id<\d+>}', name: 'api_starship_get', methods: ['GET'])]
    public function getOne(StarshipRepository $starshipRepository, int $id):Response{
        $starship = $starshipRepository->findBy(['id'=>$id]);
        if(!$starship){
            throw $this->createNotFoundException("Starship with id $id not found"); //returns 404
        }
        return $this->json($starship, Response::HTTP_OK,[],['groups' => ['starship:read']]);
    }

    #[Route('', name: 'api_starship', methods: ['POST'])]
    public function postOne(EntityManagerInterface $entityManager, LoggerInterface $logger, Request $request):Response{
        $starship = new \App\Entity\Starship();
        $starship->setName('New Starship');
        $starship->setClass('New Class');


        $captain = $entityManager->getRepository(\App\Entity\Captain::class)->find($request->request->get('captain_id'));
        if(!$captain){
            throw $this->createNotFoundException("Captain not found");
        }
        $starship->setCaptain($captain);
        $starship->setStatus(\App\Enum\StarshipStatus::ACTIVE);
        $starship->setArrivedAt(new \DateTimeImmutable());
        $entityManager->persist($starship);
        $entityManager->flush();
        $logger->info("New starship created with id ".$starship->getId());
        return $this->json($starship, Response::HTTP_CREATED,[],['groups' => ['starship:read']]);
    }

    #[Route('/{id<\d+>}', name: 'api_starship_delete', methods: ['DELETE'])]
    public function deleteOne(EntityManagerInterface $entityManager, LoggerInterface $logger, int $id):Response
    {
        $starship = $entityManager->getRepository(\App\Entity\Starship::class)->find($id);
        if (!$starship) {
            throw $this->createNotFoundException("Starship with id $id not found"); //returns 404
        }
        $entityManager->remove($starship);
        $entityManager->flush();
        $logger->info("Starship deleted with id " . $id);
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

}