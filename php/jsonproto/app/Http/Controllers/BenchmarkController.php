<?php

namespace App\Http\Controllers;

use App\Benchmark\BenchmarkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class BenchmarkController extends Controller
{
    public function __construct(
        private BenchmarkService $benchmarkService
    )
    {
    }

    public function create(int $size): JsonResponse
    {
        $trip = $this->benchmarkService->createTrip($size);
        return response()->json($this->benchmarkService->tripToArray($trip));
    }

    /**
     * @throws ExceptionInterface
     */
    public function unshaped(int $size, int $iters): Response
    {
        $serializationTime = 0.0;
        $deSerializationTime = 0.0;

        for ($i = 0; $i < $iters; $i++) {
            $result = $this->benchmarkService->runUnShapedSerialization($this->benchmarkService->createTrip($size));
            $serializationTime += $result->duration;
            $deSerializationTime += $this->benchmarkService->runUnShapedDeSerialization($result->json);
            unset($result);
        }

        return response("serialize time $serializationTime deserialize time $deSerializationTime");

    }

    public function shaped(int $size, int $iters): Response
    {
        $serializationTime = 0.0;
        $deSerializationTime = 0.0;

        for ($i = 0; $i < $iters; $i++) {
            $result = $this->benchmarkService->runShapedSerialization($this->benchmarkService->createTrip($size));
            $serializationTime += $result->duration;
            $deSerializationTime += $this->benchmarkService->runShapedDeSerialization($result->json);
            unset($result);
        }

        return response("serialize time $serializationTime deserialize time $deSerializationTime");
    }

    public function shapedCarbon(int $size, int $iters): Response
    {
        $serializationTime = 0.0;
        $deSerializationTime = 0.0;

        for ($i = 0; $i < $iters; $i++) {
            $result = $this->benchmarkService->runShapedSerialization($this->benchmarkService->createTrip($size, true));
            $serializationTime += $result->duration;
            $deSerializationTime += $this->benchmarkService->runShapedDeSerialization($result->json);
            unset($result);
        }

        return response("serialize time $serializationTime deserialize time $deSerializationTime");
    }

    /**
     * @throws ExceptionInterface
     * @throws \Exception
     */
    public function proto(int $size, int $iters): Response
    {
        $serializationTime = 0.0;
        $deSerializationTime = 0.0;

        for ($i = 0; $i < $iters; $i++) {
            $result = $this->benchmarkService->runProtoSerialization($this->benchmarkService->createProtoTrip($size));
            $serializationTime += $result->duration;
            $deSerializationTime += $this->benchmarkService->runProtoDeSerialization($result->json);
            unset($result);
        }

        return response("serialize time $serializationTime deserialize time $deSerializationTime");
    }

    /**
     * @throws ExceptionInterface
     * @throws \Exception
     */
    public function protoJson(int $size, int $iters): Response
    {
        $serializationTime = 0.0;
        $deSerializationTime = 0.0;

        for ($i = 0; $i < $iters; $i++) {
            $result = $this->benchmarkService->runProtoJsonSerialization($this->benchmarkService->createProtoTrip($size));
            $serializationTime += $result->duration;
            $deSerializationTime += $this->benchmarkService->runProtoJsonDeSerialization($result->json);
            unset($result);
        }

        return response("serialize time $serializationTime deserialize time $deSerializationTime");
    }
}
