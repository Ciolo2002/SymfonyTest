<?php

namespace App\Repositories;

use App\Model\Starship;
use Psr\Log\LoggerInterface;

class StarshipRepository
{

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function all(): array
    {
        $this->logger->info("Starships get all");
        return [
            1 => new Starship(1, 'Millennium Falcon'),
            2 => new Starship(2, 'X-Wing'),
            3 => new Starship(3, 'TIE Fighter'),
        ];
    }

    public function find(int $id): ?Starship{
        foreach ($this->all() as $starship){
            if ($starship->getId() === $id){
                return $starship;
            }
        }
        return null;
    }
}