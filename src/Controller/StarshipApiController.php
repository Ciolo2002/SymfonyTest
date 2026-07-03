<?php

namespace App\Controller;

use App\Model\Starship;
use App\Repositories\StarshipRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StarshipApiController extends AbstractController
{

    #[Route('/api/starships', name: 'api_starships')]
    public function getAll(StarshipRepository $starshipRepository):Response
    {

        return $this->json($starshipRepository->all());
    }

    #[Route('/api/starships/{id<\d+>}', name: 'api_starship', methods: ['GET'])]
    public function getOne(StarshipRepository $starshipRepository, int $id):Response{
        $starship = $starshipRepository->find($id);
        if(!$starship){
            throw $this->createNotFoundException("Starship with id $id not found"); //returns 404
        }
        return $this->json($starship);
    }

}