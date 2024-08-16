<?php

namespace App\Benchmark;

use App\Benchmark\Dtos\PackageDto;
use App\Benchmark\Dtos\TransportDto;
use App\Benchmark\Dtos\TripDto;
use App\Benchmark\Dtos\TripSerializationResultRecord;
use App\Benchmark\Dtos\TripStatusEnum;
use Benchmark\Package;
use Benchmark\Transport;
use Benchmark\Trip;
use Carbon\CarbonImmutable;
use DateTimeImmutable;
use Google\Protobuf\Timestamp;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Uid\Uuid;
use Illuminate\Support\Str;

class BenchmarkService
{

    /** @var TripStatusEnum[] $allStatus */
    private array $allStatuses;

    private int $allStatusesSize;

    public function __construct(
        private Serializer $serializer
    )
    {
        $this->allStatuses = TripStatusEnum::cases();
        $this->allStatusesSize = count($this->allStatuses);
    }

    /**
     * @throws ExceptionInterface
     */
    public function tripToArray(TripDto $tripDto): array
    {
        return $this->serializer->normalize($tripDto, 'json');
    }

    public function runShapedSerialization(TripDto $tripDto) : TripSerializationResultRecord
    {
        $start = CarbonImmutable::now();
        $tripJson = $this->serializer->serialize($tripDto, 'json');
        return new TripSerializationResultRecord($tripJson, $start->diffInMicroseconds(CarbonImmutable::now()));
    }

    public function runShapedDeSerialization(string $tripString) : int
    {
        $start = CarbonImmutable::now();
        $tripDto = $this->serializer->deserialize($tripString, TripDto::class, 'json');
        return $start->diffInMicroseconds(CarbonImmutable::now());
    }

    /**
     * @throws ExceptionInterface
     */
    public function runUnShapedSerialization(TripDto $tripDto) : TripSerializationResultRecord
    {
        $tripArray = $this->serializer->normalize($tripDto);
        $start = CarbonImmutable::now();
        $tripJson = json_encode($tripArray);
        return new TripSerializationResultRecord($tripJson, $start->diffInMicroseconds(CarbonImmutable::now()));
    }

    public function runUnShapedDeSerialization(string $tripString) : int {
        $start = CarbonImmutable::now();
        $tripArray = json_decode($tripString, true);
        return $start->diffInMicroseconds(CarbonImmutable::now());
    }

    /**
     * @throws ExceptionInterface
     */
    public function runProtoSerialization(Trip $trip) : TripSerializationResultRecord
    {
        $start = CarbonImmutable::now();
        $protoBinary = $trip->serializeToString();
        return new TripSerializationResultRecord($protoBinary, $start->diffInMicroseconds(CarbonImmutable::now()));
    }

    /**
     * @throws \Exception
     */
    public function runProtoDeSerialization(string $protoString) : int {
        $trip = new Trip();
        $start = CarbonImmutable::now();
        $trip->mergeFromString($protoString);
        return $start->diffInMicroseconds(CarbonImmutable::now());
    }

    /**
     * @throws ExceptionInterface
     */
    public function runProtoJsonSerialization(Trip $trip) : TripSerializationResultRecord
    {
        $start = CarbonImmutable::now();
        $protoBinary = $trip->serializeToJsonString();
        return new TripSerializationResultRecord($protoBinary, $start->diffInMicroseconds(CarbonImmutable::now()));
    }

    /**
     * @throws \Exception
     */
    public function runProtoJsonDeSerialization(string $protoString) : int {
        $trip = new Trip();
        $start = CarbonImmutable::now();
        $trip->mergeFromJsonString($protoString);
        return $start->diffInMicroseconds(CarbonImmutable::now());
    }


    public function createTrip(int $size, bool $useCarbon = false): TripDto
    {
        return new TripDto(
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            Uuid::v4()->toRfc4122(),
            Str::random(8),
            Str::random(4),
            Str::random(8),
            Str::random(10),
            Str::random(10),
            Str::random(7),
            Str::random(6),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            $this->getRandomStatus(),
            $this->createTransports($size, $useCarbon)
        );
    }

    public function createProtoTrip(int $size): Trip
    {
        $trip = new Trip();
        $trip->setCreatedAt($this->createProtoTimeStamp());
        $trip->setUpdatedAt($this->createProtoTimeStamp());
        $trip->setId(Uuid::v4()->toRfc4122());
        $trip->setCode(Str::random(8));
        $trip->setExternalId(Str::random(4));
        $trip->setDepartment(Str::random(8));
        $trip->setDriverName(Str::random(10));
        $trip->setDriverMobile(Str::random(10));
        $trip->setVehicleRegistration(Str::random(7));
        $trip->setVehicleType(Str::random(6));
        $trip->setPlannedStartAt($this->createProtoTimeStamp());
        $trip->setPlannedEndAt($this->createProtoTimeStamp());
        $trip->setActualStartAt($this->createProtoTimeStamp());
        $trip->setActualEndAt($this->createProtoTimeStamp());
        $trip->setStatus(random_int(0, 5));
        $trip->setTransports($this->createProtoTransports($size));
        return $trip;
    }


    /**
     * @return TransportDto[]
     * @throws \Exception
     */
    private function createTransports(int $size, bool $useCarbon): array
    {
        $i = 0;
        $out = [];
        while ($i < $size) {
            $i++;
            $out[] = $this->createTransportDto($useCarbon);
        }
        return $out;
    }

    /**
     * @return Transport[]
     * @throws \Exception
     */
    private function createProtoTransports(int $size): array
    {
        $i = 0;
        $out = [];
        while ($i < $size) {
            $i++;
            $out[] = $this->createProtoTransport();
        }
        return $out;
    }

    /**
     * @throws \Exception
     */
    private function createTransportDto(bool $useCarbon = false): TransportDto
    {
        return new TransportDto(
            Str::random(16),
            Str::random(16),
            Str::random(32),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            $useCarbon ? CarbonImmutable::now() : new DateTimeImmutable(),
            random_int(1, 10000000),
            random_int(1, 1000),
            $this->createPackages(10)
        );
    }

    private function createProtoTransport(): Transport
    {
        $transport = new Transport();
        $transport->setId(Str::random(16));
        $transport->setCode(Str::random(16));
        $transport->setExternalId(Str::random(32));
        $transport->setPlannedStartAt($this->createProtoTimeStamp());
        $transport->setPlannedEndAt($this->createProtoTimeStamp());
        $transport->setActualStartAt($this->createProtoTimeStamp());
        $transport->setActualEndAt($this->createProtoTimeStamp());
        $transport->setCost(random_int(1, 10000000));
        $transport->setTravelTime(random_int(1, 1000));
        $transport->setPackages($this->createProtoPackages(10));
        return $transport;
    }

    /**
     *
     * @return PackageDto[]
     * @throws \Exception
     */
    private function createPackages(int $num): array
    {
        for ($i = 0; $i < $num; $i++) {
            $out[] = $this->createPackageDto();
        }
        return $out;
    }

    /**
     * @return Package[]
     */
    private function createProtoPackages(int $num): array
    {
        $packages = [];
        for ($i = 0; $i < $num; $i++) {
            $out[] = $this->createProtoPackage();
        }
        return $out;
    }

private function createPackageDto(): PackageDto
{
    return new PackageDto(
        Str::random(8),
        floatval(random_int(1, 10000)),
        floatval(random_int(1, 10000)),
        floatval(random_int(1, 10000)),
        floatval(random_int(1, 100000)),
        floatval(random_int(1, 100000)),
    );
}

    private function createProtoPackage(): Package
    {
        $package = new Package();
        $package->setBarcode(Str::random(8));
        $package->setWeight(floatval(random_int(1, 10000)));
        $package->setVolume(floatval(random_int(1, 10000)));
        $package->setLength(floatval(random_int(1, 10000)));
        $package->setWidth(floatval(random_int(1, 100000)));
        $package->setHeight(floatval(random_int(1, 100000)));
        return $package;
    }

    private function getRandomStatus(): TripStatusEnum
    {
        return $this->allStatuses[rand(0, $this->allStatusesSize - 1)];
    }
    private function getProtoRandomStatus(): TripStatusEnum
    {
        return $this->allStatuses[rand(0, $this->allStatusesSize - 1)];
    }



    private function createProtoTimeStamp(): Timestamp
    {
        $microtimeString = microtime(false);

        list($microseconds, $seconds) = explode(' ', $microtimeString);

        $milliseconds = intval($microseconds * 1000);
        $t = new Timestamp();
        $t->setSeconds(time());
        $t->setNanos($milliseconds);
        return $t;
    }
}
