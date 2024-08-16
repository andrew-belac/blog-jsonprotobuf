<?php

namespace App\Benchmark\Dtos;

class TripSerializationResultRecord
{
    public function __construct(public string $json, public float $duration)
    {}
}
