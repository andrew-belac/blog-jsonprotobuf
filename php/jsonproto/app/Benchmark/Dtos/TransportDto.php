<?php

namespace App\Benchmark\Dtos;

use Carbon\CarbonImmutable;
use DateTimeImmutable;

class TransportDto
{
    public function __construct(
        public string $id,
        public string $code,
        public string $externalId,
        public DateTimeImmutable|CarbonImmutable $plannedStartAt,
        public DateTimeImmutable|CarbonImmutable $plannedEndAt,
        public DateTimeImmutable|CarbonImmutable $actualStartedAt,
        public DateTimeImmutable|CarbonImmutable $actualEndedAt,
        public float $cost,
        public float $travelTime,
        /** @var PackageDto[] $packages */
        public array $packages,
    )
    {}
}
