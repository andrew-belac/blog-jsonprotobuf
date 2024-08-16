<?php

namespace App\Benchmark\Dtos;

enum TripStatusEnum : string
{
    case CREATED = 'CREATED';
    case PLANNING = 'PLANNING';
    case PLANNED = 'PLANNED';
    case IN_PROGRESS = 'IN_PROGRESS';
    case COMPLETED = 'COMPLETED';
    case CANCELLED = 'CANCELLED';
}
