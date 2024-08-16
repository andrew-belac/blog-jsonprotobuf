<?php

namespace App\Benchmark\Dtos;

class TripSerializationProtosResultRecord
{
    public function __construct(public string $json, public float $duration)
    {}
}
