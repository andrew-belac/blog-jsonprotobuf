<?php

namespace App\Benchmark\Dtos;

class PackageDto
{
    public function __construct(
        public string $barcode,
        public float $weight,
        public float $volume,
        public float $length,
        public float $width,
        public float $height
    )
    {}
}
