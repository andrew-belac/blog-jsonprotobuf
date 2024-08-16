<?php

namespace App\Benchmark\Dtos;

use Carbon\CarbonImmutable;
use DateTimeImmutable;

class TripDto
{
    public function __construct(
        public DateTimeImmutable|CarbonImmutable $createdAt,
        public DateTimeImmutable|CarbonImmutable $updatedAt,
        public string $id,
        public string $code,
        public string $externalId,
        public string $department,
        public string $driverName,
        public string $driverMobile,
        public string $vehicleRegistration,
        public string $vehicleType,
        public DateTimeImmutable|CarbonImmutable $plannedStartAt,
        public DateTimeImmutable|CarbonImmutable $plannedEndAt,
        public DateTimeImmutable|CarbonImmutable $actualStartedAt,
        public DateTimeImmutable|CarbonImmutable $actualEndedAt,
        public TripStatusEnum $status,
        /** @var TransportDto $transports */
        public array $transports,
    )
    {}
}
