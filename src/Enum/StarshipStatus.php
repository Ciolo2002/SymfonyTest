<?php

namespace App\Enum;

enum StarshipStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DESTROYED = 'destroyed';
}